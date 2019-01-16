## Awesome WP Comment Rating

Awesome WP Comment Rating allows users to provide star rating on comment form of WordPress posts, custom posts or pages. Integration is very easy and simple.

Download from [WordPress Plugin Directory](https://wordpress.org/plugins/awesome-wp-comment-rating/)

#### Stars Rating are Displayed as:

* Five stars field on comment form.
* Display rating bar template above/below the Post/Page content.
* You can use disable auto placement and use shortcodes to view rating bar.
* You can hide rating bar from posts or pages.

#### Shortcodes:

* Total Rating: [awcr_rating type='totalRating']
* Average Rating: [awcr_rating type='averageRating']
* Rating bar: [awcr_rating type='ratingBar']
* Get single rating: [awcr_rating type='singleRating' rating='5'] // rating = 1,2,3,4 and 5
* Template google histogram : [awcr_google_histogram]
* Template dynamic google histogram : [awcr_google_histogram type='dynamic']
* Template gauge chart : [awcr_gauge_chart]
* Template gaming bar : [awcr_gaming_bar]

#### Shortcodes in PHP:

You can easily use shortcodes in a php file. Methods:
* Method 1: <?php echo do_shortcode( "[awcr_gauge_chart]" ); ?>
* Method 2: <?php echo apply_filters( 'the_content',"[awcr_gauge_chart]"); ?>

## Installation

How to install the plugin and get it working.

1. Upload the plugin files to the "/wp-content/plugins/" directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> Awesome WP Comment Rating to modify options

## Screenshots

* Star field and display rating bar with comment text:
![screenshots-1](https://user-images.githubusercontent.com/13184472/51090650-48373400-17a9-11e9-8491-36b0fa12ab0b.png)

* Plugin settings:
![screenshots-2](https://user-images.githubusercontent.com/13184472/51090683-ce537a80-17a9-11e9-80a8-0dc0801b9589.png)

* Star field customization:
![screenshots-3](https://user-images.githubusercontent.com/13184472/51090682-ce537a80-17a9-11e9-9bc5-631ca3be58e6.png)

* Rating templates:
![screenshots-4](https://user-images.githubusercontent.com/13184472/51090375-3eabcd00-17a5-11e9-8686-52906ce6d981.png)

## LICENCE

* [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)

Changelog:
----------------------
```
v1.0 (Jan 14, 2018)
------------------------
- [new] Initial version released
```