<?php

add_action('admin_menu', 'setting_page_menu_setup');

function setting_page_menu_setup() {
    add_menu_page(
        'Easy Hidden Plugins Settings',
        'Easy Hidden Plugins',
        'manage_options',
        'easy_hidden_plugins_settings',
        'setting_page_html_render',
        'dashicons-admin-generic'
    );
}

function setting_page_html_render() {
?>
<h1>Easy Hidden Plugins Settings</h1>
<?php
}

add_action('admin_init', 'setting_page_init');

function setting_page_init() {
    $TEXT_DOMAIN = 'easy-hidden-plugins';
    register_setting($TEXT_DOMAIN, $TEXT_DOMAIN . '_options');

    add_settings_section(
        $TEXT_DOMAIN . '_settings',
        'Easy Hidden Plugins',
        'setting_page_cb',
        $TEXT_DOMAIN
    );
}

function setting_page_cb() {
}
