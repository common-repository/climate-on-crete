<?php
/*
Plugin Name: Climate on Crete
Plugin URI: http://www.ostheimer.at/leistungen-preise/wordpress/plugins/climate-on-crete/
Description: This Plugin shows you climatic information about crete. The user choose place and month and gets displayed the correct climatic information. The admin can display this plugin by adding the widget into a sidebar or via shortcode [climate_on_crete] into posts/pages. 
Author: Ostheimer.at
Version: 1.3
Author URI: http://www.ostheimer.at

	Copyright 2012  Ostheimer.at  (email : office@ostheimer.at)

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


/* Version check */
global $wp_version;

$exit_msg='Climate on Crete requires WordPress 3.0 or newer.
<a href="http://codex.wordpress.org/Upgrading_Wordpress">Please update!</a>';

if(version_compare($wp_version, "3.0","<")) {
	exit($exit_msg);
}

/* Select the URL of the plugin */
$plugin_url_crete = trailingslashit( WP_PLUGIN_URL.'/'. dirname( plugin_basename(__FILE__) ));

/* Localization */
load_plugin_textdomain( 'climate', false, dirname( plugin_basename(__FILE__) ).'/languages/'  );

/* Load CSS and Register Widget */
function crete_init() {
	global $plugin_url_crete;
	wp_register_sidebar_widget('Climate on Crete', 'Climate on Crete Widget', 'crete_widget');
	wp_register_widget_control('Climate on Crete', 'Climate on Crete Widget', 'crete_widget_control');
}
add_action('init','crete_init');

/* Load CSS */
function crete_css() {
	global $plugin_url_crete;
	wp_register_style( 'crete-css', $plugin_url_crete . 'climate-on-crete.css' );
	wp_enqueue_style( 'crete-css' );
}
add_action( 'wp_enqueue_scripts', 'crete_css' );


/* Load Scripts */
function crete_scripts() {
	global $plugin_url_crete;
	wp_enqueue_script('crete', $plugin_url_crete . 'climate-on-crete.js', array('jquery'));
	wp_enqueue_script('crete-weather-scala', $plugin_url_crete . 'climate-on-crete-table-celsius.js', array('jquery'));
	$options = get_option('wp_crete');
	$temperature = $options['temperature'];
		if($temperature != 'celsius') {?>
        	<script type="text/javascript"> var fahrenheit = true; </script>
        <?php
		} else { ?>
        	<script type="text/javascript"> var fahrenheit = false; </script>
        <?php
		}
}
add_action('wp_enqueue_scripts','crete_scripts',10);

