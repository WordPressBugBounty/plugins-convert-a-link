<?php
if (!defined('ABSPATH')) exit;

/*
Plugin Name: Awin Publisher MasterTag
Description: The Awin Publisher MasterTag allows you to access and enable technology from Awin and our partners.
Version:     1.8.5
Author:      awinglobal
Author URI:  https://profiles.wordpress.org/awinglobal/
Plugin URI:  https://wordpress.org/plugins/convert-a-link
*/

define('PUBLISHER_MASTERTAG_ADMIN_SLUG', 'publisher-mastertag');

###############################################
# MENU PAGES #
###############################################
add_action('admin_menu', "convert_a_link_settings");
function convert_a_link_settings()
{
    add_menu_page(
        'Awin Publisher MasterTag',
        'Awin Publisher MasterTag',
        'manage_options',
        PUBLISHER_MASTERTAG_ADMIN_SLUG,
        'publisher_mastertag_render_settings_page',
        plugins_url('icon.png', __FILE__)
    );
}

function publisher_mastertag_render_settings_page() {
    require_once dirname(__FILE__) . '/convert-a-link-admin.php';
}

/** Plugin version (used in script URL for cache busting; not the Publisher MasterTag script version). */
define('PUBLISHER_MASTERTAG_PLUGIN_VERSION', '1.8.5');

add_action('wp_enqueue_scripts', 'convert_a_link_enqueue_script');
function convert_a_link_enqueue_script() {
    $publisherId = get_option('cal_publisherId');
    $script_url = 'https://www.dwin2.com/pub.' . $publisherId . '.min.js?' . 'plugin_ver=' . PUBLISHER_MASTERTAG_PLUGIN_VERSION . '&wp_ver=' . get_bloginfo('version');
    wp_enqueue_script('convert-a-link', $script_url, array(), null, true);
}


##########################################################
# ADMIN NOTIFICATION #
##########################################################
function convert_a_link_admin_notice()
{
    $publisherId = get_option('cal_publisherId');

    if (empty($publisherId)) {
?>
        <div class="notice notice-error">
            <p><?php _e('<a href="' . admin_url('admin.php?page=' . PUBLISHER_MASTERTAG_ADMIN_SLUG) . '">
                Enter your Publisher ID to configure the MasterTag!</a>', 'my-text-domain'); ?>
            </p>
        </div>
<?php
    }
}
add_action('admin_notices', 'convert_a_link_admin_notice');

##########################################################
# DEACTIVATION #
##########################################################
register_deactivation_hook(__FILE__, 'convertALinkUninstall');
function convertALinkUninstall()
{
    delete_option('cal_publisherId');
}
