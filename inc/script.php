  <script>
    // script by : https://stackoverflow.com/users/1000289/yusufabdulloh

        var video_list      = ["<?php echo esc_url($main_video); ?>",
                               "<?php echo esc_url($ads_video); ?>"
                              ];

        var video_index     = 0;
        var video_player    = null;

        document.onload = onload();
        
        function onload(){

            video_player        = document.getElementById("idle_video");
            video_player.setAttribute("src", video_list[video_index]);
            video_player.play();
        }

        function onVideoEnded(){

            if(video_index < video_list.length - 1){
                video_index++;
                 document.getElementById("vi").style.display="none";
            }
            else{
                video_index = 0;
            }
            video_player.setAttribute("src", video_list[video_index]);
            video_player.play();
        }
    </script>
