<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Plugin Name: Oganro Reservation Widget
 * Plugin URI: http://www.oganro.com/
 * Description: Customize your own reservation panel
 * Version: 1.0
 * Author: Oganro (Pvt)Ltd
 * Author URI: http://www.oganro.com/
 * License: GPL2
 */ 

function ogn_rw_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
		return $default;
	//Sanitize $color if "#" is provided
	if ($color[0] == '#' ) {
   	$color = substr( $color, 1 );
   }
	//Check if color has 6 or 3 characters and get values
   if (strlen($color) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
   } elseif ( strlen( $color ) == 3 ) {
      $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}
	
	//Convert hexadec to rgb
	$rgb =  array_map('hexdec', $hex);
	//Check if opacity is set(rgba or rgb)
   if($opacity){
		if(abs($opacity) > 1)
			$opacity = 1.0;
       	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
      } else {
      	$output = 'rgb('.implode(",",$rgb).')';
      }
return $output;
}

function ogn_rw_load_stylesheet(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-autocomplete');	
	wp_enqueue_script('bootstrap.min.js', plugins_url( 'bootstrap.min.js', __FILE__ ) );		
	wp_enqueue_script('bootstrap-datepicker.min.js', plugins_url( 'bootstrap-datepicker.min.js', __FILE__ ) );
	wp_enqueue_script('bootstrap-datetimepicker.fa.js', plugins_url( 'bootstrap-datetimepicker.fa.js', __FILE__ ) );
	
	wp_enqueue_style( 'jquery-ui.min.css', plugins_url( 'jquery-ui.min.css', __FILE__ ) );	
	wp_enqueue_style( 'datepicker.min.css', plugins_url( 'datepicker.min.css', __FILE__ ) );	
	wp_enqueue_style( 'bootstrap.min.css', plugins_url( 'bootstrap.min.css', __FILE__ ) );	
	wp_enqueue_style( 'bootstrap-theme.min.css', plugins_url( 'bootstrap-theme.min.css', __FILE__ ) );
	wp_enqueue_style( 'bootstrap_override.css', plugins_url( 'bootstrap_override.css', __FILE__ ) );	
	wp_enqueue_style( 'widget-main-style.css', plugins_url( 'ogn-rw-main-style.css', __FILE__ ) );
	
	echo '<link rel="icon" href="/favicon.ico" type="image/x-icon" />';
	
}
add_action('wp_print_styles', 'ogn_rw_load_stylesheet');

function ogn_rw_load_widget_screen(){
	$ogn_rw_view_setting_active 				= get_option('ogn_rw_opt_setting_active');
	$ogn_rw_view_setting_cname 				= get_option('ogn_rw_opt_setting_cname');	
	$ogn_rw_view_setting_title 				= get_option('ogn_rw_opt_setting_title');
	$ogn_rw_view_location_title 				= get_option('ogn_rw_opt_location_title');
	$ogn_rw_view_checkin_title 				= get_option('ogn_rw_opt_checkin_title');
	$ogn_rw_view_checkout_title 				= get_option('ogn_rw_opt_checkout_title');
	$ogn_rw_view_nights_title 					= get_option('ogn_rw_opt_nights_title');
	$ogn_rw_view_rooms_title 					= get_option('ogn_rw_opt_rooms_title');
	$ogn_rw_view_search_btntxt 				= get_option('ogn_rw_opt_search_btntxt');	
	$ogn_rw_view_location_placeholder		= get_option('ogn_rw_opt_location_placeholder');
	$ogn_rw_view_setting_bgcolor				= get_option('ogn_rw_opt_setting_bgcolor');
	$ogn_rw_view_setting_transparency 		= get_option('ogn_rw_opt_setting_transparency');
	$ogn_rw_view_setting_boxwidth				= get_option('ogn_rw_opt_setting_boxwidth');
	$ogn_rw_view_setting_bodercolor 			= get_option('ogn_rw_opt_setting_bodercolor');
	$ogn_rw_view_setting_mainbodercolor 	= get_option('ogn_rw_opt_setting_mainbodercolor');
	$ogn_rw_view_setting_mainboderradius 	= get_option('ogn_rw_opt_setting_mainboderradius');
	$ogn_rw_view_setting_titlefontsize 		= get_option('ogn_rw_opt_setting_titlefontsize');
	$ogn_rw_view_setting_titlefontcolor 	= get_option('ogn_rw_opt_setting_titlefontcolor');

   $ogn_rw_view_location_titlecolor			= get_option('ogn_rw_opt_location_titlecolor');
   $ogn_rw_view_location_boxwidth			= get_option('ogn_rw_opt_location_boxwidth');
	$ogn_rw_view_location_bgcolor				= get_option('ogn_rw_opt_location_bgcolor');
	$ogn_rw_view_location_txtcolor			= get_option('ogn_rw_opt_location_txtcolor');
	$ogn_rw_view_location_icncolor			= get_option('ogn_rw_opt_location_icncolor');
	$ogn_rw_view_location_icnbgcolor			= get_option('ogn_rw_opt_location_icnbgcolor');	
	$ogn_rw_view_location_placeholdercolor	= get_option('ogn_rw_opt_location_placeholdercolor');

	$ogn_rw_view_checkin_titlecolor 			= get_option('ogn_rw_opt_checkin_titlecolor');
	$ogn_rw_view_checkin_boxwidth 			= get_option('ogn_rw_opt_checkin_boxwidth');
	$ogn_rw_view_checkin_bgcolor 				= get_option('ogn_rw_opt_checkin_bgcolor');
	$ogn_rw_view_checkin_txtcolor 			= get_option('ogn_rw_opt_checkin_txtcolor');
	$ogn_rw_view_checkin_icncolor 			= get_option('ogn_rw_opt_checkin_icncolor');
	$ogn_rw_view_checkin_icnbgcolor 			= get_option('ogn_rw_opt_checkin_icnbgcolor');
 
	$ogn_rw_view_checkout_titlecolor 		= get_option('ogn_rw_opt_checkout_titlecolor');
	$ogn_rw_view_checkout_boxwidth 			= get_option('ogn_rw_opt_checkout_boxwidth');
	$ogn_rw_view_checkout_bgcolor 			= get_option('ogn_rw_opt_checkout_bgcolor');
	$ogn_rw_view_checkout_txtcolor 			= get_option('ogn_rw_opt_checkout_txtcolor');
	$ogn_rw_view_checkout_icncolor 			= get_option('ogn_rw_opt_checkout_icncolor');
	$ogn_rw_view_checkout_icnbgcolor 		= get_option('ogn_rw_opt_checkout_icnbgcolor');
	
	$ogn_rw_view_nights_titlecolor 			= get_option('ogn_rw_opt_nights_titlecolor');
	$ogn_rw_view_nights_boxwidth 				= get_option('ogn_rw_opt_nights_boxwidth');
	$ogn_rw_view_nights_bgcolor 				= get_option('ogn_rw_opt_nights_bgcolor');
	$ogn_rw_view_nights_txtcolor 				= get_option('ogn_rw_opt_nights_txtcolor');
	 
	$ogn_rw_view_rooms_titlecolor 			= get_option('ogn_rw_opt_rooms_titlecolor');
	$ogn_rw_view_rooms_boxwidth 				= get_option('ogn_rw_opt_rooms_boxwidth');
	$ogn_rw_view_rooms_bgcolor 				= get_option('ogn_rw_opt_rooms_bgcolor');
	$ogn_rw_view_rooms_txtcolor 				= get_option('ogn_rw_opt_rooms_txtcolor');
	 
	$ogn_rw_view_search_btnwidth 				= get_option('ogn_rw_opt_search_btnwidth');
	$ogn_rw_view_search_btnbgcolor 			= get_option('ogn_rw_opt_search_btnbgcolor');
	$ogn_rw_view_search_txtcolor 				= get_option('ogn_rw_opt_search_txtcolor');
	
	$ogn_rw_view_setting_convert_bgcolor_rgba	= ogn_rw_hex2rgba($ogn_rw_view_setting_bgcolor,$ogn_rw_view_setting_transparency);

echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="hotel">
	<div id="main_top_bg" class="ogh_formwrap">
		<div class="top_searchbox_row">
			<div class="searchbox_wrapper">
				<div class="mainWrapper">
 				<div class="">
 					<div class="background_title col-lg-12 text-center">
 						<div class="maintitle_italic">
							<h2>'.$ogn_rw_view_setting_title.' </h2>
						</div>
					</div>
					<div class="clearfix"></div>';

if($ogn_rw_view_setting_active == 'ogn-rw-ogn-res-active') {
	echo '<style type="text/css">
		.ogh_submitwrap .searchsubmit {
		background: '.$ogn_rw_view_search_btnbgcolor.' none repeat scroll 0 0 !important;
		color: '.$ogn_rw_view_search_txtcolor.';
		width: '.$ogn_rw_view_search_btnwidth .'px;
		font-size: 15px !important;
		}

@media (max-width: 940px) {  	
.ogh_formwrap .ogh_searchbox {
  width: 100% !important;
}
  	

.ogh_formwrap .ogh_checkin {
	width: 100% !important;
}

.ogh_formwrap .ogh_checkout {
	width: 100% !important;
}

.ogh_formwrap .ogh_nights {
	width: 100% !important;
}

.ogh_formwrap .ogh_nights {
	width: 100% !important;
}

.ogh_formwrap .ogh_rooms {
	width: 100% !important;
}

.ogh_submitwrap .searchsubmit {
	background: '.$ogn_rw_view_search_btnbgcolor.' none repeat scroll 0 0 !important;
	color: '.$ogn_rw_view_search_txtcolor.';
	width: '.$ogn_rw_view_search_btnwidth .'px;
	font-size: 15px !important;
}
	
.ogh_checkout .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_checkout_titlecolor.'!important;
}

.ogh_nights .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_nights_titlecolor.';
}
				
.ogh_rooms .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_rooms_titlecolor.';
}

