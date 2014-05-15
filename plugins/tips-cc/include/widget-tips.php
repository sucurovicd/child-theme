<?php 
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Tips_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function Tips_Widget() {
        $widget_ops = array( 'classname' => 'tips-golf', 'description' => 'Side bar widget tips' );
        $this->WP_Widget( 'tips-golf', 'Tips', $widget_ops );
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
        echo 'Tips'; // Can set this with a widget option, or omit altogether
        echo $after_title;

  $args = array(

                //Type & Status Parameters
                'post_type'   => 'tip',
                'post_status' => 'publish',

                //Order & Orderby Parameters
                
                'order'               => 'DESC',
                'orderby'             => 'date',
                

                
                
                //Pagination Parameters
                
                'posts_per_page'         => 4,
                'posts_per_archive_page' => 4,
                'nopaging'               => false,
                'paged'                  => get_query_var('paged'),
                'offset'                 => 0,

                //Parameters relating to caching
                'no_found_rows'          => false,
                'cache_results'          => true,
                'update_post_term_cache' => true,
                'update_post_meta_cache' => true,
                
                
            );
        
        $query = new WP_Query( $args );
    ?>
        <div class="tips">
        <?php
        while ($query->have_posts()) : $query->the_post(); ?>

            <?php echo the_content(); ?>
            <hr />

        <?php   
        
        endwhile; ?>
        </div>
            <?php
        wp_reset_postdata();

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
        $instance = wp_parse_args( (array) $instance, array() );

        // display field names here using:
        // $this->get_field_id( 'option_name' ) - the CSS ID
        // $this->get_field_name( 'option_name' ) - the HTML name
        // $instance['option_name'] - the option value
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'Tips_Widget' );" ) );



 ?>