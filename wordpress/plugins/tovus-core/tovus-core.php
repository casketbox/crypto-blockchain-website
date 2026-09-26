<?php
/**
 * Plugin Name:       tovus Core
 * Plugin URI:        https://tovus.jp/
 * Description:       tovus.jp の機能プラグイン。「用語集」投稿タイプ、有効化時の初期設定（トップページ・ブログページ・パーマリンク）、基本的なセキュリティ設定を追加します。
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      8.0
 * License:           GPL-2.0-or-later
 * Text Domain:       tovus-core
 *
 * @package tovus-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 「用語集」投稿タイプ（/glossary/）。
 */
function tovus_core_register_glossary() {
	register_post_type(
		'tovus_glossary',
		array(
			'labels'        => array(
				'name'               => '用語集',
				'singular_name'      => '用語',
				'menu_name'          => '用語集',
				'add_new'            => '新規追加',
				'add_new_item'       => '用語を追加',
				'edit_item'          => '用語を編集',
				'new_item'           => '新しい用語',
				'view_item'          => '用語を表示',
				'search_items'       => '用語を検索',
				'not_found'          => '用語が見つかりません',
				'not_found_in_trash' => 'ゴミ箱に用語はありません',
				'all_items'          => '用語一覧',
			),
			'public'        => true,
			'show_in_rest'  => true,
			'has_archive'   => 'glossary',
			'rewrite'       => array(
				'slug'       => 'glossary',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-book-alt',
			'menu_position' => 20,
			'supports'      => array( 'title', 'editor', 'excerpt', 'revisions' ),
		)
	);
}
add_action( 'init', 'tovus_core_register_glossary' );

/**
 * 用語集の一覧は 1 ページにすべて表示し、五十音（タイトル）順に並べる。
 */
add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'tovus_glossary' ) ) {
			$query->set( 'posts_per_page', 100 );
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
		}
	}
);

/**
 * 有効化時の初期設定。すでに設定済みの項目は上書きしない。
 */
function tovus_core_activate() {
	tovus_core_register_glossary();

	$home_id = tovus_core_ensure_page(
		'home',
		'ホーム',
		'<!-- wp:pattern {"slug":"tovus/front-page"} /-->',
		'page-landing'
	);
	$blog_id = tovus_core_ensure_page( 'blog', 'ブログ', '', '' );

	if ( 'posts' === get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		update_option( 'page_for_posts', $blog_id );
	}

	if ( '' === get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	if ( ! get_option( 'site_icon' ) ) {
		$icon_id = tovus_core_import_theme_image( 'site-icon-512.png', 'サイトアイコン' );
		if ( $icon_id ) {
			update_option( 'site_icon', $icon_id );
		}
	}

	if ( ! get_theme_mod( 'custom_logo' ) && ! get_option( 'site_logo' ) ) {
		$logo_id = tovus_core_import_theme_image( 'monogram-96.png', 'ロゴ' );
		if ( $logo_id ) {
			update_option( 'site_logo', $logo_id );
		}
	}

	tovus_core_seed_glossary();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'tovus_core_activate' );
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/**
 * 用語集が空のときだけ、基本の用語をいくつか登録する。
 */
function tovus_core_seed_glossary() {
	$has_terms = get_posts(
		array(
			'post_type'   => 'tovus_glossary',
			'post_status' => 'any',
			'numberposts' => 1,
			'fields'      => 'ids',
		)
	);
	if ( $has_terms ) {
		return;
	}

	$terms = array(
		'ブロック'           => '一定期間の取引データをひとまとめにした記録の単位。前のブロックのハッシュ値を含むことで、鎖のようにつながります。',
		'ハッシュ関数'         => '任意のデータから固定長の値（ハッシュ値）を計算する関数。元データが少しでも変わると値が大きく変わるため、改ざんの検出に使われます。',
		'秘密鍵'             => '暗号資産の持ち主であることを証明するための鍵。他人に知られると資産を移動されてしまうため、絶対に共有してはいけません。',
		'シードフレーズ'         => 'ウォレットを復元するための 12〜24 個の英単語の並び。秘密鍵と同じく、誰にも教えてはいけません。',
		'ウォレット'           => '暗号資産を管理するためのソフトウェアや機器。実際には資産そのものではなく、秘密鍵を保管しています。',
		'コンセンサスアルゴリズム' => 'ネットワークの参加者が、どのブロックを正しいとみなすかを決めるためのルール。PoW（プルーフ・オブ・ワーク）や PoS（プルーフ・オブ・ステーク）があります。',
	);
	foreach ( $terms as $title => $body ) {
		wp_insert_post(
			array(
				'post_type'    => 'tovus_glossary',
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_excerpt' => $body,
				'post_content' => '<!-- wp:paragraph --><p>' . esc_html( $body ) . '</p><!-- /wp:paragraph -->',
			)
		);
	}
}

/**
 * スラッグで固定ページを探し、なければ作成して ID を返す。
 *
 * @param string $slug     スラッグ。
 * @param string $title    タイトル。
 * @param string $content  本文。
 * @param string $template ページテンプレート（空なら既定）。
 * @return int
 */
function tovus_core_ensure_page( $slug, $title, $content, $template ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		return (int) $existing->ID;
	}
	$id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => $title,
			'post_content' => $content,
		)
	);
	if ( $id && ! is_wp_error( $id ) && $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	return is_wp_error( $id ) ? 0 : (int) $id;
}

/**
 * 有効なテーマの assets/images/ にある画像をメディアライブラリに取り込む。
 *
 * @param string $file  ファイル名。
 * @param string $title メディアのタイトル。
 * @return int 添付ファイル ID（失敗時は 0）。
 */
function tovus_core_import_theme_image( $file, $title ) {
	$path = get_theme_file_path( 'assets/images/' . $file );
	if ( ! file_exists( $path ) ) {
		return 0;
	}
	$upload = wp_upload_bits( $file, null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}
	$id = wp_insert_attachment(
		array(
			'post_mime_type' => wp_check_filetype( $upload['file'] )['type'],
			'post_title'     => $title,
			'post_status'    => 'inherit',
		),
		$upload['file']
	);
	if ( ! $id || is_wp_error( $id ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
	return (int) $id;
}

/*
 * 基本的なセキュリティ設定。
 */

// XML-RPC（ブルートフォース攻撃の標的になりやすい）を無効化。
add_filter( 'xmlrpc_enabled', '__return_false' );

// HTML から WordPress のバージョン表記を外す。
remove_action( 'wp_head', 'wp_generator' );

// ログインしていない利用者に REST API からユーザー一覧を見せない。
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( ! is_user_logged_in() ) {
			unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
		return $endpoints;
	}
);

// ?author=1 によるユーザー名の推測を防ぐ。
add_action(
	'template_redirect',
	function () {
		if ( ! is_admin() && isset( $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}
);
