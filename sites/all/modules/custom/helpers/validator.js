var valida={
	_nKeypress : window.Event ? true : false,
	entero : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 || (key >= 48 && key <= 57));
	},
	flotante : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
	},
	first_name:function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key ==32));
	},
	alfanumerico : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 12 || (key >= 48 && key <= 57) || ((key >= 65 && key <= 90) || (key >= 97 && key <= 122)) || (key==193 || key==201 || key==205 || key==209 || key==211 || key==218 || key==225 || key==233 || key==237 || key==241 || key==243 || key==250 || key==95 || key==45));
	},
	string_email : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key==64 || key==46 || key==45 || key==95));
	},
        nickname : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key==64 || key==46 || key==45));
	},
	alfanumericosignos : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key >= 40 && key <= 47) || (key==32 || key==38 || key==58 || key==59 || key==64 || key==91 || key==92 || key==93 || key==95));
	},
        password : function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key >= 40 && key <= 47) || (key==32 || key==38 || key==58 || key==59 || key==64 || key==91 || key==92 || key==93 || key==95 || key==36 || key==33 || key==126|| key==35 || key==37 || key==94  || key==61 || key==123 || key==125 || key==124 || key==63 || key==164));
	},
	alfanumericosignos_sinenter: function(evt){
		var key = this._nKeypress ? evt.which : evt.keyCode;
		return (key <= 12 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key >= 40 && key <= 47) || (key==32 || key==38 || key==58 || key==59 || key==64 || key==91 || key==92 || key==93 || key==95));
	},
	email : function(str_email){
		var filtrar=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/;
		if (filtrar.test(str_email)){
			return true;
		}else{
			return false;
		}
	}

};

var capslock = {
  init: function() {
    if (!document.getElementsByTagName) {
      return;
    }
    // Find all password fields in the page, and set a keypress event on them
    var inps = document.getElementsByTagName("input");
    for (var i=0, l=inps.length; i<l; i++) {
      if (inps[i].type == "password") {
        capslock.addEvent(inps[i], "keypress", capslock.keypress);
      }
    }
  },
  addEvent: function(obj,evt,fn) {
    if (document.addEventListener) {
      capslock.addEvent = function (obj,evt,fn) {
        obj.addEventListener(evt,fn,false);
      };
      capslock.addEvent(obj,evt,fn);
    } else if (document.attachEvent) {
      capslock.addEvent = function (obj,evt,fn) {
        obj.attachEvent('on'+evt,fn);
      };
      capslock.addEvent(obj,evt,fn);
    } else {
      // no support for addEventListener *or* attachEvent, so quietly exit
    }
  },
  keypress: function(e) {
    var ev = e ? e : window.event;
    if (!ev) {
      return;
    }
    var targ = ev.target ? ev.target : ev.srcElement;
    // get key pressed
    var which = -1;
    if (ev.which) {
      which = ev.which;
    } else if (ev.keyCode) {
      which = ev.keyCode;
    }
    // get shift status
    var shift_status = false;
    if (ev.shiftKey) {
      shift_status = ev.shiftKey;
    } else if (ev.modifiers) {
      shift_status = !!(ev.modifiers & 4);
    }
    if (((which >= 65 && which <=  90) && !shift_status) ||
        ((which >= 97 && which <= 122) && shift_status)) {
      // uppercase, no shift key
      capslock.show_warning(targ);
    } else {
      capslock.hide_warning(targ);
    }
  },

  show_warning: function(targ) {
    if (!targ.warning) {
      targ.warning = document.createElement('img');
      targ.warning.src = "/sites/media/img/bloq-mayusc-activado.png";
      targ.warning.style.position = "absolute";
      targ.warning.style.top = (targ.offsetTop + 90) + "px";
      targ.warning.style.left = (targ.offsetLeft + targ.offsetWidth + 325 ) + "px";
      targ.warning.style.zIndex = "999";
      targ.warning.setAttribute("alt", "Bloque de mayúsculas activado");
	  targ.warning.setAttribute("title", "Bloque de mayúsculas activado");
      if (targ.warning.runtimeStyle) {
        // PNG transparency for IE
        targ.warning.runtimeStyle.filter +=
"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/sites/media/img/bloq-mayusc-activado.png',sizingMethod='scale')";
      }
      document.body.appendChild(targ.warning);
    }
  },
  hide_warning: function(targ) {
    if (targ.warning) {
      targ.warning.parentNode.removeChild(targ.warning);
      targ.warning = null;
    }
  }
};

