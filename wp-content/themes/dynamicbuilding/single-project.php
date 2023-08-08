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
get_header(); ?>

    <div class="wrapper" id="single-project">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 no-padding">
                    <?php
                    if(has_post_thumbnail($post->ID))
                    { ?>
                        <div class="inside-banner-wrapper">
                            <?=get_the_post_thumbnail($post->ID, 'full')?>
                            <div class="page-title">
                                <h1><?=get_the_title()?></h1>
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
                    <main id="main" class="site-main" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'loop-templates/content', 'project' ); ?>
                            <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>
                        <?php endwhile; // end of the loop. ?>
                    </main>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>