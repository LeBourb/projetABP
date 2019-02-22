<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
        global $post;
        $is_atelier = get_option("woocommerce_atelier_page_id") == $post->ID ? true : false;
        $is_production = get_option("woocommerce_production_page_id") == $post->ID ? true : false;
        $is_collection = get_option("woocommerce_collection_page_id") == $post->ID ? true : false;
        $atelier_id = get_option("woocommerce_atelier_page_id");
        $production_id = get_option("woocommerce_production_page_id");
        $collection_id = get_option("woocommerce_production_page_id");
        
    ?>

<meta name="description" content="">
<meta name="author" content="">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Google Font -->
<!--link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600' rel='stylesheet' type='text/css'-->
<!-- =========================
     SCRIPTS    
============================== -->
<head>

        <style>
            .site-logo svg {
                width: 100%;
                height: 100%;
                display: inline;
                fill: #dedede;                
            }
            .site-logo {
                cursor: pointer;
                width: 7em;
                height: 3em;
                margin-top: 4px;
                margin-left: 10px;
                margin-right: 31px;
            }
            
            @media (min-width: 768px) {
                .site-logo {
                    width: 8em;
                    height: 4em;
                    margin-top: 6px;
                    margin-left: 7px;
                }
            }
            
            #product-menu {
                counter-reset: prd_number;
            }
            
            #product-menu .nb-product:before{                
                content: counter(prd_number); 
                counter-increment: prd_number;
            }
            
            .navbar nav.categories ul.categories {
                display: flex;
                flex-flow: column;
                list-style-type: none;
                text-align: center;
                margin: 0;
            }
            
            .navbar nav.categories ul.categories li.sub-category-elem.current {
                display: none;
            }

            .navbar nav.categories ul.categories li.sub-category-elem , 
            .navbar nav.categories .selected   {
                padding: 1em;
            }

            .navbar nav.categories {
                z-index: 1;
                width: 100%;
                position: fixed;
                background-color: white;
                border-top: 1px solid #e1e1e1;
                border-bottom: 1px solid #e1e1e1;
                display: none;
            }
            
            .navbar nav.categories .selected {
                justify-content: center ;
                display: flex;
                align-items: center;
            }
            
            .subnavContainer.eshop.active {
                display: block;
            }
            
            .navbar nav.categories .downArrow {            
                background: url(<?php echo get_site_url() . '/wp-content/themes/atelierbourgeonspro/assets/images/drop-arrow.svg'; ?>) no-repeat;
                background-size: 100%;
                border: 0 none;
                display: block;
                height: 8px;
                right: 23px;
                top: 16px;
                width: 14px;
                margin-left: 1rem;
            }
            
            .navbar nav.categories .downArrow {            
                display: flex;
                align-items: center ;
            }
            
            .sub-menu-image > div {
                display: none;
            }
            
            .sub-menu-image > div.active {
                display: block;
            }
            
            .sub-menu h6:hover {
                text-decoration: underline;
            }
              
            @media screen and ( min-width: 768px ) {        
                .navbar nav.categories ul.categories.cd-tabs-navigation {
                    display: flex!important;
                    justify-content: space-evenly;
                    flex-flow: row;
                }
                
                .navbar nav.categories .selected {
                    display: none;
                }
                
                .navbar nav.categories ul.categories li.sub-category-elem.current {
                    display: block;
                    background-color: black;
                    color: white;
                }
                
                .navbar nav.categories ul.categories li.sub-category-elem {
                    color: black;
                }
                
                .categories.cd-tabs-navigation a {
                     line-height: 0px;
                    margin-top: 0;
                    margin-bottom: 0;
                    width: 25%;
                    text-align: center;
                }
    
            }
            
            
            
        </style>

</head>
<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

<!-- =========================
     PRE LOADER       
============================== -->
<?php 
    if(is_front_page()) {
?>
<div class="preloader">

	<!--div class="sk-rotating-plane"></div-->
        <div class="overlay-loader show" id="loader" style="position: fixed; top: 0px; right: 0px; bottom: 0px; left: 0px; width: 100%; background-color: rgb(255, 255, 255);">
        <?php include('inc/svg-logo-atelierbourgeons.php'); ?>
        <!--<div style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; background-color: rgb(255, 255, 255); display: block;" class="loader-background"></div>-->
    </div>

</div>
<?php 
    }
?>

<!-- =========================
     NAVIGATION LINKS     
============================== -->

