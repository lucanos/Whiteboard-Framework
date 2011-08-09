<?php get_header(); ?>

<div id="content">
  <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
      <article>
        <h1><?php the_title(); ?></h1>
        <?php edit_post_link('<small>Edit this entry</small>','',''); ?>
        <?php if( has_post_thumbnail() ){ /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ ?>
        <div class="featured-thumbnail"><?php the_post_thumbnail(); ?></div><?php } ?>
  
        <div class="post-content page-content">
          <?php the_content(); ?>
          <?php wp_link_pages( 'before=<div class="pagination">&after=</div>' ); ?>
        </div><!--.post-content .page-content -->
      </article>

      <div id="page-meta">
        <h3>Written by <?php the_author_posts_link() ?></h3>
        <?php if(function_exists('get_avatar')) { ?>
        <p class="gravatar"><?php echo get_avatar( get_the_author_email() , '80' ); ?></p><?php } ?>
        <p>Posted on <?php the_time( 'F j, Y' ); ?> at <?php the_time() ?></p>
      </div><!--#pageMeta-->
    </div><!--#post-# .post-->

    <?php comments_template( '' , true ); ?>

  <?php endwhile;endif; ?>
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
