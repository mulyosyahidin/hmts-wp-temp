<?php
/*

Plugin Name: Boosted Elements
Description: Page Builder Add-on for Elementor
Plugin URI: https://boosted.progression-studios.com
Version: 5.2
Author: Progression Studios
Author URI: http://progressionstudios.com/
Text Domain: boosted-elements-progression
License: GNU General Public License v3.0

*/
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

define( 'BOOSTED_ELEMENTS_PROGRESSION_FILE__', __FILE__ );
define( 'BOOSTED_ELEMENTS_PROGRESSION_PATH', plugin_dir_path( __FILE__ ) );

// Translation Setup
function boosted_elements_progression() {
	load_plugin_textdomain( 'boosted-elements-progression', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
	require( __DIR__ . '/elementor-helper.php' );
	require( __DIR__ . '/elements/queries.php' );
    require( __DIR__ . '/admin/mega-menu/mega-menu-framework.php' );
	
    if ( class_exists( 'WooCommerce' ) ) {
    require( __DIR__ . '/woo-helper.php' );
    }
	
	//Plugin Activation
	require BOOSTED_ELEMENTS_PROGRESSION_PATH . 'admin/tgm-plugin-activation/plugin-activation.php';
	
}
add_action('plugins_loaded', 'boosted_elements_progression');


//Plugin Updator
require BOOSTED_ELEMENTS_PROGRESSION_PATH . 'admin/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://progression-studios.com/updater/update-details.json',
    __FILE__, 'boosted-elements-progression'
);


// Google Maps API Key
function boosted_elements_progression_google_maps_customizer( $wp_customize ) {
	$wp_customize->add_section( 'boosted_elements_progression_panel_google_Maps', array(
		'priority'    => 800,
       'title'       => esc_html__( 'Google Maps', 'boosted-elements-progression' ),
    ) );
	 
	$wp_customize->add_setting( 'boosted_elements_progression_google_maps_api' ,array(
		'default' =>  '',
		'sanitize_callback' => 'boosted_elements_progression_google_maps_sanitize_text',
	) );
	$wp_customize->add_control( 'boosted_elements_progression_google_maps_api', array(
		'label'          => esc_html__('Google Maps API Key', 'boosted-elements-progression'),
		'description'    => 'See documentation under "Google Maps API Key" for directions. Get API key: https://developers.google.com/maps/documentation/javascript/get-api-key',
		'section' => 'boosted_elements_progression_panel_google_Maps',
		'type' => 'text',
		'priority'   => 10,
		)
	
	);
	
	$wp_customize->add_setting( 'boosted_elements_progression_google_maps_custom_styling' ,array(
		'default' =>  '',
		'sanitize_callback' => 'boosted_elements_progression_google_maps_sanitize_customizer',
	) );
	$wp_customize->add_control( 'boosted_elements_progression_google_maps_custom_styling', array(
		'label'          => esc_html__('Google Maps Custom Styling', 'boosted-elements-progression'),
		'description'    => 'Via https://snazzymaps.com',
		'section' => 'boosted_elements_progression_panel_google_Maps',
		'type' => 'textarea',
		'priority'   => 20,
		)
	);
	
}
add_action( 'customize_register', 'boosted_elements_progression_google_maps_customizer' );

// Sanitize NO HTML Text 
function boosted_elements_progression_google_maps_sanitize_text( $input ) {
    return wp_filter_nohtml_kses( $input );
}

//Query Categories List
function boosted_template_list(){

	$boosted_elementor_args = array('post_type' => 'elementor_library', 'posts_per_page' => 99);
	$boosted_elementor_posts = get_posts( $boosted_elementor_args );

	foreach ( $boosted_elementor_posts as $boosted_elementor_post ) {
		 $boosted_elementor_library_list[$boosted_elementor_post->ID] = $boosted_elementor_post->post_title;
	}
	return $boosted_elementor_library_list;

}



