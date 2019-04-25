// Create Social Share Buttons .
if ( ! function_exists( 'socialshare_buttons' ) ):
function socialshare_buttons() {

	// Get current page URL 
	$longvietURL = urlencode(get_permalink());

	// Get current page title
	$longvietTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	
	// Get Post Thumbnail for pinterest
	$longvietThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$longvietTitle.'&amp;url='.$longvietURL;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$longvietURL;
	$bufferURL = 'https://bufferapp.com/add?url='.$longvietURL.'&amp;text='.$longvietTitle;
	$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$longvietURL.'&amp;title='.$longvietTitle;
	$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$longvietURL.'&amp;media='.$longvietThumbnail[0].'&amp;description='.$longvietTitle;

	// Add sharing button at the end of page/page content
	?><div class="longviet-social">
		<div class="longviet-link social-title"><h5>SHARE ON</h5></div>
		<a class="longviet-link longviet-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a>
		<a class="longviet-link longviet-facebook" href="'.$facebookURL.'" target="_blank">Facebook</a>
		<a class="longviet-link longviet-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>
		<a class="longviet-link longviet-linkedin" href="'.$linkedInURL.'" target="_blank">LinkedIn</a>
		<a class="longviet-link longviet-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pin It</a>
	</div><?php

}
endif;
// Create Social Share Buttons .
if ( !class_exists( 'AddSocilaShareContent' ) ) {
	class AddSocilaShareContent {
		function __construct() {
			add_filter(	'the_content', array( $this,'insert_socialshare_content') );
		}
		public function insert_socialshare_content( $content ) {
			if ( is_singular( array( 'post', 'page' ) ) ) { // Display On post, page
				socialshare_buttons();  // Display on Before
				$socialshare_content = $this->get_after_content();
		    	$content.= apply_filters('socialshare_content', $socialshare_content );
			}
		   	return $content;
		} // Star Display On After
		public function get_after_content() {
			ob_start();
			socialshare_buttons(); 
			$socialshare = ob_get_contents();
			ob_end_clean();
			return $socialshare;
		} // End Display On After
	}
	new AddSocilaShareContent(); 
}
