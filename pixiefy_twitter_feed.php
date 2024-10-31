<?php
/*
Plugin Name: Pixiefy Twitter Feed
Plugin URI: http://pixiefy.com/demo/pixiefy-twitter-feed/
Description: This is a plugin to embed the twitter feed to your site in a very easily way with many options to customize the twitter feed box.
.
Author: Mohammad Limon Mia
Author URI: http://pixiefy.com
Version: 1.0
*/

/**
 * Sample color Picker Widget Class
 */

if (!class_exists('pixiefyTwitterFeed')) {
class pixiefyTwitterFeed extends WP_Widget {
    function __construct() {
        parent::__construct(
            'pixiefyTwitterFeed', // Base ID
            __('Pixiefy Twitter Widget', 'pixiefytf'), // Name
            array( 'description' => __( 'A Twitter Widget for fetch your twitter feed', 'pixiefytf' ), ) // Args
        );
        load_plugin_textdomain('pixiefytf', false, dirname(plugin_basename(__FILE__)) . '/lang/');
    }

    function widget($args, $instance) { 
        extract( $args );
        global $wpdb;
 
    $title = apply_filters('widget_title', $instance['title']);
    $widget_ID = $instance['widget_ID'];
    $theme = $instance['theme'];
    $width = $instance['width'];
    $height = $instance['height'];
    $tweet_limit = $instance['tweet_limit'];
    $link_color = $instance['link_color'];
    $border_color = $instance['border_color'];
    $noheader = $instance['noheader'];
    $nofooter = $instance['nofooter'];
    $noborders = $instance['noborders'];
    $noscrollbar = $instance['noscrollbar'];
    $transparent = $instance['transparent'];
    $lang = $instance['lang'];

    echo $before_widget;


    if ( $title ) {
    echo $before_title . $title . $after_title;
    }
    ?>
    <a 
    class="twitter-timeline" 
    href="https://twitter.com/twitterapi" 
    data-widget-id="<?php if ( $widget_ID ) { echo $widget_ID; } ?>" 
    data-theme="<?php if ( $theme == 'light' ) { echo 'light';} else { echo 'dark';} ?>" 
    data-link-color="<?php if ( $link_color ) { echo $link_color; } ?>"  
    data-border-color="<?php if ( $border_color ) { echo $border_color; } ?>"
    data-related="twitterapi,twitter" 
    width="<?php if ( $width ) { echo $width; } ?>"
    height="<?php if ( $height ) { echo $height; } ?>"
    data-aria-polite="assertive" 
    data-chrome="<?php if ( $noheader == true ) { echo 'noheader'; } ?> <?php if ( $nofooter == true ) { echo 'nofooter'; } ?> <?php if ( $noborders == true ) { echo 'noborders'; } ?> <?php if ( $noscrollbar == true ) { echo 'noscrollbar'; } ?> <?php if ( $transparent == true ) { echo 'transparent'; } ?>"
    data-tweet-limit="<?php if ( $tweet_limit ) { echo $tweet_limit; } ?>" 
    lang="<?php if ( $lang ) { echo $lang; } ?>">
    </a>
    <?php
         echo $after_widget;
    }

    function update($new_instance, $old_instance) {     
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['widget_ID'] = strip_tags($new_instance['widget_ID']);
    $instance['theme'] = strip_tags($new_instance['theme']);
    $instance['width'] = strip_tags($new_instance['width']);
    $instance['height'] = strip_tags($new_instance['height']);
    $instance['tweet_limit'] = strip_tags($new_instance['tweet_limit']);
    $instance['link_color'] = strip_tags($new_instance['link_color']);
    $instance['border_color'] = strip_tags($new_instance['border_color']);
    $instance['noheader'] = strip_tags($new_instance['noheader']);
    $instance['nofooter'] = strip_tags($new_instance['nofooter']);
    $instance['noborders'] = strip_tags($new_instance['noborders']);
    $instance['noscrollbar'] = strip_tags($new_instance['noscrollbar']);
    $instance['transparent'] = strip_tags($new_instance['transparent']);
    $instance['lang'] = strip_tags($new_instance['lang']);
        return $instance;
    }
 

    function form($instance) {  
 
    $title = esc_attr($instance['title']);
    $widget_ID = esc_attr($instance['widget_ID']);
    $theme = esc_attr($instance['theme']);
    $width = esc_attr($instance['width']);
    $height = esc_attr($instance['height']);
    $tweet_limit = esc_attr($instance['tweet_limit']);
    $link_color = esc_attr($instance['link_color']);
    $border_color = esc_attr($instance['border_color']);
    $noheader = esc_attr($instance['noheader']);
    $nofooter = esc_attr($instance['nofooter']);
    $noborders = esc_attr($instance['noborders']);
    $noscrollbar = esc_attr($instance['noscrollbar']);
    $transparent = esc_attr($instance['transparent']);
    $lang = esc_attr($instance['lang']);  
    ?>
    <script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function()
    {
    jQuery('.cw-color-picker').each(function(){
    var $this = jQuery(this),
    id = $this.attr('rel');

    $this.farbtastic('#' + id);
    });

    });
    //]]>   
    </script>     
    <p>
        <a href="https://dev.twitter.com/docs/embedded-timelines">For More Info</a>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'pixiefytf' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('widget_ID'); ?>"><?php _e('Twitter widget ID*:', 'pixiefytf' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('widget_ID'); ?>" name="<?php echo $this->get_field_name('widget_ID'); ?>" type="text" value="<?php echo $widget_ID; ?>" />
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Select Twitter Theme:', 'pixiefytf' ); ?></label>
    <select name="<?php echo $this->get_field_name('theme'); ?>" id="<?php echo $this->get_field_id('theme'); ?>" class="widefat">
    <?php
    $options = array('light','dark');
    foreach ($options as $option) {
    echo '<option value="' . $option . '" id="' . $option . '"', $theme == $option ? ' selected="selected"' : '', '>', $option, '</option>';
    }
    ?>
    </select>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Twitter Widget Width:', 'pixiefytf' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" 
    value="<?php echo $width; ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Twitter Widget Height:', 'pixiefytf' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('tweet_limit'); ?>"><?php _e('Twitter Tweet Limit:', 'pixiefytf' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('tweet_limit'); ?>" name="<?php echo $this->get_field_name('tweet_limit'); ?>" type="text" value="<?php echo $tweet_limit; ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('link_color'); ?>"><?php _e('Data Link Color:', 'pixiefytf' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('link_color'); ?>" name="<?php echo $this->get_field_name('link_color'); ?>" type="text" value="<?php if($link_color) { echo $link_color; } else { echo '#333333';  } ?>" />
    <div class="cw-color-picker" rel="<?php echo $this->get_field_id('link_color'); ?>"></div>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Data Border Color:', 'pixiefytf' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php if($border_color) { echo $border_color; } else { echo '#222222';  } ?>" />
    <div class="cw-color-picker" rel="<?php echo $this->get_field_id('border_color'); ?>"></div>
    </p>
    <label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Put  your Desire language (First Three Letter in CAP):', 'pixiefytf' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('noscrollbar'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" type="text" value="<?php echo $lang; ?>" />
    </p>
    <p>
    <input id="<?php echo $this->get_field_id('noheader'); ?>" name="<?php echo $this->get_field_name('noheader'); ?>" type="checkbox" value="1" <?php checked( '1', $noheader ); ?>/>
    <label for="<?php echo $this->get_field_id('noheader'); ?>"><?php _e('No Header', 'pixiefytf' ); ?></label>
    </p>
    <p>
    <input id="<?php echo $this->get_field_id('nofooter'); ?>" name="<?php echo $this->get_field_name('nofooter'); ?>" type="checkbox" value="1" <?php checked( '1', $nofooter ); ?>/>
    <label for="<?php echo $this->get_field_id('nofooter'); ?>"><?php _e('No Footer', 'pixiefytf' ); ?></label>
    </p>
    <p>
    <input id="<?php echo $this->get_field_id('noborders'); ?>" name="<?php echo $this->get_field_name('noborders'); ?>" type="checkbox" value="1" <?php checked( '1', $noborders ); ?>/>
    <label for="<?php echo $this->get_field_id('noborders'); ?>"><?php _e('No Borders', 'pixiefytf' ); ?></label>
    </p>
    <p>
    <input id="<?php echo $this->get_field_id('noscrollbar'); ?>" name="<?php echo $this->get_field_name('noscrollbar'); ?>" type="checkbox" value="1" <?php checked( '1', $noscrollbar ); ?>/>
    <label for="<?php echo $this->get_field_id('noscrollbar'); ?>"><?php _e('No Scrollbar' , 'pixiefytf' ); ?></label>
    </p>

    <p>
    <input id="<?php echo $this->get_field_id('transparent'); ?>" name="<?php echo $this->get_field_name('transparent'); ?>" type="checkbox" value="1" <?php checked( '1', $transparent ); ?>/>
    <label for="<?php echo $this->get_field_id('transparent'); ?>"><?php _e('Transparent', 'pixiefytf' ); ?></label>
    </p>
    <p>
    
    <?php 
    }


    }
    
    add_action('widgets_init', create_function('', 'return register_widget("pixiefyTwitterFeed");'));
     
    function pixiefy_twitter_timeline_widget_call(){ ?>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <?php } 

    function pixify_twitter_color_picker_script() {
        wp_enqueue_script('farbtastic');
    }
    function pixify_twitter_color_picker_style() {
        wp_enqueue_style('farbtastic'); 
    }
    function pixiefyTwitterFeedUninstall() {
      delete_option('widget_pixiefyTwitterFeed');
    }

    add_action('wp_footer', 'pixiefy_twitter_timeline_widget_call');
    add_action('admin_print_scripts-widgets.php', 'pixify_twitter_color_picker_script');
    add_action('admin_print_styles-widgets.php', 'pixify_twitter_color_picker_style');
    register_deactivation_hook( __FILE__, 'pixiefyTwitterFeedUninstall' );
}
