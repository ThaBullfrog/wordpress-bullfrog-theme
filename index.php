<?php get_header(); ?>

<?php while ( have_posts() ) : the_post() ?>
<article>
  <div class="entry-header">
    <h1 class="entry-title">
      <?php if ( is_home () || is_category() || is_search() ) : ?>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <?php
        else :
          the_title();
        endif;
      ?>
    </h1>
    <?php if ( 'post' == get_post_type() ) : ?>
      <div class="entry-meta">
        <?php shape_posted_on(); ?>
      </div>
    <?php endif; ?>
  </div>
  <?php if ( is_home () || is_category() || is_search() ) : ?>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  <?php else : ?>
    <div class="entry-content">
      <?php
        the_content(__(
          'Continue reading <span class="meta-nav">→</span>',
          'shape'
        ) );
      ?>
      <?php
        wp_link_pages( array(
          'before' => '<div class="page-links">' . __( 'Pages:', 'shape' ),
          'after' => '</div>'
        ) );
      ?>
    </div>
  <?php endif; ?>
    <p class="entry-meta">
      <?php $first = true; ?>
      <?php if ( 'post' == get_post_type() ) : ?>
        <?php
          $categories_list = get_the_category_list( __( ', ', 'shape' ) );
          if ( $categories_list && shape_categorized_blog() ) :
        ?>
          <?php $first = false; ?>
          <span class="cat-links">
            <?php 
              printf( __( 'Posted in %1$s', 'shape' ), $categories_list );
            ?>
          </span>
        <?php endif; ?>

        <?php
          $tags_list = get_the_tag_list( '', __( ', ', 'shape' ) );
          if ( $tags_list ) :
        ?>
          <?php if ( !$first ) : ?>
            <span class="sep"> | </span>
          <?php
            endif;
            $first = false;
          ?>
          <span class="tag-links">
            <?php printf( __( 'Tagged %1$s', 'shape' ), $tags_list ); ?>
          </span>
        <?php endif; ?>
      <?php endif; ?>

      <?php
        $sep = '';
        if ( !$first ) :
          $sep = '<span class="sep"> |   </span>';
        endif;
        edit_post_link(
          __( 'Edit', 'shape' ),
          $sep . '<span class="edit-link">',
          '</span>'
        );
      ?>
    </p>
</article>
<?php endwhile; ?>

<?php get_footer(); ?>
