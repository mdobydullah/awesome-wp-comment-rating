<?php
/**
 * File Name: Shortcodes
 * Author:  Md. Obydullah
 * Description: Define shortcodes of the plugin
 */

/**
==========================================
  shortcode - get dynamic items
==========================================
 */
add_shortcode( 'awcr_rating', 'awcr_rating_display_function' );
function awcr_rating_display_function( $atts, $content = null ) {

	// get attributes
   	extract( shortcode_atts( array(
      'type' => 'type',
      'rating' => 'rating'
      ), $atts ) );

	// get post id
	global $post;
	$id              = $post->ID;
	
	$total_rating    = awcr_total_rating($id);
	$average_rating  = awcr_average_rating($id);
	
	// single rating
	if(isset($rating) && "" != $rating) {
		$single_rating = awcr_single_rating($id, $rating);
	}

	// ratingbar
	$stars           = '';
	$get_int_part    = floor($average_rating);
	$fraction        = $average_rating - $get_int_part;
	$awcr_empty_star = round(5 - $average_rating);

	for ( $i = 0; $i < $get_int_part; $i++ ) {
		$stars .= '<span class="dashicons dashicons-star-filled star-filled"></span>';
	}
	if($awcr_empty_star !=0) {
		for ($i=0; $i < $awcr_empty_star; $i++) {
			$stars .= '<span class="dashicons dashicons-star-empty star-empty"></span>';
		}
	}
	
	$rating_bar_content  = '<span class="awcr-average-rating-bar">' . $stars .'</span>';

    // check what type user entered
	switch ($type) {
	    case "totalRating":
			return $total_rating;
        	break;
	    case "averageRating":
	        return $average_rating;
	        break;
	    case "singleRating":
	        	return $single_rating;
	        break;
	    case "ratingBar":
	        	return $rating_bar_content;
	        break;
	    default:
	        return "Please enter type: totalRating, averageRating, ratingBar, (singleRating, rating='5')";
	}

}

/**
==========================================
  google histogram
==========================================
 */
add_shortcode( 'awcr_google_histogram', 'awcr_google_histogram' );
function awcr_google_histogram( $atts, $content = null ) {

	// get attributes
   	extract( shortcode_atts( array(
      'type' => 'type',
      ), $atts ) );

	// get post id
	global $post;
	$id = $post->ID;

	// load settings data
	$container_width = awcr_bymo_plugin_option('container_width', 'awcr_bymo_google_histogram', '400px');

   	// inline css
   	$style = '<style>.awcr-google-histogram-container {max-width: '.$container_width.';}</style>';

	$total_rating    = awcr_total_rating($id);
	$average_rating  = awcr_average_rating($id);

    // single rating
	$single_rating_1 = awcr_single_rating($id, 1);
	$single_rating_2 = awcr_single_rating($id, 2);
	$single_rating_3 = awcr_single_rating($id, 3);
	$single_rating_4 = awcr_single_rating($id, 4);
	$single_rating_5 = awcr_single_rating($id, 5);

    // percentages
    if(isset($type) && "" != $type && $type == "dynamic" && $total_rating != 0) {
	    $percentage_1 = number_format((float)(($single_rating_1/$total_rating) * 100), 2, '.', '');
	    $percentage_2 = number_format((float)(($single_rating_2/$total_rating) * 100), 2, '.', '');
	    $percentage_3 = number_format((float)(($single_rating_3/$total_rating) * 100), 2, '.', '');
	    $percentage_4 = number_format((float)(($single_rating_4/$total_rating) * 100), 2, '.', '');
	    $percentage_5 = number_format((float)(($single_rating_5/$total_rating) * 100), 2, '.', '');
	}
	else {
	    $percentage_1 = 100;
	    $percentage_2 = 100;
	    $percentage_3 = 100;
	    $percentage_4 = 100;
	    $percentage_5 = 100;
	}

	$contents = '
	<div class="awcr-google-histogram-container">
	  <div class="inner">
	    <div class="rating">
	      <span class="rating-num">'.$average_rating.'</span>
	      <div class="rating-stars">
	        <span><i class="active icon-star"></i></span>
	        <span><i class="active icon-star"></i></span>
	        <span><i class="active icon-star"></i></span>
	        <span><i class="active icon-star"></i></span>
	        <span><i class="icon-star"></i></span>
	      </div>
	      <div class="rating-users">
	        <i class="icon-user"></i> '.$total_rating.' total
	      </div>
	    </div>
	    
	    <div class="histo">
	      <div class="five histo-rate">
	        <span class="histo-star">
	          <i class="active icon-star"></i> 5 </span>
	        <span class="bar-block">
	          <span id="awcr-bar-five" class="awcr_bar">
	            <span>'.$single_rating_5.'</span>
	          </span> 
	        </span>
	      </div>
	      
	      <div class="four histo-rate">
	        <span class="histo-star">
	          <i class="active icon-star"></i> 4 </span>
	        <span class="bar-block">
	          <span id="awcr-bar-four" class="awcr_bar">
	            <span>'.$single_rating_4.'</span>
	          </span> 
	        </span>
	      </div> 
	      
	      <div class="three histo-rate">
	        <span class="histo-star">
	          <i class="active icon-star"></i> 3 </span>
	        <span class="bar-block">
	          <span id="awcr-bar-three" class="awcr_bar">
	            <span>'.$single_rating_3.'</span>
	          </span> 
	        </span>
	      </div>
	      
	      <div class="two histo-rate">
	        <span class="histo-star">
	          <i class="active icon-star"></i> 2 </span>
	        <span class="bar-block">
	          <span id="awcr-bar-two" class="awcr_bar">
	            <span>'.$single_rating_2.'</span>
	          </span> 
	        </span>
	      </div>
	      
	      <div class="one histo-rate">
	        <span class="histo-star">
	          <i class="active icon-star"></i> 1 </span>
	        <span class="bar-block">
	          <span id="awcr-bar-one" class="awcr_bar">
	            <span>'.$single_rating_1.'</span>
	          </span> 
	        </span>
	      </div>
	    </div>
	  </div>
	</div>';

	$contents .= "
	<script>
	jQuery(document).ready(function($){
	  $('.awcr_bar span').hide();
	  $('#awcr-bar-five').animate({
	     width: '".$percentage_5."%'}, 1000);
	  $('#awcr-bar-four').animate({
	     width: '".$percentage_4."%'}, 1000);
	  $('#awcr-bar-three').animate({
	     width: '".$percentage_3."%'}, 1000);
	  $('#awcr-bar-two').animate({
	     width: '".$percentage_2."%'}, 1000);
	  $('#awcr-bar-one').animate({
	     width: '".$percentage_1."%'}, 1000);
	  
	  setTimeout(function() {
	    $('.awcr_bar span').fadeIn('slow');
	  }, 1000);
	  
	});
	</script>
	";

	return $style . $contents;
}

