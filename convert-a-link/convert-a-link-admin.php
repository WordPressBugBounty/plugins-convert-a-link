<?php
if (!defined('ABSPATH')) exit;

if (!empty($_POST) && check_admin_referer('insert_publisher')) {
    if (!empty($_POST['publisherId'])) {
        $publisherId = sanitize_text_field($_POST['publisherId']);
        $publisherId = intval($publisherId);
        delete_option('cal_publisherId');
        add_option('cal_publisherId', $publisherId);
    } else {
        echo "<div class='error'>FAILED! Insert publisher ID</div>";
    }
}
?>
<div class="wrap" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h2>Configure your MasterTag Settings </h2>
    <table>
        <tr>
            <td colspan="2">
                <b>Step 1: Turn on a plugin inside of your Publisher MasterTag Settings</b>
                <br />
                <i>Under "Toolbox" > "Links & Tools"</i>
                <p>
                    <a target="_blank" href="https://wiki.awin.com/index.php/Publisher-MasterTag">
                        <img src="<?php echo plugins_url("convert-a-link/one.png") ?>""></a>
                </p>        
            </td>
        </tr>
        <tr>
            <td><b>Step 2: Enter your Publisher ID and save.</b></td>
            <td>
                <form enctype=" multipart/form-data" name="convert-a-link" method="post" action="">
                        <?php echo wp_nonce_field('insert_publisher'); ?>
                        <input type="number" value="<?php echo esc_attr(get_option('cal_publisherId')) ?>" name="publisherId" />
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
                        </form>
            </td>
        </tr>
    </table>
</div>