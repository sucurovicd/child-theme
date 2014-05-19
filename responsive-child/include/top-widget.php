<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets       
 */
class login_widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function login_widget() {
        $widget_ops = array( 'classname' => 'darko', 'description' => 'Top widget, login,register,cart' );
        $this->WP_Widget( 'darko', 'Login/Register widget', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;
        echo $before_title;
        echo $after_title;

    //
    // Widget display logic goes here
    //
        global $user_identity;
        global $woocommerce;
        $home_class = (is_front_page())? "home-page":""; ?>
        <a href="<?php echo $woocommerce->cart->get_cart_url();?>" class="<?php echo $home_class; ?>" title="<?php _e("Cart",'woothemes');?>"><?php _e("Cart",'woothemes')?></a> | 
        <?php if ( is_user_logged_in() ) { ?>
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="<?php echo $home_class?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
        | <a href="<?php echo wp_logout_url( home_url() ) ?>" class="<?php echo $home_class?>" title="Logout">Logout (<?php echo($user_identity);?>)</a>
        <?php }
        else { ?>
           <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="<?php echo $home_class?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>

         <?php }
    echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( ) );

        // display field names here using:
        // $this->get_field_id( 'option_name' ) - the CSS ID
        // $this->get_field_name( 'option_name' ) - the HTML name
        // $instance['option_name'] - the option value
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'login_widget' );" ) );      