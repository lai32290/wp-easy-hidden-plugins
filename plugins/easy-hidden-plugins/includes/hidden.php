<?php

add_filter('all_plugins', 'hide_plugins');

function hide_plugins($plugins) {
    $TEXT_DOMAIN = 'easy-hidden-plugins';
    $hidden_list = get_option('easy_hidden_plugins_hidden', []);
    $hidden_list = empty($hidden_list) ? [] : $hidden_list;

    if (is_visible_to_current_user()) {
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

function is_visible_to_current_user() {
	$roles_list = get_option('easy_hidden_plugins_roles', []);
	$roles_list = empty($roles_list) ? [] : $roles_list;

    $current_user = wp_get_current_user();
	$caps = $current_user->caps;

	$is_visible_to_role = array_reduce($roles_list, function($result, $role) use ($caps) {
		if (array_key_exists($role, $caps)) {
			return true;
		}

		return $result;
	}, false);

	return $is_visible_to_role;
}
