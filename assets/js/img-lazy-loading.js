/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {
// Lazy-loading
$( window ).load(function() {    
    var idx = 0;
    $('.img-lazy-load').each(function(){
        var that = $(this);
        if(that.data('parent-id')) {
            $('#' + that.data('parent-id')).append('<img id="img_highQuality_' + idx + '" src="' + that.data('full-src') + '" style="display:none;">');
        }else {
            that.append('<img id="img_highQuality_' + idx + '" src="' + that.data('full-src') + '" style="display:none;">');
        }
        
        $("#img_highQuality_" + idx).off().on("load", function() { 
            if(!that.hasClass('no-background')) {
                that.css({
                    "background-image" : "url(" + $(this).attr('src') + ")"
                });
            }   
            if (that.attr('src') !== '') {
                that.attr('src',$(this).attr('src'));
            }            
        });
        idx++;
    });
});

var classNames = [];
if (navigator.userAgent.match(/(iPad|iPhone|iPod)/i)) classNames.push('device-ios');
if (navigator.userAgent.match(/android/i)) classNames.push('device-android');

var html = document.getElementsByTagName('html')[0];

if (classNames.length) classNames.push('on-device');
if (html.classList) html.classList.add.apply(html.classList, classNames);

}(jQuery));
