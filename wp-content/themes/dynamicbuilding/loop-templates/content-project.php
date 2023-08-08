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
$project = new Project($post->ID);
?>
<div class="row">
    <div class="col-12 project-gallery-wrapper ani-in">
        <?=$project->getContent(true)?>
    </div>
</div>
<div class="row">
    <div class="col-12 contact-cta-wrapper">
        <a href="<?=get_page_link(9)?>" class="contact-cta">
            <div class="inner-wrapper">
                <div class="image-wrapper">
                    <?=$project->getCTAImage()?>
                </div>
                <div class="content-wrapper">
                    <h3>Let's get to know each other and make that dream build into a reality</h3>
                    <p><span>Contact us</span> today</p>
                </div>
            </div>
        </a>
    </div>
</div>