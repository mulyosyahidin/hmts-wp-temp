<?php

namespace DynamicContentForElementor;

/**
 * Widgets Class
 *
 * Register new elementor widget.
 *
 * @since 0.0.1
 */
class Widgets {

	public $widgets = [];
	public static $registered_widgets = [];
	public $grouped_widgets = [];
	public static $group = array(
		'DYNAMIC' => 'Dynamic',
		'POST' => 'Post',
		'ARCHIVE' => 'Archive',
		'ACF' => 'ACF',
		'CREATIVE' => 'Creative',
		'DEV' => 'Developer',
		'TAX' => 'Taxonomy',
		'OTHER' => 'Miscellaneous',
	);
	public static $dir = DCE_PATH . 'includes/widgets';
	public static $namespace = '\\DynamicContentForElementor\\Widgets\\';

	public function __construct() {
		$this->init();
	}

	public function init() {
		$this->widgets = $this->get_widgets();
		$this->grouped_widgets = $this->get_widgets_by_group();
		add_action('elementor/elements/categories_registered', array( $this, 'add_elementor_widget_category' ), 9999999999);
	}

	public static function find_widgets() {
		$widgets = Helper::dir_to_array(self::$dir);
		// remove unwanted files
		if ( ( $key = array_search('index.php', $widgets) ) !== false ) {
			unset($widgets[ $key ]);
		}
		if ( ( $key = array_search('DCE_Widget_Prototype.php', $widgets) ) !== false ) {
			unset($widgets[ $key ]);
		}

		return $widgets;
	}

	public static function get_widgets() {

		$widgets = self::find_widgets();

		// get a simple list
		$widgets_list = array();
		$process = $widgets;
		while ( count($process) > 0 ) {
			$current = array_pop($process);
			if ( is_array($current) ) {
				// Using a loop for clarity. You could use array_merge() here.
				foreach ( $current as $item ) {
					// As an optimization you could add "flat" items directly to the results array here.
					array_push($process, $item);
				}
			} else {
				array_push($widgets_list, $current);
			}
		}

		$tmp = array();
		foreach ( $widgets_list as $wkey => $value ) {
			$cname = str_replace('.php', '', $value);
			$tmp[ $wkey ] = $cname;
		}
		$widgets_list = $tmp;

		return $widgets_list;
	}

	public static function get_widgets_by_group() {
		$widgets = self::find_widgets();

		$grouped_widgets = self::array_compact($widgets);

		$tmp = array();
		foreach ( $grouped_widgets as $gkey => $values ) {
			foreach ( $values as $wkey => $value ) {
				$cname = str_replace('.php', '', $value);
				$tmp[ $gkey ][ $wkey ] = $cname;
			}
		}
		$grouped_widgets = $tmp;

		return $grouped_widgets;
	}

	public static function get_active_widgets() {
		$widgets = self::get_widgets();
		$active_widgets = array();
		foreach ( $widgets as $ckey => $className ) {
			$myWdgtClass = self::$namespace . $className;
			$active_widgets[ $ckey ] = $className;
		}
		return $active_widgets;
	}

	public static function get_active_widgets_by_group() {
		$grouped_widgets = self::get_widgets_by_group();
		$active_grouped_widgets = array();
		foreach ( $grouped_widgets as $key => $value ) {
			foreach ( $value as $ckey => $className ) {
				$myWdgtClass = self::$namespace . $className;
				$active_grouped_widgets[ $key ][ $ckey ] = $className;
			}
		}
		return $active_grouped_widgets;
	}

	public static function get_enabled_widgets() {
		$widgets = self::get_active_widgets();
		$excluded_widgets = self::get_excluded_widgets();
		$active_widgets = array();
		foreach ( $widgets as $ckey => $className ) {
			if ( empty($excluded_widgets) || ! in_array($className, $excluded_widgets) ) {
				$active_widgets[ $ckey ] = $className;
			}
		}
		return $active_widgets;
	}

