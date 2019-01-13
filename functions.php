<?php
/**
 * File Name: Functions
 * Author:  Md. Obydullah
 * Description: Define functions of the plugin
 */

/**
==========================================
  function to get total rating
==========================================
 */
function awcr_total_rating( $id ) {
	$comments = get_approved_comments( $id );

	if ( $comments ) {
		$total = 0;
		foreach( $comments as $comment ){
			$rate = get_comment_meta( $comment->comment_ID, 'awcr-single-rating', true );
			if( isset( $rate ) && '' !== $rate ) {
				$total++;
			}
		}
		return $total;
	}
	else {
		return "0";
	}
}

/**
==========================================
  function to get average rating
==========================================
 */
function awcr_average_rating( $id ) {
	$comments = get_approved_comments( $id );

	if ( $comments ) {
		$total = 0;
		$sum = 0;
		foreach( $comments as $comment ){
			$rate = get_comment_meta( $comment->comment_ID, 'awcr-single-rating', true );
			if( isset( $rate ) && '' !== $rate ) {
				$total++;
				$sum += $rate;
			}
		}

 		$get_avg = round($sum / $total, 1);
		return number_format((float)$get_avg, 1, '.', '');
	}
	else {
		return "0.0";
	}
}


/**
==========================================
  function to get single rating
==========================================
 */
function awcr_single_rating( $id, $rating ) {
	$comments = get_approved_comments( $id );

	// single rating counter
	if(isset($rating) && '' != $rating) {
		if ( $comments ) {
			$single_rating = 0;
			foreach( $comments as $comment ){
				$rate = get_comment_meta( $comment->comment_ID, 'awcr-single-rating', true );
				if( isset( $rate ) && '' !== $rate && $rate == $rating) {
					$single_rating++;
				}
			}
		} 
		return $single_rating;
	}
	else {
		return "0";
	}
}