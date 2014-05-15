<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Sklanjanje komentara
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {
 unset($tabs['reviews']);
 return $tabs;
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
                <ul id="collapsable">
                <?php
                if( has_nav_menu( 'sub-header-menu', 'responsive' ) ) { ?>
			<?php wp_nav_menu( array(
			'container'      => '',
			'menu_class'     => 'sub-header-menu',
			'theme_location' => 'sub-header-menu'
		));
		}
                ?>
                </ul>
            </div>
        </div>
    <?php
    }
    else{
        //Nakon toga decu iliti meni koji cemo i ispisati
        $nav_meni = get_children($root);
        if (!empty($nav_meni)){
        //Provlacimo kroz for each petlju i ako nema postavljen Order,stavljamo mu ID kao isti. Dodeljujemo li i a tagove zbog linka
            foreach ($nav_meni as $nav){
                //Ako vrednost nije postavljena iliti jednaka je 0, kao vrednost stavljamo ID
                if ($nav->menu_order == 0)
                   $write[$nav->ID] = "<li><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                //Ako je postavljena i ako postoji vec ta vrednost, dodajemo joj vrednost ID-a u decimali
                elseif (isset($write[$nav->menu_order]))
                    $write[$nav->menu_order."+0.".$nav->ID] = "<li><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                //U suprotnom, dodajemo joj samo vrednost iz Page ordera i tako i sortiramo
                else 
                    $write[$nav->menu_order] = "<li><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
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
