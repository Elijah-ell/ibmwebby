<?php
$tc_uqa_titles = array();

function tc_make_unique_title( $title ) {
	global $tc_uqa_titles;

	if ( isset( $tc_uqa_titles[ $title ] ) ) {
		$tc_uqa_titles[ $title ] = tc_make_unique_title( $tc_uqa_titles[ $title ] . ' ' );
	} else {
		$tc_uqa_titles[ $title ] = $title;
	}
	return $tc_uqa_titles[ $title ];
}

function tc_get_order_details_owner_form_fields_values( $field_name, $post_id, $field_id ) {
	$ticket_type_id	 = get_post_meta( $field_id, 'ticket_type_id', true );
	$order_id		 = isset( $_REQUEST[ 'ID' ] ) ? $_GET[ 'ID' ] : (isset( $_GET[ 'post' ] ) ? $_GET[ 'post' ] : false);

	$fields		 = array();
	$forms		 = new TC_Forms();
	$owner_form	 = $forms->get_forms( 'owner', -1, apply_filters( 'tc_ticket_type_id', $ticket_type_id ) );

	if ( count( $owner_form ) >= 1 && (isset( $owner_form[ 0 ] ) && !is_null( $owner_form[ 0 ] )) ) {
		global $wpdb;
		$owner_form = $owner_form[ 0 ];

		for ( $i = 1; $i <= apply_filters( 'tc_form_row_number', 20 ); $i++ ) {
			$results = $wpdb->get_results(
			$wpdb->prepare(
			"SELECT *, pm2.meta_value as ord FROM $wpdb->posts p, $wpdb->postmeta pm, $wpdb->postmeta pm2
											WHERE p.ID = pm.post_id 
											AND p.ID = pm2.post_id
											AND	p.post_parent = %d
											AND (pm.meta_key = 'row' AND pm.meta_value = %d)
											AND (pm2.meta_key = 'order')
											ORDER BY ord ASC"
			, $owner_form->ID, $i ), OBJECT
			);

			if ( !empty( $results ) ) {

				foreach ( $results as $result ) {

					$post_meta = get_post_meta( $result->ID );

					$element_class_name = $post_meta[ 'field_type' ][ 0 ];

					if ( class_exists( $element_class_name ) ) {
						$element = new $element_class_name( $result->ID );

						if ( $element->standard_field_admin_order_details( $element->element_name, true ) ) {
							$fields[] = $element->admin_order_details_page_value();
						}
					}
				}
			}
		}
	}

	foreach ( $fields as $field ) {
		?>
		<div class="tc_custom_field_record_order_details">
			<?php
			echo $field[ 'field_title' ] . ' ';
			eval( $field[ 'function' ] . "('" . $field[ 'id' ] . "', " . $field_id . ", '', 'owner_data');" );
			?>
		</div>
		<?php
	}
}

function tc_custom_form_fields_owner_form_templates_array() {
	$forms			 = new TC_Forms();
	$forms			 = $forms->get_forms( 'owner' );
	$forms_templates = array();

	$forms_templates[ -1 ] = __( 'None', 'tc' );

	foreach ( $forms as $form ) {
		$forms_templates[ $form->ID ] = $form->post_title;
	}

	return $forms_templates;
}

