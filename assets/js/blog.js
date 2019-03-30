/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$(document).ready(function() {
window.onload = function() {    
    var onresize = function () {
        
        if($(window).width() < 768) {
            return;
        }
        
        $main = $('#main');
        $articles = $('#main').find('article');

        var col2 = false, middle = 0;
        var padding = 0;
        if(main.clientWidth > 768) {
            col2 = true;
            middle =  main.clientWidth/2;
            padding = 0.025 * main.clientWidth; 
        }
        else {
            padding = 0.05 * main.clientWidth;             
        }
        var nav_page = $('.navigation.pagination');
        var bottom_left=$main.position().top + 20, bottom_right = $main.position().top + 20;
        if($($articles[0]))
        var _isleft = true;
        $articles.each( function( idx ){

            var article = $($articles[idx]);

            article.show();
            if(col2)
                article.addClass('col-2');
            else
                article.removeClass('col-2');

            if(_isleft || !col2 ) {
                article.css( {
                    top: bottom_left, 
                    left: padding
                });
                bottom_left = bottom_left + article.height() + padding;
                _isleft = false;
                if(bottom_left > bottom_right) {
                    nav_page.css( {
                    top: bottom_left
                    });
                    $main.height(bottom_left);
                }
            }else {
                article.css( { 
                    top: bottom_right,
                    left: middle + padding/2
                });
                bottom_right = bottom_right + article.height() + padding;
                _isleft = true;
                if(bottom_right > bottom_left) {
                    nav_page.css( {
                    top: bottom_right
                    });
                    $main.height(bottom_right);
                }
            }        
        });
    };
    
    $(window).resize(onresize);
    onresize();
};

