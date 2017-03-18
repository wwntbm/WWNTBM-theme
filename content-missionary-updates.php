<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
// get link for the author's missionary page
$author_ID = get_field( 'missionary_author' );
$author_missionary_page_link = '';
foreach ( $author_ID as $author ) {
    $author_missionary_page_link .= '<a href="'.get_permalink( $author ).'" title="'.get_the_title( $author ).'">'.get_the_title( $author ).'</a>, ';
}
$author_missionary_page_link = rtrim( $author_missionary_page_link, ', ' );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?><br/><span class="smaller"><?php echo $author_missionary_page_link; ?></span></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php echo $author_thumbnail; ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		This update was posted on <?php the_time('F j, Y'); ?> by <?php echo $author_missionary_page_link; ?>.
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
