<?php
/**
 * Title: 最新の記事（3件）
 * Slug: tovus/latest-posts
 * Categories: tovus, query
 * Viewport Width: 1400
 *
 * @package tovus
 */

?>
<!-- wp:group {"anchor":"articles","align":"full","className":"site-section","backgroundColor":"panel","layout":{"type":"constrained","contentSize":"74rem"}} -->
<div id="articles" class="wp-block-group alignfull site-section has-panel-background-color has-background">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"},"style":{"spacing":{"margin":{"bottom":"2.5rem"}}}} -->
	<div class="wp-block-group" style="margin-bottom:2.5rem">
		<!-- wp:heading {"className":"site-h2"} -->
		<h2 class="wp-block-heading site-h2">学びの記事</h2>
		<!-- /wp:heading -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-chainlink"} -->
			<div class="wp-block-button is-style-chainlink"><a class="wp-block-button__link wp-element-button" href="/blog/">すべての記事</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<!-- wp:query {"queryId":10,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"site-post-grid","layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
			<!-- wp:group {"className":"is-style-card","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.75rem"}}} -->
			<div class="wp-block-group is-style-card">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"10px"}}} /-->
				<!-- wp:post-date /-->
				<!-- wp:post-title {"level":3,"isLink":true} /-->
				<!-- wp:post-excerpt {"excerptLength":40} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p>記事は準備中です。</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
