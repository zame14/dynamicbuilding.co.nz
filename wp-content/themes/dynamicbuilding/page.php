<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
get_header();
?>
<div class="wrapper" id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <?php
                if(is_front_page())
                {
                    ?>
                    <div class="home-banner-wrapper">
                        <?=get_the_post_thumbnail($post->ID, 'full')?>
                        <div class="content-wrapper">
                            <div class="logo-overlay ani-in">
                                <img src="<?=get_stylesheet_directory_uri()?>/landscape-logo.png" alt="<?=get_bloginfo('name')?>" />
                            </div>
                            <div class="slogan-overlay">
                                <ul class="plain">
                                    <li class="s1 ani-in">Consult.</li>
                                    <li class="s2 ani-in">Design.</li>
                                    <li class="s3 ani-in">Build.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                } else { ?>
                    <div class="page-title">
                        <h1><?=get_the_title()?></h1>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div id="content" class="container">
        <div class="row">
            <div class="col-12">
                <main class="site-main" id="main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'loop-templates/content', 'page' ); ?>
                    <?php endwhile; // end of the loop. ?>
                </main><!-- #main -->
            </div>
        </div><!-- .row -->
    </div><!-- #content -->
</div>
<?php get_footer(); ?>
