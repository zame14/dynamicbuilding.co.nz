<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/1/2021
 * Time: 9:31 PM
 */
class Project extends dbBase
{
    public function getFeatureImage()
    {
        return get_the_post_thumbnail($this->Post, 'full');
    }
    public function getBlurb()
    {
        $content = wpautop($this->getPostMeta('project-blurb'));
        return $content;
    }
    public function getCTAImage()
    {
        $html = '<img src="' . $this->getPostMeta('project-cta-image') . '" alt="' . $this->getTitle() . '" />';
        return $html;
    }
    public function getProjectImages()
    {
        $gallery = Array();
        $field = get_post_meta($this->id());
        foreach($field['wpcf-project-images'] as $image) {
            $gallery[] = $image;
        }
        return $gallery;
    }
    function gallery()
    {
        $caption = '';
        $html = '
        <div class="grid">';
        foreach($this->getProjectImages() as $images) {
            $caption = '';
            $imageid = getImageID($images);
            $img = wp_get_attachment_image_src($imageid, 'full');
            $caption = wp_get_attachment_caption($imageid);
            $html .= '
            <div class="grid-item">
                <div class="inner-wrapper">
                    <img src="' . $img[0] . '" alt="" data-no-lazy="1" class="project-image" />';
                if($caption <> "") {
                    $html .= '<div class="title">' . $caption . '</div>';
                }
                $html .= '    
                </div>    
            </div>';
        }
        $html .= '
        </div>';

        return $html;
    }
}