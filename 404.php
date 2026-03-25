<?php
/**
 * トップページ
 *
 */
?>

<?php
get_header();
?>

<main>
	<section>
		<div class="sec_vertical">
			
			<div class="error-404 not-found">
				<h2 class="ttl_style03 txt_em">ページが見つかりません</h2>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', '' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
			
		</div>
	</section>
</main>

<?php
get_footer(); 
?>
