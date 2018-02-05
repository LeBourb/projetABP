<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

        <!-- Footer Section -->
        <style>
  
            
footer {
    padding: 100px 0;
}

footer .copyright {
    width: 333px;
    height: auto;
    margin-right: 50px;
    float: left;
}

footer .copyright .footer_logo {
    margin-bottom: 38px;
}

footer .copyright p {
    color: #8d8b8b;
    font-family: "raleway-regular",arial;
    font-size: 12px;
    letter-spacing: .5px;
    margin-bottom: 15px;
}

footer .copyright p a {
    text-decoration: none;
    font-family: "raleway-bold",arial;
    font-weight: bold;
    color: #8d8b8b;
}

footer .footer_links {
    display: flex;
    text-align: right;
    max-width: 100%;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 100%;
}

footer .footer_links .columns {
    width: 212px;    
    margin-right: 40px;
}

footer .footer_links .columns:last-child {
    /*margin-right: 0;*/
}

footer .footer_links .columns_title {
    color: #5e5e5e;
    font-family: "raleway-bold",arial;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 50px;
}

footer .footer_links ul li {
    list-style: none;
    display: block;
    margin-bottom: 30px;
}

footer .footer_links ul li a {
    text-decoration: none;
    color: #8c8b8b;
    font-family: "raleway-regular",arial;
    font-size: 14px;
    letter-spacing: .5px;
    transition: all .2s linear;
    -o-transition: all .2s linear;
    -moz-transition: all .2s linear;
    -webkit-transition: all .2s linear;
}

footer .footer_links ul li a:hover {
    color: #3c3c3c;
}

footer .sm ul li a:before {
    content: "";
    display: inline-block;
    width: 15px;
    margin-right: 20px;
}

footer .sm ul li .facebook:before {
    height: 14px;
    background: url('../img/fb.png') no-repeat;
    vertical-align: middle;
}

footer .sm ul li .twitter:before {
    height: 15px;
    background: url('../img/twitter.png') no-repeat;
    vertical-align: middle;
}

footer .sm ul li .google:before {
    height: 14px;
    background: url('../img/google.png') no-repeat;
    vertical-align: middle;
}

footer .address p {
    color: #8c8b8b;
    font-family: "raleway-regular",arial;
    font-size: 14px;
    margin-bottom: 30px;
    letter-spacing: .5px;
}

footer .address .phone {
    display: block;
    font-family: "raleway-bold",arial;
    font-weight: bold;
}
          
            
@media screen and (max-width:768px) {
    footer .footer_links {
        justify-content: flex-end;
    } 
    
}


        </style>
<footer class="clearfix">
    <div class="container">
        
       
        <div class="footer_links">
 
            <!-- Social Media Links  -->
            <div class="sm columns animated wow fadeInRight" data-wow-delay=".2s">
                <h3 class="columns_title">Stay Tuned</h3>
                <ul>
                    <li>
                        <a class="fa fa-facebook" href="#">Facebook</a>
                    </li>
                    <li>
                        <a class="fa fa-instagram" href="#">Instagram</a>
                    </li>
                </ul>
            </div>
 
            <!-- About Links  -->
            <div class="about columns animated wow fadeInRight" data-wow-delay=".3s">
                <h3 class="columns_title">About</h3>
                <ul>
                    <li>
                        <a href="#">Our Company</a>
                    </li>
                    <li>
                        <a href="#">Our Team</a>
                    </li>
                </ul>
            </div>
 
            <!-- Address  -->
            <div class="address columns animated wow fadeInRight" data-wow-delay=".4s">
                <h3 class="columns_title">Address</h3>
                <p>1012 14th Street Northwest</p>
                <p>GIFU, JAPAN 20005</p>
                <p class="email">pro.contact@atelierbourgeons.com</p>
            </div>
 
        </div>
        
         <!-- Copyrights  -->
        <div class="copyright animated wow fadeInUp">            
            <p>© 2018 copyright atelierbourgeons - All rights reserved</p>            
        </div>
        
 
    </div>
 
</footer><!-- end footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
