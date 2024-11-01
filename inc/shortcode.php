<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'dont access!' );
}
    global $wpdb, $table_prefix;

    $vpa_table = esc_sql($table_prefix."vpa_posts");

    $id = intval($atts['id']);

   $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$vpa_table} WHERE id = %d",$id ));
	   $post_title = $result->vpa_post_title;
       $main_video = $result->main_video;
       $ads_video  = $result->ads_video;
       $poster     = $result->vpa_poster;
       $vpa_link   = $result->vpa_link;
       $vpa_title  = $result->vpa_title;
	   $download_link  = $result->vpa_download_link;
       $download_title  = $result->vpa_download_title;
    ?>

<div class="vpa-main-form" >
<p> <?php echo esc_attr($post_title);?> </p>
    <video id="idle_video" width="100%" height="auto" poster="<?php echo esc_url($poster); ?>" controls onended="onVideoEnded();"></video>

 <a href="<?php echo esc_url($vpa_link); ?>" class="vpa-video" id="vi"> <?php echo esc_attr($vpa_title); ?> </a>
<p> <a href="<?php echo esc_url($download_link); ?>"> <?php echo esc_attr($download_title); ?> </a> </p>
</div>





