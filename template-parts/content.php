<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Free_Blog
 */
global $free_blog_theme_options;
$show_content_from = esc_attr($free_blog_theme_options['free-blog-content-show-from']);
$read_more = esc_html($free_blog_theme_options['free-blog-read-more-text']);
$masonry = esc_attr($free_blog_theme_options['free-blog-column-blog-page']);
?>
<style>
    article .entry-header .entry-meta .posted-on:before {
        content: '';
        height: 1px;
        background: rgba(0,0,0,0.2);
        width: 10px;
        margin: 0 5px;
        display: inline-block;
        vertical-align: middle;
        position: relative;
        top: -1px;
    }
    
    article .entry-header .entry-meta .posted-on {
        font-size: unset;
    }    
    
    article {
        padding-bottom: 29px;
        border-bottom: 1px solid #eaeaea;
        margin-bottom: 30px;
    }
    
    article .content-area .inline {
        float: none;
        display: inline-block;
    }
    
    @media screen and (max-width: 768px) {
        article .entry-header .entry-meta .cat-links {
            margin-bottom: 0;
        }
    }
    
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class($masonry); ?>>
	<div class="content-area" style="display: flex;flex-wrap: wrap;">
            <div class="inline col-xs-12 col-sm-12 col-md-6 col-lg-6">
             <?php free_blog_post_thumbnail(); ?>
	    </div>
            <div class="inline col-xs-12 col-sm-12 col-md-6 col-lg-6">                
		<header class="entry-header" style="border-bottom:none;">
                   
			<?php
                        
                        
			if ( 'post' === get_post_type() ) :
				?>
                                <div class="entry-meta" style="display:flex; width:100%;">
					<?php
					free_blog_posted_on();
					free_blog_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif;

			

                        the_title( '<h3 class=""><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

                        ?>
		</header><!-- .entry-header -->
		<div class="" style="width:100%; float: right; margin-right: 0;">
	            <?php
	            /*if (is_singular()) {
	                the_content();
	            }
	            elseif( $show_content_from == 'hide' ) {
	                wp_trim_words(get_the_content(), 0 );
	            }else{
	            	if ( $show_content_from == 'excerpt' ) {
	                    the_excerpt();
	                } else {
	                    the_content();
	                }
	            }*/
                    the_excerpt();
	            wp_link_pages(array(
	                'before' => '<div class="page-links">' . esc_html__('Pages:', 'free-blog'),
	                'after' => '</div>',
	            ));
	            ?>
	        </div>
	        <!-- .entry-content -->

	        <?php if( !empty( $read_more ) ): ?>
		        <div class="read-more">
		        	<a href="<?php the_permalink(); ?>"><?php echo esc_html($read_more); ?></a>
		        </div>
	    	<?php endif; ?>
            </div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->