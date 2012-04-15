<?php
/*
Plugin Name: Annual Archive
Plugin URI: http://plugins.twinpictures.de/plugins/annual-archive-widget/
Description: Display daily, weekly, monthly or annual archives with a sidebar widget or shortcode.
Version: 1.1.1
Author: Twinpictures
Author URI: http://www.twinpictures.de/
License: GPL2
*/

/*  Copyright 2012 Twinpictures (www.twinpictures.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class AnualArchives extends WP_Widget {

	function AnualArchives() {
		$widget_ops = array('classname' => 'widget_anual_archive', 'description' => __( 'A monthly or yearly archive of your site&#8217;s posts') );
		$this->WP_Widget('widget_anual_archive', __('Annual Archive'), $widget_ops);

	}

	function widget( $args, $instance ) {
		extract($args);
		$c = $instance['count'] ? '1' : '0';
		$d = $instance['dropdown'] ? '1' : '0';
		$type = empty($instance['type']) ? 'yearly' : apply_filters('widget_type', $instance['type']);
		$limit = apply_filters('widget_limit', $instance['limit']);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Annual Archive') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		if ($d) {
			$dtitle = __('Select Year');
			if ($type == 'monthly'){
				$dtitle = __('Select Month');
			}
			else if($type == 'weekly'){
				$dtitle = __('Select Week');
			}
			else if($type == 'daily'){
				$dtitle = __('Select Day');
			}
			else if($type == 'postbypost' || $type == 'alpha'){
				$dtitle = __('Select Post');
			}
		?>
		<select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__($dtitle)); ?></option> <?php wp_get_archives(apply_filters('widget_archive_dropdown_args', array('type' => $type, 'format' => 'option', 'show_post_count' => $c, 'limit' => $limit))); ?> </select>
		<?php
		} else {
		?>
		<ul>
		<?php wp_get_archives(apply_filters('widget_archive_args', array('type' => $type, 'limit' => $limit, 'show_post_count' => $c))); ?>
		</ul>
		<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = strip_tags($instance['title']);
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
		$type = strip_tags($instance['type']);
		$limit = strip_tags($instance['limit']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as a drop down'); ?></label>
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Archive type:'); ?></label> <select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>">
			<?php
			$types_arr = array(
				'daily' => 'Daily',
				'weekly' => 'Weekly',
				'monthly' => 'Monthly',
				'yearly' => 'Yearly',
				'postbypost' => 'Post By Post',
				'alpha' => 'Alpha'
			);
			foreach($types_arr as $key => $value){
				$selected = '';
				if($key == $type || (!$type && $key == 'yearly')){
					$selected = 'SELECTED';
				}
				echo '<option value="'.$key.'" '.$selected.'>'.__($value).'</option>';
			}
			?>
			</select>
		</p>
		<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit results to:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></p>
		<?php
	}
}

// register Archive By Year widget
add_action('widgets_init', create_function('', 'return register_widget("AnualArchives");'));

// the shortcode
function annual_archive($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'yearly',
		'limit' => '',
		'format' => 'html', //html, option
		'showcount' => '0',
		'tag' => 'ul',
	), $atts));
	
	if ($format == 'option') {
		$dtitle = __('Select Year');
		if ($type == 'monthly'){
			$dtitle = __('Select Month');
		}
		else if($type == 'weekly'){
			$dtitle = __('Select Week');
		}
		else if($type == 'daily'){
			$dtitle = __('Select Day');
		}
		else if($type == 'postbypost' || $type == 'alpha'){
			$dtitle = __('Select Post');
		}
		$arc = '<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;"> <option value="">'.esc_attr(__($dtitle)).'</option>';
		$arc .= wp_get_archives(array('type' => $type, 'limit' => $limit, 'format' => 'option', 'show_post_count' => $showcount, 'echo' => 0)).'</select>';
	} else if ($format == 'html') {
		$arc = '<'.$tag.'>';
		$arc .= wp_get_archives(array('type' => $type, 'limit' => $limit, 'show_post_count' => $showcount, 'echo' => 0));
		$arc .= '</'.$tag.'>';
	}
	return $arc;
}

add_shortcode('archives', 'annual_archive');
	
?>