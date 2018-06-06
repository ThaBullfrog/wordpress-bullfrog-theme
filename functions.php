<?php

function bfg_setup_assets() {
  wp_register_style(
    'Roboto',
    'https://fonts.googleapis.com/css?family=Roboto:400,400i,700,900'
  );
  wp_enqueue_style('Roboto');
  wp_enqueue_style(
    'main',
    get_template_directory_uri() . '/assets/css/main.css'
  );

  wp_register_script(
    'jQuery',
    'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js',
    null, null, true
  );
  wp_enqueue_script('jQuery' );
  wp_enqueue_script(
    'main',
    get_template_directory_uri() . '/assets/js/main.js',
    null, null, true
  );
}

function bfg_init() {
  add_theme_support('menus');
  register_nav_menu('primary', 'Primary navigation menu.');
}

if ( ! function_exists( 'shape_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Shape 1.0
 */
function shape_posted_on() {
    printf(
      __(
        '<time class="entry-date" datetime="%3$s" pubdate>%4$s</time>',
        'shape'
      ),
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr(
        sprintf(__( 'View all posts by %s', 'shape' ), get_the_author() )
      )
    );
}
endif;
 
/**
 * Returns true if a blog has more than 1 category
 *
 * @since Shape 1.0
 */
function shape_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
        // Create an array of all the categories that are attached to posts
        $all_the_cool_cats = get_categories( array(
            'hide_empty' => 1,
        ) );
 
        // Count the number of categories that are attached to the posts
        $all_the_cool_cats = count( $all_the_cool_cats );
 
        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
    }
 
    if ( '1' != $all_the_cool_cats ) {
        // This blog has more than 1 category so shape_categorized_blog should return true
        return true;
    } else {
        // This blog has only 1 category so shape_categorized_blog should return false
        return false;
    }
}
 
/**
 * Flush out the transients used in shape_categorized_blog
 *
 * @since Shape 1.0
 */
function shape_category_transient_flusher() {
    // Like, beat it. Dig?
    delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'shape_category_transient_flusher' );
add_action( 'save_post', 'shape_category_transient_flusher' );

add_action('wp_enqueue_scripts', 'bfg_setup_assets');
add_action('init', 'bfg_init');

?>