/**
==========================================
  gauge chart
==========================================
 */
add_shortcode( 'awcr_gauge_chart', 'awcr_gauge_chart' );
function awcr_gauge_chart( $atts, $content = null ) {

	// load settings data
	$name = awcr_bymo_plugin_option('name', 'awcr_bymo_gauge_chart', 'Rating');
	$background_color = awcr_bymo_plugin_option('background_color', 'awcr_bymo_gauge_chart', '#ffffff');
	$border_color = awcr_bymo_plugin_option('border_color', 'awcr_bymo_gauge_chart', '#efefef');
	$rate_info_color = awcr_bymo_plugin_option('rate_info_color', 'awcr_bymo_gauge_chart', '#000000');
	$rating_bar_text_color = awcr_bymo_plugin_option('rating_bar_text_color', 'awcr_bymo_gauge_chart', '#000000');
	$rating_bar_border_color = awcr_bymo_plugin_option('rating_bar_border_color', 'awcr_bymo_gauge_chart', '#cccccc');
	$background_color_five_star = awcr_bymo_plugin_option('background_color_five_star', 'awcr_bymo_gauge_chart', '#9FC05A');
	$background_color_four_star = awcr_bymo_plugin_option('background_color_four_star', 'awcr_bymo_gauge_chart', '#ADD633');
	$background_color_three_star = awcr_bymo_plugin_option('background_color_three_star', 'awcr_bymo_gauge_chart', '#FFD834');
	$background_color_two_star = awcr_bymo_plugin_option('background_color_two_star', 'awcr_bymo_gauge_chart', '#FFB234');
	$background_color_one_star = awcr_bymo_plugin_option('background_color_one_star', 'awcr_bymo_gauge_chart', '#FF8B5A');

	// get attributes
   	extract( shortcode_atts( array(
      'type' => 'type',
      ), $atts ) );

	// get post id
	global $post;
	$id = $post->ID;

	// average rating
	$get_total_rating  = awcr_total_rating($id);
	$average_rating  = awcr_average_rating($id);

	// total rating
	if($get_total_rating>1) {
		$total_rating  = $get_total_rating . " Reviews";
	} else {
		$total_rating  = $get_total_rating . " Review";
	}

    // single rating
	$single_rating_1 = awcr_single_rating($id, 1);
	$single_rating_2 = awcr_single_rating($id, 2);
	$single_rating_3 = awcr_single_rating($id, 3);
	$single_rating_4 = awcr_single_rating($id, 4);
	$single_rating_5 = awcr_single_rating($id, 5);
    // marks
	$marks = ($average_rating*10) * 2;

	// custom style
   	$style = '<style>';
   	$style .= '.awcr-gauge-chart-container { background-color: '.$background_color.'; border: 2px solid '.$border_color.'; }';
   	$style .= '.awcr-gauge-chart-info { color: '.$rate_info_color.'; }';
   	$style .= '.awcr-gauge-chart-right { color: '.$rating_bar_text_color.'; }';
   	$style .= '.gauge-chart-border { border: 1px solid '.$rating_bar_border_color.'; }';
   	$style .= '.gauge-chart-five-star { background-color: '.$background_color_five_star.'; }';
   	$style .= '.gauge-chart-four-star { background-color: '.$background_color_four_star.'; }';
   	$style .= '.gauge-chart-three-star { background-color: '.$background_color_three_star.'; }';
   	$style .= '.gauge-chart-two-star { background-color: '.$background_color_two_star.'; }';
   	$style .= '.gauge-chart-one-star { background-color: '.$background_color_one_star.'; }';
   	$style .= '</style>';
	
	$contents .= '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

				<div class="awcr-gauge-chart-container">
					<div class="awcr-gauge-chart-row">
					  <div class="awcr-gauge-chart-column awcr-gauge-chart-left">
						<div id="awcr_gauge_chart" class="awcr_gauge_chart"></div><div class="awcr-gauge-chart-info">'.$marks.'/100<br>'.$total_rating.'</div>
					  </div>
					  <div class="awcr-gauge-chart-column awcr-gauge-chart-right">
						<div class="gauge-chart-border gauge-chart-bar-size gauge-chart-bar-gap gauge-chart-bar-gap-top">
						  <div class="gauge-chart-five-star">5 stars <span class="gauge-chart-bar-counter">'.$single_rating_5.'<span></div>
						</div>
						<div class="gauge-chart-border gauge-chart-bar-size gauge-chart-bar-gap">
						  <div class="gauge-chart-four-star">4 stars <span class="gauge-chart-bar-counter">'.$single_rating_4.'<span></div>
						</div>
						<div class="gauge-chart-border gauge-chart-bar-size gauge-chart-bar-gap">
						  <div class="gauge-chart-three-star">3 stars <span class="gauge-chart-bar-counter">'.$single_rating_3.'<span></div>
						</div>
						<div class="gauge-chart-border gauge-chart-bar-size gauge-chart-bar-gap">
						  <div class="gauge-chart-two-star">2 stars <span class="gauge-chart-bar-counter">'.$single_rating_2.'<span></div>
						</div>
						<div class="gauge-chart-border gauge-chart-bar-size">
						  <div class="gauge-chart-one-star">1 star <span class="gauge-chart-bar-counter">'.$single_rating_1.'<span></div>
						</div>

					  </div>
					</div>
				</div>';

	$contents .= "
	<script>
	    google.charts.load('current', {
        'packages': ['gauge']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['".$name."', ".$marks."]
        ]);

        var options = {
          width: 400,
          height: 120,
          redFrom: 90,
          redTo: 100,
          yellowFrom: 75,
          yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('awcr_gauge_chart'));

        chart.draw(data, options);
      }
	</script>";
	
	return $style . $contents;
}



