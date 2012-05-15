<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'ungpirat_options', 'ungpirat_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Ung Pirat', 'ungpirat' ), __( 'Ung Pirat', 'ungpirat' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
        //add_menu_page( __( 'Ung Pirat', 'ungpirat' ), __( 'Ung Pirat', 'ungpirat' ), 'edit_theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero', 'ungpirat' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One', 'ungpirat' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two', 'ungpirat' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three', 'ungpirat' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four', 'ungpirat' )
	),
	'5' => array(
		'value' => '3',
		'label' => __( 'Five', 'ungpirat' )
	)
);

$radio_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes', 'ungpirat' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'No', 'ungpirat' )
	),
	'maybe' => array(
		'value' => 'maybe',
		'label' => __( 'Maybe', 'ungpirat' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options (In development)', 'ungpirat' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ungpirat' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'ungpirat_options' ); ?>
			<?php $options = get_option( 'ungpirat_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * A sample checkbox option
				 */ /*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'A checkbox', 'ungpirat' ); ?></th>
					<td>
						<input id="ungpirat_theme_options[option1]" name="ungpirat_theme_options[option1]" type="checkbox" value="1" <?php checked( '1', $options['option1'] ); ?> />
						<label class="description" for="ungpirat_theme_options[option1]"><?php _e( 'ung pirat checkbox', 'ungpirat' ); ?></label>
					</td>
				</tr>

				<?php */
				/**
				 * A sample text input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Main category for the menu', 'ungpirat' ); ?></th>
					<td>
						<input id="ungpirat_theme_options[maincategory]" class="regular-text" type="text" name="ungpirat_theme_options[maincategory]" value="<?php esc_attr_e( $options['maincategory'] ); ?>" />
						<label class="description" for="ungpirat_theme_options[maincategory]"><?php _e( 'ung pirat text input', 'ungpirat' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A sample select input option
				 */ /*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Select input', 'ungpirat' ); ?></th>
					<td>
						<select name="ungpirat_theme_options[selectinput]">
							<?php
								$selected = $options['selectinput'];
								$p = '';
								$r = '';

								foreach ( $select_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="ungpirat_theme_options[selectinput]"><?php _e( 'Sample select input', 'ungpirat' ); ?></label>
					</td>
				</tr>

				<?php */
				/**
				 * A sample of radio buttons
				 */ /*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Radio buttons', 'ungpirat' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Radio buttons', 'ungpirat' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $radio_options as $option ) {
								$radio_setting = $options['radioinput'];

								if ( '' != $radio_setting ) {
									if ( $options['radioinput'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="ungpirat_theme_options[radioinput]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php */
				/**
				 * A sample textarea option
				 */ /*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'A textbox', 'ungpirat' ); ?></th>
					<td>
						<textarea id="ungpirat_theme_options[sometextarea]" class="large-text" cols="50" rows="10" name="ungpirat_theme_options[sometextarea]"><?php echo esc_textarea( $options['sometextarea'] ); ?></textarea>
						<label class="description" for="ungpirat_theme_options[sometextarea]"><?php _e( 'Sample text box', 'ungpirat' ); ?></label>
					</td>
				</tr> <?php */ ?>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'ungpirat' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}