(function(i) {var u =navigator.userAgent;var e=/*@cc_on!@*/false; var st =
setTimeout;if(/webkit/i.test(u)){st(function(){var dr=document.readyState;
if(dr=="loaded"||dr=="complete"){i()}else{st(arguments.callee,10);}},10);}
else if((/mozilla/i.test(u)&&!/(compati)/.test(u)) || (/opera/i.test(u))){
document.addEventListener("DOMContentLoaded",i,false); } else if(e){     (
function(){var t=document.createElement('doc:rdy');try{t.doScroll('left');
i();t=null;}catch(e){st(arguments.callee,0);}})();}else{window.onload=i;}})(capslock.init);

var cookie={
	nombre	: '',
	valor	: '',
	vigencia: '',
	crear	: function(){
		this.nombre=arguments[0];
		this.valor=base64.encode(arguments[1]);
		this.vigencia=arguments[2];
		if (this.vigencia){
			var fecha = new Date();
			fecha.setTime(fecha.getTime()+(this.vigencia*24*60*60*1000));
			var expires="; expires="+fecha.toGMTString();
		}else{
			var expires = "";
		}
		document.cookie = this.nombre+"="+this.valor+expires+"; path=/";
	},
	leer	: function(){
		this.nombre=arguments[0];
		var nombre_cookie=this.nombre+"=";
		var contenido_cookie=document.cookie.split(';');
		for(i=0;i<contenido_cookie.length;i++){
			var elemento_cookie=contenido_cookie[i];
			while(elemento_cookie.charAt(0)==' '){
				elemento_cookie=elemento_cookie.substring(1,elemento_cookie.length);
			}
			if(elemento_cookie.indexOf(nombre_cookie)==0){
				return base64.decode(elemento_cookie.substring(nombre_cookie.length,elemento_cookie.length));
			}
		}
		return null;
	},
	borrar	: function(){
		this.nombre=arguments[0];
		this.crear(this.nombre,"",-1);
	}
};
var base64 = {
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
		//input = base64._replacement_encode(input);
		input = base64._utf8_encode(input);
		while (i < input.length) {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
			if (isNaN(chr2)){
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)){
				enc4 = 64;
			}
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
		}
		return output;
	},
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		while (i < input.length) {
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
			output = output + String.fromCharCode(chr1);
			if (enc3 != 64){
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64){
				output = output + String.fromCharCode(chr3);
			}
		}
		output = base64._utf8_decode(output);
		//output = base64._replacement_decode(output);
		return output;
	},
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++){
			var c = string.charCodeAt(n);
			if (c < 128){
				utftext += String.fromCharCode(c);
			}else if((c > 127) && (c < 2048)){
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}else{
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
		}
		return utftext;
	},
	_utf8_decode : function (utftext){
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ){
			c = utftext.charCodeAt(i);
			if (c < 128){
				string += String.fromCharCode(c);
				i++;
			}else if((c > 191) && (c < 224)){
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}else{
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
		}
		return string;
	},
	_replacement_encode : function(texto){
		var strcode="";
		var char='';
		var charcode='';
		for(i=0;i<texto.length;i++){
			char=texto.charCodeAt(i);
			charcode=String.fromCharCode(char+3);
			strcode=strcode+charcode;
		}
		return strcode;
	},
	_replacement_decode : function(texto){
		var strdecode="";
		var char='';
		var charcode='';
		for(i=0;i<texto.length;i++){
			char=texto.charCodeAt(i);
			charcode=String.fromCharCode(char-3);
			strdecode=strdecode+charcode;
		}
		return strdecode;
	}
}