function tc_custom_form_fields_owner_form_template_select( $field_name, $event_id = 0 ) {
	$forms	 = new TC_Forms();
	$forms	 = $forms->get_forms( 'owner' );

	if ( $event_id !== 0 ) {
		$selected_option = get_post_meta( $event_id, $field_name, true );
		if ( isset( $selected_option ) && !empty( $selected_option ) ) {
			
		} else {
			$selected_option = 0;
		}
	} else {
		$selected_option = 0;
	}
	?>
	<select name="<?php echo $field_name; ?>_post_meta">
		<option value="0" <?php selected( '0', $selected_option, true ); ?>><?php _e( 'Default', 'tc' ); ?></option>
		<?php
		foreach ( $forms as $form ) {
			?>
			<option value="<?php echo $form->ID; ?>" <?php selected( $form->ID, $selected_option, true ); ?>><?php echo $form->post_title; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}

function tc_get_input_admin_order_details_page_value( $field_name, $post_id, $field_id, $field_type = 'buyer_data' ) {
	$value = get_post_meta( $post_id, $field_name, true );

	if ( $field_type == 'buyer_data' ) {
		//echo isset( $value[ $field_type ][ $field_id . '_post_meta' ] ) && !empty( $value[ $field_type ][ $field_id . '_post_meta' ] ) ? $value[ $field_type ][ $field_id . '_post_meta' ] : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'buyer_data', 'text' );
	} else {
		//echo isset( $value ) && $value !== '' ? $value : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'owner_data', 'text' );
	}
}

function tc_get_textarea_admin_order_details_page_value( $field_name, $post_id, $field_id, $field_type = 'buyer_data' ) {
	$value = get_post_meta( $post_id, $field_name, true );
	if ( $field_type == 'buyer_data' ) {
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'buyer_data', 'textarea' );
		//echo isset( $value[ $field_type ][ $field_id . '_post_meta' ] ) && !empty( $value[ $field_type ][ $field_id . '_post_meta' ] ) ? $value[ $field_type ][ $field_id . '_post_meta' ] : '-';
	} else {
		//echo isset( $value ) && $value !== '' ? $value : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'owner_data', 'textarea' );
	}
}

function tc_get_radio_admin_order_details_page_value( $field_name, $post_id, $field_id, $field_type = 'buyer_data' ) {
	$value = get_post_meta( $post_id, $field_name, true );
	if ( $field_type == 'buyer_data' ) {
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'buyer_data', 'radio' );
		//echo isset( $value[ $field_type ][ $field_id . '_post_meta' ] ) && !empty( $value[ $field_type ][ $field_id . '_post_meta' ] ) ? $value[ $field_type ][ $field_id . '_post_meta' ] : '-';
	} else {
		//echo isset( $value ) && $value !== '' ? $value : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'owner_data', 'radio' );
	}
}

function tc_get_select_admin_order_details_page_value( $field_name, $post_id, $field_id, $field_type = 'buyer_data' ) {
	$value = get_post_meta( $post_id, $field_name, true );
	if ( $field_type == 'buyer_data' ) {
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'buyer_data', 'select' );
		//echo isset( $value[ $field_type ][ $field_id . '_post_meta' ] ) && !empty( $value[ $field_type ][ $field_id . '_post_meta' ] ) ? $value[ $field_type ][ $field_id . '_post_meta' ] : '-';
	} else {
		//echo isset( $value ) && $value !== '' ? $value : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'owner_data', 'select' );
	}
}

function tc_get_checkbox_admin_order_details_page_value( $field_name, $post_id, $field_id, $field_type = 'buyer_data' ) {
	$value = get_post_meta( $post_id, $field_name, true );
	if ( $field_type == 'buyer_data' ) {
		//echo isset( $value[ $field_type ][ $field_id . '_post_meta' ] ) ? $value[ $field_type ][ $field_id . '_post_meta' ] : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'buyer_data', 'checkbox' );
	} else {
		//echo isset( $value ) && $value !== '' ? $value : '-';
		tc_custom_forms_editable_field( $field_name, $post_id, $field_id, 'owner_data', 'checkbox' );
	}
}

