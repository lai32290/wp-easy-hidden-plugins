<?php

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
