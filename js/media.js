jQuery(document).ready(function($){

    $('#video_main_button').click(function(e) {

        var mediaUploader;
        e.preventDefault();
            if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
            text: 'Choose Image'
        }, multiple: false });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#video-main').val(attachment.url);
        });
        mediaUploader.open();
    });



    $('#video_ads_button').click(function(e) {

        var mediaUploader;
        e.preventDefault();
            if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
            text: 'Choose Image'
        }, multiple: false });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#video-ads').val(attachment.url);


        });
        mediaUploader.open();
    });


    $('#poster_ads_button').click(function(e) {

        var mediaUploader;
        e.preventDefault();
            if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
            text: 'Choose Image'
        }, multiple: false });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#poster-ads').val(attachment.url);
            jQuery('#poster-ads-prew').attr('src',attachment.url);

        });
        mediaUploader.open();
    });

});