	public static function array_compact( $myarray, $prekey = '' ) {
		$ret = array();
		if ( is_array($myarray) ) {
			foreach ( $myarray as $akey => $arr ) {
				if ( is_array($arr) ) {
					$tmp = self::array_compact($arr, $prekey . $akey);
					$ret = self::array_merge_recursive($ret, $tmp);
				} else {
					$tmp = self::array_compact($arr, $prekey);
					$ret = self::array_merge_recursive($ret, $tmp);
				}
			}
		} else {
			$ret[ $prekey ][] = $myarray;
		}
		return $ret;
	}

	public static function array_merge_recursive( array &$array1, array &$array2 ) {
		$merged = $array1;
		foreach ( $array2 as $key => &$value ) {
			if ( is_array($value) && isset($merged[ $key ]) && is_array($merged[ $key ]) ) {
				$merged[ $key ] = self::array_merge_recursive($merged[ $key ], $value);
			} else {
				if ( is_numeric($key) ) {
					$merged[] = $value;
				} else {
					$merged[ $key ] = $value;
				}
			}
		}
		return $merged;
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 0.0.1
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->register_widget();
	}

	/**
	 * Register Widget
	 *
	 * @since 0.5.0
	 *
	 * @access private
	 */
	public function register_widget() {
		if ( empty(self::$registered_widgets) ) {
			$excluded_widgets = json_decode(get_option(DCE_PRODUCT_ID . '_excluded_widgets'), true);
			$grouped_widgets = self::get_widgets_by_group();
			foreach ( $grouped_widgets as $aType ) {
				usort($aType, function( $a, $b ) {
					$aw = self::$namespace . $a;
					$bw = self::$namespace . $b;
					if ( $aw::get_position() == $bw::get_position() ) {
						return 0;
					}
					return ( $aw::get_position() < $bw::get_position() ) ? -1 : 1;
				}); // ordered by key (position)
				$aOrderedType = array();
				foreach ( $aType as $myWdgtClass ) {
					if ( ! isset(self::$registered_widgets[ $myWdgtClass ]) ) {
						if ( ! $excluded_widgets || ! isset($excluded_widgets[ $myWdgtClass ]) ) { // controllo se lo avevo escluso in quanto non interessante
							$aWidgetObjname = self::$namespace . $myWdgtClass;
							$aWidgetObj = new $aWidgetObjname();
							if ( $aWidgetObj->satisfy_dependencies() ) { // controllo se non è soddisfatta qualche dipendenza di plugin
								\Elementor\Plugin::instance()->widgets_manager->register_widget_type($aWidgetObj);
								self::$registered_widgets[ $myWdgtClass ] = $aWidgetObj;
							}
						}
					}
				}
			}
		}

		if ( ! empty(self::$registered_widgets) ) {
			foreach ( self::$registered_widgets as $aWidgetObj ) {
				Assets::add_depends($aWidgetObj);
			}
		}
	}

	public static function get_excluded_widgets() {
		return json_decode(get_option(DCE_PRODUCT_ID . '_excluded_widgets', '[]'), true);
	}

	/**
	 * Add category of Elementor
	 *
	 * @since 0.0.1
	 *
	 * @access public
	 */
	public function add_elementor_widget_category( $elements ) {
		$i = 0;

		// categoria di default per i widget per cui non è stato definito un gruppo tramite il nome della classe
		$elements->add_category('dynamic-content-for-elementor', array(
			'title' => __('Dynamic Content', 'dynamic-content-for-elementor'),
		));

		// creo le categorie per cui voglio personalizzare il nome
		foreach ( self::$group as $gkey => $agroup ) {
			$elements->add_category('dynamic-content-for-elementor-' . strtolower($gkey), array(
				'title' => __('Dynamic Content - ' . $agroup, 'dynamic-content-for-elementor'),
			));
		}

		// creo nuove categorie dinamiche in caso aggiungo un nuovo gruppo di widget tramite nome della classe
		$grouped_widgets = self::get_widgets_by_group();
		foreach ( $grouped_widgets as $key => $value ) {
			if ( ! in_array($key, self::$group) ) {
				$gkey = strtolower($key);
				$agroup = ucfirst($gkey);
				$elements->add_category('dynamic-content-for-elementor-' . strtolower($gkey), array(
					'title' => __('Dynamic Content - ' . $agroup, 'dynamic-content-for-elementor'),
				));
			}
		}
	}

}
