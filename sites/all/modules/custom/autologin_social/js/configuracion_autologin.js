/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function autologin_facebook(app,accion){ 
    this.app_facebook = app;
    this.accion  = accion;
    
    
    
     window.fbAsyncInit = function() {
            FB.init({
                appId: this.app_facebook,
                cookie: true, // enable cookies to allow the server to access 
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.0' // use version 2.0
            });        
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.            
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
        
        
        
        
        
        
        
        this.userConectadoFacebook = function (response) {
            var userID = response.authResponse.userID;      
            (function($) {              
                var post = {token: userID};
                var url = "/admin/config/autologin";
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: post,
                    success: function(data) {
                        if (data) {
                         this.avisoAutologueo('Te has conectado con tu facebook!!!');    
                          window.location = "/user";
                         
                        }else{
                              this.avisoAutologueo('no te encuentro en la base  !!!');   
                        } 
                    }
                });
            }(jQuery));

        }
        
        
        this.avisoAutologueo =  function (mensage){
        TINY.box.show({html:mensage,animate:true,close:true,mask:true,boxid:'success',autohide:5});    
        }



}
