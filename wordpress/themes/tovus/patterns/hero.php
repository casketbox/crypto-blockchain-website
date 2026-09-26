<?php
/**
 * Title: ヒーロー（パララックス）
 * Slug: tovus/hero
 * Categories: tovus, banner
 * Description: 3枚の画像レイヤーが奥行きをもって動くトップのヒーロー。
 * Viewport Width: 1400
 *
 * @package tovus
 */

$tovus_img = get_theme_file_uri( 'assets/images/' );
?>
<!-- wp:group {"align":"full","className":"site-hero","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull site-hero">
	<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"site-hero-layer site-hero-layer--back"} -->
	<figure class="wp-block-image size-full site-hero-layer site-hero-layer--back"><img src="<?php echo esc_url( $tovus_img . 'plate-back.jpg' ); ?>" alt=""/></figure>
	<!-- /wp:image -->

	<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"site-hero-layer site-hero-layer--mid"} -->
	<figure class="wp-block-image size-full site-hero-layer site-hero-layer--mid"><img src="<?php echo esc_url( $tovus_img . 'plate-mid.jpg' ); ?>" alt=""/></figure>
	<!-- /wp:image -->

	<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"site-hero-layer site-hero-layer--front"} -->
	<figure class="wp-block-image size-full site-hero-layer site-hero-layer--front"><img src="<?php echo esc_url( $tovus_img . 'hero-subject.png' ); ?>" alt=""/></figure>
	<!-- /wp:image -->

	<!-- wp:group {"className":"site-hero-content","layout":{"type":"default"}} -->
	<div class="wp-block-group site-hero-content">
		<!-- wp:paragraph {"className":"site-kicker site-reveal"} -->
		<p class="site-kicker site-reveal">信頼は、分散する。</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"className":"site-hero-title site-reveal"} -->
		<h1 class="wp-block-heading site-hero-title site-reveal">分散された信頼が、<br>価値を動かす。</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"site-hero-sub site-reveal"} -->
		<p class="site-hero-sub site-reveal">ブロックチェーンと暗号通貨のしくみを、はじめから丁寧に。</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"site-reveal"} -->
		<div class="wp-block-buttons site-reveal">
			<!-- wp:button {"className":"is-style-coin"} -->
			<div class="wp-block-button is-style-coin"><a class="wp-block-button__link wp-element-button" href="#blockchain">くわしく見る</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
