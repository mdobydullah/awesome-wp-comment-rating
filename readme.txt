=== Awesome WP Comment Rating ===
Contributors: obydul
Donate link: https://obydul.me/donate
Tags: post rating, page rating, comment rating, rating, reviews, ratings, stars, rating stars, star rating, vote, votes, comment star field, postratings
Requires at least: 3.2
Tested up to: 5.0.3
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Awesome WP Comment Rating allows users to provide star rating on comment form of WordPress posts, custom posts or pages.

== Description ==

Awesome WP Comment Rating allows users to provide star rating on comment form of WordPress posts, custom posts or pages. Integration is very easy and simple.

= STARS RATING ARE DESPLAYED AS =

* Five stars field on comment form.
* Display rating bar template above/below the Post/Page content.
* You can use disable auto placement and use shortcodes to view rating bar.
* You can hide rating bar from posts or pages.

= SHORTCODES =

* Total Rating: [awcr_rating type='totalRating']
* Average Rating: [awcr_rating type='averageRating']
* Rating bar: [awcr_rating type='ratingBar']
* Get single rating: [awcr_rating type='singleRating' rating='5'] // rating = 1,2,3,4 and 5
* Template google histogram : [awcr_google_histogram]
* Template dynamic google histogram : [awcr_google_histogram type='dynamic']
* Template gauge chart : [awcr_gauge_chart]
* Template gaming bar : [awcr_gaming_bar]

= SHORTCODES in PHP =

You can easily use shortcodes in a php file. Methods:
* Method 1: echo do_shortcode( "[awcr_gauge_chart]" );
* Method 2: echo apply_filters( 'the_content',"[awcr_gauge_chart]");

👉 See more information: [GitHub](https://github.com/mdobydullah/awesome-wp-comment-rating)

== Installation ==

How to install the plugin and get it working.

1. Upload the plugin files to the "/wp-content/plugins/" directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> Awesome WP Comment Rating to modify options

== Screenshots ==

1. Star field on comment form.
2. Rating bar on post/page.
3. Preview rating bars.
4. Basic Settings.
5. Star field customization.

== Changelog ==

= 1.0 =
Release Date: Jan 14, 2019

* Initial version released