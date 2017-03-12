var prequal_status    = "#prequal_status";
var tail_target_status = "#tail_target_status";
var urlhost_status     = "#urlhost_status";
var hawkeyePreQualUrl = "#prequal_url";
var sas_scriptDomain  = "#sas_scriptDomain";
var sas_pageid        = '#page_id';
var sas_siteid        = '#site_id';
var sas_formatids     = "1";
var sas_tmstp         = Math.round(Math.random()*10000000000);
var sas_masterflag    = 1;
var sas_target        = "#targets";

var url_pub="urlpublisher="+(""==location.pathname?"/":location.pathname).replace(/[^a-zA-Z0-9_]/g,"_");
var url_host="hostpublisher="+(""==location.hostname?"":location.hostname).replace(/[^a-zA-Z0-9_]/g,"_");


sas_target        = sas_target+url_pub+";";

if(urlhost_status){
  sas_target        = sas_target+url_host+";";
}

if(tail_target_status){
  sas_target        = sas_target+sasGetTT()+";";
}



var sas_target_slot   = sas_target;

window.smart_page_id = sas_pageid;

//prequal_script

imx_ads_formats = new Array();
sas_loadHandler = function(f){imx_ads_formats.push(f);};