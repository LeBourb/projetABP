<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

          


echo '<div>';
	// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set
        if(absint($page_description_id)) {
            echo '<h3>CLICK ON THE LINK TO EDIT THE PAGE:<h3>';
            echo '<a href="' . get_edit_post_link($page_description_id) . '">' . get_the_title($page_description_id) . '</a>';
        }
        else {
            echo "NO PAGE ID";
        }
echo '</div>';                       

?>
