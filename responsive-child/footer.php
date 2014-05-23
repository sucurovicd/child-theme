<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */

/*
 * Globalize Theme options
 */
global $responsive_options;
$responsive_options = responsive_get_options();
?>


<div id="footer" class="clearfix">
	<?php responsive_footer_top(); ?>

	<div id="footer-wrapper">

		<?php get_sidebar( 'footer' ); ?>

		<div class="grid col-940">
                    <div id="cc_subscribe" class="grid col-300">
                        <a href="<?php echo home_url()?>/my-account"><img src="<?php echo dirname(get_bloginfo('stylesheet_url'))?>/images/footer_new.png"><p>Sign up for our newsletter</p></a>
                    </div>
                    
			<div class="grid col-380 cc_footer_menu">
				<?php if( has_nav_menu( 'footer-menu', 'responsive' ) ) { ?>
					<?php wp_nav_menu( array(
										   'container'      => '',
										   'fallback_cb'    => false,
										   'menu_class'     => 'footer-menu',
										   'theme_location' => 'footer-menu'
									   )
					);
					?>
				<?php } ?>
			</div>
			<!-- end of col-540 -->

			<div class="grid col-220 fit">
				<?php //echo responsive_get_social_icons() ?>
			</div>
			<!-- end of col-380 fit -->

		</div>
		<!-- end of col-940 -->
                <div id="cc_signature" class="grid col-940">
                    <a href="http://www.codecrewdev.com">Design By: CodeCrewDev</a>
                </div>
	</div>
	<!-- end #footer-wrapper -->

	<?php responsive_footer_bottom(); ?>
</div><!-- end #footer -->
<?php responsive_footer_after(); ?>

<?php responsive_wrapper_bottom(); // after wrapper content hook ?>
</div><!-- end of #wrapper -->
<?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>

<?php wp_footer(); ?>
		<script type="text/javascript">
	$(document).ready(function(){
		


		var x = $(location).attr('pathname');
		if(x.indexOf("product") != -1){
			$("#menu-item-24").addClass("current-page-ancestor");
		}


	var resp = $('.main-nav ul li').css('float');
		
	if(resp == "left"){
	$('.sub-menu').hide()

}
if(resp == "right")
{
	$('.second-menu li').hover(function(){

		$(this).find('ul').stop().fadeToggle(400);
	});
}


	


	  $( 'body' ).on( 'keyup', 'input[name=password], input[name=password_retyped]',
        function( event ) {
            checkPasswordStrength(
                $('input[name=password]'),         // First password field
                $('input[name=password_retyped]'), // Second password field
                $('#password-strength'),           // Strength meter
                $('input[type=submit]'),           // Submit button
                ['black', 'listed', 'word']        // Blacklisted words
            );
        }
    );
});
</script>
<script>
	function checkPasswordStrength( $pass1,
                                $pass2,
                                $strengthResult,
                                $submitButton,
                                blacklistArray ) {
        var pass1 = $pass1.val();
    var pass2 = $pass2.val();
 
    // Reset the form & meter
    $submitButton.attr( 'disabled', 'disabled' );
        $strengthResult.removeClass( 'short bad good strong' );
 
    // Extend our blacklist array with those from the inputs & site data
    blacklistArray = blacklistArray.concat( wp.passwordStrength.userInputBlacklist() )
 
    // Get the password strength
    var strength = wp.passwordStrength.meter( pass1, blacklistArray, pass2 );
 
    // Add the strength meter results
    switch ( strength ) {
 
        case 2:
            $strengthResult.addClass( 'bad' ).html( pwsL10n.bad );
            break;
 
        case 3:
            $strengthResult.addClass( 'good' ).html( pwsL10n.good );
            break;
 
        case 4:
            $strengthResult.addClass( 'strong' ).html( pwsL10n.strong );
            break;
 
        case 5:
            $strengthResult.addClass( 'short' ).html( pwsL10n.mismatch );
            break;
 
        default:
            $strengthResult.addClass( 'short' ).html( pwsL10n.short );
 
    }
 
    // The meter function returns a result even if pass2 is empty,
    // enable only the submit button if the password is strong and
    // both passwords are filled up
    if ( 4 === strength && '' !== pass2.trim() ) {
        $submitButton.removeAttr( 'disabled' );
    }
 
    return strength;
}
 


  </script>
</body>
</html>