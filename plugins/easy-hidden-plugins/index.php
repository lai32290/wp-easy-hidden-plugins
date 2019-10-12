<?php
/* Plugin name: Easy Hidden Plugins
 * Version: 1.0.0
 * Author: Lai Xuancheng
 * Description: Hidden installed plugin from the list easily.
 */

add_filter('all_plugins', 'hide_plugins');

function hide_plugins($plugins) {
    $TEXT_DOMAIN = 'easy-hidden-plugins';
    $current_user = wp_get_current_user();
    $hidden_list = [ 'akismet' ];

    if (!($current_user->user_login === 'admin' || $current_user->ID == 1)) {
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