/* Generate Shortcode [climate_on_crete] */
function crete_shortcode($atts) {
	extract(shortcode_atts( array(
				'link' 		=> 'link'
			), $atts ));
	
	$options = get_option('wp_crete');
	$temperature = $options['temperature'];
	if($temperature == 'celsius') {
		$data = '°C';
	} else {
		$data = '°F';
	}
	 
	$return = '<div id="climate_short" class="crete">';
		$return .= '<form name="form_crete" id="form_crete">';
			$return .= '<select name="month" class="month_short">
							<option value="1">'.__('January','climate').'</option>
							<option value="2">'.__('February','climate').'</option>
							<option value="3">'.__('March','climate').'</option>
							<option value="4">'.__('April','climate').'</option>
							<option value="5">'.__('May','climate').'</option>
							<option value="6">'.__('June','climate').'</option>
							<option value="7" selected="selected">'.__('July','climate').'</option>
							<option value="8">'.__('August','climate').'</option>
							<option value="9">'.__('September','climate').'</option>
							<option value="10">'.__('October','climate').'</option>
							<option value="11">'.__('November','climate').'</option>
							<option value="12">'.__('December','climate').'</option>
						</select>';
			$return .= '<select name="city" class="city_short">
							<option value="rethymnon">'.__('Rethymno','climate').'</option>
							<option value="chania">'.__('Chania','climate').'</option>
							<option value="agiagalini">'.__('Agia Galini','climate').'</option>
							<option value="plakias">'.__('Plakias','climate').'</option>
							<option value="matala">'.__('Matala','climate').'</option>
							<option value="heraklion">'.__('Heraklion','climate').'</option>
							<option value="agiosnikolaos">'.__('Agios Nikolaos','climate').'</option>
							<option value="malia">'.__('Malia','climate').'</option>
							<option value="chorasfakion">'.__('Chora Sfakion','climate').'</option>
							<option value="sitia">'.__('Sitia','climate').'</option>
							<option value="chersonissos">'.__('Chersonissos','climate').'</option>
							<option value="agiapelagia">'.__('Agia Pelagia','climate').'</option>
							<option value="agiapaleochora">'.__('Agia Paleochora','climate').'</option>
							<option value="ierapetra">'.__('Ierapetra','climate').'</option>
							<option value="georgioupolis">'.__('Georgioupolis','climate').'</option>
							<option value="mires">'.__('Mires','climate').'</option>
							<option value="episkopi">'.__('Episkopi','climate').'</option>
						</select>';
		$return .= '<div class="clear"></div>';
		$return .= '</form>';
		$return .= '<div id="climate_output">
						<div id="max"><span class="label">'.__('max.','climate').$data.'</span><span class="max_value value"></span></div>
						<div id="min"><span class="label">'.__('min.','climate').$data.'</span><span class="min_value value"></span></div>
						<div id="wtp"><span class="label">'.__('water ','climate').$data.'</span><span class="wtp_value value"></span></div>
						<div id="spt"><span class="label">'.__('hours / d','climate').'</span><span class="spt_value value"></span></div>
						<div id="rpm"><span class="label">'.__('days / m','climate').'</span><span class="rpm_value value"></span></div>
						<div class="clear"></div>';
						if($link != 'false') {
						$return .= '<div id="link" class="field">
										<a href="http://www.ostheimer.at" title="Ostheimer WordPress Webdesign und Suchmaschinenoptimierung" target="_blank">Plugin by </a><a href="http://www.kreta-urlaub.at" target="_blank" title="Ferienwohnung an der Nordküste Kretas">kreta-urlaub.at</a>
							  		</div>';
						}
		$return .= '</div>';
	$return .= '</div>';
	
	return $return;
	
}
add_shortcode('climate_on_crete','crete_shortcode');

/* Create Climate on Crete Widget */
function crete_widget() {
	// Get saved options
	$options = get_option('wp_crete');
	$title = $options['title'];
	$temperature = $options['temperature'];
	$link = $options['link'];
	if($temperature == 'celsius') {
		$data = '°C';
	} else {
		$data = '°F';
	}
	
	echo '<div id="climate" class="crete">';
		echo '<h3 class="widget-title">'.$title.'</h3>';
		echo '<form name="form_crete" id="form_crete">';
			echo '<select name="month" class="month">
							<option value="1">'.__('January','climate').'</option>
							<option value="2">'.__('February','climate').'</option>
							<option value="3">'.__('March','climate').'</option>
							<option value="4">'.__('April','climate').'</option>
							<option value="5">'.__('May','climate').'</option>
							<option value="6">'.__('June','climate').'</option>
							<option value="7" selected="selected">'.__('July','climate').'</option>
							<option value="8">'.__('August','climate').'</option>
							<option value="9">'.__('September','climate').'</option>
							<option value="10">'.__('October','climate').'</option>
							<option value="11">'.__('November','climate').'</option>
							<option value="12">'.__('December','climate').'</option>
						</select>';
			echo '<select name="city" class="city">
							<option value="rethymnon">'.__('Rethymno','climate').'</option>
							<option value="chania">'.__('Chania','climate').'</option>
							<option value="agiagalini">'.__('Agia Galini','climate').'</option>
							<option value="plakias">'.__('Plakias','climate').'</option>
							<option value="matala">'.__('Matala','climate').'</option>
							<option value="heraklion">'.__('Heraklion','climate').'</option>
							<option value="agiosnikolaos">'.__('Agios Nikolaos','climate').'</option>
							<option value="malia">'.__('Malia','climate').'</option>
							<option value="chorasfakion">'.__('Chora Sfakion','climate').'</option>
							<option value="sitia">'.__('Sitia','climate').'</option>
							<option value="chersonissos">'.__('Chersonissos','climate').'</option>
							<option value="agiapelagia">'.__('Agia Pelagia','climate').'</option>
							<option value="agiapaleochora">'.__('Agia Paleochora','climate').'</option>
							<option value="ierapetra">'.__('Ierapetra','climate').'</option>
							<option value="georgioupolis">'.__('Georgioupolis','climate').'</option>
							<option value="mires">'.__('Mires','climate').'</option>
							<option value="episkopi">'.__('Episkopi','climate').'</option>
						</select>';
		echo '</form>';
		echo '<div class="clear"></div>';
		echo '<div id="climate_output">
						<div id="max"><span class="label">'.__('max.','climate').$data.'</span><span class="max_value value"></span></div>
						<div id="min"><span class="label">'.__('min.','climate').$data.'</span><span class="min_value value"></span></div>
						<div id="wtp"><span class="label">'.__('water ','climate').$data.'</span><span class="wtp_value value"></span></div>
						<div id="spt"><span class="label">'.__('hours / d','climate').'</span><span class="spt_value value"></span></div>
						<div id="rpm"><span class="label">'.__('days / m','climate').'</span><span class="rpm_value value"></span></div>
						<div class="clear"></div>';
						if($options['link'] != 1 || empty($options['link'])) {
						echo '<div id="link" class="field">
										<a href="http://www.ostheimer.at" title="Ostheimer WordPress Webdesign und Suchmaschinenoptimierung" target="_blank">Plugin by </a><a href="http://www.kreta-urlaub.at" target="_blank" title="Ferienwohnung an der Nordküste Kretas">kreta-urlaub.at</a>
							  		</div>';
						}
				echo '</div>';
	echo '</div>';
	
}