function tc_save_eval_strings( $string, $replace_numbers = false ) {
	$string	 = sanitize_title( $string );
	$string	 = str_replace( array( '-' ), array( '_' ), $string );

	if ( $replace_numbers ) {
		$string = str_replace( array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0' ), array( 'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nince' ), $string );
	}

	return $string;
}

function tc_custom_forms_editable_field( $field_name, $post_id, $field_id, $data_type = 'buyer_data',
										 $field_type = 'text' ) {
	$value = get_post_meta( $post_id, $field_name, true );

	$args = array(
		'name'			 => $field_name,
		'post_type'		 => 'tc_form_fields',
		'post_status'	 => 'publish',
		'numberposts'	 => 1
	);

	$form_fields = get_posts( $args );

	if ( $data_type == 'buyer_data' ) {
		$cart_info	 = get_post_meta( $post_id, 'tc_cart_info', true );
		$value		 = isset( $cart_info[ 'buyer_data' ][ $field_id . '_post_meta' ] ) ? $cart_info[ 'buyer_data' ][ $field_id . '_post_meta' ] : '';

		$args_buyer = array(
			'post_type'		 => 'tc_form_fields',
			'post_status'	 => 'publish',
			'numberposts'	 => 1,
			'meta_query'	 => array(
				array(
					'value' => $field_id
				)
			)
		);

		$form_fields = get_posts( $args_buyer );
	}

	if ( $data_type == 'buyer_data' ) {
		$input_name = 'tc_custom_field_' . esc_attr( $data_type ) . '[' . $post_id . '][' . $field_id . '_post_meta]';
	} else {
		$input_name = 'tc_custom_field_' . esc_attr( $data_type ) . '[' . $post_id . '][' . $field_name . ']';
	}

	if ( $field_type == 'text' ) {
		?>
		<label class="tc_custom_forms_editable">
			<input type="text" value="<?php echo esc_attr( $value ); ?>" name="<?php echo $input_name; ?>" />
		</label>
		<?php
	}
	if ( $field_type == 'textarea' ) {
		?>
		<label class="tc_custom_forms_editable">
			<textarea name="<?php echo $input_name; ?>"><?php echo esc_textarea( $value ); ?></textarea>
		</label>
		<?php
	}
	if ( $field_type == 'select' ) {

		if ( isset( $form_fields ) && isset( $form_fields[ 0 ] ) ) {
			$content = $form_fields[ 0 ]->post_content;
			if ( isset( $content ) ) {
				$values = explode( ',', $content );
				if ( count( $values ) > 0 ) {
					?>
					<label class="tc_custom_forms_editable">
						<select name="<?php echo $input_name; ?>">
							<?php
							foreach ( $values as $val ) {
								?>
								<option value="<?php echo esc_attr( trim( $val ) ); ?>" <?php selected( trim( $val ), trim( $value ), true ) ?>><?php echo trim( $val ); ?></option>
								<?php
							}
							?>
						</select>
					</label>
					<?php
				} else {
					_e( 'N/A', 'tc' );
				}
			} else {
				_e( 'N/A', 'tc' );
			}
		} else {
			_e( 'N/A', 'tc' );
		}
		?>

		<?php
	}
	if ( $field_type == 'radio' ) {

		if ( isset( $form_fields ) && isset( $form_fields[ 0 ] ) ) {
			$content = $form_fields[ 0 ]->post_content;
			if ( isset( $content ) ) {
				$values = explode( ',', $content );
				if ( count( $values ) > 0 ) {
					foreach ( $values as $val ) {
						?>
						<label class="tc_custom_forms_editable">
							<input type="radio" name="<?php echo $input_name; ?>" value="<?php echo esc_attr( trim( $val ) ); ?>" <?php checked( trim( $val ), trim( $value ), true ) ?>><?php echo esc_attr( trim( $val ) ); ?>
						</label>
						<?php
					}
				} else {
					_e( 'N/A', 'tc' );
				}
			} else {
				_e( 'N/A', 'tc' );
			}
		} else {
			_e( 'N/A', 'tc' );
		}
		?>

		<?php
	}
	if ( $field_type == 'checkbox' ) {

		if ( isset( $form_fields ) && isset( $form_fields[ 0 ] ) ) {
			$content = $form_fields[ 0 ]->post_content;
			if ( isset( $content ) ) {
				$values = explode( ',', trim( $content ) );
				if ( count( $values ) > 0 ) {
					?>
					<div class="tc_custom_forms_editable">
						<input type="hidden" name="<?php echo $input_name; ?>" class="checkbox_values" value="<?php echo esc_attr( str_replace( ', ', ',', $value ) ); ?>" />
						<?php
						$selected_values = explode( ',', str_replace( ', ', ',', $value ) );

						foreach ( $values as $val ) {

							$checked = in_array( trim( $val ), $selected_values ) ? 'checked="checked"' : '';
							?>
							<label>
								<input type="checkbox" class="field-checkbox" value="<?php echo esc_attr( trim( $val ) ); ?>" <?php echo $checked; ?>><?php echo esc_attr( trim( $val ) ); ?>
							</label>
							<?php
						}
						?>
					</div>
					<?php
				} else {
					_e( 'N/A', 'tc' );
				}
			} else {
				_e( 'N/A', 'tc' );
			}
		} else {
			_e( 'N/A', 'tc' );
		}
		?>

		<?php
	}
}
