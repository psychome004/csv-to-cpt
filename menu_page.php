<?php

add_action('admin_menu', 'csv_menu_page');
function csv_menu_page(){
   add_menu_page('CSV IMPORT', 'CSV IMPORT', 'manage_options' , 'csv_import', 'csv_view_post' );
   add_submenu_page('csv_import', 'Import Locations', 'Import Locations', 'manage_options', 'states_import', 'import_locations' );
   // add_submenu_page('my-menu', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
}

function import_locations(){
  include "statescsv.php";
}

function csv_view_post(){

  $csv_helper = new CSV_HELPER;
  $arrayCsv = $csv_helper->exportToArray( plugin_dir_url(__FILE__).'soah.csv' );


  // echo '<pre>';
  print_r($arrayCsv);
  // echo '</pre>';
  //
  // echo '<pre>';
  $i = 0;
  foreach ($arrayCsv as $rowCsv ) {
    if( $i == 1 ){

      // print_r( $rowCsv );
      // echo $rowCsv[4];
      $new_post = array(
          'post_title'  =>  $rowCsv[1],
          'post_content'=>  $rowCsv[4],
          'post_date'   =>  $rowCsv[2],
          'post_status' =>  'publish',
          'post_type'   =>  'reports'
      );
      $post_id = wp_insert_post($new_post);

      $term_id_arr = array();
      $categories = explode(',', $rowCsv[5] );
      foreach( $categories as $category ){

        $term = term_exists( $category, 'report-type' );

        if( !$term ){
          // TERM DOES NOT EXIST, CREATE NEW TERM
          $term = wp_insert_term( $category, 'report-type' );
        }

        array_push( $term_id_arr, $term['term_id'] );
        echo $category;
        //echo $term_id."<br>";
        //

      }
      echo "<pre>";
      print_r( $term_id_arr );
      echo "</pre>";
      wp_set_post_terms( $post_id, $term_id_arr, 'report-type' );
    }

    $i++;
  }
  echo '</pre>';
}
