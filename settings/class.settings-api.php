<?php
/**
 * File Name: Settings Class
 * Author:  Md. Obydullah
 */

if ( !class_exists('AWCR_BYMO_Plugin_Settings' ) ):
class AWCR_BYMO_Plugin_Settings {

    private $awcr_plugin_settings;

    function __construct() {
        $this->awcr_plugin_settings = new AWCR_BYMO_Plugin_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->awcr_plugin_settings->set_sections( $this->get_settings_sections() );
        $this->awcr_plugin_settings->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->awcr_plugin_settings->admin_init();
    }

    function admin_menu() {
        add_options_page( 'Awesome WP Comment Rating', 'Awesome WP Comment Rating', 'manage_options', 'awesome-wp-comment-rating', array($this, 'awcr_plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'awcr_bymo_basic_settings',
                'title' => __( 'Basic Settings', 'awcr_plugin_settings' )
            ),
            array(
                'id'    => 'awcr_bymo_star_field',
                'title' => __( 'Star Field', 'awcr_plugin_settings' )
            ),
            array(
                'id'    => 'awcr_bymo_google_histogram',
                'title' => __( 'Google Histogram', 'awcr_plugin_settings' )
            ),
            array(
                'id'    => 'awcr_bymo_gauge_chart',
                'title' => __( 'Gauge Chart', 'awcr_plugin_settings' )
            ),
            array(
                'id'    => 'awcr_bymo_gaming_bar',
                'title' => __( 'Gaming Bar', 'awcr_plugin_settings' )
            ),
            array(
                'id'    => 'awcr_bymo_shortcodes',
                'title' => __( 'Shortcodes', 'awcr_plugin_settings' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            // basic settings
            'awcr_bymo_basic_settings' => array(
                array(
                    'name' => 'choose_template',
                    'label' => __('Choose template', 'awcr_plugin_settings'),
                    'desc' => __('Default: Google histogram', 'awcr_plugin_settings'),
                    'type' => 'select',
                    'default' => 'google_histogram_dynamic',
                    'options' => array(
                        'google_histogram' => 'Google Histogram',
                        'google_histogram_dynamic' => 'Google Histogram Dynamic',
                        'gauge_chart' => 'Gauge Chart',
                        'gaming_bar' => 'Gaming Bar'
                    )
                ),
                array(
                    'name' => 'select_position',
                    'label' => __('Select position', 'awcr_plugin_settings'),
                    'desc' => __('Default: After post content', 'awcr_plugin_settings'),
                    'type' => 'select',
                    'default' => 'after_post_content',
                    'options' => array(
                        'before_post_content' => 'Before post content',
                        'after_post_content' => 'After post content'
                    )
                ),
                array(
                    'name' => 'disable_auto_placement',
                    'label' => __('Disable auto placement', 'awcr_plugin_settings'),
                    'desc' => __('Check this if you want to use shortcodes only to view the rating bar.' , 'awcr_plugin_settings'),
                    'type' => 'checkbox'
                ),
                array(
                    'name' => 'hide_on_pages',
                    'label' => __('Hide on pages', 'awcr_plugin_settings'),
                    'desc' => __('Check this if you want to hide rating field from pages.', 'awcr_plugin_settings'),
                    'type' => 'checkbox'
                ),
                array(
                    'name' => 'hide_on_posts',
                    'label' => __('Hide on posts', 'awcr_plugin_settings'),
                    'desc' => __('Check this if you want to hide rating field from posts.', 'awcr_plugin_settings'),
                    'type' => 'checkbox'
                ),
            ),
            // start customize
            'awcr_bymo_star_field' => array(
                array(
                    'name' => 'display_rating_bar',
                    'label' => __('Display rating bar', 'awcr_plugin_settings'),
                    'desc' => __('Default: Above comment text', 'awcr_plugin_settings'),
                    'type' => 'select',
                    'default' => 'after_post_content',
                    'options' => array(
                        'above_comment_text' => 'Above comment text',
                        'below_comment_text' => 'Below comment text'
                    )
                ),
                array(
                    'name' => 'field_name',
                    'label' => __('Field name', 'awcr_plugin_settings'),
                    'default' => 'Rating',
                    'desc' => __('Default: Rating', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
                array(
                    'name' => 'field_name_size',
                    'label' => __('Field name size', 'awcr_plugin_settings'),
                    'default' => '17px',
                    'desc' => __('Default: 17px', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
                array(
                    'name' => 'field_name_color',
                    'label' => __('Field name color', 'awcr_plugin_settings'),
                    'default' => '#000000',
                    'desc' => __('Default: #000000', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'field_star_size',
                    'label' => __('Field star size', 'awcr_plugin_settings'),
                    'default' => '23px',
                    'desc' => __('Default: 23px', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
                array(
                    'name' => 'star_color',
                    'label' => __('Star color', 'awcr_plugin_settings'),
                    'default' => '#333333',
                    'desc' => __('Default: #333333', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'star_size',
                    'label' => __('Star size', 'awcr_plugin_settings'),
                    'default' => '20px',
                    'desc' => __('Default: 20px', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
                array(
                    'name' => 'star_width',
                    'label' => __('Star width', 'awcr_plugin_settings'),
                    'default' => '20px',
                    'desc' => __('Default: 20px', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
                array(
                    'name' => 'star_height',
                    'label' => __('Star height', 'awcr_plugin_settings'),
                    'default' => '20px',
                    'desc' => __('Default: 20px', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
            ),
            // google histogram
            'awcr_bymo_google_histogram' => array(
                array(
                    'name' => 'container_width',
                    'label' => __('Container width', 'awcr_plugin_settings'),
                    'default' => '400px',
                    'desc' => __('Default: 400px. To make full width, write: 100%'),
                    'type' => 'text'
                ),
            ),
            // gauge chart
            'awcr_bymo_gauge_chart' => array(
                array(
                    'name' => 'name',
                    'label' => __('Name', 'awcr_plugin_settings'),
                    'default' => 'Rating',
                    'desc' => __('Default: Rating', 'awcr_plugin_settings'),
                    'type' => 'text'
                ),
                array(
                    'name' => 'background_color',
                    'label' => __('Background color', 'awcr_plugin_settings'),
                    'default' => '#ffffff',
                    'desc' => __('Default: #ffffff', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'border_color',
                    'label' => __('Border color', 'awcr_plugin_settings'),
                    'default' => '#efefef',
                    'desc' => __('Default: #efefef', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'rate_info_color',
                    'label' => __('Rate info color', 'awcr_plugin_settings'),
                    'default' => '#000000',
                    'desc' => __('Default: #000000', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'rating_bar_text_color',
                    'label' => __('Rating bar text color', 'awcr_plugin_settings'),
                    'default' => '#000000',
                    'desc' => __('Default: #000000', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'rating_bar_border_color',
                    'label' => __('Rating bar border color', 'awcr_plugin_settings'),
                    'default' => '#cccccc',
                    'desc' => __('Default: #cccccc', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'background_color_five_star',
                    'label' => __('Five star bar background color', 'awcr_plugin_settings'),
                    'default' => '#9FC05A',
                    'desc' => __('Default: #9FC05A', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'background_color_four_star',
                    'label' => __('Four star bar background color', 'awcr_plugin_settings'),
                    'default' => '#ADD633',
                    'desc' => __('Default: #ADD633', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'background_color_three_star',
                    'label' => __('Three star bar background color', 'awcr_plugin_settings'),
                    'default' => '#FFD834',
                    'desc' => __('Default: #FFD834', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'background_color_two_star',
                    'label' => __('Two star bar background color', 'awcr_plugin_settings'),
                    'default' => '#FFB234',
                    'desc' => __('Default: #FFB234', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name' => 'background_color_one_star',
                    'label' => __('One star bar background color', 'awcr_plugin_settings'),
                    'default' => '#FF8B5A',
                    'desc' => __('Default: #FF8B5A', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
            ),
            // gaming bar
            'awcr_bymo_gaming_bar' => array(
                array(
                    'name' => 'background_color',
                    'label' => __('Background color', 'awcr_plugin_settings'),
                    'default' => '#333333',
                    'desc' => __('Default: #333333', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
                array(
                    'name'              => 'background_image',
                    'label'             => __( 'Background image', 'ef_settings' ),
                    'type'              => 'file',
                    'default'           => '',
                    'desc' => __('If you set background image, the background color will be removed.', 'awcr_plugin_settings'),
                    'options'           => array(
                        'button_label'  => 'Choose Image'
                    )
                ),
                array(
                    'name' => 'text_color',
                    'label' => __('Text color', 'awcr_plugin_settings'),
                    'default' => '#ffffff',
                    'desc' => __('Default: #ffffff', 'awcr_plugin_settings'),
                    'type' => 'color'
                ),
            ),
            // shortcodes
            'awcr_bymo_shortcodes' => array(
                array(
                    'name' => 'note',
                    'label' => __('All shortcodes', 'awcr_plugin_settings'),
                    'desc' => __('See all shortcodes.'),
                    'type' => 'shortcodes_link'
                ),
            ),

        );

        return $settings_fields;
    }

    function awcr_plugin_page() {
        echo '<div class="wrap">';
        echo '<h1>Awesome WP Comment Rating</h1>';

        $this->awcr_plugin_settings->show_navigation();
        $this->awcr_plugin_settings->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
