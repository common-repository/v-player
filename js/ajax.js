jQuery(document).ready(function ($) {

    $(document).on('click','.vpa-insert',function(event){

        var video_title = $(".wpa-video-title").val();
        var main_video = $(".wpa-main-v").val();
        var ads_video = $(".wpa-ads-v").val();
        var poster_video = $(".wpa-poster").val();
        var ads_link = $(".wpa-ads-link").val();
        var ads_title = $(".wpa-ads-title").val();
        var download_title = $(".wpa-download-link").val();
        var download_link = $(".wpa-download-title").val();


        $("#loading-vpa-message").show();

        var action = "vpa_insert_ajax";
        var vpa_admin_nonce_insert = vpa_url.vpa_security_nonce_insert;

        $.ajax({

            url: vpa_url.vpa_ajax_url,
            type: "POST",
            data:{
                    action: action ,
                    video_title:video_title,
                    main_video:main_video,
                    ads_video:ads_video,
                    poster_video:poster_video,
                    ads_link:ads_link,
                    ads_title:ads_title,
                    download_title:download_title,
                    download_link:download_link,
                    vpa_admin_nonce_insert: vpa_admin_nonce_insert
                 } ,
            success: function (data) {

                $('#vpa_ajax-response').html(data);
                $('#loading-vpa-message').hide();

                }

        });

        e.preventDefault();

    });



    $(document).on('click','.vpa-update',function(event){

        var id = $(".id").val();
        var video_title_up = $(".wpa-video-title-up").val();
        var main_video_up = $(".wpa-main-v-up").val();
        var ads_video_up = $(".wpa-ads-v-up").val();
        var poster_video_up = $(".wpa-poster-up").val();
        var ads_link_up = $(".wpa-ads-link-up").val();
        var ads_title_up = $(".wpa-ads-title-up").val();
        var download_title_up = $(".wpa-download-link-up").val();
        var download_link_up = $(".wpa-download-title-up").val();


        $("#loading-vpa-message").show();

        var action = "vpa_update_ajax";
        var vpa_admin_nonce = vpa_url.vpa_security_nonce;

        $.ajax({

            url: vpa_url.vpa_ajax_url,
            type: "POST",
            data:{
                    action: action ,
                    id:id,
                    video_title_up:video_title_up,
                    main_video:main_video_up,
                    ads_video:ads_video_up,
                    poster_video:poster_video_up,
                    ads_link:ads_link_up,
                    ads_title:ads_title_up,
                    download_title_up:download_title_up,
                    download_link_up:download_link_up,
                    vpa_admin_nonce: vpa_admin_nonce
                 } ,
            success: function (data) {

                $('#vpa_ajax-response').html(data);
                $('#loading-vpa-message').hide();

                }

        });

        e.preventDefault();

    });


});