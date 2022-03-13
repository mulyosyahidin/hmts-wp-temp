<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}

function boosted_elements_mega_menu_admin_css( ) {
	if( is_admin()) {
		wp_register_style('boosted-elements-mega-admin', plugins_url( '/admin/mega-menu/mega-menu.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
		wp_enqueue_style('boosted-elements-mega-admin');		
	}
}
add_action('admin_enqueue_scripts', 'boosted_elements_mega_menu_admin_css');



//https://www.kathyisawesome.com/add-custom-fields-to-wordpress-menu-items/

/**
* Add custom fields to menu item
*
* This will allow us to play nicely with any other plugin that is adding the same hook
*
* @param  int $item_id 
* @params obj $item - the menu item
* @params array $args
*/
function boosted_mega_men_custom_nav_fields( $item_id, $item ) {

	wp_nonce_field( 'custom_menu_meta_nonce', '_custom_menu_meta_nonce_name' );
    $custom_menu_meta = get_post_meta( $item_id, '_custom_menu_meta', true );
    
    
	wp_nonce_field( 'boosted_elements_meta_select_nonce', '_boosted_elements_meta_select_nonce_name' );
    $boosted_elements_meta_select = get_post_meta( $item_id, '_boosted_elements_meta_select', true );
    
    
    
	wp_nonce_field( 'boosted_elements_meta_check_nonce', '_boosted_elements_meta_check_nonce_name' );
    $boosted_elements_meta_check = get_post_meta( $item_id, '_boosted_elements_meta_check', true );
    $boosted_elements_selected = checked ( 1, $boosted_elements_meta_check, false );
    
	?>
    
    
	<div class="field-boosted_elements_meta_check description-wide" style="margin: 5px 0;">
	    <div class="logged-input-holder">
            <label for="boosted-elements-mega-for-<?php echo esc_attr($item_id); ?>">
	        <input type="checkbox" name="boosted_elements_meta_check[<?php echo $item_id ;?>]" id="boosted-elements-mega-for-<?php echo esc_attr($item_id); ?>" value="1" <?php echo esc_attr($boosted_elements_selected); ?> />
    	    <strong class="description"><?php esc_html_e( "Enable Mega Menu", 'boosted-elements-progression' ); ?></strong>
        </label>
	    </div>
	</div>
    
    
	<input type="hidden" name="boosted-elements-template-meta-nonce" value="<?php echo wp_create_nonce( 'boosted-elements-template-meta-name' ); ?>" />
	<div class="field-boosted_elements_meta_select description-wide" style="margin: 5px 0;">
        <label for="boosted-elements-template-meta-for-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( "Mega Menu Template", 'boosted-elements-progression' ); ?><br>
	      
            
			<select class="widefat code"  name="boosted_elements_meta_select[<?php echo $item_id ;?>]" id="boosted-elements-template-meta-for-<?php echo esc_attr($item_id); ?>" >
				<option value="0"><?php esc_html_e( 'No Mega Menu', 'torney-progression' ); ?></option>
				<?php
                
                $boosted_mega_menu_args = array(
                	'numberposts'	=> 200,
                	'post_type'		=> 'elementor_library'
                );
                $boosted_mega_template_posts = get_posts( $boosted_mega_menu_args );
                
                if( ! empty( $boosted_mega_template_posts ) ){
                	foreach ( $boosted_mega_template_posts as $boosted_p ){
                		echo '<option value="' . $boosted_p->ID . '" ' . selected($item->_boosted_elements_meta_select, $boosted_p->ID) . ' >' . esc_attr($boosted_p->post_title) . '</option>';
                	}
                }
                
				?>
			</select>
            
        </label>

	</div>
    
    
	<input type="hidden" name="custom-menu-meta-nonce" value="<?php echo wp_create_nonce( 'custom-menu-meta-name' ); ?>" />
	<div class="field-custom_menu_meta description-wide" style="margin: 5px 0;">
	    <div class="description"><?php esc_html_e( "Extra Field", 'boosted-elements-progression' ); ?></div>
	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

	    <div class="logged-input-holder">
	        <input type="text" name="custom_menu_meta[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo esc_attr($item_id); ?>" value="<?php echo esc_attr( $custom_menu_meta ); ?>" />
	    </div>

	</div>

	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'boosted_mega_men_custom_nav_fields', 10, 2 );


/**
* Save the menu item meta
* 
* @param int $menu_id
* @param int $menu_item_db_id	
*/
function boosted_elements_mega_nav_update( $menu_id, $menu_item_db_id ) {

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $_POST['_custom_menu_meta_nonce_name'] ) || ! wp_verify_nonce( $_POST['_custom_menu_meta_nonce_name'], 'custom_menu_meta_nonce' ) ) {
		return $menu_id;
	}

	if ( isset( $_POST['custom_menu_meta'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['custom_menu_meta'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_custom_menu_meta', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_custom_menu_meta' );
	}


	if ( isset( $_POST['boosted_elements_meta_select'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['boosted_elements_meta_select'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_boosted_elements_meta_select', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_boosted_elements_meta_select' );
	}
    
	if ( isset( $_POST['boosted_elements_meta_check'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['boosted_elements_meta_check'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_boosted_elements_meta_check', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_boosted_elements_meta_check' );
	}


    
}
add_action( 'wp_update_nav_menu_item', 'boosted_elements_mega_nav_update', 10, 2 );




function add_search_form($items, $args) {
          if( $args->theme_location == 'menu-1' ){
          $items .= '<li class="menu-item">'
                  . '<form role="search" method="get" class="search-form" action="'.home_url( '/' ).'">'
                  . '<label>'
                  . '<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>'
                  . '<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search …', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />'
                  . '</label>'
                  . '<input type="submit" class="search-submit" value="'. esc_attr_x('Search', 'submit button') .'" />'
                  . '</form>'
                  . '</li>';
          }
        return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);





/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function boosted_elements_nav_custom_menu_title( $title, $item) {

	if( is_object( $item ) && isset( $item->ID ) ) {

		$custom_menu_meta = get_post_meta( $item->ID, '_boosted_elements_meta_select', true );
		if (  ! empty( $custom_menu_meta ) ) {
			$title .= ' - ' . $custom_menu_meta;
		}
	}
	return $title;
    
    
}
add_filter( 'nav_menu_item_title', 'boosted_elements_nav_custom_menu_title', 10, 2 );



































/**
* Output on menu of template/field
* 
*/
function boosted_elements_mega_template_insert( $items, $args ) {
    
        foreach( $items as $item ) {
            
            if ( $item->menu_item_parent == 0 )
            continue;
            
		    $custom_menu_meta = get_post_meta( $item->ID, '_boosted_elements_meta_select', true );
		    if (  ! empty( $custom_menu_meta )  ) {
                $item->title =  '<div class="boosted-elements-mega-import-container">'  . Elementor\Plugin::instance()->frontend->get_builder_content_for_display($custom_menu_meta) . '</div>';
                $item->url = 'http://google.com';
                $item->classes[] = 'boosted-elements-mega-menu-container-class';
            }
            
            
        }
        return $items;
    
}
add_filter( 'wp_nav_menu_objects', 'boosted_elements_mega_template_insert', 20, 2 );












/**
* Output on menu of template/field
* 
*/
function boosted_elements_mega_template_insert( $items, $args ) {
    
        foreach( $items as $item ) {
            
            if ( $item->menu_item_parent == 0 )
            continue;
            
		    $custom_menu_meta = get_post_meta( $item->ID, '_boosted_elements_meta_select', true );
		    if (  ! empty( $custom_menu_meta )  ) {
                $item->title =  '<div class="boosted-elements-mega-import-container">'  . Elementor\Plugin::instance()->frontend->get_builder_content_for_display($custom_menu_meta) . '</div>';
                $item->url = '#boosted-elements';
                $item->classes = 'boosted-elements-mega-menu-container-class';
            }
            
        }
        return $items;
    
}
add_filter( 'wp_nav_menu_objects', 'boosted_elements_mega_template_insert', 10, 2 );





