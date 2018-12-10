<?php

class WordPress_Fire_Push_Notifications extends WordPress_Fire_Push
{
    protected $plugin_name;
    protected $version;
    protected $token_manager;

    protected $options;

    /**
     * Construct Fire_Push Admin Class
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://plugins.db-dzine.com
     * @param   string                         $plugin_name
     * @param   string                         $version
     */
    public function __construct($plugin_name, $version, $token_manager)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->token_manager = $token_manager;
    }

    /**
     * Getter
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://plugins.db-dzine.com
     * @param   [type]                       $property [description]
     * @return  [type]                                 [description]
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    /**
     * Setter
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://plugins.db-dzine.com
     * @param   [type]                       $property [description]
     * @return  [type]                                 [description]
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Init Reports Page in Admin
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://plugins.db-dzine.com
     * @return  [type]                       [description]
     */
    public function add_menu()
    {       
        add_submenu_page(
            'wordpress_fire_push_options_options',
            __('Notifications', 'wordpress-fire-push'),
            __('Notifications', 'wordpress-fire-push'),
            'manage_options',
            'fire-push-notifications',
            array($this, 'render')
        );
    }

    public function render()
    {
		$notifications = get_option('fire_push_notifications');
        if(!$notifications || empty($notifications)) {
            echo __('No Notifications sent so far ...', 'wordpress-fire-push');
            return false;
        }
        $notifications = array_reverse($notifications, true);
    	?>

		<table class="fire-push-table">
			<thead>
				<tr>
					 <th><?php echo __('Notification', 'wordpress-fire-push') ?></th>
                     <th><?php echo __('Sent', 'wordpress-fire-push') ?></th>
                     <th><?php echo __('Failed', 'wordpress-fire-push') ?></th>
                     <!-- <th><?php echo __('Clicked', 'wordpress-fire-push') ?></th> -->
				</tr>
			</thead>

			<?php
	    	foreach ($notifications as $multicast_id) {
                $notification = get_option('fire_push_notification_' . $multicast_id);

                if(!isset($notification['clicked'])) {
                     $notification['clicked'] = 0;
                }

                echo '<tr>';

                    echo '<td width="340px">';
                        echo '<a href="' . $notification['notification']['click_action'] . '" target="_blank" class="fire-push-notification">';
                            echo '<div class="fire-push-notification-left">';
                                echo '<div class="fire-push-icon"><img width="60" src="' . $notification['notification']['icon'] . '"></div>';
                            echo '</div>';
                            echo '<div class="fire-push-notification-right">';
                                echo '<div class="fire-push-notification-title">' . $notification['notification']['title'] . '</div>';
                                echo '<div class="fire-push-notification-text">' . $notification['notification']['body'] . '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</td>';
                    echo '<td>' . $notification['success'] . '</td>';
                    echo '<td>' . $notification['failure'] . '</td>';
                    // echo '<td>' . $notification['clicked'] . '</td>';

                echo '</tr>';
	    	}
	    	?>
		</table>
    	<?php
    }

    public function updateClicked()
    {
        if (!defined('DOING_AJAX') || !DOING_AJAX) {
            $this->msg = 'No AJAX call!';
            $this->message();
        }

        if(!isset($_POST['multicast_id']) || empty($_POST['multicast_id'])) {
            $this->msg = 'multicast_id Missing';
            $this->message();
        }

        $multicast_id = $_POST['multicast_id'];

        $notification = get_option('fire_push_notification_' . $multicast_id);

        if(!$notification) {
            $this->msg = 'Notification not found!';
            $this->message();
        }

        if(isset($notification['clicked'])) {
            $notification['clicked'] = 1;
        } else {
            $notification['clicked'] = $notification['clicked'] + 1;
        }

        update_option('fire_push_notification_' . $multicast_id, $notification);
    }

    public function message()
    {
        $return = array(
            'msg' => $this->msg,
        );
        die(json_encode($return));
    }
}