<div class="<?php if(is_product()) echo "product-nav"; ?> navbar navbar-fixed-top custom-navbar active" role="navigation">
	<div class="container">

		<!-- navbar header -->
		<div class="navbar-header" style="display:flex; justify-content: space-between; align-items: center;">
			
                    <?php
                    if(!is_product()) {
                    ?>
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="margin-right: 0;">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
                    <?php
                    }else {
                        /*global $post;
                        $new_production_id = wc_get_not_stated_production_item($post->ID);
                        $link_url = '';
                        if( $new_production_id  !== null ) {*/
                            $link_url = '';
                            global $post;
                            $page_id = get_post_meta($post->ID, '_parent_page_id', true);
                            if(get_post_meta($post->ID, '_parent_page_id', true) !== "") {
                                $link_url = get_permalink(get_post_meta($post->ID, '_parent_page_id', true));
                            }else {
                                $link_url = get_permalink(get_option('woocommerce_collection_page_id'));
                            }
                        //}
                    ?>
                       <a class="arrow" style="position: relative;width: 1.7rem; height: 2.3rem;" href="<?php echo $link_url;?>">
                        <span>
                        <svg id="arrow" viewBox="0 0 33.969 23.844" width="100%" height="100%">
                                <use xlink:href="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/sprite.svg#arrow"></use>
                        </svg>
                        </span>
                        </a>
                    <?php
                    }                    
                    ?>
                    <div class="site-logo" onclick="gotohome()">
                               <!--<img src=""></div> -->
                        <svg viewBox="0 0 650 177" height="177px" width="650px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" xml:space="preserve">
                             <use xlink:href="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/sprite.svg#logo-abourgeons"></use>
                        </svg>    
                    </div>
                    
                    <div class="cart-button">
                        <a style="display: block;    position: relative;    width: 1.7rem;    height: 2.3rem;"  href="<?php echo wc_get_page_permalink( 'cart' ); ?>">
                            <span><svg id="cart" viewBox="0 0 33 40" width="100%" height="100%">
                                <path d="m685.5 36c-3.9 0-6.5 2.048-6.5 6v1h-9c-.651 0-1 .09-1 .75v31.06a1.187 1.187 0 0 0 1.179 1.194h30.642a1.187 1.187 0 0 0 1.179 -1.194v-31.06c0-.66-.349-.75-1-.75h-9v-1c0-3.952-2.6-6-6.5-6m-4.5 6c0-2.634 1.4-4 4-4s5 1.366 5 4v1h-9v-1m19 3v29h-29v-29h8v4a.9 .9 0 0 0 1 1 .809 .809 0 0 0 1 -1c-.124-.114 0-4 0-4h9v4a1 1 0 1 0 2 0v-4h8" transform="translate(-669-36)"/>
                            </svg>
                            </span>
                            <span id="labPanier" style="position: absolute;bottom: .5rem;left: 0;right: 0;color: #0d0d0d;font-size: .9rem;line-height: .9rem;text-align: center;"><span class="nbr"><?php  echo sizeof(WC()->cart->get_cart()); ?></span></span>
                        </a>
                    </div>
                         
		</div>

		<div class="collapse navbar-collapse">

			<ul class="nav navbar-nav navbar-right">
				
                                <?php
                                // if user connected => display orders ! 
                                //echo wc_get_page_id ( 'view_order' );
                                
                                echo '<li id="product-nav" class="navMobile"><a href="' . (!is_front_page() ? get_home_url() : '') . '" >Home</a></li>';                
                                echo '<li id="product-nav" class="navDesktop"><a href="' . (!is_front_page() ? get_home_url() : '') . '" >Home</a></li>';                

                                /*echo '<li><a href="' . get_permalink( wc_get_page_id ( 'shop' )) . '" >Shop</a></li>';                                            
                                $query = new WC_Product_Query( array(
                                    'limit' => 10,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'return' => 'ids',
                                    'status' => 'publish',
                                ) );   */     
                                $image = array();
                                $image['media_id'] = array( get_post_thumbnail_id( get_option('woocommerce_collection_page_id')) );
                                $image['hlink'] = get_permalink(get_option('woocommerce_collection_page_id'));                                
                                $image['textColor'] = 'white';
                                
                                $image_summer = array();
                                $image_summer['media_id'] = array( get_post_thumbnail_id( get_option('woocommerce_collection_summer_page_id')) );
                                $image_summer['hlink'] = get_permalink(get_option('woocommerce_collection_summer_page_id'));                                
                                $image_summer['textColor'] = 'white';
                                ?>    
                               <li class="navDesktop"><a href="<?php echo get_permalink(get_option('woocommerce_collection_page_id')); ?>">E-Shop</a>
                                    <div class="subnavContainer eshop" style="width: unset;padding: 1rem;" >
                                        <div class="frame" style="width: 49rem;flex-wrap: unset;flex-direction: unset;border: solid gray 1px; display:flex;">
                                            <div class="sub-menu" style="width: 32em;padding-left: 2rem;">
                                                <h5 style="margin-bottom: 2rem;">Collections</h5>
                                                <div id="title-winter-2019"><a href="<?php echo get_permalink(get_option('woocommerce_collection_page_id')); ?>"><h6><?php echo get_the_title(get_option('woocommerce_collection_page_id')); ?></h6></a></div>
                                                <div id="title-summer-2019"><a href="<?php echo get_permalink(get_option('woocommerce_collection_summer_page_id')); ?>"><h6><?php  echo get_the_title(get_option('woocommerce_collection_summer_page_id'));  ?></h6></a></div>                                            
                                            </div>
                                            <div class="sub-menu-image">
                                                <div id="image-winter-2019" class="active">
                                                    <?php echo abourgeons_fall18_render_image_featuring($image, true); ?>
                                                </div>
                                                <div id="image-summer-2019" class="" style="">
                                                    <?php echo abourgeons_fall18_render_image_featuring($image_summer, true); ?>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <li class="navMobile"><p>E-Shop</p>
                                <div class="subnavContainer mobile" style="" >   
                                    <a href="<?php  echo get_permalink( get_option('woocommerce_collection_page_id') ); ?>" ><?php echo get_the_title(get_option('woocommerce_collection_page_id')); ?></a>
                                    <a href="<?php  echo get_permalink( get_option('woocommerce_collection_summer_page_id') );?>" ><?php echo get_the_title(get_option('woocommerce_collection_summer_page_id')); ?></a>
                                </div>
                            </li>
                               <?php 
                                echo '<li id="btob-nav" class="navMobile"><a href="' . get_permalink(get_option('woocommerce_btob_page_id')) . '">B to B SALES</a></li>';
                                echo '<li id="btob-nav" class="navDesktop"><a href="' . get_permalink(get_option('woocommerce_btob_page_id')) . '">B to B SALES</a></li>';
                                echo '<li class="navDesktop"><a class="separator">|</a></li>';                                                                  
                                echo '<li class="navMobile"><a href="' . get_permalink(get_option('woocommerce_shopping_guide_page_id')) . '" >' . 'Help' . '</a></li>';                                
                                echo '<li class="navMobile"><a href="' . get_permalink( wc_get_page_id ( 'cart' )) . '" >Cart</a></li>'; 
                                echo '<li class="navDesktop"><a href="' . get_permalink(get_option('woocommerce_shopping_guide_page_id')) . '" >' . 'Help' . '</a></li>';                                
                                echo '<li class="navDesktop"><a href="' . get_permalink( wc_get_page_id ( 'cart' )) . '" >Cart</a></li>'; 
                                
                                if(is_user_logged_in()) {                                    
                                    echo '<li class="navDesktop"><a href="' . get_permalink( wc_get_page_id ( 'myaccount' )) . '" >My Account</a>'
                                            . '<div class="subnavContainer" style="">'
                                            . '<a href="' . get_permalink( wc_get_page_id ( 'myaccount' )) . '" >マイアカウント</a>'
                                            . '<a href="' . get_permalink( wc_get_page_id ( 'myaccount' )) . 'orders/" >ご注文履歴</a>'
                                            . '</div>'
                                            . '</li>';
                                    echo '<li class="navMobile"><a href="' . get_permalink( wc_get_page_id ( 'myaccount' )) . '" >My Account</a>' . '</li>';
                                }
                                else {
                                    echo '<li class="navDesktop"><a href="' . Theme_My_Login::get_page_link( 'login' ) . '" >Login</a>'
                                        . '<div class="subnavContainer" style="">'
                                        . '<a class="subnav" href="' .  Theme_My_Login::get_page_link( 'login' ) . '">ログイン</a>'
                                        . '</div>'
                                        . '</li>';
                                    
                                    echo '<li class="navDesktop"><a href="' . Theme_My_Login::get_page_link( 'register' ) . '" >Register</a>'
                                        . '<div class="subnavContainer" style="">'
                                        . '<a class="subnav" href="' .  Theme_My_Login::get_page_link( 'register' ) . '">新規会員登録</a>'
                                        . '</div>'    
                                        .'</li>'; 
                                    
                                    echo '<li class="navMobile"><a href="' . Theme_My_Login::get_page_link( 'login' ) . '" >Login</a>'  . '</li>';
                                    echo '<li class="navMobile"><a href="' . Theme_My_Login::get_page_link( 'register' ) . '" >Register</a>' . '</li>';
                                }                   
                                echo '<li class="navDesktop"><a href="' . get_permalink( get_option('woocommerce_contact_form_page_id')) . '" >Contact-us</a>'
                                        . '<div class="subnavContainer" style="">'
                                        . '<a class="subnav" href="' .  get_permalink( get_option('woocommerce_contact_form_page_id')) . '">お問い合わせ</a>'
                                        . '</div>'    
                                        . '</li>';
                                echo '<li class="navMobile"><a href="' . get_permalink( get_option('woocommerce_contact_form_page_id')) . '" >Contact-us</a>' . '</li>';
                                ?>
                            
			</ul>

		</div>
               
               

	</div>
        <?php
    
        if($is_collection || $is_production  || $is_atelier ) {
                ?>
                <nav class="categories">
                <div class="selected"><?php 
                if($is_collection)
                    echo get_the_title($collection_id);
                else if($is_production)
                    echo get_the_title($production_id); 
                else if($is_atelier)
                    echo get_the_title($atelier_id); 
                ?><span class="downArrow"></span></div>
                <ul class="categories cd-tabs-navigation" style="display:none;">
                    
                  <a href="<?php echo get_permalink($atelier_id);?>"><li class="sub-category-elem <?php if($is_atelier) echo "current"; ?>"><?php echo get_the_title($atelier_id); ?></li></a>
                  <a href="<?php echo get_permalink($collection_id); ?>"><li class="sub-category-elem <?php if($is_collection) echo "current"; ?>"><?php echo get_the_title($collection_id); ?></li></a>
                  <a href="<?php echo get_permalink($production_id) ?>"><li class="sub-category-elem <?php if($is_production) echo "current"; ?>"><?php echo get_the_title($production_id); ?></li></a>
                  <?php /* $args = array(
                       'hierarchical' => 1,
                       'show_option_none' => '',
                       'hide_empty' => 0,
                       'parent' => 0,
                       'taxonomy' => 'product_cat'
                    );
                    $subcats = get_categories($args);

                    $current_cat_id = 0;
                    foreach ($subcats as $sc) {
                        $link = get_term_link( $sc->slug, $sc->taxonomy );                    

                        $thumbnail_id = absint( get_woocommerce_term_meta( $sc->term_id, 'thumbnail_id', true ) );
                        $image = "";
                        if ( $thumbnail_id ) {
                            $image = wp_get_attachment_image_url( $thumbnail_id , 'large' );
                        }
                        echo '<li class="sub-category-elem ' . ($sc->term_id == $current_cat_id ? 'selected ' : '' ) . '" thumbnail-url="'. $image . '" ><a href="'. $link .'" >' . $sc->name . '</a></li>';
                    }*/
                    ?>
                </ul>
                </nav>
            <?php
                }
        ?>
