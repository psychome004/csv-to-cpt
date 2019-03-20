<?php

  $csv_helper = new CSV_HELPER;
  $arrayCsv = $csv_helper->exportToArray( plugin_dir_url(__FILE__).'statesdistricts.csv' );

  // echo '<pre>';
  // print_r($arrayCsv);
  // echo '</pre>';
  foreach ($arrayCsv as $states) {
    echo '';
  }
