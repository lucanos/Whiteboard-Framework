<?php get_header(); ?>
<div id="content">
  <?php
    $curauth = ( isset( $_GET['author_name'] ) ?
                 get_userdatabylogin( $author_name ) :
                 get_userdata( intval( $author ) ) );
  ?>
  <div class="author">
    <h1>About: <?php echo $curauth->display_name; ?></h1>
    <?php if( function_exists( 'get_avatar' ) ){ /* Displays the Gravatar based on the author's email address. Visit Gravatar.com for info on Gravatars */ ?>
    <p class="avatar"><?php echo get_avatar( $curauth->user_email , $size = '180' );?></p><?php } ?>

    <?php if( $curauth->description !="" ) { /* Displays the author's description from their Wordpress profile */ ?>
    <p><?php echo $curauth->description; ?></p><?php } ?>
  </div><!--.author-->

  <div id="recent-author-posts">
    <h3>Recent Posts by <?php echo $curauth->display_name; ?></h3>
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); /* Displays the most recent posts by that author. Note that this does not display custom content types */
        static $count = 0;
        $posts_to_display = 5;  // Number of posts to display
        if( $count==$posts_to_display )
          break;
      ?>
        <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
        <?php if ( has_post_thumbnail() ) { /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
        <div class="post-excerpt">
          <?php the_excerpt(); /* the excerpt is loaded to avoid duplicate content */ ?>
        </div><!--.postContent-->
        <div class="post-meta">
          <p>
            Written on <?php the_time('F j, Y'); ?> at <?php the_time() ?><br />
            Categories: <?php the_category(', ');?>
            <?php the_tags('<br />Tags: ', ', ', ' '); ?>
          </p>
        </div><!--.postMeta-->
      <?php
        $count++;
    endwhile; else: ?>
        <p>No posts by <?php echo $curauth->display_name; ?> yet.</p>
    <?php endif; ?>
  </div><!--#recentPosts-->

  <div id="recent-author-comments">
    <h3>Recent Comments by <?php echo $curauth->display_name; ?></h3>
      <?php
        $comments_to_display = 5; // number of recent comments to display
        $comments = $wpdb->get_results( "SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_author_email='$curauth->user_email' ORDER BY comment_date_gmt DESC LIMIT $comments_to_display" );
        if( $comments ) : ?>
      <ul>
        <?php foreach( (array) $comments as $comment ) : ?>
        <li class="recentcomments"><?php echo sprintf(__('%1$s on %2$s'), get_comment_date(); ?><a href="<?php echo get_comment_link( $comment->comment_ID ); ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a></li>
        <?php endforeach; ?>
      </ul>
      <?php
        else: ?>
        <p>No comments by <?php echo $curauth->display_name; ?> yet.</p>
      <?php
        endif; ?>
  </div><!--#recentAuthorComments-->
</div><!--#content-->
<?php get_footer(); ?>