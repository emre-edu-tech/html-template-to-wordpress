(function($){
	"use strict";

	$(document).ready(function(){

		// Home 1
		$('#slider-1').revolution({
			sliderLayout:"fullscreen",
			delay:12000,
			responsiveLevels:[4096,1024,778,420],
			gridwidth:[1200,1024,778,410],
			gridheight:600,
			hideThumbs:10,
			fullScreenAutoWidth: "on",
			fullScreenOffsetContainer: ".nav, .rev-offset",

			navigation: {
				onHoverStop: "off",

				touch: {
					touchenabled: "on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				},
				arrows:{
					enable:true,
					style: "hermes",
					tmp: '<div class="tp-arr-allwrapper">  <div class="tp-arr-imgholder"></div> <div class="tp-arr-titleholder">{{title}}</div> </div>',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					}
				},
				bullets:{
					style:"",
					enable:false,
					hide_onmobile:false,
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1200,
					hide_under:0,
					hide_over:9999, 
					direction:"horizontal",
					space:12,       
					h_align:"center",
					v_align:"bottom",
					h_offset:0,
					v_offset:30,
					tmp: ''
				},
			},

			parallax:{
				type:"scroll",
				levels:[5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85],
				origo:"enterpoint",
				speed:400,
				bgparallax:"on",
				disable_onmobile:"on"
			},

			spinner:"spinner4"
		});

		// Home 2
		$('#slider-2').revolution({
			sliderLayout:"auto",
			sliderType: "hero",
			delay:12000,
			responsiveLevels:[4096,1024,778,420],
			gridwidth:[1200,1024,778,410],
			gridheight: [900, 760, 600, 460],
			minHeight: 300,

			hideThumbs:10,
			fullScreenAutoWidth: "on",

			navigation: {
				onHoverStop: "off",

				touch: {
					touchenabled: "on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				},
				arrows:{
					enable:true,
					style: "hermes",
					tmp: '<div class="tp-arr-allwrapper">  <div class="tp-arr-imgholder"></div> <div class="tp-arr-titleholder">{{title}}</div> </div>',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					}
				},
				bullets:{
					style:"",
					enable:false,
					hide_onmobile:false,
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1200,
					hide_under:0,
					hide_over:9999, 
					direction:"horizontal",
					space:12,       
					h_align:"center",
					v_align:"bottom",
					h_offset:0,
					v_offset:30,
					tmp: ''
				},
			},

			parallax:{
				type:"scroll",
				levels:[5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85],
				origo:"enterpoint",
				speed:400,
				bgparallax:"on",
				disable_onmobile:"on"
			},

			spinner:"spinner4"
		});

		// Home 3
		$('#slider-3').revolution({
			sliderLayout:"fullscreen",
			delay:12000,
			responsiveLevels:[4096,1024,778,420],
			gridwidth:[1200,1024,778,410],
			gridheight:600,
			hideThumbs:10,
			fullScreenAutoWidth: "on",

			navigation: {
				onHoverStop: "off",

				touch: {
					touchenabled: "on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				},
				arrows:{
					enable:false,
					style: "hermes",
					tmp: '<div class="tp-arr-allwrapper">  <div class="tp-arr-imgholder"></div> <div class="tp-arr-titleholder">{{title}}</div> </div>',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					}
				},
				bullets:{
					style:"",
					enable:true,
					hide_onmobile:false,
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1200,
					hide_under:0,
					hide_over:9999, 
					direction:"vertical",
					space:18,       
					h_align:"right",
					v_align:"center",
					h_offset:40,
					v_offset:0,
					tmp: ''
				},
			},

			parallax:{
				type:"scroll",
				levels:[5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85],
				origo:"enterpoint",
				speed:400,
				bgparallax:"on",
				disable_onmobile:"on"
			},

			spinner:"spinner4"
		});

		// Home 4
		$('#slider-4').revolution({
			sliderLayout:"fullscreen",
			delay:12000,
			responsiveLevels:[4096,1024,778,420],
			gridwidth:[1200,1024,778,410],
			gridheight:600,
			hideThumbs:10,
			fullScreenAutoWidth: "on",
			fullScreenOffsetContainer: ".nav, .footer",

			navigation: {
				onHoverStop: "off",

				touch: {
					touchenabled: "on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				},
				arrows:{
					enable:false,
					style: "hermes",
					tmp: '<div class="tp-arr-allwrapper">  <div class="tp-arr-imgholder"></div> <div class="tp-arr-titleholder">{{title}}</div> </div>',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 0,
						v_offset: 0
					}
				},
				bullets:{
					style:"",
					enable:true,
					hide_onmobile:false,
					hide_onleave:true,
					hide_delay:200,
					hide_delay_mobile:1200,
					hide_under:0,
					hide_over:9999, 
					direction:"vertical",
					space:18,       
					h_align:"right",
					v_align:"center",
					h_offset:40,
					v_offset:0,
					tmp: ''
				},
			},

			parallax:{
				type:"scroll",
				levels:[5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85],
				origo:"enterpoint",
				speed:400,
				bgparallax:"on",
				disable_onmobile:"on"
			},

			spinner:"spinner4"
		});


	});

})(jQuery);