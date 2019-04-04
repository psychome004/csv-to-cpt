<?php

add_action('admin_menu', 'csv_menu_page');
function csv_menu_page(){
   add_menu_page('CSV IMPORT', 'CSV IMPORT', 'manage_options' , 'csv_import', 'csv_view_post' );
   // add_submenu_page('csv_import', 'Import Locations', 'Import Locations', 'manage_options', 'states_import', 'import_locations' );
   // add_submenu_page('my-menu', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
}

// function import_locations(){
//   include "statescsv.php";
// }

function customSlugify( $label ){
  return preg_replace('/\s+/', '', strtoupper( $label ));
}

function getTermsArr( $taxonomy ){

  $terms = get_terms( $taxonomy, array('hide_empty' =>  false));

  $data = array();

  foreach ($terms as $term) {

    $slug = customSlugify( $term->name );

    $data[ $slug ] = $term->term_id;
  }
  return $data;
}

function csv_view_post(){

  $locations_arr = getTermsArr('locations');
  $victims_arr = getTermsArr('victims');
  $report_type_arr = getTermsArr('report-type');


   $csv_helper = new CSV_HELPERR;
   $arrayCsv = $csv_helper->exportToArray( plugin_dir_url(__FILE__).'soah.csv' );

   $i = 0;
   foreach ($arrayCsv as $rowCsv ) {
     // while( $i<=100 )
     if( $i>=1 && $i<=50 ){
      $new_post = array(
          'post_title'  =>  $rowCsv[1],
          'post_content'=>  $rowCsv[4],
          'post_date'   =>  $rowCsv[2],
          'post_status' =>  'publish',
          'post_type'   =>  'reports'
      );
      $post_id = wp_insert_post($new_post);

      $location_id_arr = array();
      $locations = explode(',',$rowCsv[3]);
      foreach( $locations as $location_str ){
         $location_slug = customSlugify( $location_str );
         if( isset( $locations_arr[ $location_slug ] ) ){
           array_push( $location_id_arr, $locations_arr[ $location_slug ] );
        }
      }
      wp_set_post_terms( $post_id, $location_id_arr, 'locations' );

      // Add report-type if not exists
      $report_type_id_arr = array();
      $report_types = explode(',',$rowCsv[5]);
      foreach( $report_types as $report_str ){
        $term = term_exists($report_str,'report-type');
        if(!$term){
          $term = wp_insert_term( $report_str, 'report-type' );
        }
        array_push( $report_type_id_arr, $term['term_id'] );
      }
      wp_set_post_terms( $post_id, $report_type_id_arr, 'report-type' );
   }
 $i++;
 }
}
