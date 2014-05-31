<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Full Content Template
 *
Template Name:  Slider_page_events
 *
 * @file           page-width-slider.php

 */

get_header(); ?>

<?php 
    echo do_shortcode("[metaslider id=39]"); 
?>

    <div id="content" class="<?php echo implode( ' ', responsive_get_content_classes() ); ?>">



        <?php if( have_posts() ) : ?>

            <?php while( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'loop-header' ); ?>

                <?php responsive_entry_before(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php responsive_entry_top(); ?>

                    <?php get_template_part( 'post-meta-page' ); ?>

                    <div class="post-entry">
                        <?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
                    </div>
                    <!-- end of .post-entry -->

                    <?php get_template_part( 'post-data' ); ?>

                    <?php responsive_entry_bottom(); ?>
                </div><!-- end of #post-<?php the_ID(); ?> -->
                <?php responsive_entry_after(); ?>

                <?php responsive_comments_before(); ?>
                <?php comments_template( '', true ); ?>
                <?php responsive_comments_after(); ?>

            <?php
            endwhile;

            get_template_part( 'loop-nav' );

        else :

            get_template_part( 'loop-no-posts' );

        endif;
        ?>

    </div><!-- end of #content -->
<div id="events-sidebar" class="grid col-220 fit"><?php dynamic_sidebar("events-sidebar"); ?></div>

<?php get_footer(); ?>
