<?php
/**
 * Title: Dashboard - Membership Dashboard
 * Description: ACF generated page for Dashboard - Membership Dashboard.
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5b44dc56b5a7f',
	'title' => 'Dashboard - Membership Dashboard',
	'fields' => array(
		array(
			'key' => 'field_5b44dcdbaacf6',
			'label' => 'Latest Updates Access Levels',
			'name' => 'latest_updates_access',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'access',
			'field_type' => 'multi_select',
			'allow_null' => 1,
			'add_term' => 0,
			'save_terms' => 0,
			'load_terms' => 0,
			'return_format' => 'id',
			'multiple' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'templates/dashboard-member.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
