<?php

function myplugin_register_options_page() {
  add_options_page('Page Title', 'Plugin Menu', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_options_page($args)
{
    $hidden_list = get_option('easy_hidden_plugins_hidden', []);
	$hidden_list = empty($hidden_list) ? [] : $hidden_list;

	$roles_list = get_option('easy_hidden_plugins_roles', []);
	$roles_list = empty($roles_list) ? [] : $roles_list;

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
						<?php checkbox_field($plugin['Name'], $plugin['TextDomain'], 'easy_hidden_plugins_hidden[]', in_array($plugin['TextDomain'], $hidden_list)) ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
				<tr>
					<th scope="row"><label>Visible to Role</label></th>
					<td>
						<?php checkbox_field('Administrator', 'administrator', 'easy_hidden_plugins_roles[]', in_array('administrator', $roles_list)); ?>
						<?php checkbox_field('Editor', 'editor', 'easy_hidden_plugins_roles[]', in_array('editor', $roles_list)); ?>
						<?php checkbox_field('Author', 'author', 'easy_hidden_plugins_roles[]', in_array('author', $roles_list)); ?>
						<?php checkbox_field('Contributor', 'contributor', 'easy_hidden_plugins_roles[]', in_array('contributor', $roles_list)); ?>
						<?php checkbox_field('Subscriber', 'subscriber', 'easy_hidden_plugins_roles[]', in_array('subscriber', $roles_list)); ?>
					</td>
				</tr>
            </table>
            <?php  submit_button(); ?>
        </form>
    </div>
<?php
}

function checkbox_field($label, $value, $name, $checked) {
?>
<div>
	<label>
		<input type="checkbox" value="<?php echo $value ?>" name="<?php echo $name?>" <?php checked($checked); ?>>
		<?php echo $label ?>
	</label>
</div>
<?php
}

function myplugin_register_settings() {
	$fields = [
		'easy_hidden_plugins_hidden',
		'easy_hidden_plugins_roles',
	];

	foreach($fields as $field) {
		add_option($field, []);
		register_setting( 'easy_hidden_plugins_options', $field );
	}
}
add_action( 'admin_init', 'myplugin_register_settings' );