var baseMD5 = {
	hexcase : 0,
	chrsz   : 8,
	string_md5 : "",
	encode : function(texto){
		return this.hex_md5(this.string_md5 + texto);
	},
	hex_md5 : function(s){
		return this.binl2hex(this.core_md5(this.str2binl(s), s.length * this.chrsz));
	},
	binl2hex : function(binarray){
		var hex_tab = this.hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
		var str = "";
		for(var i = 0; i < binarray.length * 4; i++)
		{
			str += hex_tab.charAt((binarray[i>>2] >> ((i%4)*8+4)) & 0xF) + hex_tab.charAt((binarray[i>>2] >> ((i%4)*8  )) & 0xF);
		}
		return str;
	},
	core_md5 : function(x, len){
		x[len >> 5] |= 0x80 << ((len) % 32);
		x[(((len + 64) >>> 9) << 4) + 14] = len;
		var a =  1732584193;
		var b = -271733879;
		var c = -1732584194;
		var d =  271733878;
		for(var i = 0; i < x.length; i += 16){
			var olda = a;
			var oldb = b;
			var oldc = c;
			var oldd = d;
			a = this.md5_ff(a, b, c, d, x[i+ 0], 7 , -680876936);
			d = this.md5_ff(d, a, b, c, x[i+ 1], 12, -389564586);
			c = this.md5_ff(c, d, a, b, x[i+ 2], 17,  606105819);
			b = this.md5_ff(b, c, d, a, x[i+ 3], 22, -1044525330);
			a = this.md5_ff(a, b, c, d, x[i+ 4], 7 , -176418897);
			d = this.md5_ff(d, a, b, c, x[i+ 5], 12,  1200080426);
			c = this.md5_ff(c, d, a, b, x[i+ 6], 17, -1473231341);
			b = this.md5_ff(b, c, d, a, x[i+ 7], 22, -45705983);
			a = this.md5_ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
			d = this.md5_ff(d, a, b, c, x[i+ 9], 12, -1958414417);
			c = this.md5_ff(c, d, a, b, x[i+10], 17, -42063);
			b = this.md5_ff(b, c, d, a, x[i+11], 22, -1990404162);
			a = this.md5_ff(a, b, c, d, x[i+12], 7 ,  1804603682);
			d = this.md5_ff(d, a, b, c, x[i+13], 12, -40341101);
			c = this.md5_ff(c, d, a, b, x[i+14], 17, -1502002290);
			b = this.md5_ff(b, c, d, a, x[i+15], 22,  1236535329);
			a = this.md5_gg(a, b, c, d, x[i+ 1], 5 , -165796510);
			d = this.md5_gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
			c = this.md5_gg(c, d, a, b, x[i+11], 14,  643717713);
			b = this.md5_gg(b, c, d, a, x[i+ 0], 20, -373897302);
			a = this.md5_gg(a, b, c, d, x[i+ 5], 5 , -701558691);
			d = this.md5_gg(d, a, b, c, x[i+10], 9 ,  38016083);
			c = this.md5_gg(c, d, a, b, x[i+15], 14, -660478335);
			b = this.md5_gg(b, c, d, a, x[i+ 4], 20, -405537848);
			a = this.md5_gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
			d = this.md5_gg(d, a, b, c, x[i+14], 9 , -1019803690);
			c = this.md5_gg(c, d, a, b, x[i+ 3], 14, -187363961);
			b = this.md5_gg(b, c, d, a, x[i+ 8], 20,  1163531501);
			a = this.md5_gg(a, b, c, d, x[i+13], 5 , -1444681467);
			d = this.md5_gg(d, a, b, c, x[i+ 2], 9 , -51403784);
			c = this.md5_gg(c, d, a, b, x[i+ 7], 14,  1735328473);
			b = this.md5_gg(b, c, d, a, x[i+12], 20, -1926607734);
			a = this.md5_hh(a, b, c, d, x[i+ 5], 4 , -378558);
			d = this.md5_hh(d, a, b, c, x[i+ 8], 11, -2022574463);
			c = this.md5_hh(c, d, a, b, x[i+11], 16,  1839030562);
			b = this.md5_hh(b, c, d, a, x[i+14], 23, -35309556);
			a = this.md5_hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
			d = this.md5_hh(d, a, b, c, x[i+ 4], 11,  1272893353);
			c = this.md5_hh(c, d, a, b, x[i+ 7], 16, -155497632);
			b = this.md5_hh(b, c, d, a, x[i+10], 23, -1094730640);
			a = this.md5_hh(a, b, c, d, x[i+13], 4 ,  681279174);
			d = this.md5_hh(d, a, b, c, x[i+ 0], 11, -358537222);
			c = this.md5_hh(c, d, a, b, x[i+ 3], 16, -722521979);
			b = this.md5_hh(b, c, d, a, x[i+ 6], 23,  76029189);
			a = this.md5_hh(a, b, c, d, x[i+ 9], 4 , -640364487);
			d = this.md5_hh(d, a, b, c, x[i+12], 11, -421815835);
			c = this.md5_hh(c, d, a, b, x[i+15], 16,  530742520);
			b = this.md5_hh(b, c, d, a, x[i+ 2], 23, -995338651);
			a = this.md5_ii(a, b, c, d, x[i+ 0], 6 , -198630844);
			d = this.md5_ii(d, a, b, c, x[i+ 7], 10,  1126891415);
			c = this.md5_ii(c, d, a, b, x[i+14], 15, -1416354905);
			b = this.md5_ii(b, c, d, a, x[i+ 5], 21, -57434055);
			a = this.md5_ii(a, b, c, d, x[i+12], 6 ,  1700485571);
			d = this.md5_ii(d, a, b, c, x[i+ 3], 10, -1894986606);
			c = this.md5_ii(c, d, a, b, x[i+10], 15, -1051523);
			b = this.md5_ii(b, c, d, a, x[i+ 1], 21, -2054922799);
			a = this.md5_ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
			d = this.md5_ii(d, a, b, c, x[i+15], 10, -30611744);
			c = this.md5_ii(c, d, a, b, x[i+ 6], 15, -1560198380);
			b = this.md5_ii(b, c, d, a, x[i+13], 21,  1309151649);
			a = this.md5_ii(a, b, c, d, x[i+ 4], 6 , -145523070);
			d = this.md5_ii(d, a, b, c, x[i+11], 10, -1120210379);
			c = this.md5_ii(c, d, a, b, x[i+ 2], 15,  718787259);
			b = this.md5_ii(b, c, d, a, x[i+ 9], 21, -343485551);
			a = this.safe_add(a, olda);
			b = this.safe_add(b, oldb);
			c = this.safe_add(c, oldc);
			d = this.safe_add(d, oldd);
		}
		return Array(a, b, c, d);
	},
	md5_cmn : function(q, a, b, x, s, t){
		return this.safe_add(this.bit_rol(this.safe_add(this.safe_add(a, q), this.safe_add(x, t)), s),b);
	},
	md5_ff : function(a, b, c, d, x, s, t){
		return this.md5_cmn((b & c) | ((~b) & d), a, b, x, s, t);
	},
	md5_gg : function(a, b, c, d, x, s, t){
		return this.md5_cmn((b & d) | (c & (~d)), a, b, x, s, t);
	},
	md5_hh : function(a, b, c, d, x, s, t){
		return this.md5_cmn(b ^ c ^ d, a, b, x, s, t);
	},
	md5_ii : function(a, b, c, d, x, s, t){
		return this.md5_cmn(c ^ (b | (~d)), a, b, x, s, t);
	},
	bit_rol : function(num, cnt){
	  return (num << cnt) | (num >>> (32 - cnt));
	},
	safe_add : function(x, y){
	  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
	  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
	  return (msw << 16) | (lsw & 0xFFFF);
	},
	str2binl : function(str){
		var bin = Array();
		var mask = (1 << this.chrsz) - 1;
		for(var i = 0; i < str.length * this.chrsz; i += this.chrsz)
			bin[i>>5] |= (str.charCodeAt(i / this.chrsz) & mask) << (i%32);
		return bin;
	}
}

