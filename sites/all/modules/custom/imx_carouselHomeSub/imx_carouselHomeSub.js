$(document).ready(function(){
    //    $("#pikame").PikaChoose({
    //        transition:[0],
    //        hoverPause:true,
    //        text: {
    //            previous: "", 
    //            next: "" 
    //        }
    //    });
    jQuery('.slider-list').bxSlider({
        auto: true,
        pause: 6000,
        mode: 'fade',
        captions: true,
        pagerCustom: '#slider-thumbs',
        controls: false
    });
});

//
////$(document).ready(function() {
//    //    $('#carouselslider').PikaChoose({text: {previous: "", next: "" }});
//
////    $('#slider').nivoSlider({
////        effect: 'fade',
////        slices: 15,
////        boxCols: 8,
////        boxRows: 4,
////        animSpeed: 500,
////        pauseTime: 6000,
////        startSlide: 0,
////        directionNav: false,
////        controlNav: true,
////        controlNavThumbs: true,
////        pauseOnHover: true,
////        manualAdvance: false,
////        prevText: 'Prev',
////        nextText: 'Next',
////        randomStart: false,
////        beforeChange: function(){},
////        afterChange: function(){},
////        slideshowEnd: function(){},
////        lastSlide: function(){},
////        afterLoad: function(){}
////    });
//
//    $('#slider').nivoSlider({
//        effect:'fade', // Specify sets like: 'fold,fade,sliceDown'
//        slices:15, // For slice animations
//        boxCols: 8, // For box animations
//        boxRows: 4, // For box animations
//        animSpeed:500, // Slide transition speed
//        pauseTime:6000, // How long each slide will show
//        startSlide:0, // Set starting Slide (0 index)
//        directionNav:false, // Next & Prev navigation
//        directionNavHide:true, // Only show on hover
//        controlNav:true, // 1,2,3... navigation280280
//        controlNavThumbs:true, // Use thumbnails for Control Nav
//        controlNavThumbsFromRel:false, // Use image rel for thumbs
//        controlNavThumbsSearch: '.jpg', // Replace this with...
//        controlNavThumbsReplace: '.jpg', // ...this in thumb Image src
//        keyboardNav:true, // Use left & right arrows
//        pauseOnHover:false, // Stop animation while hovering
//        manualAdvance:false, // Force manual transitions
//        //captionOpacity:0.5, // Universal caption opacity
//        prevText: 'Prev', // Prev directionNav text
//        nextText: 'Next', // Next directionNav text
//        beforeChange: function(){}, // Triggers before a slide transition
//        afterChange: function(){}, // Triggers after a slide transition
//        slideshowEnd: function(){}, // Triggers after all slides have been shown
//        lastSlide: function(){}, // Triggers when last slide is shown
//        afterLoad: function(){} // Triggers when slider has loaded
//    });
//
///*         sliceDown
//           sliceDownLeft
//           sliceUp
//           sliceUpLeft
//           sliceUpDown
//           sliceUpDownLeft
//           fold
//           fade
//           random
//           slideInRight
//           slideInLeft
//           boxRandom
//           boxRain
//           boxRainReverse
//   */
//});