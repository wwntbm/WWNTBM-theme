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

		<?php if ( 'post' === get_post_type() ) : ?>
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
		echo '<strong>Email</strong>: <a href="mailto:' . esc_attr( $email ) . '">' . esc_attr( $email ) . '</a><br />';
	}

	$phone = get_field( 'phone' );
	if ( $phone ) {
		echo '<strong>Phone</strong>: ';

		if ( preg_match( '/[a-zA-Z]/', $phone ) > 0 ) {
			echo esc_attr( $phone );
		} else {
			echo '<a href="tel:' . esc_attr( $phone ) . '">' . esc_attr( $phone ) . '</a>';
		}

		echo '<br />';
	}

	$website = get_field( 'website' );
	if ( $website ) {
		echo '<strong>Website</strong>: <a href="' . esc_url( $website ) . '">' . esc_url( $website ) . '</a><br />';
	}

	$facebook = get_field( 'facebook' );
	if ( $facebook ) {
		echo '<strong>Ministry Facebook</strong>: <a href="' . esc_url( $facebook ) . '">' . esc_url( $facebook ) . '</a><br />';
	}

	echo '</p>';

	/**
	 * Address fields.
	 */
	if ( get_field( 'address' ) ) {
		echo '<h2>Address</h2><address>';
		the_field( 'address' );
		echo '</address>';
	}

	if ( get_field( 'sending_church' ) ) {
		echo '<h2>Sending Church</h2><address>';
		the_field( 'sending_church' );
		echo '</address>';
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
			$date = get_sub_field( 'birthday' );
			if ( get_sub_field( 'hide_year' ) ) {
				$split = explode( ',', $date );
				$date  = $split[0];
			}
			echo esc_attr( $date );
			echo '</li>';
		}
		echo '</ul>';
	}

	if ( get_field( 'anniversary' ) ) {
		echo '<h2>Anniversary</h2>';
		echo '<p>';
		the_field( 'anniversary' );
		echo '</p>';
	}

	if ( get_field( 'date_joined' ) ) {
		echo '<h2>Date Joined</h2>';
		echo '<p>';
		the_field( 'date_joined' );
		echo '</p>';
	}

	/**
	 * Any other content.
	 */
	the_content();

	/**
	 * Prayer letters.
	 */

	$wwntbm_missionary_key = strtolower( get_field( 'missionary_key' ) );

	$s3_uploads = S3_Uploads::get_instance();
	$s3_client  = $s3_uploads->s3();
	$results    = $s3_client->listObjectsV2(
		array(
			'Bucket' => $s3_uploads->get_s3_bucket(),
			'Prefix' => 'uploads/prayer-letters/' . $wwntbm_missionary_key . '/2',
		)
	);

	$folder_list = array_filter(
		$results->get( 'Contents' ),
		function( $prayer_letter ) {
			return false !== strpos( $prayer_letter['Key'], '.bzEmpty' );
		}
	);

	$folder_list = array_map(
		function( $folder ) {
			return $folder['Key'];
		},
		$folder_list
	);
	natcasesort( $folder_list );
	$folder_list = array_reverse( $folder_list );

	if ( ( ! is_null( $folder_list ) ) && ( ! is_null( $wwntbm_missionary_key ) ) ) {
		echo '<div class="prayer_letters">
			<h2>Prayer Letters:</h2>
			<ul class="dropdown">';

		// Process folders.
		foreach ( $folder_list as $group_folder ) {
			$group_folder = str_ireplace( '.bzEmpty', '', $group_folder );

			// Skip hidden folders.
			if ( strpos( basename( $group_folder ), 'site' ) !== false ) {
				continue;
			} elseif ( strpos( basename( $group_folder ), 'post' ) !== false ) {
				continue;
			}

			echo '<li class="dropdown_trigger';
			// Open group if it is this year's.
			if ( basename( $group_folder ) === gmdate( 'Y' ) ) {
				echo ' active';
			}
			echo '">' . esc_attr( strtolower( basename( $group_folder ) ) ) . '
				<ul class="sub_links" style="display:';
			if ( basename( $group_folder ) === gmdate( 'Y' ) ) {
				echo 'block';
			} else {
				echo 'none';
			}
			echo ';">' . "\n";

			// Get and sort files.
			$files     = $s3_client->listObjectsV2(
				array(
					'Bucket' => $s3_uploads->get_s3_bucket(),
					'Prefix' => $group_folder,
				)
			);
			$file_list = array_filter(
				$files->get( 'Contents' ),
				function( $prayer_letter ) {
					return false !== strpos( $prayer_letter['Key'], '.pdf' );
				}
			);
			$file_list = array_map(
				function( $file ) {
					return $file['Key'];
				},
				$file_list
			);
			natcasesort( $file_list );
			$file_list = array_reverse( $file_list );

			// Display files.
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
