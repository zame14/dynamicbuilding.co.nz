<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/2/2022
 * Time: 2:00 PM
 */
class Plan extends dbBase
{
    public function getBannerImage()
    {
        return get_the_post_thumbnail($this->Post, 'full');
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    function previous() {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID < ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="plan" 
        ORDER BY p.ID DESC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $previd = $result[0]->ID;
        if($previd == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="plan"
            ORDER BY p.ID DESC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $previd = $result1[0]->ID;

        }

        return new Plan($previd);
    }
    public function next()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID 
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID > ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="plan" 
        ORDER BY p.ID ASC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $nextid = $result[0]->ID;
        if($nextid == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="plan"
            ORDER BY p.ID ASC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $nextid = $result1[0]->ID;

        }
        return new Plan($nextid);
    }
}