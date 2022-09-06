<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('admin_menu', ['THM\Security\GUI', 'admin_menu']);

class GUI
{
    public static function admin_menu()
    {
        add_management_page('THM Security', 'THM Security', 'manage_options', 'thm-security', ['THM\Security\GUI', 'render_admin_page']);
    }

    public static function render_admin_page()
    {
        if (!current_user_can('manage_options')) return;
        
        // This variable will contain whatever is passed as ?parameter=value
        $example_get_parameter = sanitize_text_field(@$_GET['parameter']);

        ?>
            <!-- Our admin page content should all be inside .wrap -->
            <div class="wrap">
                <!-- Print the page title -->
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
                <p><br></p>
                Hello THM!
          </div>
        <?php
    }
}
