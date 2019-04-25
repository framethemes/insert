// Add Widget Before content In Any WordPress Theme.
if ( !class_exists( 'AddWidgetBeforeContent' ) ) {
	class AddWidgetBeforeContent {
		function __construct() {
			add_action( 'widgets_init', array( $this,'before_widgets_init' ) );
			add_filter(	'the_content', array( $this,'insert_before_content') );
		}
		function before_widgets_init() {

			$args = array(
				'name'          => 'Widget Before Content ',
				'id'            => 'widget_before_content',
				'description'   => __( 'This is the widgets area before the content.', 'longviet' ),
				'before_widget' => '<div class="awbc-wrapper">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			);
			register_sidebar( apply_filters( 'awbc_sidebar_arguments', $args ) );

		}
		public function insert_before_content( $content ) {
			if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'widget_before_content' ) && is_main_query() ) {
				dynamic_sidebar( 'widget_before_content' ); 
			}
		   	return $content;
		}
	}
	new AddWidgetBeforeContent(); 
}
// Add Widget Before content In Any WordPress Theme.
if ( !class_exists( 'AddWidgetAfterContent' ) ) {
	class AddWidgetAfterContent {
		function __construct() {
			add_action( 'widgets_init', array( $this,'after_widgets_init' ) );
			add_filter(	'the_content', array( $this,'insert_after_content') );
		}
		function after_widgets_init() {

			$args = array(
				'name'          => 'Widget After Content ',
				'id'            => 'widget_after_content',
				'description'   => __( 'This is the widgets area after the content.', 'longviet' ),
				'before_widget' => '<div class="awac-wrapper">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			);
			register_sidebar( apply_filters( 'awac_sidebar_arguments', $args ) );

		}
		public function insert_after_content( $content ) {
			if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'widget_after_content' ) && is_main_query() ) {
				$awac_content = $this->get_after_content();
		    	$content.= apply_filters('awac_content', $awac_content );
			}
		   	return $content;
		}
		public function get_after_content() {
			ob_start();
			dynamic_sidebar( 'widget_after_content' ); 
			$sidebar = ob_get_contents();
			ob_end_clean();
			return $sidebar;
		}
	}
	new AddWidgetAfterContent(); 
}
