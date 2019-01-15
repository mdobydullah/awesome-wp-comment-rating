<?php
/**
 * File Name: Initialization
 * Author:  Md. Obydullah
 * Description: Initilize the plugin
 */

// enqueue the plugin's styles
add_action( 'wp_enqueue_scripts', 'awcr_comment_rating_styles' );
function awcr_comment_rating_styles() {
	wp_enqueue_style('awcp-comment-rating-styles', plugin_dir_url( __FILE__ ) . 'css/style.css' );
	wp_enqueue_style( 'dashicons' );
}

// load settings data
$disable_auto_placement = awcr_bymo_plugin_option('disable_auto_placement', 'awcr_bymo_basic_settings', 'off');

// enable/disable auto placement
if($disable_auto_placement == "off") {
	// show rate bar (default google histogram)
	add_filter( 'the_content', 'add_something_to_content_filter', 20 );
}

/**
==========================================
  create the rating interface
==========================================
 */
add_action( 'comment_form_logged_in_after', 'awcr_comment_rating_rating_field' );
add_action( 'comment_form_after_fields', 'awcr_comment_rating_rating_field' );
function awcr_comment_rating_rating_field () {
	// load settings data
	$hide_on_pages    = awcr_bymo_plugin_option('hide_on_pages', 'awcr_bymo_basic_settings', 'off');
	$hide_on_posts    = awcr_bymo_plugin_option('hide_on_posts', 'awcr_bymo_basic_settings', 'off');
	$field_name       = awcr_bymo_plugin_option('field_name', 'awcr_bymo_star_field', 'Rating');
	$field_name_size  = awcr_bymo_plugin_option('field_name_size', 'awcr_bymo_star_field', 'Rating');
	$field_name_color = awcr_bymo_plugin_option('field_name_color', 'awcr_bymo_star_field', '#000000');
	$field_star_size  = awcr_bymo_plugin_option('field_star_size', 'awcr_bymo_star_field', 'Rating');

	// custom style
	$style = '<style>';
	$style .= '.awcr-rating-label {color: '.$field_name_color.'; font-size: '.$field_name_size.'; }';
	$style .= '.awcr-rating-container > input + label {font-size: '.$field_star_size.'; }';
	$style .= '</style>';

	// display on/off page on or post
	$display = 'no';

	// display on/off page
	if ($hide_on_pages != 'on' && is_singular('page')) {
		$display = 'yes';
	}
	// display on/off post
	if ($hide_on_posts != 'on' && is_singular('post')) {
		$display = 'yes';
	}

	// display
	if ($display == 'yes') {
	echo $style;
	?>
	<fieldset class="awcr-comment-rating">
	<span class="awcr-rating-label " for="awcr-single-rating"><?php echo $field_name; ?></span>
		<span class="awcr-rating-container">
			<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
				<input type="radio" id="awcr-single-rating-<?php echo esc_attr( $i ); ?>" name="awcr-single-rating" value="<?php echo esc_attr( $i ); ?>" /><label for="awcr-single-rating-<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></label>
			<?php endfor; ?>
			<input type="radio" id="awcr-single-rating-0" class="star-cb-clear" name="awcr-single-rating" value="0" /><label for="rating-0">0</label>
		</span>
	</fieldset>
	<?php
	}
}

/**
==========================================
  save the rating submitted by the user
==========================================
 */
add_action( 'comment_post', 'awcr_comment_rating_save_comment_rating' );
function awcr_comment_rating_save_comment_rating( $comment_id ) {
	if ( ( isset( $_POST['awcr-single-rating'] ) ) && ( '' !== $_POST['awcr-single-rating'] ) )
	$rating = intval( $_POST['awcr-single-rating'] );
	add_comment_meta( $comment_id, 'awcr-single-rating', $rating );
}

/**
==========================================
  make the rating required
==========================================
 */
add_filter( 'preprocess_comment', 'awcr_comment_rating_require_rating' );
function awcr_comment_rating_require_rating( $commentdata ) {
	if ( ! is_admin() && ( ! isset( $_POST['awcr-single-rating'] ) || 0 === intval( $_POST['awcr-single-rating'] ) ) )
	wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
	return $commentdata;
}

/**
==========================================
  display the rating on submitted comment
==========================================
 */
