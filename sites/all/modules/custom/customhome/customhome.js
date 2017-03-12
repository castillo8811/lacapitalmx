jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

jQuery(document).ready(function(){
    
    jQuery("#customhome-wrapper tbody").sortable().disableSelection();
    jQuery("#customhome-wrapper tbody").each(function(){
        jQuery(this).bind("sortstop", function(event, ui) {
            bloque=jQuery(this).find("select");
            bloque.each(function(i){
                jQuery(this).val(i);
            });
            id=jQuery(this).find("a");
            id.each(function(i){
                jQuery(this).attr('href',jQuery(this).attr('href') + '&id=' + i);
            });
        });
    });
    
    
    jQuery('.error').show();
    jQuery('.error').css('display','block');
});


