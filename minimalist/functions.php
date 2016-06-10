<?php
//clean wp_head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action ('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head');

//clean title
function fix_title($title){
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_bloginfo('description').' | '.get_bloginfo('name') ;
  }
  return $title.get_bloginfo('name') ;
}
add_filter( 'wp_title', 'fix_title' );

//Enqueue scripts and styles.
function load_scripts_styles() {
	wp_enqueue_style( 'simple-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'load_scripts_styles' );

//Custom Search
function my_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" ><input type="text" value="' . get_search_query() . '" name="s" placeholder="Search..." id="s" /><input type="submit" id="searchsubmit" value="" /></form>';
	return $form;
}
add_filter( 'get_search_form', 'my_search_form' );

//custom footer
function custom_footer() {
    echo '<div id="copyright"><p>Copyright &copy2016 '.get_bloginfo("name").', All Rights Reserved</p></div>';
}
add_action( 'wp_footer', 'custom_footer' );

//modify read more and the link jump
function modify_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">Read more</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );