
(function($){

    /*
 * Ejemplo de config:
 * {
 *	total_pages_show: 5,
 * }
 *
 *Ejemplo de data:
 *{
 *	1: 'html de pag 1',
 *	2: 'html de pag 2',
 *	3: 'html de pag 3'
 *}
 */
    $.fn.pagerVermas = function(config){
        var idContainer = $(this).attr('id');
        var current_page = 1;
        var elContainer = $('#' + idContainer) ;
        if(config.total_pages > 0){
            var htmlPages = "<span id='"+idContainer+"-nums-container' ><span id='"+idContainer+"-nums-container-inner'>";
            var toPage = (config.total_pages < config.total_pages_show) ? config.total_pages : config.total_pages_show ;

            // Mostramos los números que se mostrarán.
            for(p=1; p<=toPage; p++){
                if(p==current_page){
                    htmlPages = htmlPages + "<li class='pag-current' ><span class='current-page'>"+ p +"</span></li>";
                }else{
                    htmlPages = htmlPages + "<li class='pag ' ><span class='page-click'>"+ p +"</span></li>";
                }
            }


            htmlPages = htmlPages + "</li><span></span></li>";
            htmlPages = htmlPages + "<li id='"+idContainer+"-pag-next' class='pag-next pag-control'><span class='page-click'>Siguiente</span></li>";

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

//            numsContainer.css({
//                'float':'left',
//                'height': '50px',
//                'overflow' : 'hidden',
//                'padding-top' : '15px',
//                'width' : '300px',
//                'position': 'relative'
//            });

//            numsContainerInner.css('position','absolute');
//            numsContainerInner.css('margin','7px 0');

            $('#' + idContainer + ' .pag span.page-click').click(function(){
                pagers_show( $(this).html() );
            });

            $('#' + idContainer + ' .pag-prev span.page-click').click(function(){
                pagers_show('prev');
            });

            $('#' + idContainer + ' .pag-next span.page-click').click(function(){
                pagers_show('next');
            });

            $('.pag-control span.page-click').bind('click', function(){
                var currentPosition = current_page -1;
                currentPosition = ($(this).attr('class')=='pag-next') ? currentPosition+1 : currentPosition-1;
                numsContainerInner.animate({
                    'marginLeft' : '-' + ( totalPagWidth * currentPosition)+'px'
                    });
            });
        }


        function pagers_show(pag){
            if(pag == 'next'){
                if( config.total_pages > current_page ){
                    update_elements( parseInt(current_page) + 1 );
                    var left = elContainer.scrollLeft() + 1;
                    elContainer.scrollLeft(left);
                }
            }
            if(pag == 'prev'){
                if(current_page > 1 ){
                    current_page--;
                    update_elements( current_page );
                }
            }
            if( pag >= 0  && config.total_pages >= pag ){
                update_elements(pag);
            }
            return true;
        }


        function update_elements(pag){
            var pag_axu=pag -1;
            window.location=config.url+'?page='+pag_axu;
        }
    };

})(jQuery);




