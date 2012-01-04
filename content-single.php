<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php twentyeleven_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php 
	//   photo
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	  the_post_thumbnail('medium', array('class' => 'alignright'));
	} 
	?>
	<?php
		//   field
		$wwntbm_field = get_post_meta(get_the_ID(), 'Field', true);
		if ($wwntbm_field != NULL) {echo '<h2 class="field-of-service">'.$wwntbm_field.'</h2>'."\n";}
		
		//   ministry type
		$wwntbm_ministry_type = get_post_meta(get_the_ID(), 'Ministry Type', true);
		if ($wwntbm_ministry_type != NULL) {echo '<h2 class="ministry-type">'.$wwntbm_ministry_type.'</h2>'."\n";}
		
		//   title
		$wwntbm_job_title = get_post_meta(get_the_ID(), 'Title', true);
		if ($wwntbm_job_title != NULL) {echo '<h2 class="job-title">'.$wwntbm_job_title.'</h2>'."\n";}
	?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
