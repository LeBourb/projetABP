<?php
/**
 * Storefront template functions.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_display_comments' ) ) {
	/**
	 * Storefront display comments
	 *
	 * @since  1.0.0
	 */
	function storefront_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
	}
}

if ( ! function_exists( 'storefront_comment' ) ) {
	/**
	 * Storefront comment template
	 *
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int   $depth the comment depth.
	 * @since 1.0.0
	 */
	function storefront_comment( $comment, $args, $depth ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-body">
		<div class="comment-meta commentmetadata">
			<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 128 ); ?>
			<?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'storefront' ), get_comment_author_link() ); ?>
			</div>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'storefront' ); ?></em>
				<br />
			<?php endif; ?>

			<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
				<?php echo '<time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
			</a>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-content">
		<?php endif; ?>
		<div class="comment-text">
		<?php comment_text(); ?>
		</div>
		<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		<?php edit_comment_link( __( 'Edit', 'storefront' ), '  ', '' ); ?>
		</div>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php
	}
}

if ( ! function_exists( 'storefront_footer_widgets' ) ) {
	/**
	 * Display the footer widget regions.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_footer_widgets() {
		$rows    = intval( apply_filters( 'storefront_footer_widget_rows', 1 ) );
		$regions = intval( apply_filters( 'storefront_footer_widget_columns', 4 ) );

		for ( $row = 1; $row <= $rows; $row++ ) :

			// Defines the number of active columns in this footer row.
			for ( $region = $regions; 0 < $region; $region-- ) {
				if ( is_active_sidebar( 'footer-' . strval( $region + $regions * ( $row - 1 ) ) ) ) {
					$columns = $region;
					break;
				}
			}

			if ( isset( $columns ) ) : ?>
				<div class=<?php echo '"footer-widgets row-' . strval( $row ) . ' col-' . strval( $columns ) . ' fix"'; ?>><?php

					for ( $column = 1; $column <= $columns; $column++ ) :
						$footer_n = $column + $regions * ( $row - 1 );

						if ( is_active_sidebar( 'footer-' . strval( $footer_n ) ) ) : ?>

							<div class="block footer-widget-<?php echo strval( $column ); ?>">
								<?php dynamic_sidebar( 'footer-' . strval( $footer_n ) ); ?>
							</div><?php

						endif;
					endfor; ?>

				</div><!-- .footer-widgets.row-<?php echo strval( $row ); ?> --><?php

				unset( $columns );
			endif;
		endfor;
	}
}

if ( ! function_exists( 'storefront_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
			<br /> <?php printf( esc_attr__( '%1$s designed by %2$s.', 'storefront' ), 'Storefront', '<a href="http://www.woocommerce.com" title="WooCommerce - The Best eCommerce Platform for WordPress" rel="author">WooCommerce</a>' ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'storefront_header_widget_region' ) ) {
	/**
	 * Display header widget region
	 *
	 * @since  1.0.0
	 */
	function storefront_header_widget_region() {
		if ( is_active_sidebar( 'header-1' ) ) {
		?>
		<div class="header-widget-region" role="complementary">
			<div class="col-full">
				<?php dynamic_sidebar( 'header-1' ); ?>
			</div>
		</div>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_site_branding() {
		?>
		<div class="site-branding">
			<?php storefront_site_title_or_logo(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'storefront_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since 2.1.0
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function storefront_site_title_or_logo( $echo = true ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$logo = get_custom_logo();
			$html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			// Copied from jetpack_the_site_logo() function.
			$logo    = site_logo()->logo;
			$logo_id = get_theme_mod( 'custom_logo' ); // Check for WP 4.5 Site Logo
			$logo_id = $logo_id ? $logo_id : $logo['id']; // Use WP Core logo if present, otherwise use Jetpack's.
			$size    = site_logo()->theme_size();
			$html    = sprintf( '<a href="%1$s" class="site-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image(
					$logo_id,
					$size,
					false,
					array(
						'class'     => 'site-logo attachment-' . $size,
						'data-size' => $size,
						'itemprop'  => 'logo'
					)
				)
			);

			$html = apply_filters( 'jetpack_the_site_logo', $html, $logo, $size );
		} else {
			$tag = is_home() ? 'h1' : 'div';

			$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) .'>';

			if ( '' !== get_bloginfo( 'description' ) ) {
				$html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
			}
		}

		if ( ! $echo ) {
			return $html;
		}

		echo $html;
	}
}

if ( ! function_exists( 'storefront_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
					)
			);

			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
					)
			);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'storefront_secondary_navigation' ) ) {
	/**
	 * Display Secondary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_secondary_navigation() {
	    if ( has_nav_menu( 'secondary' ) ) {
		    ?>
		    <nav class="secondary-navigation" role="navigation" aria-label="<?php esc_html_e( 'Secondary Navigation', 'storefront' ); ?>">
			    <?php
				    wp_nav_menu(
					    array(
						    'theme_location'	=> 'secondary',
						    'fallback_cb'		=> '',
					    )
				    );
			    ?>
		    </nav><!-- #site-navigation -->
		    <?php
		}
	}
}

if ( ! function_exists( 'storefront_skip_links' ) ) {
	/**
	 * Skip links
	 *
	 * @since  1.4.1
	 * @return void
	 */
	function storefront_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_attr_e( 'Skip to navigation', 'storefront' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'storefront' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'storefront_homepage_header' ) ) {
	/**
	 * Display the page header without the featured image
	 *
	 * @since 1.0.0
	 */
	function storefront_homepage_header() {
		edit_post_link( __( 'Edit this section', 'storefront' ), '', '', '', 'button storefront-hero__button-edit' );
		?>
		<header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'storefront_page_header' ) ) {
	/**
	 * Display the page header
	 *
	 * @since 1.0.0
	 */
	function storefront_page_header() {
		?>
		<header class="entry-header">
			<?php
			storefront_post_thumbnail( 'full' );
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'storefront_page_content' ) ) {
	/**
	 * Display the post content
	 *
	 * @since 1.0.0
	 */
	function storefront_page_content() {
		?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'storefront_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function storefront_post_header() {
		?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			storefront_posted_on();
			the_title( '<h1 class="entry-title prout">', '</h1>' );
		} else {
			if ( 'post' == get_post_type() ) {
				storefront_posted_on();
			}

			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'storefront_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function storefront_post_content() {
		?>
		<div class="entry-content">
		<?php

		/**
		 * Functions hooked in to storefront_post_content_before action.
		 *
		 * @hooked storefront_post_thumbnail - 10
		 */
		do_action( 'storefront_post_content_before' );

		the_content(
			sprintf(
				__( 'Continue reading %s', 'storefront' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		do_action( 'storefront_post_content_after' );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
			'after'  => '</div>',
		) );
		?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'storefront_post_meta' ) ) {
	/**
	 * Display the post meta
	 *
	 * @since 1.0.0
	 */
	function storefront_post_meta() {
		?>
		<aside class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search.

			?>
			<div class="author">
				<?php
					echo get_avatar( get_the_author_meta( 'ID' ), 128 );
					echo '<div class="label">' . esc_attr( __( 'Written by', 'storefront' ) ) . '</div>';
					the_author_posts_link();
				?>
			</div>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'storefront' ) );

			if ( $categories_list ) : ?>
				<div class="cat-links">
					<?php
					echo '<div class="label">' . esc_attr( __( 'Posted in', 'storefront' ) ) . '</div>';
					echo wp_kses_post( $categories_list );
					?>
				</div>
			<?php endif; // End if categories. ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'storefront' ) );

			if ( $tags_list ) : ?>
				<div class="tags-links">
					<?php
					echo '<div class="label">' . esc_attr( __( 'Tagged', 'storefront' ) ) . '</div>';
					echo wp_kses_post( $tags_list );
					?>
				</div>
			<?php endif; // End if $tags_list. ?>

		<?php endif; // End if 'post' == get_post_type(). ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<div class="comments-link">
					<?php echo '<div class="label">' . esc_attr( __( 'Comments', 'storefront' ) ) . '</div>'; ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'storefront' ), __( '1 Comment', 'storefront' ), __( '% Comments', 'storefront' ) ); ?></span>
				</div>
			<?php endif; ?>
		</aside>
		<?php
	}
}

