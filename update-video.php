<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'dont access!' );
}
			
    global $wpdb, $table_prefix;

    $vpa_table = esc_sql($table_prefix."vpa_posts");


   $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$vpa_table} WHERE id = %d",$id ));
      $post_title = $result->vpa_post_title;
      $main_video = $result->main_video;
      $ads_video  = $result->ads_video;
      $poster     = $result->vpa_poster;
      $vpa_link   = $result->vpa_link;
      $vpa_title  = $result->vpa_title;
      $download_link  = $result->vpa_download_link;
      $download_title  = $result->vpa_download_title;


            ob_start();
                 require_once "inc/form.php";
            echo  ob_get_clean();


