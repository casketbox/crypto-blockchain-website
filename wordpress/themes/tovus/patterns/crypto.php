<?php
/**
 * Title: 暗号通貨とは（数字＋テキスト）
 * Slug: tovus/crypto
 * Categories: tovus, text
 * Viewport Width: 1400
 *
 * @package tovus
 */

$tovus_img = get_theme_file_uri( 'assets/images/' );
?>
<!-- wp:group {"anchor":"crypto","align":"full","className":"site-section","backgroundColor":"panel","layout":{"type":"constrained","contentSize":"74rem"}} -->
<div id="crypto" class="wp-block-group alignfull site-section has-panel-background-color has-background">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"clamp(2rem, 5vw, 4rem)"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"34%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:34%">
			<!-- wp:group {"className":"site-stat-rail","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"1.5rem"}}} -->
			<div class="wp-block-group site-stat-rail">
				<!-- wp:paragraph -->
				<p><strong>2009</strong>最初の暗号通貨が発行された年</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p><strong>24/7</strong>取引所も市場も止まらない</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p><strong>分散型</strong>単一の管理者を持たない</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:heading {"className":"site-h2"} -->
			<h2 class="wp-block-heading site-h2">暗号通貨は、鎖の上に生まれる新しい価値</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>ブロックチェーンに記録された残高や取引の履歴そのものが、暗号通貨の価値を裏づけています。国や銀行のような単一の発行主体を介さずに、参加者どうしが直接その価値をやり取りできる点が、これまでのお金の仕組みと大きく異なります。</p>
			<!-- /wp:paragraph -->
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"site-figure"} -->
			<figure class="wp-block-image size-full site-figure"><img src="<?php echo esc_url( $tovus_img . 'crypto.jpg' ); ?>" alt="鎖状に連なる発光するブロックのイメージ"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
