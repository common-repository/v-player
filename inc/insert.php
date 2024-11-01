<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'dont access!' );
}
        // check_admin_referer dies if nonce can not been verified
        check_admin_referer( 'vpa-admin-nonce-insert', 'vpa_admin_nonce_insert' );

	$video_title  = sanitize_text_field($_POST['video_title']);
	$main_video   = sanitize_text_field($_POST['main_video']);
	$ads_video    = sanitize_text_field($_POST['ads_video']);
	$poster_video = sanitize_text_field($_POST['poster_video']);
	$ads_title    = sanitize_text_field($_POST['ads_title']);
	$ads_link     = sanitize_text_field($_POST['ads_link']);
	$down_title   = sanitize_text_field($_POST['download_title']);
	$down_link    = sanitize_text_field($_POST['download_link']);

    global $wpdb, $table_prefix;

    $vpa_table = esc_sql($table_prefix."vpa_posts");

   $m = $wpdb->query( $wpdb->prepare(
        "
            INSERT INTO {$vpa_table}
            ( vpa_post_title, main_video, ads_video, vpa_poster, vpa_link, vpa_title, vpa_download_link, vpa_download_title )
            VALUES (  %s, %s, %s, %s, %s, %s, %s, %s )
        ",
        $video_title,
        $main_video,
        $ads_video,
        $poster_video,
        $ads_link,
        $ads_title,
        $down_title,
        $down_link

    ) );

	$short = $wpdb->insert_id;
	
        if($m){
                echo "Published, Shortcode: [v_player id=$short]";
            }else{
                echo "Error an publish!";

            }
