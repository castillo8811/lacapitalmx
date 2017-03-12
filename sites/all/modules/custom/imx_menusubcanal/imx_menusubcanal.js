//jQuery('document').ready(function(){
//    jQuery("ul.MenuCategorias li").each(function(){
//        if(jQuery(this).hasClass('current')){
//            sitio = jQuery(this).children().attr('id');
//            switch(sitio){
//                case "celebridades":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -91px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"0px -587px"
//                    });
//                    break;
//                case "moda":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -186px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-120px -452px"
//                    });
//                    break;
//                case "belleza":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -281px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-19px -329px"
//                    });
//                    break;
//                case "sexualidad":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -375px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-87px -863px"
//                    });
//                    break;	
//                case "tecnologia":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -476px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-177px -714px"
//                    });
//                    break;	
//                case "guia":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -570px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-119px -209px"
//                    });
//                    break;	
//                case "hogar":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -665px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-27px -44px"
//                    });
//                    break;
//                default:
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px 4px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-34px -1016px"
//                    });
//                    break;
//            }
//        }
//        jQuery(this).mouseover(function(){
//            var site = jQuery(this).children().attr('id');
//            switch(site){
//                case "home":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px 4px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-34px -1016px"
//                    }).fadeIn(350);
//                    break;
//                case "celebridades":
//                    //factor=factor+95 aqui se incrementa.. 
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -91px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -587px"
//                    }).fadeIn(350);
//                    break;
//                case "moda":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -186px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-120px -452px"
//                    }).fadeIn(350);
//                    break;
//                case "belleza":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -281px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-19px -329px"
//                    }).fadeIn(350);
//                    break;
//                case "sexualidad":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -375px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-87px -863px"
//                    }).fadeIn(350);
//                    break;	
//                case "tecnologia":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -476px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-177px -714px"
//                    }).fadeIn(350);
//                    break;	
//                case "guia":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -570px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-119px -209px"
//                    }).fadeIn(350);
//                    break;	
//                case "hogar":
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px -665px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-27px -44px"
//                    }).fadeIn(350);
//                    break;
//                default:
//                    jQuery("#logo_actitudfem").stop(false, true).fadeOut(0).css({
//                        "background-position":"0px 4px"
//                    }).fadeIn(350);
//                    jQuery("#logo_actitudfemOct").stop(false, true).fadeOut(0).css({
//                        "background-position":"-34px -1016px"
//                    }).fadeIn(350);
//                    break;
//            }
//        });
//        jQuery(this).mouseout(function(){
//            sitio = jQuery('ul.MenuCategorias li.current span').attr('id');
//            switch(sitio){
//                case "celebridades":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -91px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"0px -587px"
//                    });
//                    break;
//                case "moda":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -186px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-120px -452px"
//                    });
//                    break;
//                case "belleza":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -281px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-19px -329px"
//                    });
//                    break;
//                case "sexualidad":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -375px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-87px -863px"
//                    });
//                    break;	
//                case "tecnologia":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -476px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-177px -714px"
//                    });
//                    break;	
//                case "guia":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -570px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-119px -209px"
//                    });
//                    break;	
//                case "hogar":
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px -665px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-27px -44px"
//                    });
//                    break;
//                default:
//                    jQuery("#logo_actitudfem").css({
//                        "background-position":"0px 4px"
//                    });
//                    jQuery("#logo_actitudfemOct").css({
//                        "background-position":"-34px -1016px"
//                    });
//                    break;
//            }
//        });
//    });
//});        