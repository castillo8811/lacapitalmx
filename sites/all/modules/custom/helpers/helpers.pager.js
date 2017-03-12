
(function($){

	function truncate(value,arg) {
		var value_arr = value.split(' ');
		if(arg < value_arr.length) {
			value = value_arr.slice(0,arg).join(' ');}
		return value;
	}

/*
 * Ejemplo de config:
 * {
 *	total_pages_show: 5,
 *	update_element: 'elementID'
 * }
 *
 *Ejemplo de data:
 *{
 *	1: 'html de pag 1',
 *	2: 'html de pag 2',
 *	3: 'html de pag 3'
 *}
 */
    $.fn.pager = function(config,data){
        var idContainer = $(this).attr('id');
        var	current_page = 1;
        config.total_pages = myCount(data);
        var elContainer = $('#' + idContainer) ;
        var weHaveData = (data != null);
        var lambda = function(){return true;}
        config.callback = (config.callback == null) ? lambda : config.callback ;
		if(config.total_pages > 0){
                    var htmlPages = "<span id='"+idContainer+"-pag-prev' class='pag-prev pag-control'>« Anterior</span>";
                    htmlPages = htmlPages + "<span id='"+idContainer+"-nums-container' ><span id='"+idContainer+"-nums-container-inner'>";
                    var toPage = (config.total_pages < config.total_pages_show) ? config.total_pages : config.total_pages_show ;

                    // Mostramos los números que se mostrarán.
                    for(p=1; p<=toPage; p++){
                        htmlPages = htmlPages + "<span class='pag " + ((p==current_page) ? 'pag-current' : '' ) + " " + config.update_element +  "' >"+ p +"</span>";
                    }

                    // Mostramos los números que no se mostrarán.
                    var hiddenHtmlPages  ='';
                    for(pHidden=toPage+1; pHidden<=config.total_pages; pHidden++){
                        hiddenHtmlPages = hiddenHtmlPages + "<span class='pag " + ((p==current_page) ? 'pag-current' : '' ) + " " + config.update_element +  "'>"+ pHidden +"</span>";
                    }

                    htmlPages = htmlPages + "</span></span>";
                    htmlPages = htmlPages + "<span id='"+idContainer+"-pag-next' class='pag-next pag-control'>Siguiente »</span>";

                    $(this).empty().html(htmlPages);


                    var numsContainer = $("#"+idContainer+"-nums-container");
                    var numsContainerInner = $('#' +idContainer+'-nums-container-inner');
                    var totalPagWidth = ( parseInt($('.pag').width()) + parseInt($('.pag').css('margin-left')) + parseInt($('.pag').css('margin-right')) );
                    var totalWidth = numsContainer.width();

                    totalWidth += parseInt(numsContainer.css("padding-left"), 10) + parseInt(numsContainer.css("padding-right"), 10); //Total Padding Width
                    totalWidth += parseInt(numsContainer.css("margin-left"), 10) + parseInt(numsContainer.css("margin-right"), 10); //Total Margin Width
                    totalWidth += parseInt(numsContainer.css("borderLeftWidth"), 10) + parseInt(numsContainer.css("borderRightWidth"), 10); //Total Border Width

                    var pag = $(".pag");
                    var totalHeight = pag.height() + parseInt(pag.css("padding-top"), 10) + parseInt(pag.css("padding-bottom"), 10)
                    totalHeight += parseInt(pag.css("margin-top"), 10) + parseInt(pag.css("margin-bottom"), 10); //Total Margin Width

                    numsContainer.css({
                        'float':'left',
                        'height': '30px',
                        'overflow' : 'hidden',
                        'width' : '150px',
                        'position': 'relative'
                    });

                    numsContainerInner.css('position','absolute');
                    numsContainerInner.css('margin','7px 0');
                    numsContainerInner.append(hiddenHtmlPages);

                            $('#' + idContainer + ' .pag').click(function(){
                                    pager_show( $(this).html() );
                            });

                            $('#' + idContainer + ' .pag-prev').click(function(){
                                    pager_show('prev');
                            });

                            $('#' + idContainer + ' .pag-next').click(function(){
                                    pager_show('next');
                            });
                    //Ver mas comentar (module-comentarios)
                            $('.boton-vermas').click(function(){
                                    var p=parseInt($(this).attr('id'));
                                    config.update_element='comentarios-mas-'+p;
                                    $(this).attr('id',p + 1);
                                    if ((p + 1)==config.total_pages){
                                        $('.boton-vermas').css({'display':'none'});
                                        }
                                    pager_show('next');
                            });

                    $('.pag-control').bind('click', function(){
                        var currentPosition = current_page -1;
                        currentPosition = ($(this).attr('class')=='pag-next') ? currentPosition+1 : currentPosition-1;
                        numsContainerInner.animate({'marginLeft' : '-' + ( totalPagWidth * currentPosition)+'px'});
                    });
			pager_show(current_page);
		}


		function pager_show(pag){
			if(pag == 'next'){
                            if( config.total_pages > current_page ){
                                update_element( parseInt(current_page) + 1 );
                                var left = elContainer.scrollLeft() + 1;
                                elContainer.scrollLeft(left);
                            }
			}
			if(pag == 'prev'){
                            if(current_page > 1 ){
                                current_page--;
                                update_element( current_page );
                            }
			}
                        if( pag >= 0  && config.total_pages >= pag ){
                            update_element(pag);
			}
                    return true;
		}

		function get_page(pag){
                    return data[pag];
		}

		function update_element(pag){
                    config.callback(pag,'#' + config.update_element);
                    if(weHaveData){
                        $('#' + config.update_element).empty().fadeIn().html(get_page(pag));
                    }
                    current_page = pag;
                    $('.' + config.update_element).each(function(){
                        if($(this).html() == current_page){
                            $(this).addClass('pag-current');
                        }else{
                            $(this).removeClass('pag-current');
                        }
                    });
		}
	};

})(jQuery);



/**
 *	Funcion que cuenta los elementos en un objeto que tenga los
 *	índices numéricos, como obj = {1: 'data en 1', 2:'data en 2', 3: 'data en 3'}
 *	Se utiliza principalmente en el plugin de pager :)
 */
    function myCount(arr){
        var total = 0;
            if(arr != null){
                for(n=1;n<=(n+1);n++){
                    if(arr[n] == null){
                        break;
                    }
                    total = n;
                }
            }
        return total;
    }


