<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'dont access!' );
}

    global $wpdb, $table_prefix;

    $vpa_table = esc_sql($table_prefix."vpa_posts");


        $query = "SELECT * FROM {$vpa_table}";
        $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
        $total = $wpdb->get_var( $total_query );
        $items_per_page = 4;
        $page = isset( $_GET['fl_page'] ) ? abs( (int) $_GET['fl_page'] ) : 1;
        $offset = ( $page * $items_per_page ) - $items_per_page;


   $results = $wpdb->get_results($wpdb->prepare( $query . " ORDER BY id LIMIT %d, %d",$offset,$items_per_page ));

   echo "<table id='table_vpa'>";
   echo "<tr> <th> ID </th><th> Name </th><th> Update </th><th> Delete </th></tr>";
   foreach($results as $result){

    echo "<tr> <td>" . $result->ID . "</td>";
    echo "<td>" . $result->vpa_post_title . "</td>";
    echo "<td> <a href='".wp_nonce_url(add_query_arg(array('u_id'=>$result->ID)))."'>" . Update . "</a></td>";
    echo "<td> <a href='".wp_nonce_url(add_query_arg(array('id'=>$result->ID)))."'>" . Delete . "</a></td></tr>";
    }




     if($total > $items_per_page){

    echo '<tr><td><div class="navigation_vpa">' .  paginate_links( array(
        'base' => add_query_arg( 'fl_page', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => ceil($total / $items_per_page),
        'current' => $page
    )) . '</div></td></tr>';

    }


    echo "</table>";



