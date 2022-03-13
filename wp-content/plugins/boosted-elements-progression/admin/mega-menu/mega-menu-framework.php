<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}

function boosted_elements_mega_menu_admin_css( ) {
	if( is_admin()) {
		wp_register_style('boosted-elements-mega-admin', plugins_url( '/admin/mega-menu/mega-menu.css', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );
		wp_enqueue_style('boosted-elements-mega-admin');
        wp_enqueue_script('boosted-elements-mega-menu-js', plugins_url( '/admin/mega-menu/mega-menu.js', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) );	
	}
}
add_action('admin_enqueue_scripts', 'boosted_elements_mega_menu_admin_css');


/**
* https://www.kathyisawesome.com/add-custom-fields-to-wordpress-menu-items/
* Add custom fields to menu item
*
* This will allow us to play nicely with any other plugin that is adding the same hook
*
* @param  int $item_id 
* @params obj $item - the menu item
* @params array $args
*/
function boosted_mega_men_custom_nav_fields( $item_id, $item ) {
    
	wp_nonce_field( 'boosted_elements_icon_nonce', '_boosted_elements_icon_nonce_name' );
	$boosted_elements_icon = get_post_meta( $item_id, '_boosted_elements_icon', true );
    
    

	wp_nonce_field( 'boosted_elements_meta_select_nonce', '_boosted_elements_meta_select_nonce_name' );
    $boosted_elements_meta_select = get_post_meta( $item_id, '_boosted_elements_meta_select', true );
    
	wp_nonce_field( 'boosted_elements_meta_check_nonce', '_boosted_elements_meta_check_nonce_name' );
    $boosted_elements_meta_check = get_post_meta( $item_id, '_boosted_elements_meta_check', true );
    $boosted_elements_selected = checked ( 1, $boosted_elements_meta_check, false );
    
	?>
    
	<input type="hidden" name="custom-menu-meta-nonce" value="<?php echo wp_create_nonce( 'boosted-elements-icon-name' ); ?>" />
    <div class="field-boosted_elements_icon description-wide" style="margin: 5px 0;">
    	    <span class="description"><?php esc_html_e( "FontAwesome Icon Class", 'boosted-elements-progression' ); ?> (<a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free" target="_blank"><?php esc_html_e( "Icon List", 'boosted-elements-progression' ); ?></a>)</span>
    	    <br />

    	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

    	    <div class="logged-input-holder">
    	        <input type="text" name="boosted_elements_icon[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>" value="<?php echo esc_attr( $boosted_elements_icon ); ?>" />
    	    </div>

    	</div>
        
    
	<div class="field-boosted_elements_meta_check description-wide" style="margin: 5px 0;">
	    <div class="logged-input-holder">
            <label for="boosted-elements-mega-for-<?php echo esc_attr($item_id); ?>">
	        <input type="checkbox" name="boosted_elements_meta_check[<?php echo $item_id ;?>]" id="boosted-elements-mega-for-<?php echo esc_attr($item_id); ?>" class="boosted-elements-mega-for" value="1" <?php echo esc_attr($boosted_elements_selected); ?>
             />
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
    
    //Icon Addition
    if ( isset( $_POST['boosted_elements_icon'][$menu_item_db_id]  ) ) {
    	$sanitized_data = sanitize_text_field( $_POST['boosted_elements_icon'][$menu_item_db_id] );
    	update_post_meta( $menu_item_db_id, '_boosted_elements_icon', $sanitized_data );
    } else {
    	delete_post_meta( $menu_item_db_id, '_boosted_elements_icon' );
    }

	// Verify this came from our screen and with proper authorization.
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



/**
* Output on menu of template/field
* 
*/
function boosted_elements_mega_template_check( $items, $args ) {
    
        foreach( $items as $item ) {
            
            if ( $item->menu_item_parent == 1 )
            continue;
            
		    $custom_menu_meta = get_post_meta( $item->ID, '_boosted_elements_meta_check', true );
		    if (  ! empty( $custom_menu_meta )  ) {
                //$item->title = 'Title' . $custom_menu_meta = get_post_meta( $item->ID, '_boosted_elements_meta_check', true ) ;
                $item->classes[] = 'boosted-elements-mega-menu-container-class menu-item-has-children';
            }
            
        }
        return $items;
    
}
add_filter( 'wp_nav_menu_objects', 'boosted_elements_mega_template_check', 10, 2 );


function boosted_elements_icon_output_title( $title, $item ) {

	if( is_object( $item ) && isset( $item->ID ) ) {

		$boosted_elements_menu_icon = get_post_meta( $item->ID, '_boosted_elements_icon', true );

		if ( ! empty( $boosted_elements_menu_icon ) ) {
            $title = '<i class="' . $boosted_elements_menu_icon . ' boosted-elements-fa-icon-custom"></i>' . $title;
		}
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'boosted_elements_icon_output_title', 10, 2 );



class Boosted_Elements_Mega_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        
        //https://developer.wordpress.org/reference/classes/walker_nav_menu/ Added February 15, 2021
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                    $t = '';
                    $n = '';
                } else {
                    $t = "\t";
                    $n = "\n";
                }
                $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

                $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
                $classes[] = 'menu-item-' . $item->ID;

                /**
                 * Filters the arguments for a single nav menu item.
                 *
                 * @since 4.4.0
                 *
                 * @param stdClass $args  An object of wp_nav_menu() arguments.
                 * @param WP_Post  $item  Menu item data object.
                 * @param int      $depth Depth of menu item. Used for padding.
                 */
                $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

                /**
                 * Filters the CSS classes applied to a menu item's list item element.
                 *
                 * @since 3.0.0
                 * @since 4.1.0 The `$depth` parameter was added.
                 *
                 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
                 * @param WP_Post  $item    The current menu item.
                 * @param stdClass $args    An object of wp_nav_menu() arguments.
                 * @param int      $depth   Depth of menu item. Used for padding.
                 */
                $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
                $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

                /**
                 * Filters the ID applied to a menu item's list item element.
                 *
                 * @since 3.0.1
                 * @since 4.1.0 The `$depth` parameter was added.
                 *
                 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
                 * @param WP_Post  $item    The current menu item.
                 * @param stdClass $args    An object of wp_nav_menu() arguments.
                 * @param int      $depth   Depth of menu item. Used for padding.
                 */
                $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
                $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

                $output .= $indent . '<li' . $id . $class_names . '>';

                $atts           = array();
                $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
                $atts['target'] = ! empty( $item->target ) ? $item->target : '';
                if ( '_blank' === $item->target && empty( $item->xfn ) ) {
                    $atts['rel'] = 'noopener';
                } else {
                    $atts['rel'] = $item->xfn;
                }
                $atts['href']         = ! empty( $item->url ) ? $item->url : '';
                $atts['aria-current'] = $item->current ? 'page' : '';

                /**
                 * Filters the HTML attributes applied to a menu item's anchor element.
                 *
                 * @since 3.6.0
                 * @since 4.1.0 The `$depth` parameter was added.
                 *
                 * @param array $atts {
                 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
                 *
                 *     @type string $title        Title attribute.
                 *     @type string $target       Target attribute.
                 *     @type string $rel          The rel attribute.
                 *     @type string $href         The href attribute.
                 *     @type string $aria_current The aria-current attribute.
                 * }
                 * @param WP_Post  $item  The current menu item.
                 * @param stdClass $args  An object of wp_nav_menu() arguments.
                 * @param int      $depth Depth of menu item. Used for padding.
                 */
                $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

                $attributes = '';
                foreach ( $atts as $attr => $value ) {
                    if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                        $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }

                /** This filter is documented in wp-includes/post-template.php */
                $title = apply_filters( 'the_title', $item->title, $item->ID );

                /**
                 * Filters a menu item's title.
                 *
                 * @since 4.4.0
                 *
                 * @param string   $title The menu item's title.
                 * @param WP_Post  $item  The current menu item.
                 * @param stdClass $args  An object of wp_nav_menu() arguments.
                 * @param int      $depth Depth of menu item. Used for padding.
                 */
                $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

                $item_output  = $args->before;
                $item_output .= '<a' . $attributes . ' class="boosted-nav-link-def">';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                
                $custom_menu_select = get_post_meta( $item->ID, '_boosted_elements_meta_select', true );
                $megamenu_checkbox = get_post_meta( $item->ID, '_boosted_elements_meta_check', true );
    
                
                if( $depth === 0 && $megamenu_checkbox == "1" ) {
                    $item_output .= '<ul class="sub-menu"><li>';
                    $item_output .= '<div class="boosted-elements-mega-import-container">'  . Elementor\Plugin::instance()->frontend->get_builder_content_for_display($custom_menu_select) . '</div><div class="clearfix-boosted-element"></div>';
                    $item_output .= '</li></ul>';
                }
                
                $item_output .= $args->after;
                

                
                /**
                 * Filters a menu item's starting output.
                 *
                 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
                 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
                 * no filter for modifying the opening and closing `<li>` for a menu item.
                 *
                 * @since 3.0.0
                 *
                 * @param string   $item_output The menu item's starting HTML output.
                 * @param WP_Post  $item        Menu item data object.
                 * @param int      $depth       Depth of menu item. Used for padding.
                 * @param stdClass $args        An object of wp_nav_menu() arguments.
                 */
                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        
    		
    }
}
