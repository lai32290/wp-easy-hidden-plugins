<?php
/* Plugin name: Easy Hidden Plugins
 * Version: 1.0.0
 * Author: Lai Xuancheng
 * Description: Hidden installed plugin from the list easily.
 */

require_once(plugin_dir_path(__FILE__) . '/includes/setting-page.php');

add_filter('all_plugins', 'hide_plugins');

function hide_plugins($plugins) {
    $TEXT_DOMAIN = 'easy-hidden-plugins';
    $hidden_list = [ 'akismet' ];

    if (!is_active_to_current_user()) {
        return $plugins;
    }

    foreach($plugins as $key => $value) {
        $text_domain = $value[ 'TextDomain' ];
        if ($text_domain === $TEXT_DOMAIN) {
            continue;
        }

        if (in_array($text_domain, $hidden_list) && is_plugin_active($key)) {
            unset($plugins[$key]);
        }
    }

    return $plugins;
}

function is_active_to_current_user() {
    $current_user = wp_get_current_user();
   return $current_user->user_login === 'admin' || $current_user->ID == 1;
}
