var hawkeyePreQualUrl=#prequal_url;var sas_scriptDomain="#sas_scriptDomain";var sas_formatids="#formats_ids";var sas_pageid="#page_id";var sas_renderMode= #render_mode;var sas_target="urlpublisher="+(""==location.pathname?"/":location.pathname).replace(/[^a-zA-Z0-9_]/g,"_")+";#targets";var sas_target_slot=sas_target;var sas_url=function(){return sas_scriptDomain+"/call2/pubjallajax/"+sas_pageid+"/"+sas_formatids+"/"+sas_gtsf()+"/"+escape(sas_target)+"?";};if(0<sas_formatids.length){var l=new (function(d){this.d=d;this.h=d.head||d.getElementsByTagName("head")[0];this.load=function(src,callback){var s=this.d.createElement("script");s.type="text/javascript";s.async=true;s.src=src;if("function"==typeof callback){s.addEventListener("load",callback,false);}this.h.appendChild(s);};})(document);var hawkeyePreQualUrl=hawkeyePreQualUrl||false;if(hawkeyePreQualUrl){var pqRecs=new Array();l.load(hawkeyePreQualUrl,function(event){if((typeof asiPlacements!=="undefined")&&(typeof asiPqTag!=="undefined")&&(true==asiPqTag)){for(var p in asiPlacements){window["ASPQ_"+p]="";if(typeof asiPlacements[p].data!=="undefined"){for(var key in asiPlacements[p].data){window["ASPQ_"+p]+="PQ_"+p+"_"+key;}if(window["ASPQ_"+p]!=""){pqRecs.push(window["ASPQ_"+p]);}}}}if(pqRecs.length>0){sas_target+=";gwd="+pqRecs.join(",");}l.load(sas_url());});}else{l.load(sas_url());}}imx_ads_formats=new Array();sas_loadHandler=function(f){imx_ads_formats.push(f);if(typeof console!="undefined"){if(typeof imx_doresize=="function"){imx_doresize();}}};