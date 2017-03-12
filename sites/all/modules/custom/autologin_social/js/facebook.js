
window.fbAsyncInit = function() {
    FB.init({
        appId: '1474840542761699',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.0' // use version 2.0
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.



//El auto login literalmente es descoemtado esto
    FB.getLoginStatus(function(response) {
        EstadoLoginAcciones(response);

    });


};
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/es_LA/sdk.js";//connect.facebook.net/es_LA/all.js#xfbml=1
    fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));


function EstadoLoginAcciones(response) {
    if (response.status === 'connected') {
    userConectadoFacebook();
    facebookAuthResponse(response);
    } else if (reponse.status === 'not_authorized') {


    } else {
        // se considerara estado unknown;  no esta conectado en facebook  
    }
}

function capturaDelEstatusLogin() {
    FB.getLoginStatus(function(response) {
        EstadoLoginAcciones(response);
    });
}
function logout_session_usuario_facebook() {
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.logout(function(response) {
                // si quieres poner algun accion para el deslogueo es aqui
            });
        }

    });


}

function datos_users_facebook() {
    FB.api('/me', function(response) {
        console.log(response);
    });
    FB.api(
    "/me/picture",
    function (response) {
      if (response && !response.error) {
   console.log(response.data.url);

      }
    }
);
}
function facebookAuthResponse(response){
    console.log(response.authResponse);   
}
/*
 * funciones debug
 */

function ventana_debug(mensaje) {
    document.getElementById('abajo').innerHTML = mensaje;

}

function insertarImagen(src){
var img = new Image();
var div = document.getElementById('abajo');
img.src =src; 
img.id = 'login_facebook';
div.appendChild(img);  
    
}
function remover_imagen(){
setTimeout(function(){
var element = document.getElementById("login_facebook");    
element.parentNode.removeChild(element);   
}, 2000);
    
}
function userConectadoFacebook(){

datos_users_facebook();


}
 /*****************************/