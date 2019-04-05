<?php

  $input_term1 = array(
    'slug'      => 'women',
    'taxonomy'  => 'report-type'
  );

  $input_term2 = array(
    'slug'      => 'women',
    'taxonomy'  => 'victims'
  );


  $args = array(
    'post-type' =>  'reports',
    'posts_per_page' =>  100,
    'tax_query' =>  array(
      array(
        'taxonomy'  => $input_term1['taxonomy'],
        'field'     =>  'slug',
        'terms'     =>  $input_term1['slug']
      ),
    ),
  );



$term = get_term_by( 'slug', $input_term2['slug'], $input_term2['taxonomy'] );
print_r($term->term_id);

// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<li>'. get_the_title() . '</li>';
    wp_set_post_terms( get_the_ID(), $term->term_id, $input_term2['taxonomy'] );
	}
	echo '</ul>';
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	echo 'no posts found';
}
