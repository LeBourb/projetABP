<?php
/**
 * The template for displaying the help.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Collection
 *
 * @package storefront
 */

get_header();
global $post;
?>


<div style="width: 80%;margin-left: auto;margin-right: auto;padding-top: 5em;">
    <header class="entry-header">
        <h1 class="entry-title">
            <?php 
                echo get_the_title($post);    
            ?>
        </h1>		
    </header>
<?php 
//get_template_part('content','none');
echo apply_filters('the_content',$post->post_content);
?>    
</div>

<?php 
get_footer();
?>
