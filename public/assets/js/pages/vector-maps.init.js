/*
Template Name: Nazox -  Admin & Dashboard Template
Author: Themesdesign
Contact: themesdesign.in@gmail.com
File: Vector Maps init Js File
*/

! function($) {
	"use strict";

	var VectorMap = function() {
	};

	VectorMap.prototype.init = function() {
		//various examples
		$('#world-map-markers').vectorMap({
			map : 'world_mill_en',
			normalizeFunction : 'polynomial',
			hoverOpacity : 0.7,
			hoverColor : false,
			regionStyle : {
				initial : {
					fill : '#d4dadd',
					center: [0.8, 117.6],
                    zoom: 50,
				}
			},
			 markerStyle: {
                initial: {
                    r: 9,
                    'fill': '#556ee6',
                    'fill-opacity': 0.9,
                    'stroke': '#fff',
                    'stroke-width' : 7,
                    'stroke-opacity': 0.4
                },
                hover: {
                    'stroke': '#fff',
                    'fill-opacity': 1,
                    'stroke-width': 1.5
                }
            },
			backgroundColor : 'transparent',
			markers : [{
				latLng : [0.510440, 101.438309],
				name : 'Pekanbaru'
			}, {
				latLng : [-0.942942, 100.371857],
				name : 'Padang'
			}, {
				latLng : [-5.450000, 105.266670],
				name : 'Lampung'
			}, {
				latLng : [-6.200000, 106.816666],
				name : 'Jakarta'
			}, {
				latLng : [-6.905977, 107.613144],
				name : 'Bandung'
			}, {
				latLng : [-6.966667, 110.416664],
				name : 'Semarang'
			}, {
				latLng : [-1.265386, 116.831200],
				name : 'Balikpapan'
			}, {
				latLng : [-2.2136, 113.9108],
				name : 'Palangkaraya'
			}, {
				latLng : [-0.502106, 117.153709],
				name : 'Samarinda'
			}, {
				latLng : [-5.135399, 119.423790],
				name : 'Makassar'
			}, {
				latLng : [-5.310289, 119.742604],
				name : 'Gowa'
			}, {
				latLng : [-3.87000000, 119.62000000],
				name : 'Pare-Pare'
			}, {
				latLng : [-2.53, 140.72],
				name : 'Jayapura'
			}, {
				latLng : [-8.499112, 140.404984],
				name : 'Merauke'
			}, {
				latLng : [-0.88, 131.26],
				name : 'Sorong'
			}],
        });
        
        $('#usa-vectormap').vectorMap({
    			map : 'us_merc_en',
    			backgroundColor : 'transparent',
    			regionStyle : {
    				initial : {
    					fill : '#556ee6'
    				}
    			}
        });
        
        $('#india-vectormap').vectorMap({
    			map : 'in_mill_en',
    			backgroundColor : 'transparent',
    			regionStyle : {
    				initial : {
    					fill : '#556ee6'
    				}
    			}
        });
        
        $('#australia-vectormap').vectorMap({
    			map : 'au_mill_en',
    			backgroundColor : 'transparent',
    			regionStyle : {
    				initial : {
    					fill : '#556ee6'
    				}
    			}
        });
        
        $('#chicago-vectormap').vectorMap({
    			map : 'us-il-chicago_mill_en',
    			backgroundColor : 'transparent',
    			regionStyle : {
    				initial : {
    					fill : '#556ee6'
    				}
    			}
        });
    
        $('#uk-vectormap').vectorMap({
    			map : 'uk_mill_en',
    			backgroundColor : 'transparent',
    			regionStyle : {
    				initial : {
    					fill : '#556ee6'
    				}
    			}
    		});
        
        $('#canada-vectormap').vectorMap({
    			map : 'ca_lcc_en',
    			backgroundColor : 'transparent',
    			regionStyle : {
    				initial : {
    					fill : '#556ee6'
    				}
    			}
        });
    
    	},
    	//init
    	$.VectorMap = new VectorMap, $.VectorMap.Constructor =
    	VectorMap
    }(window.jQuery),

//initializing
function($) {
	"use strict";
	$.VectorMap.init()
}(window.jQuery);