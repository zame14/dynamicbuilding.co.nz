<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
require_once('modal/class.Base.php');
require_once('modal/class.Testimony.php');
require_once('modal/class.Project.php');
require_once('modal/class.Plan.php');
//require_once('modal/class.Category.php');
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    // Get the theme data
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/all.min.css');
    //wp_enqueue_style( 'google_font', 'https://fonts.googleapis.com/css2?family=Averia+Sans+Libre&family=Roboto&family=PT+Sans:wght@700&display=swap');
    //wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick.css');
    //wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
//add_action( 'after_setup_theme', 'add_child_theme_textdomain' );
function dg_remove_page_templates( $templates ) {
    unset( $templates['page-templates/blank.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/empty.php'] );
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;

}
add_image_size( 'gallery', 600);
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );
add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'contact', // Option ID
        'Contact Name', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'contact' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'facebook', // Option ID
        'Facebook Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'facebook' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'copyright', // Option ID
        'Copyright Message', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'copyright' // Should match Option ID
        )
    );

    register_setting('general','phone', 'esc_attr');
    register_setting('general','facebook', 'esc_attr');
    register_setting('general','email', 'esc_attr');
    register_setting('general','contact', 'esc_attr');
    register_setting('general','copyright', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function copyright_shortcode()
{
    return get_option('copyright');
}
add_shortcode('copyright', 'copyright_shortcode');
function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}
function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}
function socialMediaMenu() {
    $html = '
    <ul class="social-media plain">';
    if(get_option('facebook')) {

        $html .= '<li><a href="' . get_option('facebook') . '" target="_blank" class="fa fa-facebook-square"></a>';

    }
    $html .= '</ul>';
    return $html;
}
function footer_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'understrap' ),
        'id'            => 'footerwidget',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper footer-widget-1">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer_widgets_init' );
function footer1_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'understrap' ),
        'id'            => 'footerwidget1',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer1_widgets_init' );
add_action('init', 'db_register_menus');
function db_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
        )
    );
}
function getFeatureTestimonials($limit = -1)
{
    $testimonials = Array();
    $posts_array = get_posts([
        'post_type' => 'testimony',
        'post_status' => 'publish',
        'numberposts' => $limit,
        'orderby' => 'ID',
        'order' => 'DESC',
        'meta_query' => [
            [
                'key' => 'wpcf-feature-testimonial',
                'value' => 1
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $testimony = new Testimony($post);
        $testimonials[] = $testimony;
    }
    return $testimonials;
}
function getTestimonials()
{
    $testimonials = Array();
    $posts_array = get_posts([
        'post_type' => 'testimony',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'DESC'
    ]);
    foreach ($posts_array as $post) {
        $testimony = new Testimony($post);
        $testimonials[] = $testimony;
    }
    return $testimonials;
}
function featureTestimonial_shortcode()
{
    $testimonials = getFeatureTestimonials();
    shuffle($testimonials);
    $testimony = new Testimony($testimonials[0]->Post->ID);
    $html = '
    <div class="inner-wrapper">
        <span class="fa fa-quote-left"></span>
        ' . $testimony->getContent() . '
    </div>';

    return $html;
}
add_shortcode('feature_testimonial', 'featureTestimonial_shortcode');
function getProjects()
{
    $projects = Array();
    $posts_array = get_posts([
        'post_type' => 'project',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $project = new Project($post);
        $projects[] = $project;
    }
    return $projects;
}
function projectTiles_shortcode()
{
    $i = 1;
    $html = '
    <div class="row project-tiles-wrapper">';
    foreach(getProjects() as $project)
    {
        $html .= '
        <div class="col-12 project-tile p' . $i . '">
            <div class="inner-wrapper">
                <div class="image-wrapper no-lazy">
                    ' . $project->getCTAImage() . '
                    <div class="title">
                        ' . $project->getTitle() . '
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="content-inner-wrapper">
                        <div class="cube">
                            <img src="' . get_stylesheet_directory_uri() . '/images/cube.png' . '" alt="" class="no-lazy" />
                        </div>
                        <div class="blurb">
                            ' . $project->getBlurb() . '
                        </div>
                    </div>
                </div>    
            </div>
        </div>';
        $i++;
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('projects', 'projectTiles_shortcode');

function phone_shortcode()
{
    return '<a href="tel:' . formatPhoneNumber(get_option('phone')) . '">' . get_option('phone') . '</a>';
}
add_shortcode('phone', 'phone_shortcode');

function email_shortcode()
{
    return '<a href="mailto:' . get_option('email') . '">' . get_option('email') . '</a>';
}
add_shortcode('email', 'email_shortcode');

function testimonialsModule_shortcode()
{
    $html = '';
    foreach (getTestimonials() as $test)
    {
        $html .= '
        <div class="testimony-wrapper">
            <div class="inner-wrapper">
                <div class="testimony">
                    ' . $test->getContent() . '
                </div>
                <div class="author">' . $test->getTitle() . '</div>
            </div>
        </div>';
    }
    return $html;
}
add_shortcode('testimonials_module', 'testimonialsModule_shortcode');
function getPlans($limit = -1)
{
    $plans = Array();
    $posts_array = get_posts([
        'post_type' => 'plan',
        'post_status' => 'publish',
        'numberposts' => $limit,
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $plan = new Plan($post);
        $plans[] = $plan;
    }
    return $plans;
}
function housePlans_shortcode($atts)
{
    $plans = getPlans($atts['limit']);
    if($atts['limit'] == 3) {
        // we want to randomly display three plans
        shuffle($plans);
    }
    $html = '<div class="row justify-content-center row-eq-height">';
    foreach($plans as $plan)
    {
        $html .= '<div class="col-12 col-sm-6 col-md-6 col-lg-4 plan-tile">
            <div class="inner-wrapper">
                <div class="image-wrapper no-lazy">
                    <img src="' . $plan->getCustomField('plan-feature-image') . '" alt="' . $plan->getTitle() . '" />
                    <div class="quick-specs">
                        <ul class="plain">
                            <li><span class="fa fa-car"></span> ' . $plan->getCustomField('plan-garage') . '</li>
                            <li><span class="fa fa-bed"></span> ' . $plan->getCustomField('plan-bedrooms') . '</li>
                            <li><span class="fa fa-bath"></span> ' . $plan->getCustomField('plan-bathrooms') . '</li>
                            <li><span class="fas fa-couch"></span> ' . $plan->getCustomField('plan-living') . '</li>
                        </ul>
                    </div>
                </div>
                
                    <h3>' . $plan->getTitle() . ' House Plan<span>' . $plan->getCustomField('plan-dimensions') . '</span></h3>
                    <div class="snippet">' . $plan->getCustomField('plan-snippet') . '</div>
                    <a href="' . $plan->link() . '" class="btn btn-primary">view</a>
                
            </div>    
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('house_plans_module', 'housePlans_shortcode');

function brochureLink_shortcode()
{
    global $post;
    $plan = new Plan($post->id);
    $html = '<input type="text" name="brochure-file" value="' . $plan->getCustomField('floor-plan') . '" />';
    return $html;
}
add_shortcode('brochure-link', 'brochureLink_shortcode');
function housePlan_shortcode()
{
    global $post;
    $plan = new Plan($post->id);
    $html = '<input type="text" name="house-plan" value="' . $plan->getTitle() . '" />';
    return $html;
}
add_shortcode('house-plan', 'housePlan_shortcode');

function projectGallery_shortcode()
{
    global $post;
    $project = new Project($post->ID);
    return $project->gallery();
}
add_shortcode('project_gallery', 'projectGallery_shortcode');