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
		/**
		 * Photo.
		 */
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail( 'medium', array( 'class' => 'alignright rounded shadowed' ) );
		}

		/**
		 * Field.
		 */
		$wwntbm_field        = get_field( 'missionary_field' );
		$wwntbm_field_region = get_field( 'missionary_field_region' );

		if ( ! empty( $wwntbm_field ) ) {
			echo '<h2 class="field-of-service">Field of Service</h2><p>' . esc_attr( $wwntbm_field );
			if ( ! empty( $wwntbm_field_region ) ) {
				echo '<span class="field-region"> &mdash; ' . esc_attr( $wwntbm_field_region ) . '</span>';
			}
			echo '</p>';
		}

		// Ministry type.
		the_terms( $post->ID, 'wwntbm_ministries', '<h2 class="ministry-type">Ministry Type</h2><p>', ', ', '</p>' );

		// Missionary status.
		the_terms( $post->ID, 'wwntbm_status', '<h2 class="missionary-status">Missionary Status: ', ', ', '</h2>' );

		/**
		 * Contact fields.
		 */
		echo '<p class="contact">';

		$email = sanitize_email( get_field( 'email' ) );
		if ( $email ) {
			echo '<strong>Email: <a href="mailto:' . $email . '">' . $email . '</a><br />';
		}

		$phone = get_field( 'phone' );
		if ( $phone ) {
			echo '<strong>Phone: <a href="tel:' . $phone . '">' . $phone . '</a><br />';
		}

		$website = get_field( 'website' );
		if ( $website ) {
			echo '<strong>website: <a href="' . esc_url( $website ) . '">' . $website . '</a><br />';
		}

		echo '</p>';

		/**
		 * Address fields.
		 */

		if ( get_field( 'address' ) ) {
			echo '<h2>Address</h2>';
			the_field( 'address' );
		}

		if ( get_field( 'sending_church' ) ) {
			echo '<h2>Sending Church</h2>';
			the_field( 'sending_church' );
		}

		/**
		 * Significant dates.
		 */
		if ( have_rows( 'birthdays' ) ) {
			echo '<h2>Birthdays</h2><ul>';
			while ( have_rows( 'birthdays' ) ) {
				the_row();
				echo '<li>';
				the_sub_field( 'name' );
				echo ': ';
				$date = get_field( 'birthday' );
				if ( get_sub_field( 'hide_year' ) ) {
					$split = explode( ',', $date );
					$date = $split[0];
				}
				echo esc_attr( $date );
				echo '</li>';
			}
			echo '</ul>';
		}

		if ( get_field( 'anniversary' ) ) {
			echo '<h2>Anniversary</h2>';
			the_field( 'anniversary' );
		}

		if ( get_field( 'date_joined' ) ) {
			echo '<h2>Date Joined</h2>';
			the_field( 'date_joined' );
		}

		/**
		 * Any other content.
		 */
		the_content();


		/**
		 * Prayer letters.
		 */

		// get missionary unique key
		$wwntbm_missionary_key = strtolower( get_field( 'missionary_key' ) );

		// get list of prayer letters
		if ( isset( $wwntbm_missionary_key ) ) {
			$location = 'wp-content/uploads/prayer-letters/' . $wwntbm_missionary_key . '/';
		}

		// get and sort folders
		$folder_list = glob( $location . '*', GLOB_ONLYDIR );
		natcasesort( $folder_list );
		$folder_list = array_reverse( $folder_list );

		if ( ( $folder_list != null ) and ( $wwntbm_missionary_key != null ) ) {
			echo '<div class="prayer_letters">
			<h2>Prayer Letters:</h2>
			<ul class="dropdown">';

			// process folders
			foreach ( $folder_list as $group_folder ) {
				// skip hidden folders
				if ( strpos( basename( $group_folder ), 'site' ) !== false ) {
					continue;
				} elseif ( strpos( basename( $group_folder ), 'post' ) !== false ) {
					continue;
				}

				echo '<li class="dropdown_trigger';
				// open group if it is this year's
				if ( basename( $group_folder ) == date( 'Y' ) ) {
						echo ' active';}
				echo '">' . strtolower( basename( $group_folder ) ) . '
				<ul class="sub_links" style="display:';
				if ( basename( $group_folder ) == date( 'Y' ) ) {
						echo 'block';
				} else {
					echo 'none';
				}
				echo ';">' . "\n";

				// get and sort files
				$file_list = glob( $location . basename( $group_folder ) . '/*.pdf', GLOB_BRACE );
				natcasesort( $file_list );
				$file_list = array_reverse( $file_list );

				// display files
				foreach ( $file_list as $file ) {
						missionary_prayer_letters( $file, $wwntbm_missionary_key );
				}
				echo '</ul><!-- .sub_links -->
				</li>' . "\n";
			}

			echo '</ul><!-- .dropdown -->
			</div><!-- .prayer_letters -->';
		}
		?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
