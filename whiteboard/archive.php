<?php get_header(); ?>
<div id="content">

  <h1><?php if( is_day() ){
    /* if the daily archive is loaded */
    printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() );
  }elseif( is_month() ){
    /* if the montly archive is loaded */
    printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') );
  }elseif( is_year() ){
    /* if the yearly archive is loaded */
    printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') );
  }else{
    /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */
    echo 'Blog Archives';
  } ?></h1>

  <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <div class="post-single">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      <?php if( has_post_thumbnail() ) { /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ ?><div class="featured-thumbnail"><?php the_post_thumbnail(); ?></div><?php } ?>
      <p>Written on <?php the_time('F j, Y'); ?> at <?php the_time() ?>, by <?php the_author_posts_link() ?></p>
      <div class="post-excerpt">
        <?php the_excerpt(); /* the excerpt is loaded to help avoid duplicate content issues */ ?>
      </div>
      
      <div class="post-meta">
        <p>
          <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
          <br />
          Categories: <?php the_category(', ') ?>
          <br />
          <?php if( the_tags( 'Tags: ' , ', ' , ' ' ) ); ?>
        </p>
      </div><!--.postMeta-->
    </div><!--.post-single-->
  <?php endwhile; else: ?>
    <div class="no-results">
      <p><strong>There has been an error.</strong></p>
      <p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
      <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
    </div><!--noResults-->
  <?php endif; ?>
    
  <nav class="oldernewer">
    <div class="older">
      <p>
        <?php next_posts_link( '&laquo; Older Entries' ); ?>
      </p>
    </div><!--.older-->
    <div class="newer">
      <p>
        <?php previous_posts_link( 'Newer Entries &raquo;' ); ?>
      </p>
    </div><!--.older-->
  </nav><!--.oldernewer-->

</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
