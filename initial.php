<?php
/*
	Plugin Name:       Dinat Social Feed
	Plugin URI:        https://wpcoderpro.com/plugins/dinat-social-feed/
	Description:       Dinat Social Feed is the most reliable for showing Instagram Photo from your account. You don't need any sensative information at here. You can just install & use in your sidebars.
	Version:           1.0.3
	Tested up to: 	5.3.2
	Requires at least: 5.3.2
	Requires PHP:      7.1.28
	Author:            Md Dalwar
	Author URI:        https://www.wpcoderpro.com
	License:           GPL v2 or later
	License URI:       https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain:       dinat_social_feed
	License:     	   GPL2
 
	Dinat Social Feed is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.
	 
	Dinat Social Feed is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	 
	You should have received a copy of the GNU General Public License
	along with Dinat Social Feed. If not, see https://www.gnu.org/licenses/gpl-2.0.html
 */
	
	class Dinat_Social_Feed {
		public function __construct(){
			add_action('init', array($this, 'dinat_social_feed_setup'));
			add_action('widgets_init', array($this, 'dinta_social_feed_widget'));
			add_action('wp_enqueue_scripts', array($this, 'dinta_social_feed_scripts'));
			
		}
		public function dinat_social_feed_setup(){
			load_plugin_textdomain('dinat_social_feed');
		}
		public function dinta_social_feed_scripts(){
		    wp_register_script( 'dinat_social_feed', plugins_url( basename( __DIR__ )) . '/js/instagramFeed.min.js', array('jquery'), null, true);
			wp_enqueue_script('dinat_social_feed');

			wp_register_script( 'pl_script', plugins_url( basename( __DIR__ )) . '/js/scripts.js', array('dinat_social_feed'), null, true);
			wp_enqueue_script('pl_script');
		}
		public function dinta_social_feed_widget(){
			register_widget('Dinat_Social_Feed_Widget');
		}
	}

	$dinat_social_feed = new Dinat_Social_Feed();

	class Dinat_Social_Feed_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('insta-photo', __('Dinat Social Feed', 'anri'), array(
				'description'		=> __('Dinat Social Feed widget by Md Dalwar', 'dinat_social_feed')
			));
		}

		public function widget($args, $instance){
			echo $args['before_widget'];

			if(!empty($instance['title']) || $instance['title'] != NULL){
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			?>
			<div class="instagram-username"><?php echo $instance['username']; ?></div>
			<div class="item_per_row"><?php if(!empty($instance['item_per_row'])){echo $instance['item_per_row'];}else{echo 3;} ?></div>
			<div class="total_item"><?php if(!empty($instance['total_item'])){echo $instance['total_item'];}else{echo 9;} ?></div>
		    <div id="sidebar-widget__instagram" class="instagram_feed" style="overflow:hidden;"></div>
			<?php
			echo $args['after_widget'];
		}

		public function form($instance){
			?>
			<div class="widget-content">
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
					<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat">
				</p>				
			</div>
			<div class="widget-content">
				<p>
					<label for="<?php echo $this->get_field_id('username'); ?>">Instagram Username</label>
					<input type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" class="widefat">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('item_per_row'); ?>">Item per row :</label>
					<input type="number" class="tiny-text" id="<?php echo $this->get_field_id('item_per_row'); ?>" name="<?php echo $this->get_field_name('item_per_row'); ?>" value="<?php if(!empty($instance['item_per_row'])){ echo $instance['item_per_row'];}else{ echo 3;} ?>" min="1">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('total_item'); ?>">Total item show :</label>
					<input type="number" class="tiny-text" id="<?php echo $this->get_field_id('total_item'); ?>" name="<?php echo $this->get_field_name('total_item'); ?>" value="<?php if(!empty($instance['total_item'])){ echo $instance['total_item'];}else{ echo 9;} ?>" min="1">
				</p>
			</div>

			<?php
		}
		public function update($args, $instance){
			$values = array();
			$values['title'] = wp_strip_all_tags($args['title']);
			$values['username'] = wp_strip_all_tags($args['username']);
			$values['item_per_row'] = wp_strip_all_tags($args['item_per_row']);
			$values['total_item'] = wp_strip_all_tags($args['total_item']);

			return $values;
		}
	}

