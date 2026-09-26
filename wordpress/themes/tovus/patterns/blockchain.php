<?php
/**
 * Title: ブロックチェーンとは（テキスト＋図）
 * Slug: tovus/blockchain
 * Categories: tovus, text
 * Viewport Width: 1400
 *
 * @package tovus
 */

$tovus_img = get_theme_file_uri( 'assets/images/' );
?>
<!-- wp:group {"anchor":"blockchain","align":"full","className":"site-section","layout":{"type":"constrained","contentSize":"74rem"}} -->
<div id="blockchain" class="wp-block-group alignfull site-section">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"clamp(2rem, 5vw, 4rem)"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:heading {"className":"site-h2"} -->
			<h2 class="wp-block-heading site-h2">ブロックチェーンとは、書き換えられない記録の連なり</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>取引の記録を「ブロック」としてまとめ、時系列に鎖のようにつなげていく技術です。ひとつ前のブロックの内容をもとに次のブロックが作られるため、途中の記録をあとから書き換えることは極めて困難になります。</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p>管理者が一箇所にいるのではなく、ネットワークに参加する多数のコンピュータが同じ記録を共有し、たがいに検証し合うことで正しさを保っています。</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"site-figure"} -->
			<figure class="wp-block-image size-full site-figure"><img src="<?php echo esc_url( $tovus_img . 'diagram.jpg' ); ?>" alt="ブロックが鎖状につながるしくみを表した図"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
