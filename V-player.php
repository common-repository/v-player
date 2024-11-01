<?php
/**
 *
 * Plugin Name: V-player
 * Plugin URI: https://www.yasin.tk/
 * Description: This Plugin To Show Your Video With Ads And Poster.
 * Version: 1.0
 * Author: Yasin Ti
 * Author URI: https://profiles.wordpress.org/yasintechnology
 * License: GPLv2 or later
 *
 * @package   V-player
 * @author    Yasin Ti <yasin.coding@gmail.com>
 * @copyright Copyright (c) 2018, yasin.cf.
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( 'dont access!' );
}

vpac_main_class::init();

CLASS vpac_main_class {
	
	
		public static function init(){
		
    	    register_activation_hook(__FILE__, array(__CLASS__, 'install'));

            // add admin ajax file
            add_action('admin_enqueue_scripts', array(__CLASS__, 'vpa_admin_script_file'));
			
			// user style
			add_action('wp_enqueue_scripts',array(__CLASS__,'add_style'));
			
    		// call function admin data insert
    	    add_action('wp_ajax_vpa_insert_ajax',array(__CLASS__,'vpa_admin_ajax_insert'));
    	    add_action('wp_ajax_nopriv_vpa_insert_ajax',array(__CLASS__,'vpa_admin_ajax_insert'));

    		// call function admin data update
    	    add_action('wp_ajax_vpa_update_ajax',array(__CLASS__,'vpa_admin_ajax_update'));
    	    add_action('wp_ajax_nopriv_vpa_update_ajax',array(__CLASS__,'vpa_admin_ajax_update'));


           // add admin menu
           add_action('admin_menu', array(__CLASS__, 'admin_menus'));

           add_shortcode("v_player", array(__CLASS__, 'vpa_callback'));


		}


		    public static function install() {

                global $wpdb, $table_prefix;

				$table_vpa = $table_prefix."vpa_posts";

			//Check table already exists
		  	if($wpdb->get_var("show tables like {$table_vpa}") != $table_vpa){

					$sql = "CREATE TABLE IF NOT EXISTS {$table_vpa} (
							  `ID` int(255) NOT NULL AUTO_INCREMENT,
                              `vpa_post_title`  varchar(100)  NULL,
							  `main_video` varchar(100)  NULL,
							  `ads_video`  varchar(100)  NULL,
							  `vpa_poster` varchar(100)  NULL,
							  `vpa_link`   varchar(100)  NULL,
							  `vpa_title`  varchar(100)  NULL,
							  `vpa_download_link`  varchar(100)  NULL,
							  `vpa_download_title`  varchar(100)  NULL,
							  PRIMARY KEY (`ID`)
							) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci AUTO_INCREMENT=44";

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			}
			
	}

		public static function add_style(){

			 wp_enqueue_style('vpa_style', plugins_url('style/vpa-user.css',__FILE__),false);
		}

		public static function vpa_admin_script_file() {

        wp_enqueue_media();



        wp_enqueue_style('vpa_style', plugins_url('style/vpa-admin.css',__FILE__));

	   	wp_enqueue_script('vpa-media',plugins_url('/js/media.js',__FILE__),array('jquery'),null);
        wp_enqueue_script('media-uploader');

		wp_enqueue_script('vpa-admin-ajax',plugins_url('/js/ajax.js',__FILE__),array('jquery'),true);
		wp_localize_script( 'vpa-admin-ajax', 'vpa_url', array(
	    	'vpa_ajax_url' => admin_url( 'admin-ajax.php' ),
            'vpa_security_nonce' => wp_create_nonce('vpa-admin-nonce'),
			'vpa_security_nonce_insert' => wp_create_nonce('vpa-admin-nonce-insert')
		));

	}

		// add admin menu
		public static function admin_menus()
		{
       

			  add_menu_page('new vp', 'New Vp', 'manage_options', 'new_vp', array(__CLASS__, 'wpa_post_new'));
		   	  add_submenu_page('new_vp', 'new v', 'New v', 'manage_options', 'new_vp', array(__CLASS__, 'wpa_post_new'));
		  	  add_submenu_page('new_vp', 'All Video', 'All Video', 'manage_options', 'all_video', array(__CLASS__, 'all_video'));
		  	 

		}




	public static function wpa_post_new() {
			//must check that the user has the required capability
			if (!current_user_can('manage_options'))
		    	{
			        wp_die( __('You do not have sufficient permissions to access this page.') );
			    }

        ob_start();
        require_once "new-post.php";
        echo  ob_get_clean();

    }

 	public static function all_video() {


	    //must check that the user has the required capability
		if (!current_user_can('manage_options'))
		    {
			    wp_die( __('You do not have sufficient permissions to access this page.') );
		    }


        if(!empty($_GET['id']) && intval($_GET['id'])){

            $id = intval($_GET['id']);

            wp_verify_nonce($_GET['_wpnonce'] ) || die('wrong');


            self::delete($id);

        }

        if(!empty($_GET['u_id']) && intval($_GET['u_id'])){

            $id = intval($_GET['u_id']);

            wp_verify_nonce($_GET['_wpnonce'] ) || die('wrong');

            ob_start();
                 require_once "update-video.php";
            echo  ob_get_clean();

        } else {

        ob_start();
        require_once "all-video.php";
        echo  ob_get_clean();

    }

    }


    public static function delete($id) {

         global $wpdb, $table_prefix;

         $vpa_table = esc_sql($table_prefix."vpa_posts");

         $sql_d = "DELETE FROM {$vpa_table} WHERE ID=$id ";

          $wpdb->query($sql_d);

        }




	public static function vpa_callback($atts)  {

        ob_start();
        require_once "inc/shortcode.php";
        require_once "inc/script.php";
        echo  ob_get_clean();


    }




	public static function vpa_admin_ajax_insert() {
	
            // check_admin_referer dies if nonce can not been verified
           check_admin_referer( 'vpa-admin-nonce-insert', 'vpa_admin_nonce_insert' );

             require_once "inc/insert.php";

	    	wp_die();
    	}




	public static function vpa_admin_ajax_update() {

            // check_admin_referer dies if nonce can not been verified
            check_admin_referer( 'vpa-admin-nonce', 'vpa_admin_nonce' );

            global $wpdb, $table_prefix;

            $vpa_table = esc_sql($table_prefix."vpa_posts");

            $id   = intval($_POST['id']);
            $video_title    = sanitize_text_field($_POST['video_title_up']);
            $main_video     = sanitize_text_field($_POST['main_video']);
            $ads_video      = sanitize_text_field($_POST['ads_video']);
            $poster_video   = sanitize_text_field($_POST['poster_video']);
            $ads_title      = sanitize_text_field($_POST['ads_title']);
            $ads_link       = sanitize_text_field($_POST['ads_link']);
            $download_title = sanitize_text_field($_POST['download_title_up']);
            $download_link  = sanitize_text_field($_POST['download_link_up']);

            $r = $wpdb->query( $wpdb->prepare( "UPDATE {$vpa_table}
              set vpa_post_title = %s ,
              main_video = %s ,
              ads_video = %s ,
              vpa_poster = %s ,
              vpa_title = %s ,
              vpa_link = %s ,
              vpa_download_link = %s ,
              vpa_download_title = %s
              WHERE ID = %d",
              $video_title,
              $main_video,
              $ads_video,
              $poster_video,
              $ads_title,
              $ads_link,
              $download_title,
              $download_link,
               $id
               ) );




               if($r){
                    echo "Updated";
               }else{
                    echo "Error an Update!";

               }

	    	wp_die();
    	}





	}




?>