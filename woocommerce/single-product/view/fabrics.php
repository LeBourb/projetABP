<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section id="products" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12 wow bounceIn">
				<div class="section-title">
					<h2>Fabrics</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<!-- Testimonial Owl Carousel section
			================================================== -->
			<div id="owl-products" class="owl-carousel">
                            
                            <?php                                 
                                $data = get_post_meta( $product->get_id(), 'product_fabrics', true );                                
                                if(is_array($data) && array_key_exists('product_fabric_id',$data)){
                                    $product_fabric_ids = $data['product_fabric_id'] ;    
                                    $index        = -1;                                    
                                    if($product_fabric_ids) {
                                        foreach ( $product_fabric_ids as $fabric_id ) {
                                            $index++;
                                            $image_attachment_id = null;
                                            $image_url = null;
                                            $price = null;
                                            $supplier = null;


                                            $image_attachment_id = get_post_meta( $fabric_id, 'image_attachment_id', true);
                                            $image_url = wp_get_attachment_image_src( $image_attachment_id, 'large' );
                                            $price = get_post_meta( $fabric_id, 'price_term', true);
                                            $supplier_id = get_post_meta( $fabric_id, 'supplier_id', true);
                                            $fabric = get_term_by('id', $fabric_id, 'pa_fabric');
                                                
                                            
                                            echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                                                    <div class="products-wrapper">
                                                        <img src="'. $image_url[0] . '" class="img-responsive" alt="products">
                                                        <div class="products-thumb">
                                                            <h3>' . $fabric->name . '</h3></a>  
                                                                <h4>' . $fabric->description . '</h4>
                                                                <p>Supplier: <a href="' . get_permalink($supplier_id) . '">' . get_the_title($supplier_id) . '</a></p>
                                                        </div>
                                                    </div>
                                                    </div>';
                                        }
                                    }
                                }
                                $data = get_post_meta( $product->get_id(), 'product_supplies', true );
                                if(is_array($data) && array_key_exists('product_supply_id',$data)){
                                    $product_supply_ids = $data['product_supply_id'] ;    
                                    $index        = -1;                                    
                                    if($product_supply_ids) {
                                        foreach ( $product_supply_ids as $supply_id ) {
                                            $index++;
                                            $image_attachment_id = null;
                                            $image_url = null;
                                            $price = null;
                                            $supplier = null;


                                            $image_attachment_id = get_post_meta( $supply_id, 'image_attachment_id', true);
                                            $image_url = wp_get_attachment_image_src( $image_attachment_id , 'large');
                                            $price = get_post_meta( $supply_id, 'price_term', true);
                                            $supplier_id = get_post_meta( $supply_id, 'supplier_id', true);
                                            $supply = get_term_by('id', $supply_id, 'pa_supply');
                                                
                                            
                                            echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                                                    <div class="products-wrapper">
                                                        <img src="'. $image_url[0] . '" class="img-responsive" alt="products">
                                                        <div class="products-thumb">
                                                            <h3>' . $supply->name . '</h3></a>  
                                                                <h4>' . $supply->description . '</h4>
                                                                <p>Supplier: <a href="' . get_permalink($supplier_id) . '">' . get_the_title($supplier_id) . '</a></p>
                                                        </div>
                                                    </div>
                                                    </div>';
                                        }
                                    }
                                }
                            ?>

				
			</div>

		</div>
	</div>
</section>
    