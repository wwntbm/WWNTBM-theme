<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	</div><!-- #main -->

	<footer id="colophon" class="rounded-bottom" role="contentinfo">

			<?php
				/*
				 A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				&copy;2006&ndash;<?php echo date( 'Y' ); ?> | <?php the_privacy_policy_link(); ?> | designed and developed by <a target="_blank" href="https://andrewrminion.com">AndrewRMinion Design</a> and April Howell | powered by <a target="_blank" href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Wordpress</a> | <span class="light-weight"><?php wp_loginout(); ?></span>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