/**
==========================================
  awcr gaming
==========================================
 */
add_shortcode( 'awcr_gaming_bar', 'awcr_gaming_bar' );
function awcr_gaming_bar( $atts, $content = null ) {

	// get attributes
   	extract( shortcode_atts( array(
      'type' => 'type',
      ), $atts ) );

	// load settings data
	$background_color = awcr_bymo_plugin_option('background_color', 'awcr_bymo_gaming_bar', '#333333');
   	$background_image = awcr_bymo_plugin_option('background_image', 'awcr_bymo_gaming_bar', '');
   	$text_color = awcr_bymo_plugin_option('text_color', 'awcr_bymo_gaming_bar', '#ffffff');

   	// inline css
   	$style = '<style>';
   	$style .= '.awcr-gaming .header {background-color: '.$background_color.';}';
   	$style .= '.awcr-gaming .content h3 {color: '.$text_color.';}';
   	$style .= '</style>';

	// get post id
	global $post;
	$id = $post->ID;

	$get_total_rating  = awcr_total_rating($id);

	// total rating
	if($get_total_rating>1) {
		$total_rating  = awcr_total_rating($id) . " Reviews";
	} else {
		$total_rating  = awcr_total_rating($id) . " Review";
	}

	// average rating
	$average_rating  = awcr_average_rating($id);

    // marks
	$marks = ($average_rating*10) * 2;

	// swtich rate class
	switch($marks) {
		case $marks >= 90 && $marks <= 100:
		    $rate = "<span class='rate rate10'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 80 && $marks < 90:
		    $rate = "<span class='rate rate9'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 70 && $marks < 80:
		    $rate = "<span class='rate rate8'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 60 && $marks < 70:
		    $rate = "<span class='rate rate7'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 50 && $marks < 60:
		    $rate = "<span class='rate rate6'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 40 && $marks < 50:
		    $rate = "<span class='rate rate5'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 30 && $marks < 40:
		    $rate = "<span class='rate rate4'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 20 && $marks < 30:
		    $rate = "<span class='rate rate3'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 10 && $marks < 20:
		    $rate = "<span class='rate rate2'>$marks<span>/100</span></span>";
		    break;
		case $marks >= 0 && $marks < 10:
		    $rate = "<span class='rate rate2'>$marks<span>/100</span></span>";
		    break;
		default:
			$rate = "<span class='rate rate2'>Error</span>";
		    break;
	}

	$contents = '
	<div class="awcr-gaming">
		<div class="header">';

	if(!empty($background_image)) {
	$contents .= '<img src="'.$background_image.'">';
	}

	$contents .= '<div class="content">
				<h3>'.$total_rating.'</h3>
				'.$rate.'
			</div>
		</div>
	</div>';
	
	return $style . $contents;
}