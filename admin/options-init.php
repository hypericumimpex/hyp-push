<?php

	/**
	 * For full documentation, please visit: http://docs.reduxframework.com/
	 * For a more extensive sample-config file, you may look at:
	 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
	 */

if (! class_exists('Redux')) {
	return;
}

	// This is your option name where all the Redux data is fire-pushd.
	$opt_name = "wordpress_fire_push_options";

	/**
	 * ---> SET ARGUMENTS
	 * All the possible arguments for Redux.
	 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	 * */

	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		'opt_name' => 'wordpress_fire_push_options',
		'use_cdn' => true,
		'dev_mode' => false,
		'display_name' => __('WordPress Fire Push', 'wordpress-fire-push'),
		'display_version' => '1.0.6',
		'page_title' => __('WordPress Fire Push', 'wordpress-fire-push'),
		'update_notice' => true,
		'intro_text' => '',
		'footer_text' => '&copy; ' . date('Y') . ' DB-Dzine',
		'admin_bar' => true,
		'menu_type' => 'menu',
		'menu_title' => __('Fire Push', 'wordpress-fire-push'),
		'menu_icon' => 'dashicons-testimonial',
		'allow_sub_menu' => true,
		'page_parent' => '',
		'page_parent_post_type' => '',
		'customizer' => false,
		'default_mark' => '*',
		'hints' => array(
			'icon_position' => 'right',
			'icon_color' => 'lightgray',
			'icon_size' => 'normal',
			'tip_style' => array(
				'color' => 'light',
			),
			'tip_position' => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect' => array(
				'show' => array(
					'duration' => '500',
					'event' => 'mouseover',
				),
				'hide' => array(
					'duration' => '500',
					'event' => 'mouseleave unfocus',
				),
			),
		),
		'output' => true,
		'output_tag' => true,
		'settings_api' => true,
		'cdn_check_time' => '1440',
		'compiler' => true,
		'page_permissions' => 'manage_options',
		'save_defaults' => true,
		'show_import_export' => true,
		'database' => 'options',
		'transient_time' => '3600',
		'network_sites' => true,
	);

	Redux::setArgs($opt_name, $args);

	/*
	 * ---> END ARGUMENTS
	 */

	/*
	 * ---> START HELP TABS
	 */

	$tabs = array(
		array(
			'id'      => 'help-tab',
			'title'   => __('Information', 'wordpress-fire-push'),
			'content' => __('<p>Need support? Please use the comment function on codecanyon.</p>', 'wordpress-fire-push')
		),
	);
	Redux::setHelpTab($opt_name, $tabs);

	/*
	 * <--- END HELP TABS
	 */


	/*
	 *
	 * ---> START SECTIONS
	 *
	 */
	Redux::setSection( $opt_name, array(
		'title'  => __( 'General Settings', 'wordpress-fire-push' ),
		'id'     => 'general',
		'desc'   => __( 'Need support? Please use the comment function on codecanyon.', 'wordpress-fire-push' ),
		'icon'   => 'el el-home',
	) );

	Redux::setSection($opt_name, array(
		'title'      => __('Settings', 'wordpress-fire-push'),
		'id'         => 'general-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'enable',
				'type'     => 'checkbox',
				'title'    => __('Enable', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'saveGuestToken',
				'type'     => 'checkbox',
				'title'    => __('Save Guest Token', 'wordpress-fire-push'),
				'subtitle'  => __('Tokens are used to send notifications to users. If you do not want to send notifictions to logged out users disable this option to only save tokens for logged in users.', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'removeFailedSubscribers',
				'type'     => 'checkbox',
				'title'    => __('Remove failed Subscribers', 'wordpress-fire-push'),
				'subtitle'  => __('Remove subscribers who have blocked or removed their access.', 'wordpress-fire-push'),
				'default'  => '0',
			),
			
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('Credentials', 'wordpress-fire-push'),
		'id'         => 'credentials',
		'desc'       => __('Please read our documentation how to get your Firebase API Credentials here.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'serverKey',
				'type'     => 'text',
				'title'    => __('Server Key', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'apiKey',
				'type'     => 'text',
				'title'    => __('apiKey', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'authDomain',
				'type'     => 'text',
				'title'    => __('authDomain', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'databaseURL',
				'type'     => 'text',
				'title'    => __('databaseURL', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'projectId',
				'type'     => 'text',
				'title'    => __('projectId', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'storageBucket',
				'type'     => 'text',
				'title'    => __('storageBucket', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'messagingSenderId',
				'type'     => 'text',
				'title'    => __('messagingSenderId', 'wordpress-fire-push'),
				'default'  => '',
				'required' => array('enable','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('Defaults', 'wordpress-fire-push'),
		'id'         => 'defaults',
		'desc'       => __('Theses will be used as a fallback in case no specific data was defined.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'defaultTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => get_bloginfo('name'),
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'defaultBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => get_bloginfo('description'),
				'required' => array('enable','equals','1'),
			),
			array(
				'id'       => 'defaultClickAction',
				'type'     => 'text',
				'title'    => __('Click Action URL', 'wordpress-fire-push'),
				'default'  => get_bloginfo('wpurl'),
				'required' => array('enable','equals','1'),
			),
			array(
				'id'        =>'defaultIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'subtitle'  => __('The icon must be in square format.', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('enable','equals','1'),
			),
		)
	));

    Redux::setSection($opt_name, array(
        'title'      => __('Popup', 'wordpress-fire-push'),
        'id'         => 'popup-settings',
        'desc'       => __('The popup when user has not given permission for messaging.', 'wordpress-fire-push'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'popupEnable',
                'type'     => 'checkbox',
                'title'    => __('Enable Popup', 'wordpress-fire-push'),
                'default'  => '1',
            ), 
            array(
                'id'       => 'popupText',
                'type'     => 'editor',
                'title'    => __('Popup Text', 'wordpress-fire-push'),
                'default'  => __('We would like to keep you updated with special notifications.', 'wordpress-fire-push'),
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'       => 'popupTextAgree',
                'type'     => 'text',
                'title'    => __('Popup Agree Text', 'wordpress-fire-push'),
                'subtitle' => __('Leave Empty if not needed', 'wordpress-fire-push'),
                'default'  => __('I accept', 'wordpress-fire-push'),
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'       => 'popupTextDecline',
                'type'     => 'text',
                'title'    => __('Popup Decline Text', 'wordpress-fire-push'),
                'subtitle' => __('Leave Empty if not needed', 'wordpress-fire-push'),
                'default'  => __('I decline', 'wordpress-fire-push'),
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'       => 'popupStyle',
                'type'     => 'select',
                'title'    => __('Popup Style', 'wordpress-fire-push'),
                'options' => array(
                    'wordpress-fire-push-popup-full-width' => __('Full Width', 'wordpress-fire-push'),
                    'wordpress-fire-push-popup-small' => __('Small Width', 'wordpress-fire-push'),
                ),
                'default' => 'wordpress-fire-push-popup-small',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'       => 'popupPosition',
                'type'     => 'select',
                'title'    => __('Popup Position', 'wordpress-fire-push'),
                'options' => array(
                    'wordpress-fire-push-popup-top' => __('Top', 'wordpress-fire-push'),
                    'wordpress-fire-push-popup-bottom' => __('Bottom', 'wordpress-fire-push'),
                ),
                'default' => 'wordpress-fire-push-popup-top',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupBackgroundColor',
                'type' => 'color',
                'title' => __('Background Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#f7f7f7',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupTextColor',
                'type' => 'color',
                'title' => __('Text Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#333333',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupAgreeColor',
                'type' => 'color',
                'title' => __('Accept Button Text Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#FFFFFF',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupAgreeBackgroundColor',
                'type' => 'color',
                'title' => __('Accept Button Background Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#4CAF50',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupDeclineColor',
                'type' => 'color',
                'title' => __('Decline Button Text Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#FFFFFF',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupDeclineBackgroundColor',
                'type' => 'color',
                'title' => __('Decline Button Background Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#F44336',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupLinkColor',
                'type' => 'color',
                'title' => __('Link Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#FF5722',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'       => 'popupCloseIcon',
                'type'     => 'text',
                'title'    => __('Close Icon', 'wordpress-fire-push'),
                'default'  => 'fa fa-times',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupCloseIconBackgroundColor',
                'type' => 'color',
                'title' => __('Close Icon Background Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#000000',
                'required' => array('popupEnable','equals','1'),
            ),
            array(
                'id'     =>'popupCloseIconColor',
                'type' => 'color',
                'title' => __('Close Icon Color', 'wordpress-fire-push'), 
                'validate' => 'color',
                'default' => '#FFFFFF',
                'required' => array('popupEnable','equals','1'),
            ),
        )
    ));

	Redux::setSection($opt_name, array(
		'title'      => __('Welcome Notification', 'wordpress-fire-push'),
		'id'         => 'welcome',
		'desc'       => __('Send users visiting your website a welcome notification.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'welcomeEnabled',
				'type'     => 'checkbox',
				'title'    => __('Enable', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'welcomeTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('Thanks for Subscribing', 'wordpress-fire-push'),
				'required' => array('welcomeEnabled','equals','1'),
			),
			array(
				'id'       => 'welcomeBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('We will keep you updated as soon as something special comes up!', 'wordpress-fire-push'),
				'required' => array('welcomeEnabled','equals','1'),
			),
			array(
				'id'       => 'welcomeURL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => get_bloginfo('wpurl'),
			),
			array(
				'id'        =>'welcomeIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'subtitle'  => __('The icon must be in square format.', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('welcomeEnabled','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('Custom Notification', 'wordpress-fire-push'),
		'id'         => 'custom',
		'desc'       => __('Send a custom Notification. You need to save the options before sending!', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'customTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => ''
			),
			array(
				'id'       => 'customBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => ''
			),
			array(
				'id'       => 'customURL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '',
			),
			array(
				'id'        => 'customIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'subtitle'  => __('The icon must be in square format.', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
			),
			array(
				'id'   => 'customSend',
				'type' => 'info',
				'desc' => '<div style="text-align:center;">
					<a href="' . get_admin_url() . 'admin.php?page=wordpress_fire_push_options_options&send-custom-notification=true" class="button button-success">' . __('Send', 'wordpress-fire-push') . '</a>
					</div>'
			),
		)
	));

	Redux::setSection( $opt_name, array(
		'title'  => __( 'WP Notifictions', 'wordpress-fire-push' ),
		'id'     => 'wp-notifications',
		'desc'   => __( 'Need support? Please use the comment function on codecanyon.', 'wordpress-fire-push' ),
		'icon'   => 'el el-wordpress',
	) );

	Redux::setSection($opt_name, array(
		'title'      => __('1. Notification', 'wordpress-fire-push'),
		'id'         => 'wpNotification1',
		'desc'       => __('Configure your first notification.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'wpNotification1Enabled',
				'type'     => 'checkbox',
				'title'    => __('Enable WP Notification 1', 'wordpress-fire-push'),
				'default'  => '0',
			),
			array(
				'id'       => 'wpNotification1OnPublish',
				'type'     => 'checkbox',
				'title'    => __('Notify on Publish', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification1Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification1OnUpdate',
				'type'     => 'checkbox',
				'title'    => __('Notify on Update', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification1Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification1OnNewComment',
				'type'     => 'checkbox',
				'title'    => __('Notify on new Comment', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification1Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification1PostTypes',
				'type'     => 'select',
				'title'    => __( 'Post types', 'wordpress-fire-push' ),
				'subtitle' => __( 'For what post types should notifications be enabled.', 'wordpress-fire-push' ),
				'data' => 'post_types',
				'required' => array('wpNotification1Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification1UserRoles',
				'type'     => 'select',
				'title'    => __( 'User Roles', 'wordpress-fire-push' ),
				'subtitle' => __( 'Empty means all users get the notification.', 'wordpress-fire-push' ),
				'data' => 'roles',
				'required' => array('wpNotification1Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification1Title',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('New {post_type}: {post_title}', 'wordpress-fire-push'),
				'required' => array('wpNotification1Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification1Body',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('{post_excerpt}', 'wordpress-fire-push'),
				'required' => array('wpNotification1Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification1URL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
				'required' => array('wpNotification1Enabled','equals','1'),
			),
			array(
				'id'        =>'wpNotification1Icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('wpNotification1UseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'wpNotification1UseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('wpNotification1Enabled','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('2. Notification', 'wordpress-fire-push'),
		'id'         => 'wpNotification2',
		'desc'       => __('Configure your first notification.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'wpNotification2Enabled',
				'type'     => 'checkbox',
				'title'    => __('Enable WP Notification 2', 'wordpress-fire-push'),
				'default'  => '0',
			),
			array(
				'id'       => 'wpNotification2OnPublish',
				'type'     => 'checkbox',
				'title'    => __('Notify on Publish', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification2Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification2OnUpdate',
				'type'     => 'checkbox',
				'title'    => __('Notify on Update', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification2Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification2OnNewComment',
				'type'     => 'checkbox',
				'title'    => __('Notify on new Comment', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification2Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification2PostTypes',
				'type'     => 'select',
				'title'    => __( 'Post types', 'wordpress-fire-push' ),
				'subtitle' => __( 'For what post types should notifications be enabled.', 'wordpress-fire-push' ),
				'data' => 'post_types',
				'required' => array('wpNotification2Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification2UserRoles',
				'type'     => 'select',
				'title'    => __( 'User Roles', 'wordpress-fire-push' ),
				'subtitle' => __( 'Empty means all users get the notification.', 'wordpress-fire-push' ),
				'data' => 'roles',
				'required' => array('wpNotification2Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification2Title',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('New {post_type}: {post_title}', 'wordpress-fire-push'),
				'required' => array('wpNotification2Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification2Body',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('{post_excerpt}', 'wordpress-fire-push'),
				'required' => array('wpNotification2Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification2URL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
				'required' => array('wpNotification2Enabled','equals','1'),
			),
			array(
				'id'        =>'wpNotification2Icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('wpNotification2UseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'wpNotification2UseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('wpNotification2Enabled','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('3. Notification', 'wordpress-fire-push'),
		'id'         => 'wpNotification3',
		'desc'       => __('Configure your first notification.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'wpNotification3Enabled',
				'type'     => 'checkbox',
				'title'    => __('Enable WP Notification 3', 'wordpress-fire-push'),
				'default'  => '0',
			),
			array(
				'id'       => 'wpNotification3OnPublish',
				'type'     => 'checkbox',
				'title'    => __('Notify on Publish', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification3OnUpdate',
				'type'     => 'checkbox',
				'title'    => __('Notify on Update', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification3OnNewComment',
				'type'     => 'checkbox',
				'title'    => __('Notify on new Comment', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification3PostTypes',
				'type'     => 'select',
				'title'    => __( 'Post types', 'wordpress-fire-push' ),
				'subtitle' => __( 'For what post types should notifications be enabled.', 'wordpress-fire-push' ),
				'data' => 'post_types',
				'required' => array('wpNotification3Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification3UserRoles',
				'type'     => 'select',
				'title'    => __( 'User Roles', 'wordpress-fire-push' ),
				'subtitle' => __( 'Empty means all users get the notification.', 'wordpress-fire-push' ),
				'data' => 'roles',
				'required' => array('wpNotification3Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification3Title',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('New {post_type}: {post_title}', 'wordpress-fire-push'),
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification3Body',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('{post_excerpt}', 'wordpress-fire-push'),
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification3URL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'        =>'wpNotification3Icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('wpNotification3Enabled','equals','1'),
			),
			array(
				'id'        =>'wpNotification3Icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('wpNotification3UseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'wpNotification3UseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('wpNotification3Enabled','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('4. Notification', 'wordpress-fire-push'),
		'id'         => 'wpNotification4',
		'desc'       => __('Configure your first notification.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'wpNotification4Enabled',
				'type'     => 'checkbox',
				'title'    => __('Enable WP Notification 4', 'wordpress-fire-push'),
				'default'  => '0',
			),
			array(
				'id'       => 'wpNotification4OnPublish',
				'type'     => 'checkbox',
				'title'    => __('Notify on Publish', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification4OnUpdate',
				'type'     => 'checkbox',
				'title'    => __('Notify on Update', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification4OnNewComment',
				'type'     => 'checkbox',
				'title'    => __('Notify on new Comment', 'wordpress-fire-push'),
				'default'  => '1',
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification4PostTypes',
				'type'     => 'select',
				'title'    => __( 'Post types', 'wordpress-fire-push' ),
				'subtitle' => __( 'For what post types should notifications be enabled.', 'wordpress-fire-push' ),
				'data' => 'post_types',
				'required' => array('wpNotification4Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification4UserRoles',
				'type'     => 'select',
				'title'    => __( 'User Roles', 'wordpress-fire-push' ),
				'subtitle' => __( 'Empty means all users get the notification.', 'wordpress-fire-push' ),
				'data' => 'roles',
				'required' => array('wpNotification4Enabled','equals','1'),
				'multi' => true,
			),
			array(
				'id'       => 'wpNotification4Title',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('New {post_type}: {post_title}', 'wordpress-fire-push'),
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification4Body',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('{post_excerpt}', 'wordpress-fire-push'),
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'       => 'wpNotification4URL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'        =>'wpNotification4Icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('wpNotification4Enabled','equals','1'),
			),
			array(
				'id'        =>'wpNotification4Icon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('wpNotification4UseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'wpNotification4UseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('wpNotification4Enabled','equals','1'),
			),
		)
	));

	Redux::setSection( $opt_name, array(
		'title'  => __( 'WooCommerce Notifictions', 'wordpress-fire-push' ),
		'id'     => 'woocommerce',
		'desc'   => __( 'Need support? Please use the comment function on codecanyon.', 'wordpress-fire-push' ),
		'icon'   => 'el el-shopping-cart-sign',
	) );

	Redux::setSection($opt_name, array(
		'title'      => __('New Product', 'wordpress-fire-push'),
		'id'         => 'woocommerce-product',
		'desc'       => __('Configure if and how notifications for new products should be handled.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
				'fields'     => array(
			array(
				'id'       => 'woocommerceNewProduct',
				'type'     => 'checkbox',
				'title'    => __('Enable Notification', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'woocommerceNewProductTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('New Product: {post_title}', 'wordpress-fire-push'),
				'required' => array('woocommerceNewProduct','equals','1'),
			),
			array(
				'id'       => 'woocommerceNewProductBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('{post_excerpt}', 'wordpress-fire-push'),
				'required' => array('woocommerceNewProduct','equals','1'),
			),
			array(
				'id'       => 'woocommerceNewProductURL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
			),
			array(
				'id'        =>'woocommerceNewProductIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('woocommerceNewProductUseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'woocommerceNewProductUseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('woocommerceNewProduct','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('Price Drop', 'wordpress-fire-push'),
		'id'         => 'woocommerce-price-drop',
		'desc'       => __('Configure if and how notifications for new products should be handled.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
				'fields'     => array(
			array(
				'id'       => 'woocommercePriceDrop',
				'type'     => 'checkbox',
				'title'    => __('Enable Notification', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'woocommercePriceDropTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('Price Drop!', 'wordpress-fire-push'),
				'required' => array('woocommercePriceDrop','equals','1'),
			),
			array(
				'id'       => 'woocommercePriceDropBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('A special price is available for {post_title}', 'wordpress-fire-push'),
				'required' => array('woocommercePriceDrop','equals','1'),
			),
			array(
				'id'       => 'woocommercePriceDropURL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
			),
			array(
				'id'        =>'woocommercePriceDropIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('woocommercePriceDropUseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'woocommercePriceDropUseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('woocommercePriceDrop','equals','1'),
			),
		)
	));


	Redux::setSection($opt_name, array(
		'title'      => __('New Order', 'wordpress-fire-push'),
		'id'         => 'woocommerce-new-order',
		'desc'       => __('They will be send to admins & shop managers only! Configure if and how notifications for new orders should be handled.', 'wordpress-fire-push'),
		'subsection' => true,
				'fields'     => array(
			array(
				'id'       => 'woocommerceNewOrder',
				'type'     => 'checkbox',
				'title'    => __('Enable Notification', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'woocommerceNewOrderTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('New Order received', 'wordpress-fire-push'),
				'required' => array('woocommerceNewOrder','equals','1'),
			),
			array(
				'id'       => 'woocommerceNewOrderBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('Click to see order!', 'wordpress-fire-push'),
				'required' => array('woocommerceNewOrder','equals','1'),
			),
			array(
				'id'       => 'woocommerceNewOrderURL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
			),
			array(
				'id'        =>'woocommerceNewOrderIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('woocommerceNewOrder','equals','1'),
			),
		)
	));

	Redux::setSection($opt_name, array(
		'title'      => __('Low Stock', 'wordpress-fire-push'),
		'id'         => 'woocommerce-low-stock',
		'desc'       => __('They will be send to admins & shop managers only! Configure if and how notifications for new orders should be handled.<br><br><b>Note:</b> You can use any placeholder for post data & meta data e.g.: {post_author}, {post_date}, {_regular_price}, {post_content}, {post_title}, {post_excerpt}, {post_status}, {comment_status}, {post_modified}, {post_type} + All other data.', 'wordpress-fire-push'),
		'subsection' => true,
				'fields'     => array(
			array(
				'id'       => 'woocommerceLowStock',
				'type'     => 'checkbox',
				'title'    => __('Enable Notification', 'wordpress-fire-push'),
				'default'  => '1',
			),
			array(
				'id'       => 'woocommerceLowStockTitle',
				'type'     => 'text',
				'title'    => __('Title', 'wordpress-fire-push'),
				'default'  => __('Product on Low Stock: {post_title}', 'wordpress-fire-push'),
				'required' => array('woocommerceLowStock','equals','1'),
			),
			array(
				'id'       => 'woocommerceLowStockBody',
				'type'     => 'text',
				'title'    => __('Text', 'wordpress-fire-push'),
				'default'  => __('{post_excerpt}', 'wordpress-fire-push'),
				'required' => array('woocommerceLowStock','equals','1'),
			),
			array(
				'id'       => 'woocommerceLowStockURL',
				'type'     => 'text',
				'title'    => __('URL (Click Action)', 'wordpress-fire-push'),
				'default'  => '{post_url}',
			),
			array(
				'id'        =>'woocommerceLowStockIcon',
				'type'      => 'media',
				'url'       => true,
				'title'     => __('Icon', 'wordpress-fire-push'),
				'args'      => array(
					'teeny'            => false,
				),
				'required' => array('woocommerceLowStockUseFeatureImage','equals','0'),
			),
			array(
				'id'       => 'woocommerceLowStockUseFeatureImage',
				'type'     => 'checkbox',
				'title'    => __('Use feature image as icon', 'wordpress-fire-push'),
				'default'  => '0',
				'required' => array('woocommerceLowStock','equals','1'),
			),
		)
	));