</div>
    
 <script>
    (function($) {
        $('.nav.navbar-nav li').mouseenter(function() {
            $(this).find('.subnavContainer').addClass('active');

        });
        $( ".subnavContainer" ).mouseleave(function() {
            //$(this).hide();
            $(this).removeClass('active');
        });
        $( ".nav.navbar-nav li" ).mouseleave(function() {
            $(this).find('.subnavContainer').removeClass('active');
        });
        
        $( ".nav.navbar-nav li" ).click(function(evt) {
            if($(this).find('.subnavContainer').hasClass('active')) {
                $(this).find('.subnavContainer').removeClass('active');
            }else {
                $(this).find('.subnavContainer').addClass('active');
            }
            evt.stopPropagation();
        });
        
        $( 'nav.categories' ).click(function() {
            $('nav.categories .categories.cd-tabs-navigation').toggle();
        });
        
        $('#title-summer-2019').mouseenter(function() {
              $('#image-winter-2019').removeClass('active');
             $('#image-summer-2019').addClass('active');
        });
        $('#title-summer-2019').mouseleave(function() {
              $('#image-summer-2019').removeClass('active');
             $('#image-winter-2019').addClass('active');
        });
        
    }(jQuery));
</script>

<!--div class="navbar-fixed-top" role="navigation" style="height:auto;position:absolute">
    <div style="display:flex; align-items: center;
    height: 5.9rem;
    padding-left: 2.7rem;
    padding-right: 2.7rem;
    justify-content: space-between;">
        
    
    </div>
</div-->
