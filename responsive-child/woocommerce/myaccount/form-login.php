<?php
/**
 * Form Login
 *
 *
 * @file           form-login.php
 * @package        Responsive-Child
 * @author         CodeCrewDev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="col2-set" id="customer_login">

    <div class="col-1">

<?php endif; ?>
    <h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

    <form method="post" class="login">

        <?php do_action( 'woocommerce_login_form_start' ); ?>
	<p class="form-row form-row-wide">
            <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="username" id="username" />
        </p>
        <p class="form-row form-row-wide">
            <label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input class="input-text" type="password" name="password" id="password" />
	</p>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<p class="form-row">
            <?php wp_nonce_field( 'woocommerce-login' ); ?>
            <?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?><br><br>
            <input type="hidden" name="redirect" value="<?php echo $_SERVER["HTTP_REFERER"]; ?>" />
            <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /> 
            <label for="rememberme" class="inline">
            <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
            </label>
	</p>
	<p class="lost_password">
            <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="col-2 register_ul">

            <p>Not already a U.S. Kids Golf Club member?</p>
            <p>Join the USKG Club now to:</p>
            <ul>
                <li>Manage orders, profile and addresses</li>
                <li>Register and keep track of tournaments</li>
                <li>Buy five clubs, receive a 6th club free!</li>
            </ul>
            <a href="<?php echo home_url()?>/register"><input type="button" class="reg_button" value="Create Account"></a>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>