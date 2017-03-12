jQuery(document).ready(function () {
    //UpdateNewsletterField
    jQuery("#boletin-si").click(function(){
        sendNewsletterStatus(1);
    });

    jQuery("#boletin-no").click(function(){
        sendNewsletterStatus(0);
    });
});

function sendNewsletterStatus(value){
    jQuery.ajax({
        method: "POST",
        url: "/usuario/updateNewsletter",
        data: {'value_newsletter': value},
        success: function (result) {
 //           console.log("Guardado");
        }
    });
}