.ogh_checkout .input-group-addon {
	background-color: '.$ogn_rw_view_checkout_icnbgcolor.' !important;  
}

.ogh_checkin .glyphicon.glyphicon-calendar {
	/*color: '.$ogn_rw_view_checkin_icncolor.'!important;*/
	color: #0c0!important;
}

}

.ogh_checkin .input-group-addon {
	background-color: '.$ogn_rw_view_checkin_icnbgcolor.' !important;  
}

.ogh_checkin .glyphicon.glyphicon-calendar {
	color: '.$ogn_rw_view_checkin_icncolor.'!important;
}

.ogh_formwrap {
	background: '.$ogn_rw_view_setting_convert_bgcolor_rgba.' none repeat scroll 0 0;
	width: '.$ogn_rw_view_setting_boxwidth.'%; 						
}   

.ogh_checkin .input-group-addon {
	padding: 5px !important;
}

.ogh_searchbox .input-group .form-control , .ogh_checkin .input-group .form-control , .ogh_formwrap .nights ,.ogh_rooms .searchbox_wrapper .btn , .ogh_checkout .input-group .form-control , .ogh_checkout .input-group-addon , .ogh_searchbox .input-group-addon , .ogh_formwrap .roomstype , .ogh_checkin .input-group-addon{
	border: 1px solid '.$ogn_rw_view_setting_bodercolor.'; 
}

.ogh_formwrap {    					
	border: 1px solid '.$ogn_rw_view_setting_mainbodercolor.';    					
}

.ogh_formwrap {
	border-radius: '.$ogn_rw_view_setting_mainboderradius.'px;
}

.ogh_formwrap h2 {
	color: '.$ogn_rw_view_setting_titlefontcolor.';
	font-size: '.$ogn_rw_view_setting_titlefontsize.'px;
	margin: 6px 0 22px;
}					

.ogh_searchbox .control-label {
	color: '.$ogn_rw_view_location_titlecolor.';    					
}

.ogh_formwrap .ogh_searchbox { 						
	width: '.$ogn_rw_view_location_boxwidth.'%;
}					

.glyphicon.glyphicon-map-marker {
	color: '.$ogn_rw_view_location_icncolor.';
}

.ogh_searchbox .input-group-addon {
	background-color: '.$ogn_rw_view_location_icnbgcolor.' !important;    					
}					

.ogh_searchbox .input-group .form-control {
	background-color: '.$ogn_rw_view_location_bgcolor.'!important;
	color: '.$ogn_rw_view_location_txtcolor.';
}

.form-control::-moz-placeholder {
	color:'.$ogn_rw_view_location_placeholdercolor.'!important;
	opacity:1;
}

.form-control:-ms-input-placeholder {
	color:'.$ogn_rw_view_location_placeholdercolor.'!important;
}

.form-control::-webkit-input-placeholder {
	color:'.$ogn_rw_view_location_placeholdercolor.'!important;
}					

.ogh_checkin .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_checkin_titlecolor.';
}

@media all and (max-width: 3000px) and (min-width: 940px) {
	.ogh_formwrap .ogh_checkin {
	width: '.$ogn_rw_view_checkin_boxwidth.'% !important;
}

.ogh_checkin .input-group .form-control {
	background-color: '.$ogn_rw_view_checkin_bgcolor.' !important;
	color: '.$ogn_rw_view_checkin_txtcolor.';    
}

.ogh_checkout .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_checkout_titlecolor.';
}

