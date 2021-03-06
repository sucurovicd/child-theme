<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Search Form Template
 *
 *
 * @file           searchform.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/searchform.php
 * @link           http://codex.wordpress.org/Function_Reference/get_search_form
 * @since          available since Release 1.0
 */
?>
<?php
    //Ako je trazena neka rec, da je upise u input
    $search_word = (isset($_GET['s']))? $_GET['s']: "";
    //Ako korisnik trazi proizvode, selectuje se isti
    $cc_selected = ($_GET['cc_search'] == 'products')? "selected='selected'": "";
?>
<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_attr_e( 'Search for:', 'responsive' ) ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'search here &hellip;', 'responsive' ); ?>" value="<?php echo $search_word?>"/>
        <select id="cc_search" name="cc_search">
            <option value="<?php esc_attr_e( 'pages', 'responsive' ); ?>" >Pages</option>
            <option value="<?php esc_attr_e( 'products', 'responsive' ); ?>" <?php echo $cc_selected?>>Products</option>
        </select>  
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Go', 'responsive' ); ?>" />
</form>