if ( ! function_exists( 'storefront_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function storefront_paging_nav() {
		global $wp_query;

		$args = array(
			'type' 	    => 'list',
			'next_text' => _x( 'Next', 'Next post', 'storefront' ),
			'prev_text' => _x( 'Previous', 'Previous post', 'storefront' ),
			);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'storefront_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function storefront_post_nav() {
		$args = array(
			'next_text' => '%title',
			'prev_text' => '%title',
			);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'storefront_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function storefront_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( 'Posted on %s', 'post date', 'storefront' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo wp_kses( apply_filters( 'storefront_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
			'span' => array(
				'class'  => array(),
			),
			'a'    => array(
				'href'  => array(),
				'title' => array(),
				'rel'   => array(),
			),
			'time' => array(
				'datetime' => array(),
				'class'    => array(),
			),
		) );
	}
}

if ( ! function_exists( 'storefront_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_product_categories( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_product_categories_args', array(
				'limit' 			=> 3,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				'title'				=> __( 'Shop by Category', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'product_categories', apply_filters( 'storefront_product_categories_shortcode_args', array(
				'number'  => intval( $args['limit'] ),
				'columns' => intval( $args['columns'] ),
				'orderby' => esc_attr( $args['orderby'] ),
				'parent'  => esc_attr( $args['child_categories'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns product categories
			 */
			if ( false !== strpos( $shortcode_content, 'product-category' ) ) {

				echo '<section class="storefront-product-section storefront-product-categories" aria-label="' . esc_attr__( 'Product Categories', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_product_categories' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_product_categories_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_product_categories' );

				echo '</section>';

			}
		}
	}
}

if ( ! function_exists( 'storefront_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_recent_products( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_recent_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'New In', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'recent_products', apply_filters( 'storefront_recent_products_shortcode_args', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-recent-products" aria-label="' . esc_attr__( 'Recent Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_recent_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_recent_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_recent_products' );

				echo '</section>';

			}
		}
	}
}

if ( ! function_exists( 'storefront_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_featured_products( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_featured_products_args', array(
				'limit'   => 4,
				'columns' => 4,
				'orderby' => 'date',
				'order'   => 'desc',
				'title'   => __( 'We Recommend', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'featured_products', apply_filters( 'storefront_featured_products_shortcode_args', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
				'orderby'  => esc_attr( $args['orderby'] ),
				'order'    => esc_attr( $args['order'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-featured-products" aria-label="' . esc_attr__( 'Featured Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_featured_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_featured_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_featured_products' );

				echo '</section>';

			}
		}
	}
}

if ( ! function_exists( 'storefront_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_popular_products( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_popular_products_args', array(
				'limit'   => 4,
				'columns' => 4,
				'title'   => __( 'Fan Favorites', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'top_rated_products', apply_filters( 'storefront_popular_products_shortcode_args', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-popular-products" aria-label="' . esc_attr__( 'Popular Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_popular_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_popular_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_popular_products' );

				echo '</section>';

			}
		}
	}
}

if ( ! function_exists( 'storefront_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @param array $args the product section args.
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_on_sale_products( $args ) {

		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_on_sale_products_args', array(
				'limit'   => 4,
				'columns' => 4,
				'title'   => __( 'On Sale', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'sale_products', apply_filters( 'storefront_on_sale_products_shortcode_args', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-on-sale-products" aria-label="' . esc_attr__( 'On Sale Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_on_sale_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_on_sale_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_on_sale_products' );

				echo '</section>';

			}
		}
	}
}

if ( ! function_exists( 'storefront_best_selling_products' ) ) {
	/**
	 * Display Best Selling Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since 2.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function storefront_best_selling_products( $args ) {
		if ( storefront_is_woocommerce_activated() ) {

			$args = apply_filters( 'storefront_best_selling_products_args', array(
				'limit'   => 4,
				'columns' => 4,
				'title'	  => esc_attr__( 'Best Sellers', 'storefront' ),
			) );

			$shortcode_content = storefront_do_shortcode( 'best_selling_products', apply_filters( 'storefront_best_selling_products_shortcode_args', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			) ) );

			/**
			 * Only display the section if the shortcode returns products
			 */
			if ( false !== strpos( $shortcode_content, 'product' ) ) {

				echo '<section class="storefront-product-section storefront-best-selling-products" aria-label="' . esc_attr__( 'Best Selling Products', 'storefront' ) . '">';

				do_action( 'storefront_homepage_before_best_selling_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				do_action( 'storefront_homepage_after_best_selling_products_title' );

				echo $shortcode_content;

				do_action( 'storefront_homepage_after_best_selling_products' );

				echo '</section>';

			}
		}
	}
}

if ( ! function_exists( 'storefront_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	function storefront_homepage_content() {
		while ( have_posts() ) {
			the_post();

			get_template_part( 'content', 'homepage' );

		} // end of the loop.
	}
}

if ( ! function_exists( 'storefront_social_icons' ) ) {
	/**
	 * Display social icons
	 * If the subscribe and connect plugin is active, display the icons.
	 *
	 * @link http://wordpress.org/plugins/subscribe-and-connect/
	 * @since 1.0.0
	 */
	function storefront_social_icons() {
		if ( class_exists( 'Subscribe_And_Connect' ) ) {
			echo '<div class="subscribe-and-connect-connect">';
			subscribe_and_connect_connect();
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'storefront_get_sidebar' ) ) {
	/**
	 * Display storefront sidebar
	 *
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function storefront_get_sidebar() {
		get_sidebar();
	}
}

if ( ! function_exists( 'storefront_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @param string $size the post thumbnail size.
	 * @since 1.5.0
	 */
	function storefront_post_thumbnail( $size = 'full' ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $size );
		}
	}
}

if ( ! function_exists( 'storefront_primary_navigation_wrapper' ) ) {
	/**
	 * The primary navigation wrapper
	 */
	function storefront_primary_navigation_wrapper() {
		echo '<div class="storefront-primary-navigation">';
	}
}

if ( ! function_exists( 'storefront_primary_navigation_wrapper_close' ) ) {
	/**
	 * The primary navigation wrapper close
	 */
	function storefront_primary_navigation_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'atelierbourgeons_html_email_template_header' ) ) {
    function atelierbourgeons_html_email_template_header($title) {
        return '<html style=""><head><meta name="viewport" content="width=device-width, initial-scale=1">
            <head/>
            <body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important">
  <tbody><tr>
    <td align="center" valign="top" width="100%" style="background: linear-gradient(-180deg,#e3bab3 0%,#e9dccd 100%) 0% 0%/cover; padding:35px 15px 0;" class="m_4412137695263643084mobile-padding">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
        <tbody><tr>
          <td align="center" valign="top" style="padding:30px 0">
                      <svg viewBox="0 0 650 177" height="177px" width="650px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" xml:space="preserve" style="fill:white;width:100%;">
<path xmlns="http://www.w3.org/2000/svg" d="M51.784,91.232c-0.36,0.476-0.93,0.822-1.211,1.421c-2.574,5.473-24.436,6.668-27.839,0.563    c-0.393-0.701-1.188,0.996-1.68,1.564c-0.498,0.563-1.103,0.991-1.815,1.274c-0.182,0.287-0.564,0.59-1.146,0.922    s-6.174,4.451-8.812,0.926c-0.646-0.868-0.806-2.036-0.806-3.264c0-16.711,15.693-14.813,16.146-13.768    c0.171,0.096,0.44,0.141,0.799,0.141c0.633,0,1.214-0.234,1.748-0.709c0.54-0.477,1.031-0.711,1.479-0.711    c0.452,0,0.86,0.383,1.216,1.139c-0.268,0.756-0.626,1.396-1.078,1.914c-0.446,0.519-0.67,1.301-0.67,2.34    c0,0.757,5.772,15.197,21.518,6.035c0.761-0.444,1.521-0.83,2.152-1.492c0.363,0,0.537,0.144,0.537,0.425    C52.322,90.329,52.148,90.758,51.784,91.232z M17.351,82.433c-0.356,0-5.575,9.443-2.554,12.631    c0.062,0.064,0.188,0.007,0.268,0.068c2.665,2.076,5.881-6.406,6.058-6.736C22.388,85.993,17.805,82.433,17.351,82.433z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M105.102,82.577c-0.399,0.188-0.688,0.516-0.868,0.996c-1.524,0.942-3.029,1.911-4.51,2.903    c-1.48,0.998-3.024,1.875-4.644,2.629c-0.354,0-0.711,0.281-1.068,0.849c-0.633,0.192-1.191,0.475-1.683,0.854    c-0.496,0.375-1.012,0.705-1.55,0.992c-1.968,1.135-3.988,2.244-6.051,3.332c-2.064,1.09-4.146,2.088-6.252,2.984    c-2.109,0.897-4.284,1.631-6.525,2.196c-2.238,0.57-4.484,0.854-6.724,0.854c-4.345,0-10.146-2.068-12.907-5.965    c-0.19-0.273-2.167-7.162-2.023-11.351c0.018-0.567-0.144-5.875,0.68-6.248c-0.232,0.107-2.696-0.221-2.696-0.987    c0-1.132,1.588-1.908,2.825-2.275c0.901-0.262,0.673-3.734,0.673-4.109c0-0.475-0.234-4.438,1.479-5.819    c0.2-0.164,0.384-0.287,0.605-0.287c0.229,0,0.431-0.047,0.609-0.142c0.177-0.094,0.353-0.211,0.528-0.352    c0.183-0.145,0.408-0.213,0.679-0.213c0.451,0,2.639,1.943,1.884,3.973c-0.269,0.726-1.075,5.349-1.075,6.104v0.992    c1.968,0.192,3.878,0.252,5.714,0.424c4.279,0.414,14.082,0.248,17.418-0.424l5.786-0.853c0.355,0,0.534,0.142,0.534,0.424    c0,0.281-0.358,0.57-1.077,0.853c-7.477,2.975-24.971,2.834-26.628,2.834h-1.883c-0.176,0.385-0.227,1.184-0.469,2.35    c-0.646,3.084,0.883,8.381,1.004,9.152c0.507,3.19,4.194,6.668,6.125,7.236c1.922,0.567,3.923,0.942,5.981,0.854    c6.721-0.295,13.807-3.551,16.679-4.971c2.869-1.42,5.623-2.937,8.272-4.541c2.641-1.609,5.042-3.123,7.192-4.543    c0.534,0,1.012-0.236,1.41-0.709c0.403-0.476,0.919-0.707,1.551-0.707h0.401c0.18-0.381,0.355-0.572,0.532-0.572    c0.186,0.094,0.316,0.141,0.408,0.141c0.091,0.101,0.226,0.142,0.405,0.142C105.754,82.058,105.51,82.386,105.102,82.577z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M120.634,93.217c-2.239,0.949-4.482,2.063-6.729,3.336c-2.235,1.279-4.582,1.939-6.988,2.346    c-3.581,0.603-11.864-0.116-15.2-2.627c-2.016-1.516-1.524-6.221-1.615-6.317c0.309-1.457,1.602-5.904,2.964-7.806    c0.968-1.348,4.673-5.813,9.282-5.813c0.067,0,0.143,0,0.217,0.002c0.635,0.021,1.205,0.139,1.73,0.35    c0.579,0.234,2.084,3.617,2.084,4.187c0,0.664-0.401,1.44-1.213,2.338c-0.802,0.904-1.747,1.775-2.818,2.627    c-1.075,0.855-2.159,1.613-3.229,2.271c-1.081,0.663-1.883,1.045-2.426,1.139c-0.177,0.186-0.265,0.424-0.265,0.705    c0,0.854,2.325,3.836,3.229,4.399c0.888,0.564,1.784,1.127,2.751,1.42c5.715,1.707,14.509-1.971,15.265-2.696    c0.812-0.771,4.142-3.181,5.789-2.695C124.259,90.616,121.079,92.652,120.634,93.217z M99.918,80.446    c-0.711,0.381-1.345,1.043-1.883,1.987c-0.534,0.945-0.802,3.404-0.802,3.404s2.663-2.029,3.153-2.406    C100.887,83.05,100.099,80.544,99.918,80.446z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M160.374,93.217c-1.299,0.949-8.316,5.178-14.126,6.389c-7.199,1.504-18.285,2.238-22.592-4.112    c-0.306-0.449-2.53-4.59-2.892-5.25c0.18-0.384-0.835-7.949,0-12.351c1.042-5.487-0.003-13.864,1.348-19.018    c0,0-0.245-6.306,2.353-7.521c0.729-0.342,1.098-0.994,1.816-0.994c0.179,0.289,1.479,1.47,1.479,1.847    c0,0.381-0.32,4.24-0.67,6.104c-1.506,7.916-2.104,21.566-1.078,27.392c0.063,0.371-0.083,8.432,9.751,10.993    c3.504,0.916,19.716-1.598,22.462-4.254c0.613-0.594,3.454-2.721,4.035-3.19c0.582-0.476,1.544-0.617,1.544-0.428    C163.804,88.821,161.679,92.271,160.374,93.217z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M287.452,81.87c1.479-20.783,4.104-34.035,4.236-35.979c0.32-4.735-0.945-6.033-0.945-6.033    c0-1.133-0.398-6.381-0.667-7.518l1.612-2.555c0.447-0.283,2.418-1.416,2.961-1.416c0.979,0,1.591,0.444,1.812,1.348    c0.227,0.896,0.336,1.771,0.336,2.623c0,0,0.63-0.33,0.538-0.424c0.628-0.854,1.48-4.826,2.021-5.676    c0-0.759,3.735-9.896,6.586-13.06c4.605-5.111,16.455-9.287,19.906-1.277c3.946,9.148,2.737,22.699-0.791,32.935    c-1.298,3.766-6.07,12.051-6.07,12.051c0,0.281-1.566,3.031-1.745,3.121c0.537-0.09,2.557-0.428,3.093-0.422    c4.369,0.031,13.99,4.674,14.604,5.361c10.057,11.293,12.402,24.096,5.434,35.936c-0.955,1.625-2.141,3.104-3.494,4.469    c-6.477,6.529-19.098,6.439-25.014,4.472c-1.354-0.449-2.712-1.043-4.106-1.703c-1.385-0.66-2.642-1.535-3.764-2.627    c-1.119-1.086-1.822-2.533-1.679-4.326c0.513-6.4,1.891-10.601,5.276-13.459c0.396-0.338,2.895,0.473,1.72,4.233    c-0.038,0.132-2.479,9.728,5.975,11.822c0.675,0.17,12.065,4.939,18.594-1.235c12.783-12.091,4.117-28.449-5.272-35.064    c-7.527-5.305-18.804,1.201-19.973,1.201c-0.446,0-1.574,0.617-2.418-0.277c-0.862-0.916,0.044-1.137,0.136-1.424    c0.088-0.287,0.398-0.615,0.938-0.992c0.718-0.471,1.435-1.088,2.153-1.848c0.714-0.754,2.823-2.219,3.093-2.695    c0.266-0.469,2.831-3.082,3.898-5.393c4.522-9.791,6.988-19.996,7.14-24.041c0.168-4.529,0.101-11.605-2.928-16.271    c-2.715-4.174-6.309-3.182-9.88-0.354c-2.099,1.662-4.411,7.479-4.411,7.764c-1.166,2.461-5.615,12.09-6.326,14.736    c-0.18,0.662-1.527,7.188-1.886,9.084c-0.361,1.891-0.629,3.832-0.809,5.817l0.729,14.115c0.088,1.326-1.175,30.209-1.266,30.867    c0,0,0.141,14.232-1.615,17.887c-3.504,7.312-7.82-5.682-7.935-6.248C285.745,101.81,285.895,96.519,287.452,81.87     M294.241,69.804c0,0-0.27-2.035-0.27-2.412v0.709c0,0-0.648,1.918-0.604,2.06c0.044,0.139-0.739,6.315-0.739,6.315    c0,0.427-0.684,7.814-1.074,11.205c-0.47,4.058,1.284,18.103,1.611,20.439v0.141C293.254,107.508,294.42,70.751,294.241,69.804z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M182.962,91.943c-1.475,0.945-2.979,1.847-4.501,2.697c-2.333,1.322-4.729,2.506-7.197,3.545    c-2.462,1.045-8.94,1.869-9.208,1.918c-0.271,0.045-5.387-1.006-8.747-3.901c-3.318-2.865-3.605-12.439-3.563-13.769    c0.047-1.324,0.11-2.646,0.069-3.971c-0.072-2.127,6.092-3.453,6.453-3.551c0.357,0.098-0.405,6.575-0.405,8.66    c0,3.5,1.442,6.258,2.829,9.223c3.923,8.373,22.368-2.178,23.534-2.842c0.623-0.377,3.63-2.271,3.63-2.271    C186.222,87.681,184.449,90.999,182.962,91.943z M152.102,60.724c-0.201-0.787,3.049-2.604,3.763-2.699    c0.18,0.189,1.037,0.214,1.213,0.072c0.181-0.141,0.358-0.213,0.535-0.213c0.449,0,3.239,2.373,2.559,3.973    c-0.035,0.086,0.048,0.144,0.136,0.144C160.306,62.472,153.265,65.277,152.102,60.724z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M243.544,82.294c-2.332,0.945-4.75,1.609-7.264,1.984c-2.509,0.381-4.995,0.637-7.394,1.139    c-3.469,0.725-9.191-0.283-9.819-0.283c-0.177,0.189,0.7,3.785,0.741,4.254c0.047,0.473,0.342,7.367-1.553,9.363    c-0.546,0.576-2.775,1.854-3.495,1.854c-0.98,0-1.851-1.012-2.149-3.694c-0.053-0.472,0.815-1.816,0.67-3.974    c-0.276-4.114-1.205-8.967-1.205-9.575c0-0.617-0.224-1.164-0.678-1.632c0.091-0.291,1.773-3.246,4.711-4.26    c0.358-0.125,1.792,3.357,1.88,3.828c0.358-0.283,0.788-0.518,1.279-0.705c0.499-0.188,1.635-0.711,2.084-0.711    c1.081,0,1.497,1.916,3.093,1.988c6.451,0.299,27.752-3.836,28.113-4.123c0.445,0,1.252,0.201,1.071,0.717    C253.07,80.075,244.532,81.919,243.544,82.294z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M383.004,84.277c-0.355,0-1.525,0.191-1.884,0.287c-0.088,0.095-3.629-0.287-3.629-0.287    c-0.536-0.188-2.334,1.134-2.02,1.703c0.918,1.662-0.402,5.941-1.479,7.308c-1.079,1.375-1.629,2.936-2.559,4.053    c-3.752,4.512-9.863,2.836-10.488,2.836c-0.896-0.852-1.325-2.104-2.084-3.338c-2.182-3.563,0.201-8.535,0.201-9.574v-0.428    c0-0.283,1.723-6.041,6.857-8.441c0.553-0.26,1.102-0.481,1.657-0.647c2.55-0.74,5.65,1.377,6.279,1.565l1.613,0.568    c0.178,0.188,1.166,0.563,2.957,1.133c1.795,0.564,3.856,0.855,6.188,0.855s4.57-0.312,6.724-0.925    c2.147-0.616,4.66-1.493,7.53-2.625c0.182,0.097,0.34,0.119,0.475,0.074c0.133-0.049,0.543-0.047,0.471,0.207    C398.728,82.267,383.18,84.277,383.004,84.277z M367.674,82.148c-0.898-0.028-1.551,0.285-1.949,0.851    c-0.408,0.574-2.09,7.67-2.09,7.67c-0.715,4.342,1.842,5.104,2.826,5.104h0.135c0.18-0.28,0.463-0.674,0.879-1.133    c3.578-3.965,2.977-9.653,2.883-9.936C370.268,84.136,371.053,82.267,367.674,82.148z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M438.271,99.183c-9.504,0.121-15.309-4.615-15.803-5.043c-0.49-0.422-5.295-6.291-5.576-6.313    c-0.549-0.047-3.631,7.612-7.535,10.356c-1.598,1.125-3.541,1.849-6.053,1.849c-2.873,0-5.021-1.183-6.457-3.55    c-1.437-2.364-2.801-7.448-2.016-11.778c0.239-1.308,0.225-2.412,0.399-3.269c-0.268-0.375-1.022-2.895,1.078-4.108    c1.027-0.599,2.39-1.845,2.957-0.992c2.004,2.983,1.076,6.287,1.076,7.235c0,1.134-1.063,12.39,4.576,12.063    c3.35-0.193,7.063-5.842,7.799-9.797c0.258-1.4,0.502-4.41,1.346-5.533c0.592-0.779,4.098-2.699,5.717-1.42    c2.641,2.088,3.137,6.557,5.248,8.869c2.105,2.32,4.564,5.77,11.701,7.026c1.662,0.296,3.385,1.072,5.447,0.992    c6.318-0.246,10.977-2.696,11.426-2.696c0.631,0,0.943,0.237,0.943,0.713C454.187,94.45,446.111,99.079,438.271,99.183z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M507.666,143.741c-0.416,4.602-4.75,22.377-18.898,31.647c-1.625,1.063-3.916,0.992-6.252,0.992    c-1.527,0-11.547-1.457-16.207-6.959c-4.191-4.943-4.645-10.039-4.77-10.922c-1.996-14.56,2.859-22.859,5.646-25.047    c1.48-1.166-6.211,17.35-2.15,26.039c3.441,7.364,4.629,10.379,9.412,11.563c33.896,8.4,29.65-56.399,28.381-62.229    c-1.074-4.931-4.631-16.297-9.148-18.306c-0.928-0.41-6.186,5.681-6.186,5.681c-2.553,1.838-6.014,1.356-6.928,0.563    c-2.346-2.049-0.607-7.57-0.336-8.369c0.238-0.694,1.826-5.521,5.578-8.301c0.949-0.703,1.906-1.305,2.895-1.774    c0.986-0.478,3.307-0.712,4.305-0.287c1.758,0.741,0.568,2.871,0.537,3.836c-0.014,0.299,1.125,0.278,1.213,0.278    c0.629-0.467,1.387-0.711,2.285-0.711c0.357,0,0.723,0.191,1.074,0.574c0.18,0.375,0.828,3.383,0.873,3.898    c0.045,0.52,6.707,18.651,8.072,25.83C509.019,122.038,509.019,128.741,507.666,143.741z M487.627,82.294    c0,0-3.398,3.051-3.229,9.08c0.02,0.694,0.381,1.258,0.607,1.772c0.223,0.523,0.736,0.808,1.549,0.783    c2.479-0.08,4.162-5.76,4.301-6.248C492.183,83.017,487.627,82.294,487.627,82.294z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M626.949,97.341c0,0.469-1.389,1.086-1.748,1.27c-0.359,0.193-7.662,1.847-9.014,1.847c-1.072,0-2.34,0.026-3.76-0.211    c-6-0.992-11.438-4.92-12.51-6.957c-1.078-2.033-1.885-3.806-2.426-5.318c-0.445,1.514-3.986,6.055-4.438,7.377    c0,0-1.277,1.736-4.172,2.84c-3.008,1.154-4.316,0.945-5.244-1.42c-1.4-3.576-3.225-13.053-3.225-14.754    c0-1.231,0.668-2.205,2.018-2.912c1.344-0.705,2.512-1.065,3.496-1.065c0.357,0,0.629,0.146,0.809,0.43    c0,0.85,0.953,5.32,0.807,8.654c-0.012,0.188,0.604,4.61,0.736,5.037c0.135,0.426,1.998,0.073,2.621-1.064    c0.629-1.137,1.258-2.412,1.891-3.826c0.621-1.426,2.426-6.25,4.438-6.531c0.797-0.112,1.545-0.329,2.217-0.991    c0.674-0.662,2.873-0.814,3.027-0.289c1.207,4.104,0.064,9.795,2.424,11.78c1.039,0.88,4.928,4.214,6.18,4.685    c1.26,0.475,12.127,1.352,12.982,1.205C624.91,96.978,626.949,96.859,626.949,97.341z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M639.787,98.469c-2.855,1.887-10.121,1.789-15.264-0.424c-0.6-0.256-0.811-1.562-0.811-1.562    c0.092,0,0.158-0.021,0.205-0.071c0.043-0.047,0.107-0.068,0.203-0.068c0.445,0,10.02,1.326,10.223,1.273    c2.988-0.779,0.873-3.002,0.738-3.332c-0.137-0.332-8.135-3.123-8.408-8.447v-0.139c0,0,0.266-2.445,0.268-3.267    c0.008-3.229,5.666-6.125,10.359-5.252c0.98,0.187,2.844,0.387,3.424,0.785c1.988,1.359-0.465,3.33-0.465,3.33    c-0.092,0.191-1.076,0.91-2.088,0.072c-0.244-0.203-1.143-1.343-1.41-1.629c-0.271-0.289-0.762-0.478-1.48-0.568    c-0.447,0.092-2.486,1.365-2.961,3.262c-1.313,5.271,6.861,5.105,9.082,10.287C641.427,92.786,643.17,96.234,639.787,98.469z"></path>             
<path xmlns="http://www.w3.org/2000/svg" d="M211.366,94.536c-2.241,0.944-4.484,2.063-6.729,3.336c-2.235,1.274-4.587,1.938-6.994,2.344    c-3.578,0.604-11.862-0.117-15.195-2.625c-2.021-1.516-1.526-6.223-1.615-6.318c0.308-1.459,1.598-5.907,2.961-7.807    c0.972-1.346,4.674-5.814,9.279-5.814c0.074,0,0.148,0,0.221,0.007c0.635,0.021,1.204,0.137,1.729,0.344    c0.581,0.24,2.089,3.623,2.089,4.19c0,0.664-0.405,1.441-1.215,2.339c-0.806,0.897-1.748,1.771-2.823,2.627    c-1.072,0.852-2.156,1.608-3.226,2.271c-1.078,0.664-1.887,1.045-2.43,1.135c-0.174,0.188-0.262,0.427-0.262,0.709    c0,0.855,2.326,3.834,3.229,4.4c0.893,0.564,1.789,1.127,2.754,1.42c5.715,1.705,14.506-1.977,15.264-2.699    c0.812-0.77,4.138-3.18,5.789-2.692C214.986,91.933,211.813,93.967,211.366,94.536z M190.65,81.763    c-0.712,0.377-1.346,1.039-1.881,1.988c-0.537,0.945-0.809,3.404-0.809,3.404s2.666-2.029,3.159-2.41    C191.616,84.366,190.83,81.859,190.65,81.763z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M480.041,82.304c-2.332,0.941-4.754,1.605-7.268,1.984c-2.508,0.377-4.994,0.633-7.396,1.135    c-3.461,0.725-9.189-0.281-9.818-0.281c-0.178,0.188,0.699,3.783,0.74,4.254c0.047,0.476,0.348,7.369-1.549,9.365    c-0.545,0.578-2.773,1.851-3.498,1.851c-0.979,0-1.848-1.013-2.146-3.693c-0.053-0.467,0.814-1.814,0.668-3.971    c-0.273-4.115-1.207-8.968-1.207-9.58c0-0.613-0.223-1.16-0.678-1.629c0.092-0.289,1.777-3.244,4.715-4.261    c0.355-0.125,1.791,3.355,1.883,3.828c0.355-0.281,0.785-0.516,1.273-0.707c0.498-0.188,1.637-0.707,2.084-0.707    c1.08,0,1.5,1.912,3.092,1.986c6.455,0.299,27.752-3.834,28.113-4.119c0.449,0,1.256,0.197,1.076,0.715    C489.562,80.089,481.021,81.926,480.041,82.304z"></path>
<path xmlns="http://www.w3.org/2000/svg" d="M566.638,84.06c-0.359,0-1.525,0.189-1.881,0.281c-0.092,0.096-3.633-0.281-3.633-0.281    c-0.539-0.19-2.332,1.133-2.018,1.703c0.918,1.66-0.406,5.938-1.479,7.305c-1.078,1.378-1.633,2.937-2.557,4.048    c-3.756,4.52-9.865,2.838-10.49,2.838c-0.9-0.849-1.33-2.103-2.084-3.336c-2.184-3.56,0.201-8.533,0.201-9.578v-0.426    c0-0.279,1.723-6.037,6.855-8.441c0.555-0.258,1.988-0.742,2.154-0.783c1.963-0.547,8.563,2.84,10.354,3.406    c1.797,0.566,3.855,0.854,6.188,0.854s4.574-0.309,6.727-0.922c2.15-0.617,4.662-1.494,7.535-2.625    c0.178,0.099,0.336,0.119,0.471,0.07c0.127-0.047,0.541-0.045,0.467,0.209C582.363,82.051,566.816,84.06,566.638,84.06z     M551.304,81.929c-0.898-0.031-1.543,0.283-1.945,0.848c-0.408,0.57-2.088,7.669-2.088,7.669    c-0.713,4.344,1.975,5.635,2.826,5.106c4.088-2.52,3.988-10.787,3.895-11.068C553.904,83.917,554.687,82.051,551.304,81.929z"></path>             
<path xmlns="http://www.w3.org/2000/svg" d="M537.91,94.327c-2.242,0.946-4.486,2.063-6.732,3.336c-2.236,1.274-4.584,1.938-6.988,2.342    c-3.58,0.604-11.859-0.117-15.201-2.627c-2.018-1.516-1.52-6.221-1.609-6.314c0.309-1.459,1.596-5.907,2.963-7.805    c0.965-1.348,4.672-5.816,9.279-5.816c0.07,0,0.145,0,0.221,0.007c0.629,0.021,1.201,0.137,1.729,0.346    c0.582,0.238,2.084,3.621,2.084,4.188c0,0.662-0.406,1.443-1.211,2.339c-0.807,0.901-1.75,1.774-2.822,2.627    c-1.078,0.854-2.156,1.61-3.229,2.271c-1.078,0.662-1.883,1.043-2.426,1.139c-0.176,0.187-0.27,0.421-0.27,0.707    c0,0.854,2.33,3.834,3.23,4.398c0.895,0.566,1.787,1.129,2.758,1.418c5.711,1.709,14.506-1.971,15.264-2.693    c0.807-0.774,4.141-3.182,5.783-2.696C541.529,91.72,538.353,93.761,537.91,94.327z M517.195,81.554    c-0.717,0.379-1.348,1.039-1.883,1.984c-0.535,0.944-0.805,3.405-0.805,3.405s2.666-2.03,3.156-2.411    C518.16,84.155,517.375,81.648,517.195,81.554z"></path>
</svg>          
          </td>
        </tr>
        <tr>
          <td align="center" bgcolor="#ffffff" style="border-radius:10px 10px 0 0">
            <div class="m_4412137695263643084headline" style="border-bottom-color:rgba(0,0,0,0.1);border-bottom-style:solid;border-width:0 0 1px;font-size:normal;font-style:normal;font-variant:normal;font-weight:normal;height:113px;line-height:normal;margin:auto 30px;padding:0;vertical-align:baseline">
            <h2 style="border:0;color:#1e2c3a;font:400 30px/40px apple-system,BlinkMacSystemFont,Arial,\'Segoe UI\',\'Helvetica Neue\',sans-serif;margin:0;padding:35px 0 0;vertical-align:baseline" align="center">' . $title .'</h2>
            </div>
          </td>
        </tr>
      </tbody></table>
      
    </td>
  </tr>
  ';
        
    }
    
}

if ( ! function_exists( 'atelierbourgeons_html_email_template_footer' ) ) {
    function atelierbourgeons_html_email_template_footer() {
        return '
      </tbody></table>
      
    </td>
  </tr>
  <tr>
    <td align="center" height="100%" valign="top" width="100%" bgcolor="#F2F5F7" style="padding:0 15px 40px">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
         <tbody><tr>
          <td align="center" valign="top" style="color:#999999;font-family:Open Sans,Helvetica,Arial,sans-serif;padding:0">
            <p style="font-size:14px;line-height:20px">© <span class="lG">atelier Bourgeons</span> 2018</p>
          </td>
        </tr>
      </tbody></table>
      
    </td>
  </tr>
</tbody></table>



</body></html>';
    }
    
}


if ( ! function_exists( 'svg_spinner_email' ) ) {
    function svg_spinner_email() {
        return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="lds-spin" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;"><g transform="translate(80,50)">
<g transform="rotate(0)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="1" transform="scale(1.07306 1.07306)">
  <animateTransform attributeName="transform" type="scale" begin="-4.4624999999999995s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-4.4624999999999995s"/>
</circle>
</g>
</g><g transform="translate(71.21320343559643,71.21320343559643)">
<g transform="rotate(45)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.875" transform="scale(1.08556 1.08556)">
  <animateTransform attributeName="transform" type="scale" begin="-3.8249999999999997s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-3.8249999999999997s"/>
</circle>
</g>
</g><g transform="translate(50,80)">
<g transform="rotate(90)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.75" transform="scale(1.09806 1.09806)">
  <animateTransform attributeName="transform" type="scale" begin="-3.1875s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-3.1875s"/>
</circle>
</g>
</g><g transform="translate(28.786796564403577,71.21320343559643)">
<g transform="rotate(135)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.625" transform="scale(1.01056 1.01056)">
  <animateTransform attributeName="transform" type="scale" begin="-2.55s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-2.55s"/>
</circle>
</g>
</g><g transform="translate(20,50.00000000000001)">
<g transform="rotate(180)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.5" transform="scale(1.02306 1.02306)">
  <animateTransform attributeName="transform" type="scale" begin="-1.9124999999999999s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-1.9124999999999999s"/>
</circle>
</g>
</g><g transform="translate(28.78679656440357,28.786796564403577)">
<g transform="rotate(225)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.375" transform="scale(1.03556 1.03556)">
  <animateTransform attributeName="transform" type="scale" begin="-1.275s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-1.275s"/>
</circle>
</g>
</g><g transform="translate(49.99999999999999,20)">
<g transform="rotate(270)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.25" transform="scale(1.04806 1.04806)">
  <animateTransform attributeName="transform" type="scale" begin="-0.6375s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="-0.6375s"/>
</circle>
</g>
</g><g transform="translate(71.21320343559643,28.78679656440357)">
<g transform="rotate(315)">
<circle cx="0" cy="0" r="10" fill="#442317" fill-opacity="0.125" transform="scale(1.06056 1.06056)">
  <animateTransform attributeName="transform" type="scale" begin="0s" values="1.1 1.1;1 1" keyTimes="0;1" dur="5.1s" repeatCount="indefinite"/>
  <animate attributeName="fill-opacity" keyTimes="0;1" dur="5.1s" repeatCount="indefinite" values="1;0" begin="0s"/>
</circle>
</g>
</g></svg>';
    }
}

if ( ! function_exists( 'svg_valid_email' ) ) {
    function svg_valid_email() {
        return '<svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="20 20 60 60" style="width: 42%; transform-origin: 50px 50px 0px;" xml:space="preserve"><g style="transform-origin: 50px 50px 0px; transform: scale(0.6);"><g style="transform-origin: 50px 50px 0px;"><style type="text/css" class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -4.8s;">.st0{fill:none;stroke:#333333;stroke-width:8;stroke-miterlimit:10;} .st1{fill:#333333;} .st2{fill-rule:evenodd;clip-rule:evenodd;fill:#B3B3B3;} .st3{fill:#FFFFFF;} .st4{fill:#B3B3B3;} .st5{fill:#77A4BD;} .st6{fill:#A0C8D7;} .st7{fill:#ABBD81;} .st8{fill:#E15B64;} .st9{fill:#666666;} .st10{fill:none;stroke:#F47E60;stroke-width:8;stroke-linecap:round;stroke-miterlimit:10;} .st11{fill:none;stroke:#F47E60;stroke-width:9.0001;stroke-linecap:round;stroke-miterlimit:10;} .st12{fill:none;stroke:#F47E60;stroke-width:9;stroke-linecap:round;stroke-miterlimit:10;}</style><g class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -4.43077s;"><path class="st0" d="M45.7,10.2L17.6,26.4c-2.7,1.5-4.3,4.4-4.3,7.4v32.4c0,3.1,1.6,5.9,4.3,7.4l28.1,16.2c2.7,1.5,5.9,1.5,8.6,0 l28.1-16.2c2.7-1.5,4.3-4.4,4.3-7.4V33.8c0-3.1-1.6-5.9-4.3-7.4L54.3,10.2C51.6,8.6,48.4,8.6,45.7,10.2z" stroke="#030303" style="stroke: rgb(3, 3, 3);"></path></g><g style="transform-origin: 50px 50px 0px;"><g class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -4.06154s;"><path class="st7" d="M47.3,68.4L73.7,42c1.8-1.8,1.8-4.6,0-6.4c-1.8-1.8-4.6-1.8-6.4,0L44.1,58.8L32.7,47.4c-1.8-1.8-4.6-1.8-6.4,0 c-1.8,1.8-1.8,4.6,0,6.4l14.6,14.6c0.9,0.9,2,1.3,3.2,1.3S46.4,69.2,47.3,68.4z" fill="#d39182" style="fill: rgb(211, 145, 130);"></path></g></g><metadata xmlns:d="https://loading.io/stock/" class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -3.69231s;">
<d:name class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -3.32308s;">ok</d:name>
<d:tags class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -2.95385s;">ok,confirm,ready,positive,check,right,correct,affirmative,success,hexagon,form</d:tags>
<d:license class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -2.58462s;">cc-by</d:license>
<d:slug class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -2.21538s;">mz1tp2</d:slug>
</metadata></g></g><style type="text/css" class="ld ld-breath" style="transform-origin: 50px 50px 0px; animation-duration: 4.8s; animation-delay: -1.84615s;">path,ellipse,circle,rect,polygon,polyline,line { stroke-width: 0; }@keyframes ld-breath {
  0% {
    -webkit-transform: scale(0.86);
    transform: scale(0.86);
  }
  50% {
    -webkit-transform: scale(1.06);
    transform: scale(1.06);
  }
  100% {
    -webkit-transform: scale(0.86);
    transform: scale(0.86);
  }
}
@-webkit-keyframes ld-breath {
  0% {
    -webkit-transform: scale(0.86);
    transform: scale(0.86);
  }
  50% {
    -webkit-transform: scale(1.06);
    transform: scale(1.06);
  }
  100% {
    -webkit-transform: scale(0.86);
    transform: scale(0.86);
  }
}
.ld.ld-breath {
  -webkit-animation: ld-breath 1s infinite;
  animation: ld-breath 1s infinite;
}
</style></svg>';
    }
}

if ( ! function_exists( 'mail_new_user_checking' ) ) {
    function mail_new_user_checking($user_login, $user_email) {
    $message = atelierbourgeons_html_email_template_header('Thanks for registering!');
 
    
    $message .= '<tr>
    <td align="center" height="100%" valign="top" width="100%" bgcolor="#F2F5F7" style="padding:0 15px 20px" class="m_4412137695263643084mobile-padding">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
        <tbody><tr>
          <td align="center" valign="top" style="font-family:Open Sans,Helvetica,Arial,sans-serif;padding:0 0 25px">
            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
              <tbody><tr>
                <td align="center" bgcolor="#ffffff" style="border-radius:0 0 10px 10px;padding:25px">
                ' . svg_spinner_email() .'
                  <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
                    <tbody><tr>
                      
                    </tr>
                    <tr>
                      <td align="center" style="font-family:Open Sans,Helvetica,Arial,sans-serif">
                        <h2 style="border:0;color:#1e2c3a;font:400 30px/40px apple-system,BlinkMacSystemFont,Arial,\'Segoe UI\',\'Helvetica Neue\',sans-serif;margin:0;padding:15px 0;vertical-align:baseline" align="center"> ' . __( 'Welcome, thank you for registering to atelierbourgeons pro You have been approved to access {sitename}', 'new-user-approve' ) . '</h2>
                        <p style="border:0;color:#667685;font:400 16px/25px apple-system,BlinkMacSystemFont,Arial,\'Segoe UI\',\'Helvetica Neue\',sans-serif;margin:0px 0 10px;padding:0;vertical-align:baseline">
                          ' .  __( 'We are currently reviewing your  {sitename}', 'new-user-approve' ) . "\r\n\r\n" .
	  "{username}\r\n\r\n{login_url}\r\n\r\n" . __( 'We are currently reviewing your', 'new-user-approve' ) . "\r\n\r\n" . '
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding:20px 0 15px">
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse!important">
                          <tbody><tr>
                            <td align="center" style="border-radius:26px" bgcolor="#0570D4">
                              <a href="'. get_site_url() .'" style="background: #613143;border: 1px solid #613143;border-radius: 14px;color:#ffffff;display:block;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:16px;padding:14px 26px;text-decoration:none" target="_blank" data-saferedirecturl="">Visit us</a>
                            </td>
                          </tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>';

    
    // send the mail
    $message .= atelierbourgeons_html_email_template_footer();
    return nua_do_email_tags( $message, array(
        'context' => 'approve_user',        
        'user_login' => $user_login,
        'user_email' => $user_email,
    ) );
    }
}