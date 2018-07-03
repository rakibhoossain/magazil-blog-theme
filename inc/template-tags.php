<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package magazil
 */

if ( ! function_exists( 'magazil_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function magazil_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'magazil' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'magazil_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function magazil_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'magazil' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'magazil_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function magazil_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'magazil' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'magazil' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'magazil' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'magazil' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

	}
endif;

if ( ! function_exists( 'magazil_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function magazil_entry_meta($extra_class = '', $edit_link = true) {
		// Hide category and tag text for pages.
?>
<ul class="meta <?php echo esc_attr( $extra_class ); ?>">
	<li>
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
			<span class="lnr lnr-user"></span><?php echo esc_html( get_the_author() )?>
		</a>
	</li>
	<li>
		<a href="<?php the_permalink(); ?>">
			<span class="lnr lnr-calendar-full"></span>
			<?php printf('%s', esc_html( get_the_date() )); ?>
		</a>
	</li>

	<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ): ?>
	<li>
		<?php comments_popup_link( __( '<span class="lnr lnr-bubble"></span>Leave a comment', 'magazil' ), __( '<span class="lnr lnr-bubble"></span>1 Comment', 'magazil' ), __( '<span class="lnr lnr-bubble"></span>% Comments', 'magazil' ) ); ?>

	</li>
<?php endif; ?>

<?php
if ($edit_link){

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'magazil' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<li class="edit-link">',
			'</li>'
		);
}
?>
</ul>

<?php
}
endif;

if ( ! function_exists( 'magazil_post_categories' ) ) :
	/**
	 * Displays categories.
	 */
	function magazil_post_categories($multiple = false) {
		if ( 'post' === get_post_type() ) {
			if ($multiple) {
				echo get_the_category_list();
			}else{
				$category = get_the_category( get_the_ID() );
				if ( $category && !is_wp_error( $category ) ) :
					echo '<ul class="post-categories">';
					echo '<li><a href="'.get_category_link($category[0]->cat_ID).'">' . $category[0]->cat_name . '</a></li>';
					echo '</ul>';
				endif;
			}
		}
	}
endif;

if ( ! function_exists( 'magazil_post_tags' ) ) :
	/**
	 * Displays categories.
	 */
	function magazil_post_tags() {
		if ( 'post' === get_post_type() ) {
						/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'magazil' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'magazil' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;


if ( ! function_exists( 'magazil_before_post' ) ) :
	/**
	 * Displays categories.
	 */
	function magazil_before_post() {
	?>

			<!-- Start top-post Area -->
			<section class="top-post-area pt-10">
				<div class="container no-padding">
					<div class="row">
						<div class="col-lg-12">
							<div class="hero-nav-area relative">
							<?php
							if (has_header_image()) {
								echo '<div class="header-bg" style="background-image: url(\''.esc_url( get_header_image() ).'\')"></div>';
							}
							?>
							

							 <?php // if(true) { echo ' has-bg relative" style="background-image: url(\''..'\')"'; } >?>

								<div class="header-title relative">
								<?php if (is_archive()) {
									the_archive_title( '<h1 class="page-title text-white">', '</h1>' );
									the_archive_description( '<div class="archive-description">', '</div>' );
								}else{
									echo '<h1 class="page-title text-white">';
									single_post_title();
									echo '</h1>';
								}
								//magazil_breadcrumbs();
								?>
								</div>

							<?php magazil_breadcrumbs(); ?>
							</div>
						</div>
						<div class="col-lg-12">
							<?php get_template_part( 'inc/components/breaking-news' ); // Get Breaking News template ?>
						</div>
					</div>
				</div>
			</section>
			<!-- End top-post Area -->
	<?php
	}
endif;

if ( ! function_exists( 'magazil_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function magazil_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;
