<?php
/**
 * The template for displaying the help.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Workshop
 *
 * @package storefront
 */
get_header();

global $post;
$data = get_post_meta($post->ID, 'page_awesome_paragraphs', true);
?>
<style>
    #page {
        overflow-y: hidden;
    }
</style>
<header class="entry-header">
    <h1 class="entry-title">
        <?php
        echo get_the_title($post);
        ?>
    </h1>		
</header>
<div id="customers-individual">
    <section class="customers-individual-about" data-customer="daniel-arsham" id="yui_3_17_2_1_1526119896883_114">
        <div class="scroll-wrapper trigger" data-target="0" data-active-at="buffer" data-inactive-at="bottom" id="yui_3_17_2_1_1526119896883_113">

            <div class="buffer"></div>
            <div class="image-gallery trigger-target desktop-only initialized completed is-active" data-target="0" data-height="189.1999969482422">


                <?php
                if (is_array($data)) {
                    //print_r($data);
                    $idx = 0;
                    foreach ($data as $key => $item) {
                        if ($item['template_type'] == "paragraph") {
                            $idx++;

                            if ($item['media_id']) {
                                ?>                                
                                <div class="image-wrapper is-loaded" data-arrival-index="<?php echo $idx; ?>" data-departure-index="<?php echo $idx; ?>" style="background-image: url(<?php echo wp_get_attachment_image_src($item['media_id'], 'large')[0]; ?>);">
                                    <img data-load="false" data-use-bg-image="true" data-size-format="filename" data-src="<?php echo wp_get_attachment_image_src($item['media_id'], 'medium')[0]; ?>" class="" style="display: none;" data-image-dimensions="100x150" data-image-resolution="750w" alt="Interview de Daniel Arsham.">
                                </div>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </div>

            <!--div class="image-wrapper is-loaded" data-arrival-index="3" data-departure-index="1" style="background-image: url(&quot;https://static1.fr.squarespace.com/static/ta/5134cbefe4b0c6fb04df8065/9258/assets/blocks/content/customers/about-daniel-arsham/portrait-1.jpg&quot;);">
                <img data-load="false" data-use-bg-image="true" data-size-format="filename" data-src="https://static1.fr.squarespace.com/static/ta/5134cbefe4b0c6fb04df8065/9258/assets/blocks/content/customers/about-daniel-arsham/portrait-1.jpg" class="" style="display: none;" data-image-dimensions="100x150" data-image-resolution="750w" alt="Interview de Daniel Arsham.">
            </div>
            <div class="image-wrapper is-loaded" data-arrival-index="1" data-departure-index="0" style="background-image: url(&quot;https://static1.fr.squarespace.com/static/ta/5134cbefe4b0c6fb04df8065/9258/assets/blocks/content/customers/about-daniel-arsham/portrait-2.jpg&quot;);">
                <img data-load="false" data-use-bg-image="true" data-size-format="filename" data-src="https://static1.fr.squarespace.com/static/ta/5134cbefe4b0c6fb04df8065/9258/assets/blocks/content/customers/about-daniel-arsham/portrait-2.jpg" class="" style="display: none;" data-image-dimensions="100x150" data-image-resolution="750w" alt="Interview de Daniel Arsham.">
            </div>
            <div class="image-wrapper is-loaded" data-arrival-index="2" data-departure-index="2" style="background-image: url(&quot;https://static1.fr.squarespace.com/static/ta/5134cbefe4b0c6fb04df8065/9258/assets/blocks/content/customers/about-daniel-arsham/portrait-3.jpg&quot;);">
                <img data-load="false" data-use-bg-image="true" data-size-format="filename" data-src="https://static1.fr.squarespace.com/static/ta/5134cbefe4b0c6fb04df8065/9258/assets/blocks/content/customers/about-daniel-arsham/portrait-3.jpg" class="" style="display: none;" data-image-dimensions="100x150" data-image-resolution="750w" alt="Interview de Daniel Arsham.">
            </div>
        </div-->

            <!--div class="blockquotes desktop-only">
                <blockquote class="trigger-target" data-target="quote-1" data-height="719.2000122070312">
                    «&nbsp;Mon travail consiste principalement à transformer le quotidien.&nbsp;»
                </blockquote>
                <blockquote class="trigger-target" data-target="quote-2" data-height="719.2000122070312">
                    «&nbsp;Le passé est plutôt subjectif... et le futur semble très mystérieux.&nbsp;»
                </blockquote>
                <blockquote class="trigger-target" data-target="quote-3" data-height="719.2000122070312">
                    «&nbsp;Mon nouveau site Web doit pouvoir permettre aux visiteurs d'avoir une vision complète de mon&nbsp;travail.&nbsp;»
                </blockquote>
            </div-->

            <div class="sections" id="yui_3_17_2_1_1526119896883_112">
                <article class="qa section trigger" data-target="3" data-active-at="middle" data-inactive-at="bottom" id="yui_3_17_2_1_1526119896883_111">
                    <!--h2 class="title right trigger-target relative-to-center is-active" data-target="3" data-height="160.5625">Questions et réponses</h2-->
                    <div class="sqs-layout sqs-grid-1 columns-1 qa-content" data-type="block-field" data-updated-on="1507234851023" id="qa-daniel-arsham">
                        <div class="row sqs-row" id="yui_3_17_2_1_1526119896883_110">
                            <div class="col sqs-col-1 span-1" id="yui_3_17_2_1_1526119896883_109">
                                <!--div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-8ceacc9fd34c65018493">
                                    <div class="sqs-block-content"><p><strong>Pouvez-vous me donner votre nom et votre profession&nbsp;? </strong></p>
                                        <p>Je m'appelle Daniel Arsham et je suis artiste. Je réalise des œuvres d'art visuelles, des films, des peintures et des sculptures. Je viens de Cleveland, dans l'Ohio&nbsp;; mais je suis désormais un vrai New-yorkais.</p><p>&nbsp;</p><p><strong>Quelle difficulté, probablement ignorée du public, rencontrez-vous dans votre travail&nbsp;? </strong></p><p>Il n'existe aucune règle pour mouler ou créer la plupart de mes œuvres. &nbsp;La plupart des matériaux que j'utilise —&nbsp;le cristal, les cendres volcaniques —&nbsp;ne sont pas habituellement utilisés pour mouler ou créer des œuvres d'art. Ce ne sont pas des matériaux communs pour donner naissance à de nouvelles idées</p><p>&nbsp;</p>
                                    </div>
                                </div>
                                <div class="sqs-block quote-block sqs-block-quote" data-block-type="31" id="block-yui_3_17_2_3_1504126019030_5552">
                                    <div class="sqs-block-content">
                                        <figure>
                                            <blockquote>
                                                <span></span>Mon travail consiste principalement à transformer le quotidien.<span></span>
                                            </blockquote>

                                        </figure>
                                    </div>
                                </div-->
                                <?php
                                if (is_array($data)) {
                                    //print_r($data);
                                    $idx = 0;
                                    foreach ($data as $key => $item) {

                                        if ($item['template_type'] == "paragraph") {
                                            $idx++;
                                            ?>
                                            <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_3_1504126019030_5028">
                                                <div class="sqs-block-content">
                                                    <div class="blockquote-trigger trigger" data-target="<?php echo $idx; ?>"  style="<?php if ($idx == '1') {
                                    echo "margin:0; height:0;";
                                } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sqs-block image-block sqs-block-image sqs-text-ready" data-block-type="5" id="block-yui_3_17_2_5_1504192393030_8096">
                                                <div class="sqs-block-content" id="yui_3_17_2_1_1526119896883_108">
                                                    <div class="image-block-outer-wrapper layout-caption-below design-layout-inline sqs-narrow-width" id="yui_3_17_2_1_1526119896883_107">
                                                        <div class="intrinsic" style="max-width:700.0px;" id="yui_3_17_2_1_1526119896883_106">
                                                            <div style="padding-bottom: 149.571%; overflow: hidden;" class="image-block-wrapper   has-aspect-ratio" data-description="" id="yui_3_17_2_1_1526119896883_105">
                                                                <img class="thumb-image loaded is-loaded" data-src="<?php echo wp_get_attachment_image_src($item['media_id'], 'medium')[0]; ?>" data-image="<?php echo wp_get_attachment_image_src($item['media_id'], 'medium')[0]; ?>" data-image-dimensions="700x1047" data-image-focal-point="0.5,0.5" data-load="false" data-image-id="59aeb698893fc0f529ead2e6" data-type="image" data-position-mode="standard" alt="portrait-1.jpg" src="<?php echo wp_get_attachment_image_src($item['media_id'], 'medium')[0]; ?>" style="left: 0%; top: 0%; position: absolute;" data-image-resolution="1000w">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_3_1504126019030_7207">
                                                <div class="sqs-block-content"><?php
                                                    echo $item['text'];
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <!--div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_3_1504126019030_5028">
                                    <div class="sqs-block-content">
                                        <div class="blockquote-trigger trigger" data-target="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="sqs-block image-block sqs-block-image sqs-text-ready" data-block-type="5" id="block-yui_3_17_2_5_1504192393030_8096">
                                    <div class="sqs-block-content" id="yui_3_17_2_1_1526119896883_108">
                                        <div class="image-block-outer-wrapper layout-caption-below design-layout-inline sqs-narrow-width" id="yui_3_17_2_1_1526119896883_107">
                                            <div class="intrinsic" style="max-width:700.0px;" id="yui_3_17_2_1_1526119896883_106">
                                                <div style="padding-bottom: 149.571%; overflow: hidden;" class="image-block-wrapper   has-aspect-ratio" data-description="" id="yui_3_17_2_1_1526119896883_105">
                                                    <img class="thumb-image loaded is-loaded" data-src="https://static1.fr.squarespace.com/static/5134cbefe4b0c6fb04df8065/t/59aeb698893fc0f529ead2e6/1504622235432/portrait-1.jpg" data-image="https://static1.fr.squarespace.com/static/5134cbefe4b0c6fb04df8065/t/59aeb698893fc0f529ead2e6/1504622235432/portrait-1.jpg" data-image-dimensions="700x1047" data-image-focal-point="0.5,0.5" data-load="false" data-image-id="59aeb698893fc0f529ead2e6" data-type="image" data-position-mode="standard" alt="portrait-1.jpg" src="https://static1.fr.squarespace.com/static/5134cbefe4b0c6fb04df8065/t/59aeb698893fc0f529ead2e6/1504622235432/portrait-1.jpg?format=1000w" style="left: 0%; top: 0%; position: absolute;" data-image-resolution="1000w">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_3_1504126019030_7207">
                                    <div class="sqs-block-content"><p>&nbsp;</p><p><strong>Vous avez déjà écrit à propos d'architecture. Vous avez envie de nous en parler&nbsp;? </strong></p><p>Une grande partie de mon travail consiste à transformer le quotidien et à recréer des choses pour lesquelles les gens ont déjà des attentes. C'est comme ça que de nombreuses personnes apprennent à connaître mon travail, en y trouvant une familiarité dans les objets, les matériaux, qui sont ensuite transformés d'une façon différente.</p><p>&nbsp;</p><p><strong>Éprouvez-vous un engouement particulier pour le temps&nbsp;?</strong></p><p>Depuis que j'ai commencé, depuis que j'ai quitté l'école, j'ai une sorte d'obsession pour le temps dans le cadre de mon travail. Je laisse le temps flotter. C'est pourquoi je n'ai jamais intégré de chiffre à aucune de mes peintures&nbsp;; je n'ai jamais essayé de les lier à une période spécifique. Pour moi, laisser mes œuvres flotter dans le temps crée une atmosphère un peu mystérieuse. Une œuvre peut être contemporaine, mais elle peut aussi dater d'un millier d'années&nbsp;; elle peut être du passé. De la même manière que mon travail manipule l'architecture ou les différents matériaux, il manipule aussi le temps.</p>
                                    </div>
                                </div>
                                <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_3_1504131547882_6510">
                                    <div class="sqs-block-content">
                                        <div class="blockquote-trigger trigger" data-target="2">

                                        </div>

                                    </div>

                                </div>
                                <div class="sqs-block quote-block sqs-block-quote" data-block-type="31" id="block-yui_3_17_2_3_1504131547882_8455">
                                    <div class="sqs-block-content"><figure>
                                            <blockquote>
                                                <span></span>Le passé est plutôt subjectif... et le futur semble très mystérieux.<span></span>
                                            </blockquote>

                                        </figure>
                                    </div>
                                </div>
                                <div class="sqs-block image-block sqs-block-image sqs-text-ready" data-block-type="5" id="block-yui_3_17_2_5_1504192393030_9038">
                                    <div class="sqs-block-content" id="yui_3_17_2_1_1526119896883_133">
                                        <div class="image-block-outer-wrapper layout-caption-below design-layout-inline sqs-narrow-width" id="yui_3_17_2_1_1526119896883_132">
                                            <div class="intrinsic" style="max-width:700.0px;" id="yui_3_17_2_1_1526119896883_131">
                                                <div style="padding-bottom: 149.571%; overflow: hidden;" class="image-block-wrapper   has-aspect-ratio" data-description="" id="yui_3_17_2_1_1526119896883_130">
                                                    <img class="thumb-image loaded is-loaded" data-src="https://static1.fr.squarespace.com/static/5134cbefe4b0c6fb04df8065/t/59adee64cf81e0f6ca888c5b/1504570980889/" data-image="https://static1.fr.squarespace.com/static/5134cbefe4b0c6fb04df8065/t/59adee64cf81e0f6ca888c5b/1504570980889/" data-image-dimensions="700x1047" data-image-focal-point="0.5,0.5" data-load="false" data-image-id="59adee64cf81e0f6ca888c5b" data-type="image" data-position-mode="standard" src="https://static1.fr.squarespace.com/static/5134cbefe4b0c6fb04df8065/t/59adee64cf81e0f6ca888c5b/1504570980889/?format=1000w" style="left: 0%; top: 0%; position: absolute;" data-image-resolution="1000w">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_3_1504131547882_6578">
                                    <div class="sqs-block-content"><p><strong>Vous avez un point de vue intéressant sur le futur. Avez-vous une vision particulière du passé par rapport à ce point de vue&nbsp;? </strong></p><p>Le futur et le passé me semblent assez malléables. Le passé est plutôt subjectif&nbsp;: tout dépend de là où vous vous trouviez et de votre façon de vivre les choses. Le futur paraît mystérieux&nbsp;; mais le présent est le seul moment que nous pouvons vraiment connaître, qui semble réellement évident. J'aime beaucoup jouer avec cette confusion dans le temps.</p><p>&nbsp;</p><p><strong>Pouvez-vous nous expliquer ce qu'est une «&nbsp;Relique Future&nbsp;»&nbsp;?</strong></p><p>Pour moi, une relique future est un objet de notre présent qui a été reformé dans des matériaux que nous associons à une période géologique, comme la cendre volcanique et le cristal. C'est un objet du présent qui semble avoir été découvert dans le futur.</p><p>&nbsp;</p><p><strong>Avez-vous des souvenirs intimes de votre enfance qui se sont manifestés tout seuls dans votre travail&nbsp;?</strong></p><p>Je mets une attention particulière à sélectionner les objets, tout spécialement les objets iconiques, que je vais intégrer à mon travail. Cette sélection se fait de manière intentionnelle, afin de permettre à une grande partie du public d'entrer dans mon univers.&nbsp;Mes œuvres d'art fonctionnent à New York, à Tokyo, au Brésil... Je ne sais pas si cela est dû à la mondialisation mais certaines choses sont comprises par tout le monde, et c'est ce que je cherche.</p><p>&nbsp;</p><p><strong>Vous avez confié par le passé être daltonien. Comment cela affecte-t-il votre travail&nbsp;? </strong></p><p>Je sais que je suis daltonien depuis tout petit. Je n'ai jamais pensé que cela avait une influence quelconque sur mon travail, j'ai toujours fait ce que j'ai voulu faire. Mais cela a considérablement limité la palette que j'avais sélectionnée. Il y a quelques années, j'ai reçu des verres qui corrigent partiellement ma vision des couleurs, ce qui me permet de voir une gamme de couleurs beaucoup plus large. Je ne porte pas les lunettes en ce moment. J'ai arrêté de les porter régulièrement mais je les utilise comme un outil dans mon studio afin de trouver une vision plus objective. Grâce à elles, je peux voir ce que vous et la plupart des gens peuvent voir et, quand je les enlève, je vois à ma façon&nbsp;; ainsi j'ai les deux visions.</p>
                                    </div>
                                </div>
                                <div class="sqs-block quote-block sqs-block-quote" data-block-type="31" id="block-yui_3_17_2_3_1504131547882_9430">
                                    <div class="sqs-block-content"><figure>
                                            <blockquote>
                                                <span></span>Mon nouveau site Web doit pouvoir permettre aux visiteurs d'avoir une vision complète de mon&nbsp;travail.<span></span>
                                            </blockquote>

                                        </figure>
                                    </div>
                                </div>
                                <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_3_1504131547882_10628">
                                    <div class="sqs-block-content">
                                        <div class="blockquote-trigger trigger" data-target="3">

                                        </div>

                                    </div>

                                </div>
                                <div class="sqs-block image-block sqs-block-image sqs-text-ready" data-block-type="5" id="block-yui_3_17_2_5_1504192393030_10254">
                                    <div class="sqs-block-content" id="yui_3_17_2_1_1526119896883_150">
                                        <div class="image-block-outer-wrapper layout-caption-below design-layout-inline sqs-narrow-width" id="yui_3_17_2_1_1526119896883_149">
                                            <div class="intrinsic" style="max-width:700.0px;" id="yui_3_17_2_1_1526119896883_148">
                                                <div style="padding-bottom: 149.571%; overflow: hidden;" class="image-block-wrapper   has-aspect-ratio" data-description="" id="yui_3_17_2_1_1526119896883_147">              
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_3_1504131547882_9492">
                                    <div class="sqs-block-content">
                                        <p><strong>Souhaitez-vous que votre art soit accessible à tous&nbsp;? </strong></p><p>Je veux que mon travail soit vu et vécu par un maximum de personnes&nbsp;; j'ai envie qu'il soit très accessible.</p><p>&nbsp;</p><p><strong>Quelle est votre vision pour votre nouveau site Daniel Arsham&nbsp;?</strong></p><p>J'ai envie que mon nouveau site crée une véritable expérience. J'ai envie de créer un espace dans lequel les personnes qui connaissent déjà mon travail et celles qui ne le connaissent pas puissent se retrouver et avoir une vue d'ensemble de mon travail. Il existe de nombreux endroits très différents où voir mon travail,&nbsp;par exemple sur les réseaux sociaux et assurément dans une galerie ou un musée. Le site Web me permet de créer ma propre version, organisée comme je le souhaite, de mon travail. Je pense que c'est le seul endroit où je peux le contrôler de A à Z.</p>
                                    </div>
                                </div-->
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

    </section>
    <section id="workshop-product-partnership">
        <header class="woocommerce-products-header">
			<h1 class="woocommerce-products-header__title page-title" style="text-align:center;">Shop</h1>
	
	</header>
        <div class="container storefront-full-width-content">
		<div class="row ">

			<div class="wow fadeInLeft site-main" data-wow-delay="0.9s" style="">
				
                
    <!-- DISPLAY WORKSHOP PRODUCT PARTNERSHIP width: 100%;-->
    <?php
        $data = get_post_meta($post->ID, 'product_ids', true);
        $post_id = $post->ID;
        if(is_array($data)){                     
            woocommerce_product_loop_start();
            foreach ( $data as $product_id ) {
                global $product, $post; 
                $product = wc_get_product($product_id);
                $post = get_post($product_id);
                
                //wc_get_template( 'content-widget-product.php' );
                do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
                
            }
            woocommerce_product_loop_end();
        }
        
    ?>
        
      </div>
    </div>
    </div>
    </section>
    <?php 
        global $post;
        $data = get_post_meta($post_id, 'page_workshop_metadata', true);
        
    ?>
    <section id="workshop-metadata" style="height:50vh;">
        <div class="two-pans-container" style="
    width:  100%;
    position:  relative;
    display:  flex;
    height:  100%;
">
            <div class="two-pans-left-img" style="width:50%; background-image: url(<?php echo wp_get_attachment_image_src($data['media_id'], 'large')[0]; ?>); ">                
            </div>
            <div class="two-pans-right-text" style="width:50%;background-color: #eeeeee;color: black;flex-grow: 1;">
                <div class="section" style="width:100%;padding:  1em;margin-left:  auto;margin-right:  auto;">
                <?php
                echo isset($data['text']) ? $data['text'] : '';
                ?>
                </div>
            </div>
	</div>
    </section>
</div>

<script>
    jQuery( "#customers-individual" ).ready( function($) {
    var prevScrollY = 0;
    var currentScrollY = 0;
    var prevIndex = 0;
    var currentIndex = 1;

    function getMatchingIndex(scrollY) {
        var prevposition_bottom = 0;
        jQuery('.blockquote-trigger.trigger').each(function (idx, elt) {
            idx = jQuery(elt).data('target');
            prevTarget = jQuery('.blockquote-trigger.trigger[data-target="' + (idx - 1) + '"]');
            nextTarget = jQuery('.blockquote-trigger.trigger[data-target="' + (idx + 1) + '"]');
            var threshold_min = jQuery(elt).position().top + jQuery(elt).height();
            if (nextTarget.length == 0 && scrollY > threshold_min) {
                currentIndex = idx;
                return;
            } else if (prevTarget.length == 0 && scrollY < threshold_min) {
                currentIndex = idx;
                return;
            } else if (nextTarget.length == 0) {
                return;
            }
            var threshold_max = nextTarget.position().top + nextTarget.height();
            if (scrollY > threshold_min && scrollY <= threshold_max) {
                currentIndex = jQuery(elt).data('target');
            }
        });
        return currentIndex;
    }
    var thresholdY = null;
    function imageRound() {
        currentScrollY = window.innerHeight / 2 + window.scrollY;
        currentIndex = getMatchingIndex(currentScrollY);
        if (currentIndex !== prevIndex) {
            jQuery('.image-wrapper.is-loaded').removeClass('active');
            jQuery('.image-wrapper.is-loaded[data-arrival-index="' + currentIndex + '"]').addClass('active');
        }
        prevIndex = currentIndex;
        
        //if(thresholdY && thresholdY > window.scrollY) {
            thresholdY = null;
            jQuery('.image-gallery.trigger-target.desktop-only').removeClass('stop-fixed');            
        //}
        var bottom_image_gallery_offset = jQuery('.image-gallery.trigger-target.desktop-only').offset().top + jQuery('.image-gallery.trigger-target.desktop-only').height() + 108;
        var section_bottom_offset = jQuery('.qa.section.trigger').offset().top + jQuery('.qa.section.trigger').height();
        
        if(!thresholdY && bottom_image_gallery_offset >= section_bottom_offset) {
            jQuery('.image-gallery.trigger-target.desktop-only').addClass('stop-fixed');
            thresholdY = window.scrollY;
        }
        
    }
    
    window.addEventListener('scroll', function () {
        imageRound();
        
        
    });
    imageRound();
    });
</script>

<?php
get_footer();
