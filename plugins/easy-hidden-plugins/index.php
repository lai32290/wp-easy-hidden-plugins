<?php
/* Plugin name: Easy Hidden Plugins
 * Version: 1.0.0
 * Author: Lai Xuancheng
 * Description: Hidden installed plugin from the list easily.
 */


add_filter('all_plugins', 'hide_plugins');

function hide_plugins($plugins) {
    if (wp_get_current_user()->data->user_login !== 'admin') {
        return $plugins;
    }

    $hidden_list = [ 'akismet' ];
    foreach($plugins as $key => $value) {
        if (in_array($value['TextDomain'], $hidden_list) && is_plugin_active($key)) {
            unset($plugins[$key]);
        }
    }

    return $plugins;
}