var fechas={
                _this : this,
                _mensaje:'Fecha inv�lida',
                formato:'yyyy/mm/dd',
                resultados:false,
                anos : {
                               //min : 1900,
                               min: new Date().getFullYear()-100,
                               max : new Date().getFullYear()-5
                },
                _fecha:new Array(),
                is_digit:function(char){
                               return (char.charCodeAt(0)>47 && char.charCodeAt(0)<58);
                },
                valida:function(str_fecha){
                               this._fecha=str_fecha.split('/');
                               if(this._fecha[0]!='' && this._fecha[1]!='' && this._fecha[2]!=''){
                                               var formato_fecha=this._checkformat(this.formato);
                                               switch(formato_fecha){
                                                               case 'french_regular':
                                                                              valida.posicion=new Array('dia','mes','ano');
                                                                              var str_dia=this._fecha[0];
                                                                              var str_mes=this._fecha[1];
                                                                              var str_ano=this._fecha[2];
                                                               break;
                                                               case 'french_inverse':
                                                                              valida.posicion=new Array('ano','mes','dia');
                                                                              var str_dia=this._fecha[2];
                                                                              var str_mes=this._fecha[1];
                                                                              var str_ano=this._fecha[0];
                                                               break;
                                                               case 'american_regular':
                                                                              valida.posicion=new Array('mes','dia','ano');
                                                                              var str_dia=this._fecha[0];
                                                                              var str_mes=this._fecha[1];
                                                                              var str_ano=this._fecha[2];
                                                               break;
                                                               case 'american_inverse':
                                                                              valida.posicion=new Array('ano','dia','mes');
                                                                              var str_dia=this._fecha[1];
                                                                              var str_mes=this._fecha[2];
                                                                              var str_ano=this._fecha[0];
                                                               break;
                                               }
                                               resultados=this._checkdate(str_dia, str_mes, str_ano);
                                               return resultados;
                               }
                               return false;
                },
                _checkdate:function(str_dia, str_mes, str_ano){
                               var result0=false;
                               var result1=false;
                               var result2=false;
                               var str_valida0='result0=this.valida_'+valida.posicion[0]+'('+str_dia+','+str_mes+','+str_ano+');';
                               var str_valida1='result1=this.valida_'+valida.posicion[1]+'('+str_dia+','+str_mes+','+str_ano+');';
                               var str_valida2='result2=this.valida_'+valida.posicion[2]+'('+str_dia+','+str_mes+','+str_ano+');';
                               eval(str_valida0);
                               eval(str_valida1);
                               eval(str_valida2);
                               if(!result0){
                                               if(valida.posicion[0]=='ano'){str_mensaje='a�o';}else{str_mensaje=valida.posicion[0];}
                                               this._mensaje='Fecha inv�lida, revisa el formato y rectifica el '+str_mensaje;
                               }
                               if(!result1){
                                               if(valida.posicion[1]=='ano'){str_mensaje='a�o';}else{str_mensaje=valida.posicion[1];}
                                               this._mensaje='Fecha inv�lida, revisa el formato y rectifica el '+str_mensaje;
                               }
                               if(!result2){
                                               if(valida.posicion[2]=='ano'){str_mensaje='a�o';}else{str_mensaje=valida.posicion[2];}
                                               this._mensaje='Fecha inv�lida, revisa el formato y rectifica el '+str_mensaje;
                               }
                               if(result0 && result1 && result2){
                                               return true;
                               }
                               return false;
                },
                _checkformat:function(){
                               if(arguments[0]==undefined)
                                               arguments[0]=this.formato;
                               var array_formato=arguments[0].split('/');
                               if(array_formato[0]=='dd')
                                               return 'french_regular';
                               if(array_formato[0]=='mm')
                                               return 'american_regular';
                               if(array_formato[0]=='yyyy')
                                               if(array_formato[1]=='mm')
                                                               return 'french_inverse';
                                               if(array_formato[1]=='dd')
                                                               return 'american_inverse';
                               return 'french_regular';
                },
                valida_dia:function(str_dia,str_mes,str_ano){
                               var resultado=false;
                               var int_dia = parseInt(str_dia, 10);
                               resultado = resultado || ((int_dia >= 1) && (int_dia <= this.dias_mes(str_mes)));
                               return resultado;
                },
                valida_mes:function(str_dia,str_mes,str_ano){
                               var resultado = false;
                               var int_mes = parseInt(str_mes, 10);
                               resultado = resultado || ((int_mes >= 1) && (int_mes <= 12));
                               return resultado;
                },
                valida_ano:function(str_dia,str_mes,str_ano){
                               var resultado = false;
                               var int_ano = parseInt(str_ano,10);
                                resultado = resultado || ((int_ano >= this.anos.min) && (int_ano<=this.anos.max));
                               return resultado;
                },
                dias_mes:function(str_mes){
                               var int_mes=parseInt(str_mes,10);
                               if(int_mes >= 1 && int_mes <= 12){
                                               var dias_m=0;
                                               var dias_x_mes={
                                                               "m1":"31",
                                                               "m2":"29",
                                                               "m3":"31",
                                                               "m4":"30",
                                                               "m5":"31",
                                                               "m6":"30",
                                                               "m7":"31",
                                                               "m8":"31",
                                                               "m9":"30",
                                                               "m10":"31",
                                                               "m11":"30",
                                                               "m12":"31"
                                               };
                                               eval('dias_m=parseInt(dias_x_mes.m'+str_mes+',10);');
                                               return dias_m;
                               }
                               return false;
                },
                error : function (){
                               alert(this._mensaje);
                }
};