add_filter( 'comment_text', 'awcr_comment_rating_display_rating');
function awcr_comment_rating_display_rating( $comment_text ) {
	// load settings data
	$hide_on_pages = awcr_bymo_plugin_option('hide_on_pages', 'awcr_bymo_basic_settings', 'off');
	$hide_on_posts = awcr_bymo_plugin_option('hide_on_posts', 'awcr_bymo_basic_settings', 'off');

	// display on/off page on or post
	$display = 'no';

	// display on/off page
	if ($hide_on_pages != 'on' && is_singular('page')) {
		$display = 'yes';
	}
	// display on/off post
	else if ($hide_on_posts != 'on' && is_singular('post')) {
		$display = 'yes';
	}

	// display on/off page
	if ($display =='yes') {
		if ( $rating = get_comment_meta( get_comment_ID(), 'awcr-single-rating', true ) ) {

			$awcr_empty_star = (5 - $rating);

			// load settings data
			$display_rating_bar  = awcr_bymo_plugin_option('display_rating_bar', 'awcr_bymo_star_field', 'above_comment_text');
			$star_color  = awcr_bymo_plugin_option('star_color', 'awcr_bymo_star_field', '#333333');
			$star_size   = awcr_bymo_plugin_option('star_size', 'awcr_bymo_star_field', '20px');
			$star_width  = awcr_bymo_plugin_option('star_width', 'awcr_bymo_star_field', '20px');
			$star_height = awcr_bymo_plugin_option('star_height', 'awcr_bymo_star_field', '20px');

			// custom style
			$style = '<style>span.dashicons.dashicons-star-filled.star_filled {color: '.$star_color.'; font-size: '.$star_size.';  width: '.$star_width.'; height: '.$star_height.'; }</style>';

			$stars = '<span class="stars">';
			for ( $i = 1; $i <= $rating; $i++ ) {
				$stars .= '<span class="dashicons dashicons-star-filled star_filled"></span>';
			}
			if($awcr_empty_star !=0) {
				for ($i=0; $i < $awcr_empty_star; $i++) {
					$stars .= '<span class="dashicons dashicons-star-empty star_empty"></span>';
				}
			}
			$stars .= '</span><br>';

			// display rating with comment
			switch ($display_rating_bar) {
				case 'above_comment_text':
					$comment_text = $style . $stars . $comment_text;
					break;
				case 'below_comment_text':
					$comment_text = $style . $comment_text . '<br>' .$stars;
					break;
				default:
					$comment_text = $style . $stars . $comment_text;
					break;
			}

			return $comment_text;
		}
		else {
			return $comment_text;
		}
	}
	else {
		return $comment_text;
	}
}

/**
==========================================
  show rate bar (default google histogram)
==========================================
 */
function add_something_to_content_filter( $content ) {

    $original_content = $content ; // preserve the original ...

	// load settings data
	$awcr_choose_template = awcr_bymo_plugin_option('choose_template', 'awcr_bymo_basic_settings', 'after_post_content');
	$awcr_select_position = awcr_bymo_plugin_option('select_position', 'awcr_bymo_basic_settings', 'after_post_content');
	$hide_on_pages        = awcr_bymo_plugin_option('hide_on_pages', 'awcr_bymo_basic_settings', 'off');
	$hide_on_posts        = awcr_bymo_plugin_option('hide_on_posts', 'awcr_bymo_basic_settings', 'off');

	// set template
    $shortcode = '';
	switch ($awcr_choose_template) {
		case 'google_histogram':
			$shortcode = "[awcr_google_histogram]";
			break;
		case 'google_histogram_dynamic':
			$shortcode = "[awcr_google_histogram type='dynamic']";
			break;
		case 'gauge_chart':
			$shortcode = "[awcr_gauge_chart]";
			break;
		case 'gaming_bar':
			$shortcode = "[awcr_gaming_bar]";
			break;
		default:
			$shortcode = "[awcr_google_histogram type='dynamic']";
			break;
	}

	// display on/off page on or post
	$display = 'no';

	// display on/off page
	if ($hide_on_pages != 'on' && is_singular('page')) {
		$display = 'yes';
	}
	// display on/off post
	else if ($hide_on_posts != 'on' && is_singular('post')) {
		$display = 'yes';
	}

	// set placement
	if($display == 'yes') {
		switch ($awcr_select_position) {
			case 'before_post_content':
				$add_before_content = do_shortcode($shortcode);
				$content = $add_before_content . $original_content;
				break;
			case 'after_post_content':
				$add_after_content = do_shortcode($shortcode);
				$content = $original_content  . $add_after_content ;
				break;
			default:
				$add_after_content = do_shortcode($shortcode);
				$content = $original_content  . $add_after_content ;
				break;
		}
	}

    // returns the content.
    return $content;
}