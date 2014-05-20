<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sitemap Template
 *
Template Name: Sitemap
 *
 * @file           sitemap.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sitemap.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>
<?php 
global $woocommerce;
    $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
?>
<div id="content-sitemap" class="grid col-940">

	<?php get_template_part( 'loop-header' ); ?>

	<?php if( have_posts() ) : ?>

		<?php while( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="post-title"><?php the_title(); ?></h1>

				<div class="post-entry">
					<div id="widgets">
                                            <div class="widget-title"><h3><?php _e( 'Pages', 'responsive' ); ?></h3></div>
                                            <ul><?php wp_list_pages( "title_li=", "exclude=$myaccount_page_id,$cart_id,$checkout_id" ); ?></ul>
					</div>
					<!-- end of #widgets -->
					<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
				</div>
				<!-- end of .post-entry -->

				<div class="post-edit"><?php edit_post_link( __( 'Edit', 'responsive' ) ); ?></div>
			</div><!-- end of #post-<?php the_ID(); ?> -->

		<?php
		endwhile;

		get_template_part( 'loop-nav' );

	else :

		get_template_part( 'loop-no-posts' );

	endif;
	?>

</div><!-- end of #content-sitemap -->

<?php get_footer(); ?>
