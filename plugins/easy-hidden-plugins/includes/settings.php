<?php

function myplugin_register_options_page() {
  add_options_page('Page Title', 'Plugin Menu', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_options_page($args)
{
    $hidden_list = get_option('easy_hidden_plugins_hidden', []);
    $plugins = get_plugins();
?>
    <div>
        <h1>Easy Hidden Plugins</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'easy_hidden_plugins_options' ); ?>
            <table class="form-table">
                <tr>
                    <th scpoe="row"><label>Hidden Plugins</label></th>
                    <td>
                        <?php foreach($plugins as $key => $plugin): ?>
                        <div>
                            <label>
                            <input type="checkbox" value="<?php echo $plugin['TextDomain'] ?>" name="easy_hidden_plugins_hidden[]" <?php checked(in_array($plugin['TextDomain'], $hidden_list)); ?>>
                                <?php echo $plugin['Name'] ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
            <?php  submit_button(); ?>
        </form>
    </div>
<?php
}

function myplugin_register_settings() {
   add_option( 'easy_hidden_plugins_hidden', []);
   register_setting( 'easy_hidden_plugins_options', 'easy_hidden_plugins_hidden' );
}
add_action( 'admin_init', 'myplugin_register_settings' );