/* Create Windspeed Converter Widget Control */
function crete_widget_control() {
	
	 // Get saved options
      $options = get_option('wp_crete');
      
      // Handle user input
      if ($_POST["crete_submit"]) {
          // Define variables from the request
          $options['title'] = strip_tags(stripslashes($_POST["title"]));
		  $options['temperature'] = strip_tags(stripslashes($_POST["temperature"]));
		  $options['link'] = strip_tags(stripslashes($_POST["link"]));
          
          // Update the options to database
          update_option('wp_crete', $options);
      }
      
	  // Save options to variables
      $title = $options['title'];
	  $temperature = $options['temperature'];
	  $link = $options['link'];
	  
	  // Display the Widget-Control
	  echo '<div class="widget-content">';
	  echo '<p><label for="title">';__( 'Title', 'climate' ); echo ' <input  name="title" type="text" value="'.$title.'" /></label></p>';
	  if($temperature == 'celsius') {	
				echo '<div id="celsius" class="field">
						<label>';echo __( 'Celsius', 'climate' ); echo '</label>
						<input type="radio" name="temperature" value="celsius" checked="checked" class="input_field" />
					  </div>';
				echo '<div id="fahrenheit" class="field">
						<label>';echo __( 'Fahrenheit', 'climate' ); echo '</label>
						<input type="radio" name="temperature" value="fahrenheit" class="input_field" />
					  </div>';
	  } else if($temperature == 'fahrenheit') {	
				echo '<div id="celsius" class="field">
						<label>';echo __( 'Celsius', 'climate' ); echo '</label>
						<input type="radio" name="temperature" value="celsius" class="input_field" />
					  </div>';
				echo '<div id="fahrenheit" class="field">
						<label>';echo __( 'Fahrenheit', 'climate' ); echo '</label>
						<input type="radio" name="temperature" value="fahrenheit" checked="checked" class="input_field" />
					  </div>';
	  } else {
		  echo '<div id="celsius" class="field">
						<label>';echo __( 'Celsius', 'climate' ); echo '</label>
						<input type="radio" name="temperature" value="celsius" checked="checked" class="input_field" />
					  </div>';
				echo '<div id="fahrenheit" class="field">
						<label>';echo __( 'Fahrenheit', 'climate' ); echo '</label>
						<input type="radio" name="temperature" value="fahrenheit" class="input_field" />
					  </div>';
	  }
	  echo '<br />';
	  if($link == 1) {
		   echo '<p><input type="checkbox" name="link" value="1" checked="checked" /><label> ';echo __( 'Hide Link?', 'climate' ); echo '</label></p>';
	  } else {
		  echo '<p><input type="checkbox" name="link" value="1" /><label> ';echo __( 'Hide Link?', 'climate' ); echo '</label></p>';
	  }
	  
	  echo '<input type="hidden" id="crete_submit" name="crete_submit" value="1" />';
	  echo '</div>';
}