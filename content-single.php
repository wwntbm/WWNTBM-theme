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
		
		<div class="prayer-letters">
		<h2>Prayer Letters:</h2>
		<?php
			//   get slug of current page
			$slug = basename(get_permalink());
			
			//   get lastname-firstname construct
			$name_array = explode('-',$slug);
			$missionary_name_key = array_pop($name_array).'-'.ucwords($name_array[0]);
			$missionary_name_key = ucwords($missionary_name_key);
			
			//   get list of prayer letters
			$location = 'wp-content/uploads/Prayer-letters/'.$missionary_name_key.'/';
			
			//   get and sort folders
			$folder_list = glob($location.'*',GLOB_ONLYDIR);
			natcasesort($folder_list);
			$folder_list = array_reverse($folder_list);
			
			echo '<ul class="dropdown">';

			//   process folders
			foreach ($folder_list as $group_folder) {
				echo '<li><a class="dropdown_trigger';
				//   open group if it is this year's
				if (basename($group_folder) == date('Y')) {echo ' active';}
				echo '"><span class="trigger_pointer_arrow"></span>'.ucwords(strtolower(basename($group_folder))).'</a>
				<ul class="sub_links" style="display:';
				if (basename($group_folder) == date('Y')) {echo 'block';}
				else {echo 'none';}
				echo ';">'."\n";
				
				//   get and sort files
				$file_list = glob($location.basename($group_folder).'/*.pdf',GLOB_BRACE);
				natcasesort($file_list);
				$file_list = array_reverse($file_list);
				
				//   display files
				foreach ($file_list as $file) {
					missionary_prayer_letters($file,$missionary_name_key);
				}
				echo '</ul><!-- .sub_links -->
				</li>'."\n";
			}
			
			echo '</ul><!-- .dropdown -->';
			
		?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
