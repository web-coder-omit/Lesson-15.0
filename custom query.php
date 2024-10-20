<?php
/**
 * Plugin Name: Custom query
 * Plugin URI:  Plugin URL Link
 * Author:      Plugin Author Name
 * Author URI:  Plugin Author Link
 * Description: This plugin make for pratice wich is "custom query".
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: cst_qr
 */
// Languages file loaded
function plugin_file_function(){
    load_plugin_textdomain('cst_qr', false, dirname(__FILE__) . "/languages");
}
add_action('plugins_loaded', 'plugin_file_function');
// Start to write code from here
// function cst_qr_function(){
//     $posts = get_posts(array(
//         'numberposts' => 2,
//         'post_type' => 'post'
//     ));
//     foreach($posts as $post){
//         setup_postdata($post);
//         // echo "<pre>";
//         // print_r($post);
//         // echo "<pre>";
//         ?>
//         <h2> <?php the_title(); ?></h2>
//         <h2> <?php echo get_the_ID(); ?></h2>
//         <?php

//     }
//     wp_reset_postdata();

// }
//  add_action('wp_footer',"cst_qr_function");
// //add_action('admin_notices',"cst_qr_function");


function wp_qr_function() {
    $posts = new WP_Query(array(
        'posts_per_page' => 7,
        'post_type' => 'post',
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array('demos') 
            ),
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => array('post_tag')
            )
        )
        //----------------Access any post by date
        // 'monthnum'=>5,
        // 'year' =>2024
        
        //---------------Access any post which are in "Draft"
        // 'post_status'=>'draft'
    ));

    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post();
            ?>
        
            <h2><?php the_title(); ?></h2>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo 'No posts found';
    }
}
add_action('wp_footer', 'wp_qr_function');












// Stop to write code from there
?>