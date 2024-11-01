   <h4>  Update Video  </h4>
 <div id="vpa-main">
<div style="display:none;" id="loading-vpa-message"><img src="<?php echo esc_url(plugins_url('/../img/loading-admin.gif',__FILE__)); ?>" alt="loading" /> </div>
   <div class="vpa-box">
<input type="text" name="video-title" class="wpa-video-title-up" value="<?php echo esc_attr($post_title); ?>" /> Video Title
</div>

  <input type="hidden" class="id" value="<?php echo intval($id); ?>"/>
 <div class="vpa-box">
<input id="video-main" type="text" name="video-main" class="wpa-main-v-up" value="<?php echo esc_attr($main_video); ?>" />
<input id="video_main_button" type="button" class="v-button-primary"  value="Insert main video" />
</div>

 <div class="vpa-box">
<input id="video-ads" type="text" name="video-ads" class="wpa-ads-v-up" value="<?php echo esc_url($ads_video); ?>" />
<input id="video_ads_button" type="button" class="v-button-primary"  value="Insert ads video" />
</div>

 <div class="vpa-box">
<input type="text" name="video-ads" class="wpa-ads-link-up" value="<?php echo esc_url($vpa_link); ?>" /> ads link
</div>
 <div class="vpa-box">
<input type="text" name="video-ads" class="wpa-ads-title-up" value="<?php echo esc_attr($vpa_title); ?>" /> ads link title
</div>

 <div class="vpa-box">
     <img alt="" src="<?php echo esc_url($poster); ?>" id="poster-ads-prew" class="wpa-poster-pre" />
<input id="poster-ads" type="text" name="background_image2" class="wpa-poster-up" value="<?php echo esc_url($poster); ?>" />
<input id="poster_ads_button" type="button" class="v-button-primary" value="Insert poster" />

</div>


 <div class="vpa-box">
<input type="text" name="video-download-link" class="wpa-ads-title wpa-download-link-up" value="<?php echo esc_url($download_link); ?>" /> download link
</div>
 <div class="vpa-box">
<input type="text" name="video-download-title" class="wpa-ads-title wpa-download-title-up" value="<?php echo esc_attr($download_title); ?>" /> download link title
</div>


<div class="vpa-update"> Save Video</div>

<div id="vpa_ajax-response"> </div>

</div>
