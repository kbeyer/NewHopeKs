<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article>
	<header>
	<?php if ( is_front_page() ) { ?>
		<h2><?php the_title(); ?></h2>
	<?php } else { ?>	
		<h1><?php the_title(); ?></h1>
	<?php } ?>	
	</header>			

	<?php the_content(); ?>
	
	<footer>
		<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</footer>
</article>
<?php comments_template( '', true ); ?>
	


<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>