// Sanitize HTML Text
function boosted_elements_progression_google_maps_sanitize_customizer( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Frontend Enqueue Styles + JS
function boosted_elements_progression_plugin_enqueuing() {
	
	wp_enqueue_script( 'jquery' );
	
	//Frontend Custom CSS
  	wp_register_style( 'boosted-elements-progression-frontend-styles',  plugins_url( '/assets/css/frontend.min.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
	wp_enqueue_style( 'boosted-elements-progression-frontend-styles' );
	

  	wp_register_style( 'boosted-elements-progression-prettyphoto-optional',  plugins_url( '/assets/css/prettyphoto.min.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
	wp_enqueue_style( 'boosted-elements-progression-prettyphoto-optional' );
	
	//Register JS for elements
	wp_register_script( 'boosted_elements_progression_animated_js',  plugins_url( '/assets/js/animated-typing.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_cart_js',  plugins_url( '/assets/js/cart.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_search_js',  plugins_url( '/assets/js/search.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
    wp_register_script( 'boosted_elements_progression_countdown_js',  plugins_url( '/assets/js/countdown.min.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_popup_js',  plugins_url( '/assets/js/jquery.popupoverlay.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_scrollnav_js',  plugins_url( '/assets/js/scrollnav.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_masonry_js',  plugins_url( '/assets/js/masonry.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_prettyphoto_js',  plugins_url( '/assets/js/prettyPhoto.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_flexslider_js',  plugins_url( '/assets/js/flexslider.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_matchheight_js',  plugins_url( '/assets/js/jquery.matchHeight-min.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_video_background_js',  plugins_url( '/assets/js/video-backgrounds.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_fotorama_js',  plugins_url( '/assets/js/fotorama.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	//Deprecated WordPress 5.5 wp_register_script( 'boosted_elements_progression_flipbox_js',  plugins_url( '/assets/js/flip.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	//Deprecated WordPress 5.5 wp_register_script( 'boosted_elements_progression_team_js',  plugins_url( '/assets/js/team.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
	wp_register_script( 'boosted_elements_progression_image_compare_js',  plugins_url( '/assets/js/jquery.images-compare.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
    wp_register_script( 'boosted_elements_prgoression_navigation',  plugins_url( '/assets/js/navigation.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
    wp_register_script( 'boosted_elements_progression_tabs',  plugins_url( '/assets/js/jquery.smartTab.min.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ), array( 'jquery' ),'1.0',true);
    

	//Google Maps JS along witih API key
   if ( get_theme_mod( 'boosted_elements_progression_google_maps_api') ) {
       $boosted_elements_progression_google_api_url =  '?key='. get_theme_mod('boosted_elements_progression_google_maps_api');
	} else {
		$boosted_elements_progression_google_api_url = '';
	}
	
	if ( get_theme_mod( 'boosted_elements_progression_google_maps_custom_styling') ) {
		$progression_studios_google_maps_styles =  "styles:". get_theme_mod('boosted_elements_progression_google_maps_custom_styling');
	} else {
		$progression_studios_google_maps_styles = "";
	}
	
	wp_register_script( 'boosted_elements_progression_google_maps', 'https://maps.google.com/maps/api/js' . $boosted_elements_progression_google_api_url, array( 'jquery' ),'1.0',true );   	
	wp_add_inline_script( 'boosted_elements_progression_google_maps',  "
	!function(e){function t(e){this.setMap(e)}var o=new google.maps.Geocoder;t.prototype=new google.maps.OverlayView,t.prototype.onAdd=function(){},t.prototype.onRemove=function(){},t.prototype.draw=function(){},e.goMap={},e.fn.goMap=function(t){return this.each(function(){var o=e(this).data(\"goMap\");if(o)e.goMap=o;else{var i=e.extend(!0,{},e.goMapBase);e(this).data(\"goMap\",i.init(this,t)),e.goMap=i}})},e.goMapBase={defaults:{address:\"\",latitude:56.9,longitude:24.1,zoom:4,delay:0,hideByClick:!0,oneInfoWindow:!0,prefixId:\"gomarker\",polyId:\"gopoly\",groupId:\"gogroup\",navigationControl:!0,navigationControlOptions:{position:\"TOP_LEFT\",style:\"DEFAULT\"},mapTypeControl:!0,mapTypeControlOptions:{position:\"TOP_RIGHT\",style:\"DEFAULT\"},scaleControl:!1,scrollwheel:!0,directions:!1,directionsResult:null,disableDoubleClickZoom:!1,streetViewControl:!1,markers:[],overlays:[],polyline:{color:\"#FF0000\",opacity:1,weight:2},polygon:{color:\"#FF0000\",opacity:1,weight:2,fillColor:\"#FF0000\",fillOpacity:.2},circle:{color:\"#FF0000\",opacity:1,weight:2,fillColor:\"#FF0000\",fillOpacity:.2},rectangle:{color:\"#FF0000\",opacity:1,weight:2,fillColor:\"#FF0000\",fillOpacity:.2},maptype:\"HYBRID\",html_prepend:'<div class=\"gomapMarker\">',html_append:\"</div>\",addMarker:!1},map:null,count:0,markers:[],polylines:[],polygons:[],circles:[],rectangles:[],tmpMarkers:[],geoMarkers:[],lockGeocode:!1,bounds:null,overlays:null,overlay:null,mapId:null,plId:null,pgId:null,cId:null,rId:null,opts:null,centerLatLng:null,init:function(o,i){var s=e.extend(!0,{},e.goMapBase.defaults,i);this.mapId=e(o),this.opts=s,s.address?this.geocode({address:s.address,center:!0}):e.isArray(s.markers)&&s.markers.length>0?s.markers[0].address?this.geocode({address:s.markers[0].address,center:!0}):this.centerLatLng=new google.maps.LatLng(s.markers[0].latitude,s.markers[0].longitude):this.centerLatLng=new google.maps.LatLng(s.latitude,s.longitude);var a={center:this.centerLatLng,disableDoubleClickZoom:s.disableDoubleClickZoom,mapTypeControl:s.mapTypeControl,streetViewControl:s.streetViewControl,mapTypeControlOptions:{position:google.maps.ControlPosition[s.mapTypeControlOptions.position.toUpperCase()],style:google.maps.MapTypeControlStyle[s.mapTypeControlOptions.style.toUpperCase()]},mapTypeId:google.maps.MapTypeId[s.maptype.toUpperCase()],panControl:s.navigationControl,zoomControl:s.navigationControl,panControlOptions:{position:google.maps.ControlPosition[s.navigationControlOptions.position.toUpperCase()]},zoomControlOptions:{position:google.maps.ControlPosition[s.navigationControlOptions.position.toUpperCase()],style:google.maps.ZoomControlStyle[s.navigationControlOptions.style.toUpperCase()]},scaleControl:s.scaleControl,scrollwheel:s.scrollwheel,zoom:s.zoom, $progression_studios_google_maps_styles };this.map=new google.maps.Map(o,a),this.overlay=new t(this.map),this.overlays={polyline:{id:\"plId\",array:\"polylines\",create:\"createPolyline\"},polygon:{id:\"pgId\",array:\"polygons\",create:\"createPolygon\"},circle:{id:\"cId\",array:\"circles\",create:\"createCircle\"},rectangle:{id:\"rId\",array:\"rectangles\",create:\"createRectangle\"}},this.plId=e('<div style=\"display:none;\"/>').appendTo(this.mapId),this.pgId=e('<div style=\"display:none;\"/>').appendTo(this.mapId),this.cId=e('<div style=\"display:none;\"/>').appendTo(this.mapId),this.rId=e('<div style=\"display:none;\"/>').appendTo(this.mapId);for(var r=0,n=s.markers.length;n>r;r++)this.createMarker(s.markers[r]);for(var r=0,n=s.overlays.length;n>r;r++)this[this.overlays[s.overlays[r].type].create](s.overlays[r]);var l=this;return 1==s.addMarker||\"multi\"==s.addMarker?google.maps.event.addListener(l.map,\"click\",function(e){var t={position:e.latLng,draggable:!0},o=l.createMarker(t);google.maps.event.addListener(o,\"dblclick\",function(e){o.setMap(null),l.removeMarker(o.id)})}):\"single\"==s.addMarker&&google.maps.event.addListener(l.map,\"click\",function(e){if(!l.singleMarker){var t={position:e.latLng,draggable:!0},o=l.createMarker(t);l.singleMarker=!0,google.maps.event.addListener(o,\"dblclick\",function(e){o.setMap(null),l.removeMarker(o.id),l.singleMarker=!1})}}),delete s.markers,delete s.overlays,this},ready:function(e){google.maps.event.addListenerOnce(this.map,\"bounds_changed\",function(){return e()})},geocode:function(e,t){var i=this;setTimeout(function(){o.geocode({address:e.address},function(o,s){s==google.maps.GeocoderStatus.OK&&e.center&&i.map.setCenter(o[0].geometry.location),s==google.maps.GeocoderStatus.OK&&t&&t.markerId?t.markerId.setPosition(o[0].geometry.location):s==google.maps.GeocoderStatus.OK&&t?i.lockGeocode&&(i.lockGeocode=!1,t.position=o[0].geometry.location,t.geocode=!0,i.createMarker(t)):s==google.maps.GeocoderStatus.OVER_QUERY_LIMIT&&i.geocode(e,t)})},this.opts.delay)},geoMarker:function(){if(this.geoMarkers.length>0&&!this.lockGeocode){this.lockGeocode=!0;var e=this.geoMarkers.splice(0,1);this.geocode({address:e[0].address},e[0])}else if(this.lockGeocode){var t=this;setTimeout(function(){t.geoMarker()},this.opts.delay)}},setMap:function(e){delete e.mapTypeId,e.address?(this.geocode({address:e.address,center:!0}),delete e.address):e.latitude&&e.longitude&&(e.center=new google.maps.LatLng(e.latitude,e.longitude),delete e.longitude,delete e.latitude),e.mapTypeControlOptions&&e.mapTypeControlOptions.position&&(e.mapTypeControlOptions.position=google.maps.ControlPosition[e.mapTypeControlOptions.position.toUpperCase()]),e.mapTypeControlOptions&&e.mapTypeControlOptions.style&&(e.mapTypeControlOptions.style=google.maps.MapTypeControlStyle[e.mapTypeControlOptions.style.toUpperCase()]),\"undefined\"!=typeof e.navigationControl&&(e.panControl=e.navigationControl,e.zoomControl=e.navigationControl),e.navigationControlOptions&&e.navigationControlOptions.position&&(e.panControlOptions={position:google.maps.ControlPosition[e.navigationControlOptions.position.toUpperCase()]},e.zoomControlOptions={position:google.maps.ControlPosition[e.navigationControlOptions.position.toUpperCase()]}),e.navigationControlOptions&&e.navigationControlOptions.style&&(\"undefined\"==typeof e.zoomControlOptions?e.zoomControlOptions={style:google.maps.ZoomControlStyle[e.navigationControlOptions.style.toUpperCase()]}:e.zoomControlOptions.style=google.maps.ZoomControlStyle[e.navigationControlOptions.style.toUpperCase()]),this.map.setOptions(e)},getMap:function(){return this.map},createListener:function(t,o,i){var s;if(\"object\"!=typeof t&&(t={type:t}),\"map\"==t.type?s=this.map:\"marker\"==t.type&&t.marker?s=e(this.mapId).data(t.marker):\"info\"==t.type&&t.marker&&(s=e(this.mapId).data(t.marker+\"info\")),s)return google.maps.event.addListener(s,o,i);if((\"marker\"==t.type||\"info\"==t.type)&&this.getMarkerCount()!=this.getTmpMarkerCount())var a=this;setTimeout(function(){a.createListener(t,o,i)},this.opts.delay)},removeListener:function(e){google.maps.event.removeListener(e)},setInfoWindow:function(t,o){var i=this;o.content=i.opts.html_prepend+o.content+i.opts.html_append;var s=new google.maps.InfoWindow(o);s.show=!1,e(i.mapId).data(t.id+\"info\",s),o.popup&&(i.openWindow(s,t,o),s.show=!0),google.maps.event.addListener(t,\"click\",function(){s.show&&i.opts.hideByClick?(s.close(),s.show=!1):(i.openWindow(s,t,o),s.show=!0)})},openWindow:function(t,o,i){var s=this;this.opts.oneInfoWindow&&this.clearInfo(),i.ajax?(t.open(this.map,o),e.ajax({url:i.ajax,success:function(e){t.setContent(s.opts.html_prepend+e+s.opts.html_append)}})):i.id?(t.setContent(s.opts.html_prepend+e(i.id).html()+s.opts.html_append),t.open(this.map,o)):t.open(this.map,o)},setInfo:function(t,o){var i=e(this.mapId).data(t+\"info\");\"object\"==typeof o?i.setOptions(goMap.opts.html_prepend+o+goMap.opts.html_append):i.setContent(goMap.opts.html_prepend+o+goMap.opts.html_append)},getInfo:function(t,o){var i=e(this.mapId).data(t+\"info\").getContent();return o?e(i).html():i},clearInfo:function(){for(var t=0,o=this.markers.length;o>t;t++){var i=e(this.mapId).data(this.markers[t]+\"info\");i&&(i.close(),i.show=!1)}},fitBounds:function(t,o){var i=this;if(this.getMarkerCount()!=this.getTmpMarkerCount())setTimeout(function(){i.fitBounds(t,o)},this.opts.delay);else{if(this.bounds=new google.maps.LatLngBounds,!t||t&&\"all\"==t)for(var s=0,a=this.markers.length;a>s;s++)this.bounds.extend(e(this.mapId).data(this.markers[s]).position);else if(t&&\"visible\"==t)for(var s=0,a=this.markers.length;a>s;s++)this.getVisibleMarker(this.markers[s])&&this.bounds.extend(e(this.mapId).data(this.markers[s]).position);else if(t&&\"markers\"==t&&e.isArray(o))for(var s=0,a=o.length;a>s;s++)this.bounds.extend(e(this.mapId).data(o[s]).position);this.map.fitBounds(this.bounds)}},getBounds:function(){return this.map.getBounds()},createPolyline:function(e){return e.type=\"polyline\",this.createOverlay(e)},createPolygon:function(e){return e.type=\"polygon\",this.createOverlay(e)},createCircle:function(e){return e.type=\"circle\",this.createOverlay(e)},createRectangle:function(e){return e.type=\"rectangle\",this.createOverlay(e)},createOverlay:function(e){var t=[];switch(e.id||(this.count++,e.id=this.opts.polyId+this.count),e.type){case\"polyline\":if(!(e.coords.length>0))return!1;for(var o=0,i=e.coords.length;i>o;o++)t.push(new google.maps.LatLng(e.coords[o].latitude,e.coords[o].longitude));t=new google.maps.Polyline({map:this.map,path:t,strokeColor:e.color?e.color:this.opts.polyline.color,strokeOpacity:e.opacity?e.opacity:this.opts.polyline.opacity,strokeWeight:e.weight?e.weight:this.opts.polyline.weight});break;case\"polygon\":if(!(e.coords.length>0))return!1;for(var o=0,i=e.coords.length;i>o;o++)t.push(new google.maps.LatLng(e.coords[o].latitude,e.coords[o].longitude));t=new google.maps.Polygon({map:this.map,path:t,strokeColor:e.color?e.color:this.opts.polygon.color,strokeOpacity:e.opacity?e.opacity:this.opts.polygon.opacity,strokeWeight:e.weight?e.weight:this.opts.polygon.weight,fillColor:e.fillColor?e.fillColor:this.opts.polygon.fillColor,fillOpacity:e.fillOpacity?e.fillOpacity:this.opts.polygon.fillOpacity});break;case\"circle\":t=new google.maps.Circle({map:this.map,center:new google.maps.LatLng(e.latitude,e.longitude),radius:e.radius,strokeColor:e.color?e.color:this.opts.circle.color,strokeOpacity:e.opacity?e.opacity:this.opts.circle.opacity,strokeWeight:e.weight?e.weight:this.opts.circle.weight,fillColor:e.fillColor?e.fillColor:this.opts.circle.fillColor,fillOpacity:e.fillOpacity?e.fillOpacity:this.opts.circle.fillOpacity});break;case\"rectangle\":t=new google.maps.Rectangle({map:this.map,bounds:new google.maps.LatLngBounds(new google.maps.LatLng(e.sw.latitude,e.sw.longitude),new google.maps.LatLng(e.ne.latitude,e.ne.longitude)),strokeColor:e.color?e.color:this.opts.circle.color,strokeOpacity:e.opacity?e.opacity:this.opts.circle.opacity,strokeWeight:e.weight?e.weight:this.opts.circle.weight,fillColor:e.fillColor?e.fillColor:this.opts.circle.fillColor,fillOpacity:e.fillOpacity?e.fillOpacity:this.opts.circle.fillOpacity});break;default:return!1}return this.addOverlay(e,t),t},addOverlay:function(t,o){e(this[this.overlays[t.type].id]).data(t.id,o),this[this.overlays[t.type].array].push(t.id)},setOverlay:function(t,o,i){if(o=e(this[this.overlays[t].id]).data(o),i.coords&&i.coords.length>0){for(var s=[],a=0,r=i.coords.length;r>a;a++)s.push(new google.maps.LatLng(i.coords[a].latitude,i.coords[a].longitude));i.path=s,delete i.coords}else i.ne&&i.sw?(i.bounds=new google.maps.LatLngBounds(new google.maps.LatLng(i.sw.latitude,i.sw.longitude),new google.maps.LatLng(i.ne.latitude,i.ne.longitude)),delete i.ne,delete i.sw):i.latitude&&i.longitude&&(i.center=new google.maps.LatLng(i.latitude,i.longitude),delete i.latitude,delete i.longitude);o.setOptions(i)},showHideOverlay:function(t,o,i){\"undefined\"==typeof i&&(i=this.getVisibleOverlay(t,o)?!1:!0),i?e(this[this.overlays[t].id]).data(o).setMap(this.map):e(this[this.overlays[t].id]).data(o).setMap(null)},getVisibleOverlay:function(t,o){return e(this[this.overlays[t].id]).data(o).getMap()?!0:!1},getOverlaysCount:function(e){return this[this.overlays[e].array].length},removeOverlay:function(t,o){var i,s=e.inArray(o,this[this.overlays[t].array]);if(s>-1){i=this[this.overlays[t].array].splice(s,1);var a=i[0];return e(this[this.overlays[t].id]).data(a).setMap(null),e(this[this.overlays[t].id]).removeData(a),!0}return!1},clearOverlays:function(t){for(var o=0,i=this[this.overlays[t].array].length;i>o;o++){var s=this[this.overlays[t].array][o];e(this[this.overlays[t].id]).data(s).setMap(null),e(this[this.overlays[t].id]).removeData(s)}this[this.overlays[t].array]=[]},showHideMarker:function(t,o){if(\"undefined\"==typeof o)if(this.getVisibleMarker(t)){e(this.mapId).data(t).setVisible(!1);var i=e(this.mapId).data(t+\"info\");i&&i.show&&(i.close(),i.show=!1)}else e(this.mapId).data(t).setVisible(!0);else e(this.mapId).data(t).setVisible(o)},showHideMarkerByGroup:function(t,o){for(var i=0,s=this.markers.length;s>i;i++){var a=this.markers[i],r=e(this.mapId).data(a);if(r.group==t)if(\"undefined\"==typeof o)if(this.getVisibleMarker(a)){r.setVisible(!1);var n=e(this.mapId).data(a+\"info\");n&&n.show&&(n.close(),n.show=!1)}else r.setVisible(!0);else r.setVisible(o)}},getVisibleMarker:function(t){return e(this.mapId).data(t).getVisible()},getMarkerCount:function(){return this.markers.length},getTmpMarkerCount:function(){return this.tmpMarkers.length},getVisibleMarkerCount:function(){return this.getMarkers(\"visiblesInMap\").length},getMarkerByGroupCount:function(e){return this.getMarkers(\"group\",e).length},getMarkers:function(t,o){var i=[];switch(t){case\"json\":for(var s=0,a=this.markers.length;a>s;s++){var r=\"'\"+s+\"': '\"+e(this.mapId).data(this.markers[s]).getPosition().toUrlValue()+\"'\";i.push(r)}i=\"{'markers':{\"+i.join(\",\")+\"}}\";break;case\"data\":for(var s=0,a=this.markers.length;a>s;s++){var r=\"marker[\"+s+\"]=\"+e(this.mapId).data(this.markers[s]).getPosition().toUrlValue();i.push(r)}i=i.join(\"&\");break;case\"visiblesInBounds\":for(var s=0,a=this.markers.length;a>s;s++)this.isVisible(e(this.mapId).data(this.markers[s]).getPosition())&&i.push(this.markers[s]);break;case\"visiblesInMap\":for(var s=0,a=this.markers.length;a>s;s++)this.getVisibleMarker(this.markers[s])&&i.push(this.markers[s]);break;case\"group\":if(o)for(var s=0,a=this.markers.length;a>s;s++)e(this.mapId).data(this.markers[s]).group==o&&i.push(this.markers[s]);break;case\"markers\":for(var s=0,a=this.markers.length;a>s;s++){var r=e(this.mapId).data(this.markers[s]);i.push(r)}break;default:for(var s=0,a=this.markers.length;a>s;s++){var r=e(this.mapId).data(this.markers[s]).getPosition().toUrlValue();i.push(r)}}return i},getVisibleMarkers:function(){return this.getMarkers(\"visiblesInBounds\")},createMarker:function(e){if(e.geocode||(this.count++,e.id||(e.id=this.opts.prefixId+this.count),this.tmpMarkers.push(e.id)),e.address&&!e.geocode)this.geoMarkers.push(e),this.geoMarker();else if(e.latitude&&e.longitude||e.position){var t={map:this.map};t.id=e.id,t.group=e.group?e.group:this.opts.groupId,t.zIndex=e.zIndex?e.zIndex:0,t.zIndexOrg=e.zIndexOrg?e.zIndexOrg:0,0==e.visible&&(t.visible=e.visible),e.title&&(t.title=e.title),e.draggable&&(t.draggable=e.draggable),e.icon&&e.icon.image?(t.icon=e.icon.image,e.icon.shadow&&(t.shadow=e.icon.shadow)):e.icon?t.icon=e.icon:this.opts.icon&&this.opts.icon.image?(t.icon=this.opts.icon.image,this.opts.icon.shadow&&(t.shadow=this.opts.icon.shadow)):this.opts.icon&&(t.icon=this.opts.icon),t.position=e.position?e.position:new google.maps.LatLng(e.latitude,e.longitude);var o=new google.maps.Marker(t);return e.html&&(e.html.content||e.html.ajax||e.html.id?e.html.content||(e.html.content=null):e.html={content:e.html},this.setInfoWindow(o,e.html)),this.addMarker(o),o}},addMarker:function(t){e(this.mapId).data(t.id,t),this.markers.push(t.id)},setMarker:function(t,o){var i=e(this.mapId).data(t);if(delete o.id,delete o.visible,o.icon){var s=o.icon;delete o.icon,s&&\"default\"==s?this.opts.icon&&this.opts.icon.image?(o.icon=this.opts.icon.image,this.opts.icon.shadow&&(o.shadow=this.opts.icon.shadow)):this.opts.icon&&(o.icon=this.opts.icon):s&&s.image?(o.icon=s.image,s.shadow&&(o.shadow=s.shadow)):s&&(o.icon=s)}o.address?(this.geocode({address:o.address},{markerId:i}),delete o.address,delete o.latitude,delete o.longitude,delete o.position):(o.latitude&&o.longitude||o.position)&&(o.position||(o.position=new google.maps.LatLng(o.latitude,o.longitude))),i.setOptions(o)},removeMarker:function(t){var o,i=e.inArray(t,this.markers);if(i>-1){this.tmpMarkers.splice(i,1),o=this.markers.splice(i,1);var s=o[0],t=e(this.mapId).data(s),a=e(this.mapId).data(s+\"info\");return t.setVisible(!1),t.setMap(null),e(this.mapId).removeData(s),a&&(a.close(),a.show=!1,e(this.mapId).removeData(s+\"info\")),!0}return!1},clearMarkers:function(){for(var t=0,o=this.markers.length;o>t;t++){var i=this.markers[t],s=e(this.mapId).data(i),a=e(this.mapId).data(i+\"info\");s.setVisible(!1),s.setMap(null),e(this.mapId).removeData(i),a&&(a.close(),a.show=!1,e(this.mapId).removeData(i+\"info\"))}this.singleMarker=!1,this.lockGeocode=!1,this.markers=[],this.tmpMarkers=[],this.geoMarkers=[]},isVisible:function(e){return this.map.getBounds().contains(e)}}}(jQuery);
	" );

	//Add this so JS displays when editor is open
	if ( is_user_logged_in() ) {
		wp_enqueue_script( 'boosted_elements_progression_animated_js' );
		wp_enqueue_script( 'boosted_elements_progression_countdown_js' );
		wp_enqueue_script( 'boosted_elements_progression_popup_js' );
		wp_enqueue_script( 'boosted_elements_progression_scrollnav_js' );	
		wp_enqueue_script( 'boosted_elements_progression_masonry_js' );
		wp_enqueue_script( 'boosted_elements_progression_prettyphoto_js' );
		wp_enqueue_script( 'boosted_elements_progression_flexslider_js' );
		wp_enqueue_script( 'boosted_elements_progression_matchheight_js' );
		wp_enqueue_script( 'boosted_elements_progression_video_background_js' );
		wp_enqueue_script( 'boosted_elements_progression_fotorama_js' );
		wp_enqueue_script( 'boosted_elements_progression_google_maps' );
		wp_enqueue_script( 'boosted_elements_progression_image_compare_js' );
        wp_enqueue_script( 'boosted_elements_prgoression_navigation' );
        wp_enqueue_script( 'boosted_elements_progression_tabs' );
	}
	
} 
add_action( 'wp_enqueue_scripts', 'boosted_elements_progression_plugin_enqueuing', 20, 1 );


// CSS THAT DISPLAYS ON EDITOR PANEL
add_action( 'elementor/editor/before_enqueue_scripts', function() {
	
   wp_register_style( 'boosted-elements-progression-admin-styles',  plugins_url( '/assets/css/backend.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
   wp_enqueue_style( 'boosted-elements-progression-admin-styles' );


	//Disables Pro Templates in Admin Area
	if ( !function_exists( 'elementor_pro_load_plugin' ) ) {
   wp_register_style( 'boosted-elements-progression-admin-hide-pro-templates',  plugins_url( '/assets/css/backend-hide-pro-elements.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
   wp_enqueue_style( 'boosted-elements-progression-admin-hide-pro-templates');
	}
	
} );

// CSS THAT DISPLAYS ONLY WHEN EDITOR IS OPEN ON IFRAME
add_action( 'elementor/preview/enqueue_styles', function() {
	
   wp_register_style( 'boosted-elements-progression-editor-styles',  plugins_url( '/assets/css/editor-preview.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
   wp_enqueue_style( 'boosted-elements-progression-editor-styles');

	
} );




?>