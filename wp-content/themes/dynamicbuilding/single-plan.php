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
global $post;
$plan = new Plan($post->ID);
get_header(); ?>
<div class="wrapper" id="single-plan">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <div class="plan-banner-wrapper">
                    <?=$plan->getBannerImage()?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?=$plan->getTitle()?> House Plan - <span><?=$plan->getCustomField('plan-dimensions')?></span></h1>
                <div class="quick-specs">
                    <ul class="plain">
                        <li><span class="fa fa-car"></span><?=$plan->getCustomField('plan-garage')?></li>
                        <li><span class="fa fa-bed"></span><?=$plan->getCustomField('plan-bedrooms')?></li>
                        <li><span class="fa fa-bath"></span><?=$plan->getCustomField('plan-bathrooms')?></li>
                        <li><span class="fa fa-users"></span><?=$plan->getCustomField('plan-living')?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 plan-left-col">
                <div class="description">
                    <?=$plan->getContent()?>
                </div>
                <div class="image-wrapper">
                    <img src="<?=$plan->getCustomField('plan-feature-image')?>" alt="<?=$plan->getTitle()?>" />
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 plan-right-col">
                <h3>Download the Plan</h3>
                <div class="form-wrapper">
                    <?=do_shortcode('[contact-form-7 id="247" title="Enquiry Form"]')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 plans-navigation">
                <div class="inner-wrapper">
                <?php
                $previous = $plan->previous();
                if($previous->id() <> "") {
                    echo '<a href="' . $previous->link() . '" class="previous"><span class="fas fa-long-arrow-alt-left"></span>&nbsp;<strong>' . $previous->getTitle() . '</strong></a>';
                }
                echo '<a href="' . get_page_link(235) . '" class="listing"><span class="fa fa-th"></span></a>';
                $next = $plan->next();
                if($next->id() <> "") {
                    echo '<a href="' . $next->link() . '" class="next"><strong>' . $next->getTitle() . '</strong>&nbsp;&nbsp;<span class="fas fa-long-arrow-alt-right"></span></a>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
