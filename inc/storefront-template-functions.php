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
        $header_email = '<html style=""><head><meta name="viewport" content="width=device-width, initial-scale=1">
            <head/>
            <body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important">
  <tbody><tr>
    <td align="center" valign="top" width="100%" style="background: linear-gradient(-180deg,#fdf6e2 0%,#e9dccd 100%) 0% 0%/cover; padding:35px 15px 0;" class="m_4412137695263643084mobile-padding">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
        <tbody><tr>
          <td align="center" valign="top" style="padding:30px 0; position:relative; height: 250px;">
       ';
        
        ob_start();        
        $logo_email = true;
        include('svg-logo-atelierbourgeons.php');
        $header_email .= ob_get_contents();
        ob_end_clean();
        $header_email .= '
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
        return $header_email;
        
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


if ( ! function_exists( 'mail_new_user_confirm_email' ) ) {
    function mail_new_user_confirm_email($user) {
    $message = atelierbourgeons_html_email_template_header('会員登録のお申し込み、誠にありがとうございます！登録完了まであと一歩です。');
    
    global $wpdb, $current_site;
    
    $user_login = stripslashes( $user->user_login );
    $user_email = stripslashes( $user->user_email );

    // Generate an activation key
    //$key = wp_generate_password( 20, false );
    $code = sha1( $user->ID . time() );    

    /*$wpdb->update( 
        $wpdb->users, //table name                 
            array( 'user_activation_key' => $code ), // string    ),                               
            array('ID' => $user->ID)    
        );*/
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => $code ), array( 'ID' => $user->ID ) );

    // Set the activation key for the user
    //$wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'user_login' => $user->user_login ) );

   
    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
    // we want to reverse this for the plain text arena of emails.
    $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
    $activation_url = add_query_arg( array( 'action' => 'confirm-email', 'key' => $code, 'user' => $user->ID), wp_login_url() );
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
                        <p style="">
                            atelier Bourgeons （アトリエブルジョン）への会員登録をご申請いただき、誠にありがとうございます。下記のURLをクリックして、あなたのメールアドレスでのアクセスを有効にしてください。                          
                  </p><p>会員登録認証用URL:
             <a href="' . $activation_url . '">' . $activation_url . '</a>' 
             . '</p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding:20px 0 15px">
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse!important">
                          <tbody><tr>
                            <td align="center" style="border-radius:26px" bgcolor="#0570D4">
                              <a href="'. get_site_url() .'" style="background: #613143;border: 1px solid #613143;border-radius: 14px;color:#ffffff;display:block;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:16px;padding:14px 26px;text-decoration:none" target="_blank" data-saferedirecturl="">サイトへ移動</a>
                            </td>
                          </tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              
                <tr>
                    <td align="center" style="padding:20px 0 15px">
                        <p>※URLのクリックにて登録認証されるまではお手続きが完了しませんので、ご注意ください。
※本メールに関してお心当たりがない場合、または何かご不明な点がございましたら、恐れ入りますがその旨をご記入のうえ<a href="mailto:contact@atelierbourgeons.com">contact@atelierbourgeons.com</a>までお問い合わせください。
※本メールは、会員登録申請の際にご入力いただいたメールアドレスへ自動送信しています。</p>
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



if ( ! function_exists( 'mail_new_user_checking' ) ) {
    function mail_new_user_checking($user) {
    $message = atelierbourgeons_html_email_template_header('ビジネス会員登録のお申し込み、誠にありがとうございます！');
    
    $user_login = stripslashes( $user->user_login );
    $user_email = stripslashes( $user->user_email );
    
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
                        <p>
                          この度は、atelier Bourgeons （アトリエブルジョン）の会員登録をご申請いただき、誠にありがとうございます。
                           ビジネス会員の登録には、サイト管理者による会員認証が必要です。ご登録内容の確認後、当方より改めてメールをお送りしますので、今しばらくお待ちくださいませ。
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding:20px 0 15px">
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse!important">
                          <tbody><tr>
                            <td align="center" style="border-radius:26px" bgcolor="#0570D4">
                              <a href="'. get_site_url() .'" style="background: #613143;border: 1px solid #613143;border-radius: 14px;color:#ffffff;display:block;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:16px;padding:14px 26px;text-decoration:none" target="_blank" data-saferedirecturl="">サイトへ移動</a>
                            </td>
                          </tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                    <td align="center" style="padding:20px 0 15px">
                        <p>※本メールは、会員登録申請の際にご入力いただいたメールアドレスへ自動送信しています。
※ビジネス会員の登録については、当方がお客様のご登録内容を確認後、認証完了のメールをお送りした時点で会員登録完了となります。ご登録内容によっては、稀にご希望に添えない場合がございます。
※ ご登録内容の確認には、数日かかる場合がございます。
※ご登録内容に関するご確認のため、こちらからメールにてご連絡させていただく場合がございます。
※本メールに関してお心当たりがない場合、または何かご不明点がございましたら、恐れ入りますがその旨をご記入のうえ<a href="mailto:contact@atelierbourgeons.com">contact@atelierbourgeons.com</a>までお問い合わせください。</p>
                    </td>
                </tr>
            </tbody></table>
          </td>
        </tr>';

    
    // send the mail
    $message .= atelierbourgeons_html_email_template_footer();
    return nua_do_email_tags( $message, array(
        'context' => 'confirm-email',        
        'user_login' => $user_login,
        'user_email' => $user_email,
    ) );
    }
}