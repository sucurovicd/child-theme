<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * register-page
 *
Template Name:  register-page (no sidebar)
 *
 * @file           register-page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 */

get_header(); 
	$firstname = empty( $_POST['firstname'] ) ? '' : $_POST['firstname'];
	$lastname  = empty( $_POST['lastname'] ) ? '' : $_POST['lastname'];
	$address = empty( $_POST['address'] ) ? '' : $_POST['address'];
	$city = empty( $_POST['city'] ) ? '' : $_POST['city'];
	$state = empty( $_POST['state'] ) ? '' : $_POST['state'];
	$zip = empty( $_POST['zip'] ) ? '' : $_POST['zip'];
	$phone = empty( $_POST['phone'] ) ? '' : $_POST['phone'];
        $country = empty( $_POST['country'] ) ? '' : $_POST['country'];
        $address2 = empty( $_POST['address2'] ) ? '' : $_POST['address2'];

?>

<div id="content-full" class="grid col-940 register-page">
    <h1 <?php style($page_id)?>><?php _e( 'Register', 'woocommerce' ); ?></h1>
    <?php wc_print_notices(); ?>

    <form method="post" class="register">
        <?php do_action( 'woocommerce_register_form_start' ); ?>
        <fieldset><legend><?php _e("Create new account", "woocomerce"); ?></legend>
            <fieldset id="acc"><legend><?php _e("Account info", "woocomerce"); ?></legend>
            <p class="form-row form-row-wide">
                <label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
            </p>
            <p class="form-row form-row-wide">
                <label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password'] ); ?>" />
            </p>
            <p class="form-row form-row-wide">
                <label for="reg_password2"><?php _e( 'Retype password', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="password" class="input-text" name="password_retyped" id="reg_password2" value="<?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
                

            </p>
            <p>
                <span id="password-strength"></span>
            </p>
                </fieldset>
            <fieldset id="pinfo"><legend><?php _e("Personal info", "woocomerce"); ?></legend>
            	<p class="form-row form-row-wide">
		<label for="reg_firstname"><?php _e( 'First Name', 'woocommerce' ) ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="firstname" id="reg_firstname" size="30" value="<?php echo esc_attr( $firstname ) ?>" />
                </p>	
                <p class="form-row form-row-wide">
                        <label for="reg_lastname"><?php _e( 'Last Name', 'woocommerce' ) ?><span class="required">*</span></label>
                        <input type="text" class="input-text" name="lastname" id="reg_lastname" size="30" value="<?php echo esc_attr( $lastname ) ?>" />
                </p>
                <p class="form-row form-row-wide">
                        <label for="reg_phone"><?php _e( 'Phone', 'woocommerce' ) ?><span class="required">*</span></label>
                        <input type="text" class="input-text" name="phone" id="reg_phone" size="30" value="<?php echo esc_attr( $phone ) ?>" />
                </p>
            </fieldset>
            <fieldset id="address"><legend><?php _e("Home Address", "woocomerce"); ?></legend>
                <select class="country_to_state country_select" name="country">
                <?php $test = new WC_Countries;
                foreach ($test->countries as $k => $t){
                     if ($k == FR)
                         echo "<option value='$k' selected>$t</option>";
                     echo "<option value='$k'>$t</option>";           
                 }
                ?>
                </select>
                <p class="form-row form-row-wide">
                        <label for="reg_address"><?php _e( 'Adrress', 'woocommerce' ) ?><span class="required">*</span></label>
                        <input type="text" class="input-text" name="address" id="reg_adrress" size="30" value="<?php echo esc_attr( $address ) ?>" />
                </p>
                <p class="form-row form-row-wide">
                        <label for="reg_address2"><?php _e( 'Adrress 2', 'woocommerce' ) ?><span class="required">*</span></label>
                        <input type="text" class="input-text" name="address2" id="reg_adrress" size="30" value="<?php echo esc_attr( $address2 ) ?>" />
                </p>

                <p class="form-row form-row-wide">
                        <label for="reg_city"><?php _e( 'City', 'woocommerce' ) ?><span class="required">*</span></label>
                        <input type="text" class="input-text" name="city" id="reg_city" size="30" value="<?php echo esc_attr( $city ) ?>" />
                </p>
                <p class="form-row form-row-wide">
                        <label for="reg_state"><?php _e( 'State', 'woocommerce' ) ?></label>
                        <input type="text" class="input-text" name="state" id="reg_state" size="30" value="<?php echo esc_attr( $state ) ?>" />
                </p>
                <p class="form-row form-row-wide">
                        <label for="reg_zip"><?php _e( 'ZIP', 'woocommerce' ) ?><span class="required">*</span></label>
                        <input type="text" class="input-text" name="zip" id="reg_zip" size="30" value="<?php echo esc_attr( $zip ) ?>" />
                </p>
            </fieldset>

<!-- Spam Trap -->
<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

<?php do_action( 'woocommerce_register_form' ); ?>
<?php do_action( 'register_form' ); ?>

<p class="form-row">
<?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
<input type="submit" class="button reg_button" name="register" id="submit-register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
    </p>
    </fieldset>


<?php do_action( 'woocommerce_register_form_end' ); ?>

</form>

</div><!-- end of #content-full -->

<?php get_footer(); ?>
