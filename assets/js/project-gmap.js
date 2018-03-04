/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(function() {
	function atelierBMap(inputMapElem, inputMapDefElem) {
		var defaultPos = new google.maps.LatLng(0, 0);
		var atelierBstyles = [{
			featureType: 'water',
			elementType: 'all',
			stylers: [{
				hue: '#d6d6d6'
			}, {
				saturation: -100
			}, {
				lightness: 33
			}, {
				visibility: 'on'
			}]
		}, {
			featureType: 'landscape',
			elementType: 'all',
			stylers: [{
				hue: '#062345'
			}, {
				saturation: 78
			}, {
				lightness: -83
			}, {
				visibility: 'simplified'
			}]
		}, {
			featureType: 'road',
			elementType: 'all',
			stylers: [{
				hue: '#062345'
			}, {
				saturation: 78
			}, {
				lightness: -83
			}, {
				visibility: 'off'
			}]
		}, {
			featureType: 'transit',
			elementType: 'all',
			stylers: [{
				hue: '#062345'
			}, {
				saturation: 78
			}, {
				lightness: -83
			}, {
				visibility: 'off'
			}]
		}, {
			featureType: 'poi',
			elementType: 'all',
			stylers: [{
				hue: '#062345'
			}, {
				saturation: 78
			}, {
				lightness: -83
			}, {
				visibility: 'off'
			}]
		}, {
			featureType: 'administrative.locality',
			elementType: 'labels',
			stylers: [{
				hue: '#062345'
			}, {
				saturation: 78
			}, {
				lightness: -83
			}, {
				visibility: 'off'
			}]
		}, {
			featureType: 'administrative',
			elementType: 'all',
			stylers: [{
				hue: '#062345'
			}, {
				saturation: 78
			}, {
				lightness: -83
			}, {
				visibility: 'off'
			}]
		}];
                var myLatlng = null;
                var zoom = 2;
                if($(inputMapDefElem).data('lat') != null && $(inputMapDefElem).data('lng') && $(inputMapDefElem).data('zoom')) {
                    myLatlng = new google.maps.LatLng($(inputMapDefElem).data('lat'), $(inputMapDefElem).data('lng'));
                    zoom = $(inputMapDefElem).data('zoom');
                }
		var myMapOptions = {
			zoom: zoom,
			center: myLatlng ? myLatlng : defaultPos,
			styles: atelierBstyles,
			mapTypeControl: false,
			streetViewControl: false,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.DEFAULT,
				position: google.maps.ControlPosition.LEFT_TOP
			},
			panControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var theMap = new google.maps.Map(inputMapElem, myMapOptions);                
  
                
		$(inputMapDefElem).find('li').each(function(idx, elt) {

			var boxText = document.createElement("div");
			boxText.style.cssText = "border: 1px solid #eeeeee; background: #ffffff; padding: 20px;";
			boxText.innerHTML = '<div class="gmap-box">' + jQuery(elt).html() + '</div>';
                        window.site_url = window.site_url ? window.site_url : '';
			var marker = new google.maps.Marker({
				map: theMap,
				position: new google.maps.LatLng(jQuery(elt).data('lat'), jQuery(elt).data('lng')),
				icon: window.site_url + "/wp-content/themes/atelierbourgeonspro/assets/images/icon/icon-" + jQuery(elt).data('type') + ".png",
				visible: true,
				ib: new InfoBox({
					content: boxText,
					disableAutoPan: false,
					maxWidth: 0,
					pixelOffset: new google.maps.Size(20, -40),
					zIndex: null,
					boxStyle: {
						width: "400px"
					},
					closeBoxMargin: "10px 10px 0 0",
					closeBoxURL: "//www.google.com/intl/en_us/mapfiles/close.gif",
					infoBoxClearance: new google.maps.Size(1, 1),
					isHidden: false,
					pane: "floatPane",
					enableEventPropagation: false
				})
			});

			google.maps.event.addListener(marker, "click", function(e) {
				this.ib.open(theMap, this);
			});
                        
                        

		});

	}

	window.atelierBMap = atelierBMap;
});