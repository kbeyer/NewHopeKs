<?php
/*
Template Name: Archives with Content
*/
?>

<?php get_header(); ?>
<?php
$show_nav = false;
$post_ancestors = ( isset($post->ancestors) ) ? $post->ancestors : get_post_ancestors($post);
$top_page = $post_ancestors ? end($post_ancestors) : $post->ID; //get the top page id
$childrenOfParent = get_pages('child_of='.$top_page->ID);
$childrenOfMe = get_pages('child_of='.$post->ID);
// show nav if this page is parent and has children
if( count( $post_ancestors ) == 0 ){
  $show_nav = ( count($childrenOfMe) == 0 ); 
}else{
  // OR if child page has siblings
  $show_nav = ( count($childrenOfParent) == 0 );
}
?>

<div id="main" role="main" <?php if( $show_nav ) { ?>class="no_children"<?php } ?> >
  <section id="page">
     <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <div class="widget" id="post">
  		<div>
  			<header><h1 id="post-<?php the_ID(); ?>"><?php the_title();?></h1></header>
            <?php the_content(); ?>
            <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

    <?php endwhile; endif; ?>

            <h2>Most Recent Messages</h2>
            <?php 
                $args = array( 'numberposts' => 10, 'post_type' => 'nh_message' );
                $lastposts = get_posts( $args );
                foreach($lastposts as $post) : setup_postdata($post); ?>           
            <article class="audio">
            <p class="meta"><strong>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong><br><a href="#">Todd Stewart</a> | <time pubdate datetime=""><abbr title="August">Aug</abbr> 7, 2011</time></p>
            <div class="audio-player"><?php the_excerpt(); ?></div>
            <?php
                $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
                $attachments = get_posts($args);
                if ($attachments) {
                    foreach ( $attachments as $attachment ) {
                        apply_filters( 'the_title' , $attachment->post_title );?>
                        <p class="slides-link"><?php echo wp_get_attachment_link( $attachment->ID, '' , false, false, 'Download Slides'); ?></p>
                        <?php
                    }
                }
            ?>
            </article>
            <?php endforeach; ?>
            
        </div>
    </div>
    
</section>

   <?php // hide secondary nav if no children
     if( count( $children ) != 0 ) : ?>
     
    <nav class="secondary">

    <?php
    // left sidebar holds page nav
    if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>

    		  <?php dynamic_sidebar( 'primary-widget-area' ); ?>

    <?php endif; ?>

    </nav>
    <?php endif; ?>
    
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>