.ogh_formwrap .ogh_checkout {
	width: '.$ogn_rw_view_checkout_boxwidth.'% !important;
}

.ogh_checkout .input-group .form-control {
	background-color: '.$ogn_rw_view_checkout_bgcolor.' !important;
	color: '.$ogn_rw_view_checkout_txtcolor.';    
}

.ogh_checkout .glyphicon.glyphicon-calendar {
	color: '.$ogn_rw_view_checkout_icncolor.';
}

.ogh_checkout .input-group-addon {
	background-color: '.$ogn_rw_view_checkout_icnbgcolor.' !important;  
}

.ogh_nights .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_nights_titlecolor.';
}

.ogh_formwrap .ogh_nights {
	width: '.$ogn_rw_view_nights_boxwidth.'% !important;
}

.ogh_nights #nightsDrpdwnBtn > span {
	color: '.$ogn_rw_view_nights_txtcolor.';
}

.ogh_formwrap .nights {
	background: '.$ogn_rw_view_nights_bgcolor.' none repeat scroll 0 0 !important;
	color: '.$ogn_rw_view_nights_txtcolor.';
}

.ogh_rooms .control-label {
	font-size: 14px;
	color: '.$ogn_rw_view_rooms_titlecolor.';
}

.ogh_formwrap .roomstype {
	background: none repeat scroll 0 0 '.$ogn_rw_view_rooms_bgcolor.' !important;
 	color: '.$ogn_rw_view_rooms_txtcolor.' !important;
	text-shadow: none;
}

.ogh_rooms #noOfRoomsDrpdwnBtn >  span {
	color: '.$ogn_rw_view_rooms_txtcolor.'!important;
}

.ogh_formwrap .ogh_rooms {
	width: '.$ogn_rw_view_rooms_boxwidth.'% !important;
}

.ogh_rooms #noOfRoomsDrpdwnBtn >  span {
	color: #333333;
}

.ogh_submitwrap .searchsubmit {
	background: '.$ogn_rw_view_search_btnbgcolor.' none repeat scroll 0 0 !important;
	color: '.$ogn_rw_view_search_txtcolor.';
	width: '.$ogn_rw_view_search_btnwidth .'px;
	font-size: 15px !important;
}
}					
</style>';
}

include( plugin_dir_path( __FILE__ ) . '/ogn-rw-form-view.php');
wp_enqueue_script( 'ogn-rw-form-script.js', plugins_url( 'ogn-rw-form-script.js', __FILE__ ) );
echo '</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div role="tabpanel" class="tab-pane fade" id="flights">
<div id="main_top_bg" class="ogh_formwrap">
<div class="top_searchbox_row">
<div class="searchbox_wrapper">
<div class="mainWrapper">
<div class="">
<div class="background_title col-lg-12 text-center">
<div class="maintitle_italic">
<h2>'.$opt_title_val.'</h2>
</div>
</div>
<div class="clearfix"></div>';	
echo '</div>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>';	
?>
<div> </div>
<?php
}
add_shortcode( 'ogn_rw_widget_screen', 'ogn_rw_load_widget_screen' );


function ogn_rw_load_admin_menu() {
    add_options_page(__('Reservation Widget','menu-ogn-rw'), __('Oganro-Reservation','menu-ogn-rw'), 'manage_options', 'ogn_rw_reservation_admin', 'ogn_rw_load_settings_page');
}
add_action('admin_menu', 'ogn_rw_load_admin_menu');


