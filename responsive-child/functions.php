<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('include/top-widget.php');
//Sklanjanje komentara
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {
 unset($tabs['reviews']);
 return $tabs;
}
//Promena imena prve stavke u breadcumb u woocomercu iz Home u Shop
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text($defaults){
    // Change the breadcrumb home text from 'Home' to 'Appartment'
    $defaults['home']='Shop';
    return $defaults;
}
//Breadcrumb u prodavnici, kad se klikne na shop vodi u prodavnicu,a ne na homepage
add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url(){
    return get_permalink(woocommerce_get_page_id('shop'));
}


register_sidebar(array(
    'name' => 'Shop left sidebar',
    'id' => 'shopleftsidebar',
    'description' => 'Left Sidebar for Shop',
    'before_widget' => '<div class="widget-shop-left-sidebar">',
    'after_widget' => '</div>',
));
function get_root_parent($page_id) {
global $wpdb;
    $parent = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE post_type='page' AND ID = '$page_id'");
    if ($parent == 0) return $page_id;
    else return get_root_parent($parent);
}
function url_prepare($word){
    $t = strtr($word," ","-");
    return strtolower($t);
}
//Izlistava sve menije, za ime je potrebno uneti: Get_All_Wordpress_Menus()[0]->name
function Get_All_Wordpress_Menus(){
    return get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
}
//Izlistava sve podmenije jednog menija
function Get_sub_menus($name){
    return wp_get_nav_menu_items($name);
}
function nav_bar($page_id){
    //Izvlacimo pocetne roditelje
    $root = get_root_parent($page_id);
    $root_title = url_prepare(get_the_title($root));
    //Prvi meni
    $menus = Get_All_Wordpress_Menus()[0]->name;
    //Izlistavamo sve podmenije
    $sub_menus = Get_sub_menus($menus);
    //Drugi meni, za product
    $menu = Get_All_Wordpress_Menus()[1]->name;
    if (is_woocommerce()){
        ?> <div class="row" id="sub-nav">
            <div class="second-menu">
                <button type="button" id="second-menu-toggle" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> </button>
                
                <?php
                if( has_nav_menu( 'sub-header-menu', 'responsive' ) ) { ?>
			<?php wp_nav_menu( array(
			'container'      => '',
			'menu_class'     => 'sub-header-menu',
			'theme_location' => 'sub-header-menu'
		));
		}
                ?>
               
            </div>
        </div>
    <?php
    }
    else{
        //Nakon toga decu iliti meni koji cemo i ispisati
        $nav_meni = get_children($root);
        $svi_roditelji = get_post_ancestors($page_id); 
        $klasa_trenutna;
        if (!empty($nav_meni)){
        //Provlacimo kroz for each petlju i ako nema postavljen Order,stavljamo mu ID kao isti. Dodeljujemo li i a tagove zbog linka
            foreach ($nav_meni as $nav){
                //Proveravamo da li je izabran trenutni podmeni
                if ($nav->ID == $page_id || in_array($nav->ID, $svi_roditelji))
                    $klasa_trenutna = "class=current-menu-item";   
                    //Ako vrednost nije postavljena iliti jednaka je 0, kao vrednost stavljamo ID
                    if ($nav->menu_order == 0)
                       $write[$nav->ID] = "<li $klasa_trenutna><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                    //Ako je postavljena i ako postoji vec ta vrednost, dodajemo joj vrednost ID-a u decimali
                    elseif (isset($write[$nav->menu_order]))
                        $write[$nav->menu_order."+0.".$nav->ID] = "<li $klasa_trenutna><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                    //U suprotnom, dodajemo joj samo vrednost iz Page ordera i tako i sortiramo
                    else 
                        $write[$nav->menu_order] = "<li $klasa_trenutna><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                    $klasa_trenutna = "";
            }
            //Sortiramo od manjeg ka vecem i ispisujemo tako
            ksort ($write);
            ?>
            <div class="row" id="sub-nav">
                <div class="second-menu">
                    <button type="button" id="second-menu-toggle" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> </button>
                    <ul id="collapsable">
                        <?php
                        foreach ($write as $w)
                            $ispis .= $w;
                        echo $ispis;
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        }
    }
}
//Funkcija za izlistavanje side meni-a
function side_nav_menu($page_id){
    if(!is_woocommerce()){
        $svi_roditelji = get_post_ancestors($page_id); 
        end($svi_roditelji);
        $drugi = prev($svi_roditelji);
        //Ako ne postoji drugi, dodeljujemo mu vrednost
        if (empty($drugi))
            $drugi = $page_id;
        $args = array(
            'child_of' => $drugi,
            'depth' => 0,
            'sort_column' => 'post_date',
            'title_li'=> get_the_title($drugi),
            'echo' => 0,
        );
        //Dajemu mu izlistavanje
           $meni = wp_list_pages($args);
           echo "<div class='side_menu'>";
            echo $meni;
           echo '</div>';
    }
  }
	/* *************** SIDEBAR**************** */
	   /**
	    * Creates a sidebar
	    * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
	    */
	    $args = array(
	        'name'          => __( 'Events sidebar', 'theme_text_domain' ),
	        'id'            => 'events-sidebar',
	        'description'   => '',
	        'class'         => '',
	        'before_widget' => '<div class="event">',
	        'after_widget'  => '</div>',
	        'before_title'  => '<h2 class="widgettitle">',
	        'after_title'   => '</h2>'
	    );
	
	    register_sidebar( $args );

