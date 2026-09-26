<?php
/**
 * tovus theme setup.
 *
 * @package tovus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TOVUS_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Google Fonts URL shared by the front end and the editor.
 */
function tovus_fonts_url() {
	return 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&family=IBM+Plex+Mono:wght@400;500;600&display=swap';
}

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'editor-styles' );
		add_editor_style( array( tovus_fonts_url(), 'assets/css/theme.css' ) );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'tovus-fonts', tovus_fonts_url(), array(), null );
		wp_enqueue_style(
			'tovus-theme',
			get_theme_file_uri( 'assets/css/theme.css' ),
			array( 'tovus-fonts' ),
			TOVUS_VERSION
		);
		wp_enqueue_script(
			'tovus-parallax',
			get_theme_file_uri( 'assets/js/parallax.js' ),
			array(),
			TOVUS_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
);

add_action(
	'wp_head',
	function () {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
		echo '<meta name="theme-color" content="#10142b">' . "\n";
	},
	1
);

add_action(
	'init',
	function () {
		register_block_pattern_category(
			'tovus',
			array( 'label' => __( 'tovus', 'tovus' ) )
		);

		// ボタンのバリエーション（ブロックの「スタイル」から選べます）。
		register_block_style(
			'core/button',
			array(
				'name'  => 'coin',
				'label' => __( 'コイン', 'tovus' ),
			)
		);
		register_block_style(
			'core/button',
			array(
				'name'  => 'stamp',
				'label' => __( 'スタンプ', 'tovus' ),
			)
		);
		register_block_style(
			'core/button',
			array(
				'name'  => 'chainlink',
				'label' => __( 'チェーンリンク', 'tovus' ),
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'  => 'card',
				'label' => __( 'カード', 'tovus' ),
			)
		);
	}
);
