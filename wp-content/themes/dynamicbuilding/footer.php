<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<a class="top">
    <span class="fa fa-chevron-up"></span>
</a>
<section id="footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 f-col-1">
                <h3>Contact</h3>
                <p><strong><?=get_bloginfo('name')?></strong></p>
                <ul class="plain">
                    <li><a href="tel:<?=formatPhoneNumber(get_option('phone'))?>"><span class="fa fa-phone"></span> <?=get_option('phone')?></a></li>
                    <li><a href="mailto:<?=get_option('email')?>"><span class="fa fa-envelope"></span> <?=get_option('email')?></a></li>
                </ul>
                <a href="<?=get_page_link(133)?>" class="sitemap"><span class="fa fa-sitemap"></span>&nbsp;Sitemap</a>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 f-col-2">
                <h3>Projects</h3>
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'footer-menu',
                        'container_class' => 'footer-menu-wrapper',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'fallback_cb'     => '',
                        'menu_id'         => 'footer-menu',
                    )
                ); ?>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2 f-col-3">
                <h3>Follow Us</h3>
                <?=socialMediaMenu()?>
            </div>
            <div class="col-8 col-sm-6 col-md-6 col-lg-3 f-col-4">
                <h3>Registered Members of</h3>
                <div class="inner-wrapper">
                    <?php
                    if(is_active_sidebar('footerwidget')){
                        dynamic_sidebar('footerwidget');
                    }
                    ?>
                    <?php
                    if(is_active_sidebar('footerwidget1')){
                        dynamic_sidebar('footerwidget1');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="plain">
                    <li>&copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?></li>
                    <li class="website-by">Custom website by <a href="https://www.azwebsolutions.co.nz/" target="_blank">A-Z Web Solutions Ltd<span class="az"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
</div>
<?php wp_footer(); ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/noframework.waypoints.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="<?=get_stylesheet_directory_uri()?>/js/theme.js" type="text/javascript"></script>
</body>
</html>