//Menja style u zavisnosti od trenutne stranice
function style($page_id){
    //Saznajemo koji je root stranice gde se nalazimo
    $pocetak = get_the_title(get_root_parent($page_id));
    //Izlistavamo sve menije
    $menus = Get_All_Wordpress_Menus()[0]->name;
    //Izlistavamo sve podmenije
    $sub_menus = Get_sub_menus($menus);
    //ako je naziv roota trenutne stranice isti sa imenom nekog podmenija, menjamo mu boju
    if ($pocetak == $sub_menus[2]->title)
        return "blue";
    elseif($pocetak == $sub_menus[1]->title)
        return "green";
    elseif(is_front_page())
        return "none_color";
    else {
        return 'red';
    }
}

//Uklanjanje Templajtova iz parent teme
add_filter( 'theme_page_templates', 'my_remove_page_template' );
    function my_remove_page_template( $pages_templates ) {
    unset($pages_templates['blog.php']);
    unset($pages_templates['blog-excerpt.php']);
    unset($pages_templates['content-sidebar-half-page.php']);
    unset($pages_templates['content-sidebar-page.php']);
    unset($pages_templates['sidebar-content-half-page.php']);
    unset($pages_templates['landing-page.php']);
    return $pages_templates;
}


function adding_custom_registration_fields( ) {

	//lets make the field required so that i can show you how to validate it later;
	$firstname = empty( $_POST['firstname'] ) ? '' : $_POST['firstname'];
	$lastname  = empty( $_POST['lastname'] ) ? '' : $_POST['lastname'];
	$address = empty( $_POST['address'] ) ? '' : $_POST['address'];
	$city = empty( $_POST['city'] ) ? '' : $_POST['city'];
	$state = empty( $_POST['state'] ) ? '' : $_POST['state'];
	$zip = empty( $_POST['zip'] ) ? '' : $_POST['zip'];
	$phone = empty( $_POST['phone'] ) ? '' : $_POST['phone'];
        
	?>
	<p class="form-row form-row-wide">
		<label for="reg_firstname"><?php _e( 'First Name', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="firstname" id="reg_firstname" size="30" value="<?php echo esc_attr( $firstname ) ?>" />
	</p>	<p class="form-row form-row-wide">

	<p class="form-row form-row-wide">
		<label for="reg_lastname"><?php _e( 'Last Name', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="lastname" id="reg_lastname" size="30" value="<?php echo esc_attr( $lastname ) ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_address"><?php _e( 'Adrress', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="address" id="reg_adrress" size="30" value="<?php echo esc_attr( $address ) ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_city"><?php _e( 'City', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="city" id="reg_city" size="30" value="<?php echo esc_attr( $city ) ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_state"><?php _e( 'State', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="state" id="reg_state" size="30" value="<?php echo esc_attr( $state ) ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_zip"><?php _e( 'ZIP', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="zip" id="reg_zip" size="30" value="<?php echo esc_attr( $zip ) ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_phone"><?php _e( 'Phone', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="phone" id="reg_phone" size="30" value="<?php echo esc_attr( $phone ) ?>" />
	</p>
 
            <?php
}

//Validation registration form  after submission using the filter registration_errors
add_filter( 'woocommerce_registration_errors', 'registration_errors_validation' );

/**
 * @param WP_Error $reg_errors
 *
 * @return WP_Error
 */
function registration_errors_validation( $reg_errors ) {

	if ( empty( $_POST['firstname'] ) || empty( $_POST['lastname']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['country']) || empty($_POST['zip']) || empty($_POST['phone'])) {
		$reg_errors->add( 'empty required fields', __( 'Please fill in the required fields.', 'woocommerce' ) );
	}

	return $reg_errors;
}

//Updating use meta after registration successful registration
add_action('woocommerce_created_customer','adding_extra_reg_fields');

function adding_extra_reg_fields($user_id) {
	extract($_POST);
	update_user_meta($user_id,'first_name', $firstname);
	update_user_meta($user_id,'last_name', $lastname);
	update_user_meta($user_id,'billing_first_name', $firstname);
	//update_user_meta($user_id, 'shipping_first_name', $firstname);
	update_user_meta($user_id,'billing_last_name', $lastname);
	//update_user_meta($user_id, 'shipping_last_name', $lastname);
        update_user_meta($user_id,'billing_address_1', $address);
        update_user_meta($user_id,'billing_address_2', $address2);
        update_user_meta($user_id,'billing_city',$city);
        update_user_meta($user_id,'billing_state',$state);
        update_user_meta($user_id,'billing_postcode',$zip);
        update_user_meta($user_id,'billing_phone',$phone);
        update_user_meta($user_id,'billing_country',$country);
}

/*
*****************REGISTER JQUERY***********
*/
function register_script_child(){
    wp_register_script( "jquery_child", get_stylesheet_directory_uri()."/js/jquery-1.11.1.min.js", null, true );
    wp_enqueue_script("jquery_child" );
    wp_enqueue_script( 'password-strength-meter' );
}
add_action("wp_enqueue_scripts", "register_script_child" );

