<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script>
    window.site_url="<?php echo get_site_url(); ?>";
</script>

		<h1>Carte des revendeurs</h1>

		<ul id="points" data-lat="35.652832" data-lng="139.839478" data-zoom="6">
                   <?php  $args = array( 'post_type' => 'shop_reseller' );
        $resellers = get_posts( $args ); 
            foreach($resellers as $reseller) {                              
                $data = get_post_meta(  $reseller->ID, 'gmp_arr', true );
                                    
            
    ?>

                    <li data-type="matiere-premiere" data-lat="<?php echo $data['gmp_lat']?>" data-lng="<?php echo $data['gmp_long']?>">
					<strong><?php get_the_title();?></strong> 
											<h2>Vendeur responsable</h2>
										<div class="clearfix media">
                                                                                    <?php echo get_the_post_thumbnail( $reseller->ID, 'thumbnail' ); ?>						<div class="media">
							<p><?php echo the_excerpt($reseller->ID); ?></p>
<p>&nbsp;</p>
<p><em></em>Disponible dans sa boutique:</p>
<ul>
<li>W18: Robes du soir</li>
<li>W18: Pull super</li>
<li>W18: Jupe trop chouette</li>
</ul>
<p><em></em>Adresse de sa boutique:</p>

<p><?php  echo $data['gmp_address1'];?></p>
<p><?php  echo $data['gmp_city'];?></p>
<p><?php  echo $data['gmp_state'];?></p>
<p><?php  echo $data['gmp_zip'];?></p>


<p><a href="<?php echo get_permalink($reseller->ID); ?>">En savoir plus</a></p>
						</div>
					</div>
				</li>
                                
                            <?php }   ?>
                </ul>

		<div class="clearfix">
			<div class="span10" style="margin-left:0;">
				<div id="map"></div>
			</div><!-- .span10 -->
			<div class="span2">
				<strong class="legend-title">Légende</strong>
				<ul class="legend-list">
                                    <li><img src="<?php echo get_site_url(); ?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/icon-design-small.png" /> Physical Shops</li>
                                </ul>
			</div><!-- .span2 -->
		</div><!-- .clearfix -->

