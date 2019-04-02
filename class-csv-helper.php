<?php
class CSV_HELPERR{

  function exportToArray( $path ){
    $file = fopen( $path, "r" );
    $arrayCsv = array();
    while( !feof( $file ) ) {
      $fpTotal = fgetcsv( $file );
      array_push( $arrayCsv, $fpTotal );
    }
    fclose( $file );
    return $arrayCsv;

  }

  // function insertTerms($taxonomy){
  //   $term_id_arr = array();
  //
  //   $taxonomy = explode(',',$rowCsv[3]);
  //       foreach( $taxonomy as $taxonomies ){
  //
  //         //Returns the term_id if exists else returns null
  //         $term = term_exists( $taxonomies, $taxonomy );
  //
  //         if( !$term ){
  //           // TERM DOES NOT EXIST, CREATE NEW TERM
  //           $term = wp_insert_term( $location, $taxonomy );
  //         }
  //         array_push( $term_id_arr, $term['term_id'] );
  //     }
  //     return $term_id_arr;
  // }

}
