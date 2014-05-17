<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages Template
 *
 *
 * @file           page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>
<?php //get_responsive_breadcrumb_lists();?>
    <?php if (!is_product()):?>
        <div class="grid col-940">
            <div id="breadcrumb">
                <?php woocommerce_breadcrumb(); ?>
            </div>

            <div class="grid col-620 right">
        <?php woocommerce_content(); ?>     
            </div>
            <div class="grid col-300 fit left-sidebar">
                <div id="shop-left-sidebar-categories">
                    <?php dynamic_sidebar('shopleftsidebar') ?>
                </div>
            </div>
    <?php else: ?>
        <div class="grid col-940">
            <div id="content">
                <div id="breadcrumb">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            <?php woocommerce_content(); ?>     
            </div>
    <?php endif; ?>
    </div>
<?php get_footer(); ?>
