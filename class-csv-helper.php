<?php
class CSV_HELPER{

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

  

}