function ogn_rw_load_settings_page() {
   if (!current_user_can('manage_options')){
   	wp_die( __('You do not have sufficient permissions to access this page.') );
   }
   $loop = get_option( 'ogn_rw_opt_setting_boxwidth' );
	if($loop == 0){
		$loop = 100;
	}
   
	$ogn_rw_opt_setting_active 				= 'ogn_rw_opt_setting_active';
   $ogn_rw_opt_setting_active_val			=	get_option( $ogn_rw_opt_setting_active );    
	$ogn_rw_opt_setting_title 					= 'ogn_rw_opt_setting_title';
	$ogn_rw_opt_setting_title_val				=	get_option( $ogn_rw_opt_setting_title );	
	$ogn_rw_opt_setting_cname 					= 'ogn_rw_opt_setting_cname';
	$ogn_rw_opt_setting_cname_val				=	get_option( $ogn_rw_opt_setting_cname );		
	$ogn_rw_opt_setting_bgcolor 				= 'ogn_rw_opt_setting_bgcolor';
	$ogn_rw_opt_setting_bgcolor_val			=  get_option( $ogn_rw_opt_setting_bgcolor );	
	$ogn_rw_opt_setting_boxwidth 				= 'ogn_rw_opt_setting_boxwidth';
	$ogn_rw_opt_setting_boxwidth_val			=  get_option( $ogn_rw_opt_setting_boxwidth );		
	$ogn_rw_opt_setting_bodercolor 			= 'ogn_rw_opt_setting_bodercolor';
	$ogn_rw_opt_setting_bodercolor_val		=  get_option( $ogn_rw_opt_setting_bodercolor );	
	$ogn_rw_opt_setting_mainbodercolor 		= 'ogn_rw_opt_setting_mainbodercolor';
   $ogn_rw_opt_setting_mainbodercolor_val	=	get_option( $ogn_rw_opt_setting_mainbodercolor );   
   $ogn_rw_opt_setting_mainboderradius 	= 'ogn_rw_opt_setting_mainboderradius';
   $ogn_rw_opt_setting_mainboderradius_val=	get_option( $ogn_rw_opt_setting_mainboderradius );   
   $ogn_rw_opt_setting_titlefontsize 		= 'ogn_rw_opt_setting_titlefontsize';
   $ogn_rw_opt_setting_titlefontsize_val	=	get_option( $ogn_rw_opt_setting_titlefontsize );   
   $ogn_rw_opt_setting_titlefontcolor 		= 'ogn_rw_opt_setting_titlefontcolor';
   $ogn_rw_opt_setting_titlefontcolor_val	=	get_option( $ogn_rw_opt_setting_titlefontcolor );      
   $ogn_rw_opt_setting_transparency 		= 'ogn_rw_opt_setting_transparency';
   $ogn_rw_opt_setting_transparency_val	=	get_option( $ogn_rw_opt_setting_transparency );   
   $ogn_rw_opt_setting_boxwidth_hidden		= 'ogn_rw_opt_setting_boxwidth_hidden';      
      
	$ogn_rw_opt_location_title 						= 'ogn_rw_opt_location_title';
   $ogn_rw_opt_location_title_val					=	get_option( $ogn_rw_opt_location_title );
   $ogn_rw_opt_location_titlecolor 					= 'ogn_rw_opt_location_titlecolor';
   $ogn_rw_opt_location_titlecolor_val				=	get_option( $ogn_rw_opt_location_titlecolor );
   $ogn_rw_opt_location_placeholder					= 'ogn_rw_opt_location_placeholder';
   $ogn_rw_opt_location_placeholder_val			=	get_option( $ogn_rw_opt_location_placeholder );
   $ogn_rw_opt_location_placeholdercolor			= 'ogn_rw_opt_location_placeholdercolor';
   $ogn_rw_opt_location_placeholdercolor_val		=	get_option( $ogn_rw_opt_location_placeholdercolor );
   $ogn_rw_opt_location_boxwidth 					= 'ogn_rw_opt_location_boxwidth';
	$ogn_rw_opt_location_boxwidth_val				=	get_option( $ogn_rw_opt_location_boxwidth );
   $ogn_rw_opt_location_bgcolor 						= 'ogn_rw_opt_location_bgcolor';
   $ogn_rw_opt_location_bgcolor_val					=	get_option( $ogn_rw_opt_location_bgcolor );    
   $ogn_rw_opt_location_txtcolor 					= 'ogn_rw_opt_location_txtcolor';
   $ogn_rw_opt_location_txtcolor_val				=	get_option( $ogn_rw_opt_location_txtcolor );
   $ogn_rw_opt_location_icncolor 					= 'ogn_rw_opt_location_icncolor';
   $ogn_rw_opt_location_icncolor_val				=	get_option( $ogn_rw_opt_location_icncolor );
   $ogn_rw_opt_location_icnbgcolor 					= 'ogn_rw_opt_location_icnbgcolor';
   $ogn_rw_opt_location_icnbgcolor_val				=	get_option( $ogn_rw_opt_location_icnbgcolor );    
   	
	$ogn_rw_opt_checkin_title 					= 'ogn_rw_opt_checkin_title';
   $ogn_rw_opt_checkin_title_val				=	get_option( $ogn_rw_opt_checkin_title );
   $ogn_rw_opt_checkin_titlecolor 			= 'ogn_rw_opt_checkin_titlecolor';
   $ogn_rw_opt_checkin_titlecolor_val		=	get_option( $ogn_rw_opt_checkin_titlecolor );
	$ogn_rw_opt_checkin_boxwidth 				= 'ogn_rw_opt_checkin_boxwidth';
   $ogn_rw_opt_checkin_boxwidth_val			=	get_option( $ogn_rw_opt_checkin_boxwidth );	    
   $ogn_rw_opt_checkin_bgcolor 				= 'ogn_rw_opt_checkin_bgcolor';
   $ogn_rw_opt_checkin_bgcolor_val			=	get_option( $ogn_rw_opt_checkin_bgcolor );
   $ogn_rw_opt_checkin_txtcolor 				= 'ogn_rw_opt_checkin_txtcolor';
   $ogn_rw_opt_checkin_txtcolor_val			=	get_option( $ogn_rw_opt_checkin_txtcolor );
   $ogn_rw_opt_checkin_icncolor 				= 'ogn_rw_opt_checkin_icncolor';
   $ogn_rw_opt_checkin_icncolor_val			=	get_option( $ogn_rw_opt_checkin_icncolor );
   $ogn_rw_opt_checkin_icnbgcolor 			= 'ogn_rw_opt_checkin_icnbgcolor';
   $ogn_rw_opt_checkin_icnbgcolor_val		=	get_option( $ogn_rw_opt_checkin_icnbgcolor );
      
   $ogn_rw_opt_checkout_title 				= 'ogn_rw_opt_checkout_title';
   $ogn_rw_opt_checkout_title_val			=	get_option( $ogn_rw_opt_checkout_title );
   $ogn_rw_opt_checkout_titlecolor 			= 'ogn_rw_opt_checkout_titlecolor';
   $ogn_rw_opt_checkout_titlecolor_val		=	get_option( $ogn_rw_opt_checkout_titlecolor );
	$ogn_rw_opt_checkout_boxwidth 			= 'ogn_rw_opt_checkout_boxwidth';
   $ogn_rw_opt_checkout_boxwidth_val		=	get_option( $ogn_rw_opt_checkout_boxwidth );	    
   $ogn_rw_opt_checkout_bgcolor 				= 'ogn_rw_opt_checkout_bgcolor';
   $ogn_rw_opt_checkout_bgcolor_val			=	get_option( $ogn_rw_opt_checkout_bgcolor );
   $ogn_rw_opt_checkout_txtcolor 			= 'ogn_rw_opt_checkout_txtcolor';
   $ogn_rw_opt_checkout_txtcolor_val		=	get_option( $ogn_rw_opt_checkout_txtcolor );
   $ogn_rw_opt_checkout_icncolor 			= 'ogn_rw_opt_checkout_icncolor';
   $ogn_rw_opt_checkout_icncolor_val		=	get_option( $ogn_rw_opt_checkout_icncolor );
   $ogn_rw_opt_checkout_icnbgcolor 			= 'ogn_rw_opt_checkout_icnbgcolor';
   $ogn_rw_opt_checkout_icnbgcolor_val		=	get_option( $ogn_rw_opt_checkout_icnbgcolor );
   	
	$ogn_rw_opt_nights_title 					= 'ogn_rw_opt_nights_title';
   $ogn_rw_opt_nights_title_val				=	get_option( $ogn_rw_opt_nights_title );
   $ogn_rw_opt_nights_titlecolor 			= 'ogn_rw_opt_nights_titlecolor';
   $ogn_rw_opt_nights_titlecolor_val		=	get_option( $ogn_rw_opt_nights_titlecolor );
   $ogn_rw_opt_nights_boxwidth 				= 'ogn_rw_opt_nights_boxwidth';
   $ogn_rw_opt_nights_boxwidth_val			=	get_option( $ogn_rw_opt_nights_boxwidth );
   $ogn_rw_opt_nights_bgcolor 				= 'ogn_rw_opt_nights_bgcolor';
   $ogn_rw_opt_nights_bgcolor_val			=	get_option( $ogn_rw_opt_nights_bgcolor );
   $ogn_rw_opt_nights_txtcolor 				= 'ogn_rw_opt_nights_txtcolor';
   $ogn_rw_opt_nights_txtcolor_val			=	get_option( $ogn_rw_opt_nights_txtcolor );
		
	$ogn_rw_opt_rooms_title 					= 'ogn_rw_opt_rooms_title';
   $ogn_rw_opt_rooms_title_val				=	get_option( $ogn_rw_opt_rooms_title );
   $ogn_rw_opt_rooms_titlecolor 				= 'ogn_rw_opt_rooms_titlecolor';
   $ogn_rw_opt_rooms_titlecolor_val			=	get_option( $ogn_rw_opt_rooms_titlecolor );
   $ogn_rw_opt_rooms_bgcolor 					= 'ogn_rw_opt_rooms_bgcolor';
   $ogn_rw_opt_rooms_bgcolor_val				=	get_option( $ogn_rw_opt_rooms_bgcolor );
   $ogn_rw_opt_rooms_txtcolor 				= 'ogn_rw_opt_rooms_txtcolor';
   $ogn_rw_opt_rooms_txtcolor_val			=	get_option( $ogn_rw_opt_rooms_txtcolor );    
   $ogn_rw_opt_rooms_boxwidth 				= 'ogn_rw_opt_rooms_boxwidth';
   $ogn_rw_opt_rooms_boxwidth_val			=	get_option( $ogn_rw_opt_rooms_boxwidth );    
		
	$ogn_rw_opt_search_btntxt 					= 'ogn_rw_opt_search_btntxt';
   $ogn_rw_opt_search_btntxt_val				=	get_option( $ogn_rw_opt_search_btntxt );
   $ogn_rw_opt_search_btnwidth 				= 'ogn_rw_opt_search_btnwidth';
   $ogn_rw_opt_search_btnwidth_val			=	get_option( $ogn_rw_opt_search_btnwidth );
   $ogn_rw_opt_search_btnbgcolor 			= 'ogn_rw_opt_search_btnbgcolor';
   $ogn_rw_opt_search_btnbgcolor_val		=	get_option( $ogn_rw_opt_search_btnbgcolor );
   $ogn_rw_opt_search_txtcolor 				= 'ogn_rw_opt_search_txtcolor';
   $ogn_rw_opt_search_txtcolor_val			=	get_option( $ogn_rw_opt_search_txtcolor );    
    
    if( isset($_POST[ 'ogn_rw_admin_submit' ]) ) {
		  
		  $ogn_rw_opt_setting_active_val	= 'ogn-rw-ogn-res-active';
		  update_option( $ogn_rw_opt_setting_active, $ogn_rw_opt_setting_active_val );		  
		  $ogn_rw_opt_setting_title_val	= $_POST[ $ogn_rw_opt_setting_title ];
		  update_option( $ogn_rw_opt_setting_title, $ogn_rw_opt_setting_title_val );
		  $ogn_rw_opt_setting_cname_val	= $_POST[ $ogn_rw_opt_setting_cname ];
		  update_option( $ogn_rw_opt_setting_cname, $ogn_rw_opt_setting_cname_val );			  
		  $ogn_rw_opt_setting_bgcolor_val	= $_POST[ $ogn_rw_opt_setting_bgcolor ];
		  update_option( $ogn_rw_opt_setting_bgcolor, $ogn_rw_opt_setting_bgcolor_val );			  
		  $ogn_rw_opt_setting_boxwidth_val	= $_POST[ $ogn_rw_opt_setting_boxwidth_hidden ];//$_POST[ $opt_setting_boxwidth ];
		  update_option( $ogn_rw_opt_setting_boxwidth, $ogn_rw_opt_setting_boxwidth_val );		  
		  $ogn_rw_opt_setting_bodercolor_val	= $_POST[ $ogn_rw_opt_setting_bodercolor ];		  
		  update_option( $ogn_rw_opt_setting_bodercolor, $ogn_rw_opt_setting_bodercolor_val );		  
		  $ogn_rw_opt_setting_mainbodercolor_val	= $_POST[ $ogn_rw_opt_setting_mainbodercolor ];		  
		  update_option( $ogn_rw_opt_setting_mainbodercolor, $ogn_rw_opt_setting_mainbodercolor_val );		  
		  $ogn_rw_opt_setting_mainboderradius_val	= $_POST[ $ogn_rw_opt_setting_mainboderradius ];		  
		  update_option( $ogn_rw_opt_setting_mainboderradius, $ogn_rw_opt_setting_mainboderradius_val );		  
		  $ogn_rw_opt_setting_titlefontsize_val	= $_POST[ $ogn_rw_opt_setting_titlefontsize ];		  
		  update_option( $ogn_rw_opt_setting_titlefontsize, $ogn_rw_opt_setting_titlefontsize_val );		  
		  $ogn_rw_opt_setting_titlefontcolor_val	= $_POST[ $ogn_rw_opt_setting_titlefontcolor ];		  
		  update_option( $ogn_rw_opt_setting_titlefontcolor, $ogn_rw_opt_setting_titlefontcolor_val );		  
		  $ogn_rw_opt_setting_transparency_val	= $_POST[ $ogn_rw_opt_setting_transparency ];		  
		  update_option( $ogn_rw_opt_setting_transparency, $ogn_rw_opt_setting_transparency_val );		  		  
    	  
    	  $ogn_rw_opt_location_title_val	= $_POST[ $ogn_rw_opt_location_title ];    	  
    	  update_option( $ogn_rw_opt_location_title, $ogn_rw_opt_location_title_val );    	  
    	  $ogn_rw_opt_location_titlecolor_val	= $_POST[ $ogn_rw_opt_location_titlecolor ];    	  
    	  update_option( $ogn_rw_opt_location_titlecolor, $ogn_rw_opt_location_titlecolor_val );    	  
    	  $ogn_rw_opt_location_placeholder_val	= $_POST[ $ogn_rw_opt_location_placeholder ];    	  
    	  update_option( $ogn_rw_opt_location_placeholder, $ogn_rw_opt_location_placeholder_val );   	  
    	  $ogn_rw_opt_location_placeholdercolor_val	= $_POST[ $ogn_rw_opt_location_placeholdercolor ];    	  
    	  update_option( $ogn_rw_opt_location_placeholdercolor, $ogn_rw_opt_location_placeholdercolor_val );    	  
    	  $ogn_rw_opt_location_boxwidth_val	= $_POST[ $ogn_rw_opt_location_boxwidth ];    	  
    	  update_option( $ogn_rw_opt_location_boxwidth, $ogn_rw_opt_location_boxwidth_val );    	  
    	  $ogn_rw_opt_location_bgcolor_val	= $_POST[ $ogn_rw_opt_location_bgcolor ];    	  
    	  update_option( $ogn_rw_opt_location_bgcolor, $ogn_rw_opt_location_bgcolor_val );    	  
    	  $ogn_rw_opt_location_txtcolor_val	= $_POST[ $ogn_rw_opt_location_txtcolor ];    	  
    	  update_option( $ogn_rw_opt_location_txtcolor, $ogn_rw_opt_location_txtcolor_val );    	  
    	  $ogn_rw_opt_location_icncolor_val	= $_POST[ $ogn_rw_opt_location_icncolor ];    	  
    	  update_option( $ogn_rw_opt_location_icncolor, $ogn_rw_opt_location_icncolor_val );    	  
    	  $ogn_rw_opt_location_icnbgcolor_val	= $_POST[ $ogn_rw_opt_location_icnbgcolor ];    	  
    	  update_option( $ogn_rw_opt_location_icnbgcolor, $ogn_rw_opt_location_icnbgcolor_val );    	  
    	  		  
		  $ogn_rw_opt_checkin_title_val	= $_POST[ $ogn_rw_opt_checkin_title ];    	  
    	  update_option( $ogn_rw_opt_checkin_title, $ogn_rw_opt_checkin_title_val );    	  
    	  $ogn_rw_opt_checkin_titlecolor_val	= $_POST[ $ogn_rw_opt_checkin_titlecolor ];    	  
    	  update_option( $ogn_rw_opt_checkin_titlecolor, $ogn_rw_opt_checkin_titlecolor_val );  
    	  $ogn_rw_opt_checkin_boxwidth_val	= $_POST[ $ogn_rw_opt_checkin_boxwidth ];    	  
    	  update_option( $ogn_rw_opt_checkin_boxwidth, $ogn_rw_opt_checkin_boxwidth_val );
    	  $ogn_rw_opt_checkin_bgcolor_val	= $_POST[ $ogn_rw_opt_checkin_bgcolor ];    	  
    	  update_option( $ogn_rw_opt_checkin_bgcolor, $ogn_rw_opt_checkin_bgcolor_val );
    	  $ogn_rw_opt_checkin_txtcolor_val	= $_POST[ $ogn_rw_opt_checkin_txtcolor ];    	  
    	  update_option( $ogn_rw_opt_checkin_txtcolor, $ogn_rw_opt_checkin_txtcolor_val );
    	  $ogn_rw_opt_checkin_icncolor_val	= $_POST[ $ogn_rw_opt_checkin_icncolor ];    	  
    	  update_option( $ogn_rw_opt_checkin_icncolor, $ogn_rw_opt_checkin_icncolor_val );
    	  $ogn_rw_opt_checkin_icnbgcolor_val	= $_POST[ $ogn_rw_opt_checkin_icnbgcolor ];    	  
    	  update_option( $ogn_rw_opt_checkin_icnbgcolor, $ogn_rw_opt_checkin_icnbgcolor_val );
		  		  
		  $ogn_rw_opt_checkout_title_val	= $_POST[ $ogn_rw_opt_checkout_title ];    	  
    	  update_option( $ogn_rw_opt_checkout_title, $ogn_rw_opt_checkout_title_val );    	  
    	  $ogn_rw_opt_checkout_titlecolor_val	= $_POST[ $ogn_rw_opt_checkout_titlecolor ];    	  
    	  update_option( $ogn_rw_opt_checkout_titlecolor, $ogn_rw_opt_checkout_titlecolor_val );  
    	  $ogn_rw_opt_checkout_boxwidth_val	= $_POST[ $ogn_rw_opt_checkout_boxwidth ];    	  
    	  update_option( $ogn_rw_opt_checkout_boxwidth, $ogn_rw_opt_checkout_boxwidth_val );
    	  $ogn_rw_opt_checkout_bgcolor_val	= $_POST[ $ogn_rw_opt_checkout_bgcolor ];    	  
    	  update_option( $ogn_rw_opt_checkout_bgcolor, $ogn_rw_opt_checkout_bgcolor_val );
    	  $ogn_rw_opt_checkout_txtcolor_val	= $_POST[ $ogn_rw_opt_checkout_txtcolor ];    	  
    	  update_option( $ogn_rw_opt_checkout_txtcolor, $ogn_rw_opt_checkout_txtcolor_val );
    	  $ogn_rw_opt_checkout_icncolor_val	= $_POST[ $ogn_rw_opt_checkout_icncolor ];    	  
    	  update_option( $ogn_rw_opt_checkout_icncolor, $ogn_rw_opt_checkout_icncolor_val );
    	  $ogn_rw_opt_checkout_icnbgcolor_val	= $_POST[ $ogn_rw_opt_checkout_icnbgcolor ];    	  
    	  update_option( $ogn_rw_opt_checkout_icnbgcolor, $ogn_rw_opt_checkout_icnbgcolor_val );

    	  $ogn_rw_opt_nights_title_val	= $_POST[ $ogn_rw_opt_nights_title ];    	  
    	  update_option( $ogn_rw_opt_nights_title, $ogn_rw_opt_nights_title_val );    	  
    	  $ogn_rw_opt_nights_titlecolor_val	= $_POST[ $ogn_rw_opt_nights_titlecolor ];    	  
    	  update_option( $ogn_rw_opt_nights_titlecolor, $ogn_rw_opt_nights_titlecolor_val );  
    	  $ogn_rw_opt_nights_boxwidth_val	= $_POST[ $ogn_rw_opt_nights_boxwidth ];    	  
    	  update_option( $ogn_rw_opt_nights_boxwidth, $ogn_rw_opt_nights_boxwidth_val );
    	  $ogn_rw_opt_nights_bgcolor_val	= $_POST[ $ogn_rw_opt_nights_bgcolor ];    	  
    	  update_option( $ogn_rw_opt_nights_bgcolor, $ogn_rw_opt_nights_bgcolor_val );
    	  $ogn_rw_opt_nights_txtcolor_val	= $_POST[ $ogn_rw_opt_nights_txtcolor ];
    	  update_option( $ogn_rw_opt_nights_txtcolor, $ogn_rw_opt_nights_txtcolor_val );    	      	  
    	  
    	  $ogn_rw_opt_rooms_title_val	= $_POST[ $ogn_rw_opt_rooms_title ];    	  
    	  update_option( $ogn_rw_opt_rooms_title, $ogn_rw_opt_rooms_title_val );    	  
    	  $ogn_rw_opt_rooms_titlecolor_val	= $_POST[ $ogn_rw_opt_rooms_titlecolor ];    	  
    	  update_option( $ogn_rw_opt_rooms_titlecolor, $ogn_rw_opt_rooms_titlecolor_val );    	  
    	  $ogn_rw_opt_rooms_bgcolor_val	= $_POST[ $ogn_rw_opt_rooms_bgcolor ];    	  
    	  update_option( $ogn_rw_opt_rooms_bgcolor, $ogn_rw_opt_rooms_bgcolor_val );    	  
    	  $ogn_rw_opt_rooms_txtcolor_val	= $_POST[ $ogn_rw_opt_rooms_txtcolor ];
    	  update_option( $ogn_rw_opt_rooms_txtcolor, $ogn_rw_opt_rooms_txtcolor_val );
    	  $ogn_rw_opt_rooms_boxwidth_val	= $_POST[ $ogn_rw_opt_rooms_boxwidth ];    	  
    	  update_option( $ogn_rw_opt_rooms_boxwidth, $ogn_rw_opt_rooms_boxwidth_val );    	      	  

    	  $ogn_rw_opt_search_btntxt_val	= $_POST[ $ogn_rw_opt_search_btntxt ];    	  
    	  update_option( $ogn_rw_opt_search_btntxt, $ogn_rw_opt_search_btntxt_val );
    	  $ogn_rw_opt_search_btnwidth_val	= $_POST[ $ogn_rw_opt_search_btnwidth ];    	  
    	  update_option( $ogn_rw_opt_search_btnwidth, $ogn_rw_opt_search_btnwidth_val );
    	  $ogn_rw_opt_search_btnbgcolor_val	= $_POST[ $ogn_rw_opt_search_btnbgcolor ];    	  
    	  update_option( $ogn_rw_opt_search_btnbgcolor, $ogn_rw_opt_search_btnbgcolor_val );
    	  $ogn_rw_opt_search_txtcolor_val	= $_POST[ $ogn_rw_opt_search_txtcolor ];    	  
    	  update_option( $ogn_rw_opt_search_txtcolor, $ogn_rw_opt_search_txtcolor_val );
        
        $loop = $ogn_rw_opt_setting_boxwidth_val;
			if($loop == 0){
	 			$loop =100;
	 		}
}
    echo '<div class="ognwrap">';
    echo "<h2>" . __( 'Oganro Reservation Widget', 'menu-ogn-rw' ) . "</h2><hr width='100%' class='line'> ";
    if( isset($_POST[ 'Submit' ]) ) {
?>
<div class="ogh_admin_updated"><p><strong><?php _e('Your settings has been updated.', 'menu-ogn-rw' ); ?></strong></p></div>
<?php } ?>
<form id="form1" name="form1" method="post" action="">

<fieldset title="Settings" class="fieldwrap settings">
<legend><span class="iconssettings"></span> Settings</legend>


<table class="sectionwrappers">

<tr>
	<td><?php _e("Search Box Title", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_title; ?>" value="<?php echo $ogn_rw_opt_setting_title_val; ?>" size="" style="width: 600px;" title="Heading of the reservation box"/></td>	
    <td></td>    
</tr>
<tr>
	<td><?php _e("Search Box Title Font Size", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_titlefontsize; ?>" value="<?php echo $ogn_rw_opt_setting_titlefontsize_val; ?>" size="" style="width: 100px;"/>px</td>	
    <td></td>    
</tr>
<tr>

	<td class="colorpick"><?php _e("Search Box Title Font Colour ", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_titlefontcolor; ?>" value="<?php echo $ogn_rw_opt_setting_titlefontcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Cname Domain", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_cname; ?>" value="<?php echo $ogn_rw_opt_setting_cname_val; ?>" size="" style="width: 600px;"/></td>	
    <td><em></em></td>    
</tr>
<tr>

	<td class="colorpick"><?php _e("Search Box Background Colour ", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_bgcolor; ?>" value="<?php echo $ogn_rw_opt_setting_bgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Search Box Transparency", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_transparency; ?>" value="<?php echo $ogn_rw_opt_setting_transparency_val; ?>" size="" style="width: 100px;" class="" /> ( Values should be within 0 - 1 ) eg. 0.4</td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Search Box width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5">
	<script>
for (i=0;i<=100;i++)
 {
 s = "<span class='sliderline' style='height:15px;width:3px;' onMouseOver='f(" + i + ")' id='i" + i + "' onclick='ognSliderClick("+ i +");' onmouseout='ognResetValue();'>&nbsp;</span>";
 document.write(s);
 }
</script>   
   <input type=text name="<?php echo $ogn_rw_opt_setting_boxwidth; ?>" value=0 id='t1'  class="og_wrapbar_val" readonly="readonly"> %
   <input type=hidden name="ogn_rw_opt_setting_boxwidth_hidden" value="<?php echo $loop; ?>" id='ogn_rw_opt_setting_boxwidth_hidden'  class="og_wrapbar_val" readonly="readonly">
   </td>	
</tr>

<tr>
	<td><?php _e("Search Box Boarder Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_mainbodercolor; ?>" value="<?php echo $ogn_rw_opt_setting_mainbodercolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Search Box Boarder Radius", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_mainboderradius; ?>" value="<?php echo $ogn_rw_opt_setting_mainboderradius_val; ?>" size="" style="width: 100px;"/>px</td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Search Element Boarder Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_setting_bodercolor; ?>" value="<?php echo $ogn_rw_opt_setting_bodercolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

</table>
</fieldset>

<fieldset title="Settings" class="fieldwrap locn">
<legend><span class="location"></span> Location </legend>

<table class="sectionwrappers">

<tr>
	<td><?php _e("Title", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_title; ?>" value="<?php echo $ogn_rw_opt_location_title_val; ?>" size="" /></td>	
    <td></td>    
</tr>
<tr>

<tr>

	<td><?php _e("Title Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_titlecolor; ?>" value="<?php echo $ogn_rw_opt_location_titlecolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>
	<td><?php _e("Place holder Text", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_placeholder; ?>" value="<?php echo $ogn_rw_opt_location_placeholder_val; ?>" size="" /></td>	
    <td></td>    
</tr>

<tr>

	<td><?php _e("Place holder Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_placeholdercolor; ?>" value="<?php echo $ogn_rw_opt_location_placeholdercolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Box Width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_boxwidth; ?>" value="<?php echo $ogn_rw_opt_location_boxwidth_val; ?>" size="" style="width: 100px;"/>%</td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_bgcolor; ?>" value="<?php echo $ogn_rw_opt_location_bgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Text Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_txtcolor; ?>" value="<?php echo $ogn_rw_opt_location_txtcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Icon Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_icncolor; ?>" value="<?php echo $ogn_rw_opt_location_icncolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Icon Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_location_icnbgcolor; ?>" value="<?php echo $ogn_rw_opt_location_icnbgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

</table></fieldset>

<fieldset title="Settings" class="fieldwrap chkin">
<legend><span class="checkin"></span> Check In</legend>

<table class="sectionwrappers">

<tr>
	<td><?php _e("Title", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_title; ?>" value="<?php echo $ogn_rw_opt_checkin_title_val; ?>" size="" /></td>	
   <td></td>    

<tr>
	<td><?php _e("Title Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_titlecolor; ?>" value="<?php echo $ogn_rw_opt_checkin_titlecolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Box Width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_boxwidth; ?>" value="<?php echo $ogn_rw_opt_checkin_boxwidth_val; ?>" size="" style="width: 100px;"/>%</td>	
    <td></td>    
</tr>


<tr>
	<td><?php _e("Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_bgcolor; ?>" value="<?php echo $ogn_rw_opt_checkin_bgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Text Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_txtcolor; ?>" value="<?php echo $ogn_rw_opt_checkin_txtcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Icon Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_icncolor; ?>" value="<?php echo $ogn_rw_opt_checkin_icncolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Icon Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkin_icnbgcolor; ?>" value="<?php echo $ogn_rw_opt_checkin_icnbgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

</table></fieldset>

<span class="clear"></span>
<fieldset title="Settings" class="fieldwrap chkout">
<legend><span class="checkout"></span> Check Out</legend>

<table class="sectionwrappers">

<tr>
	<td><?php _e("Title", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_title; ?>" value="<?php echo $ogn_rw_opt_checkout_title_val; ?>" size="" /></td>	
   <td></td>    

<tr>
<tr>
	<td><?php _e("Title Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_titlecolor; ?>" value="<?php echo $ogn_rw_opt_checkout_titlecolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Box Width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_boxwidth; ?>" value="<?php echo $ogn_rw_opt_checkout_boxwidth_val; ?>" size="" style="width: 100px;"/>%</td>	
    <td></td>    
</tr>


<tr>
	<td><?php _e("Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_bgcolor; ?>" value="<?php echo $ogn_rw_opt_checkout_bgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>
<tr>
	<td><?php _e("Text Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_txtcolor; ?>" value="<?php echo $ogn_rw_opt_checkout_txtcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>


<tr>
	<td><?php _e("Icon Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_icncolor; ?>" value="<?php echo $ogn_rw_opt_checkout_icncolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Icon Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_checkout_icnbgcolor; ?>" value="<?php echo $ogn_rw_opt_checkout_icnbgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

</table></fieldset>

<fieldset title="Settings" class="fieldwrap night">
<legend><span class="nights"></span>Nights</legend>

<table class="sectionwrappers">

<tr>
	<td><?php _e("Title", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_nights_title; ?>" value="<?php echo $ogn_rw_opt_nights_title_val; ?>" size="" /></td>	
   <td></td>    
</tr>
<tr>

	<td><?php _e("Title Color", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_nights_titlecolor; ?>" value="<?php echo $ogn_rw_opt_nights_titlecolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>


<tr>
	<td><?php _e("Box Width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_nights_boxwidth; ?>" value="<?php echo $ogn_rw_opt_nights_boxwidth_val; ?>" size="" style="width: 100px;"/>%</td>	
    <td></td>    
</tr>


<tr>
	<td><?php _e("Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_nights_bgcolor; ?>" value="<?php echo $ogn_rw_opt_nights_bgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>
<tr>
	<td><?php _e("Text Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_nights_txtcolor; ?>" value="<?php echo $ogn_rw_opt_nights_txtcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

</table></fieldset>
<span class="clear"></span>

<fieldset title="Settings" class="fieldwrap rooms">
<legend><span class="roomsicon"></span>Rooms</legend>

<table class="sectionwrappers">
<tr>
	<td><?php _e("Title", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_rooms_title; ?>" value="<?php echo $ogn_rw_opt_rooms_title_val; ?>" size="" /></td>	
   <td></td>    
</tr>

<tr>

	<td><?php _e("Title Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_rooms_titlecolor; ?>" value="<?php echo $ogn_rw_opt_rooms_titlecolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_rooms_bgcolor; ?>" value="<?php echo $ogn_rw_opt_rooms_bgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>
<tr>
	<td><?php _e("Text Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
    <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_rooms_txtcolor; ?>" value="<?php echo $ogn_rw_opt_rooms_txtcolor_val; ?>" size="" style="width: 100px;" class="my-color-field" /></td>	
    <td></td>    
</tr>

<tr>
	<td><?php _e("Box width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_rooms_boxwidth; ?>" value="<?php echo $ogn_rw_opt_rooms_boxwidth_val; ?>" size="" style="width: 100px;"/>%</td>	
   <td></td>    
</tr>
</table></fieldset>


<fieldset title="Settings" class="fieldwrap serch">
<legend><span class="seachbox"></span>Search</legend>


<table class="sectionwrappers">
<tr>
	<td><?php _e("Button Text", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_search_btntxt; ?>" value="<?php echo $ogn_rw_opt_search_btntxt_val; ?>" size="" /></td>	
   <td></td>    
</tr>
<tr>
	<td><?php _e("Button width", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_search_btnwidth; ?>" value="<?php echo $ogn_rw_opt_search_btnwidth_val; ?>" size="" style="width: 100px;"/>px</td>	
   <td></td>    
</tr>
<tr>
	<td><?php _e("Button Background Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_search_btnbgcolor; ?>" value="<?php echo $ogn_rw_opt_search_btnbgcolor_val; ?>" size="" style="width: 100px;" class="my-color-field"/></td>	
   <td></td>    
</tr>

<tr>
	<td><?php _e("Button Text Colour", 'menu-ogn-rw' ); ?></td>
	<td>:</td>
   <td colspan="5"><input type="text" name="<?php echo $ogn_rw_opt_search_txtcolor; ?>" value="<?php echo $ogn_rw_opt_search_txtcolor_val; ?>" size="" style="width: 100px;" class="my-color-field"/></td>	
   <td></td>    
</tr>

</table></fieldset>
<span class="clear"></span>

<input type="submit" name="ogn_rw_admin_submit" class="button-primary savebtn" value="<?php esc_attr_e('Save Changes') ?>" />

</form>
</div>

<script>
var stp = '<?php echo $loop ?>';
</script>

<?php
}
function ogn_rw_load_admin_stylesheet( $hook ) {	
	if ( 'settings_page_ogn_rw_reservation_admin' != $hook ) {
		return;
	}
	wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'myscript.js' );
   wp_enqueue_style( 'wp-color-picker' );
   wp_enqueue_style( 'ogn-reservation-admin.css', plugins_url( 'ogn-reservation-admin.css', __FILE__ ) );	
   wp_enqueue_script( 'my-script-handle', plugins_url('	color-pic-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
   wp_enqueue_script( 'ogn-rw-main-wrapper-script.js', plugins_url( 'ogn-rw-main-wrapper-script.js', __FILE__ ) );    
}
add_action( 'admin_enqueue_scripts', 'ogn_rw_load_admin_stylesheet' );
?>