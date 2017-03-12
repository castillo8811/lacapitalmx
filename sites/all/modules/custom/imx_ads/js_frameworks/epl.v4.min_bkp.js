//Global variables
var eplDoc = document;
var eplLL = false;
var eS1 = "us.img.e-planning.net";
var eplArgs;
var iabResizeTimeouts = [300,300,500,1000,1000,1000,1000,1000,1000,1000];
var iabResizeTimeoutsIndex = 0;

function eplCheckStart() {
  if (document.epl) {
    var e = document.epl;
    if (e.eplReady()) {
      return true;
    } else {
      e.eplInit(eplArgs);
      document.epl.iabResize=function(){};
      
      var doResize = document.getElementById('imx-resizeable').getAttributeNode("class").value;
      if(doResize=="doresize"){
        document.epl.iabResize=function(){
          for(i in document.epl.spaces){ 
          	if(typeof document.epl.spaces[i].ads === "undefined") {
          		setTimeout(document.epl.iabResize, iabResizeTimeouts[iabResizeTimeoutsIndex++]);
          		break;
          	} else {
	            if(/^(box_|wide_)/.test(i) ? document.epl.spaces[i].ads[0].w >= 400 && document.epl.spaces[i].ads[0].w <= 480 ? true : false : false ){
	            	if(typeof imx_doresize == 'function')
	              		imx_doresize();
          				break;
	            }
          	}
          }
        }
      }
    
      if (eplArgs.custom) {
        for (var s in eplArgs.custom) {
          document.epl.setCustomAdShow(s, eplArgs.custom[s]);
        }
      }
      return e.eplReady();    
    }
  } else {
    if (eplLL) return false;
    if (!document.body) return false; var eS2; var dc = document.cookie; var ci = dc.indexOf("EPLSERVER=");
    if (ci != -1) {
      ci += 10; var ce = dc.indexOf(';', ci);
      if (ce == -1) ce = dc.length;
        eS2 = dc.substring(ci, ce);
    }
    
    var eIF = document.createElement('IFRAME');
    eIF.src = 'about:blank'; eIF.id = 'epl4iframe'; eIF.name = 'epl4iframe';
    eIF.width=0; eIF.height=0; eIF.style.width='0px'; eIF.style.height='0px';
    eIF.style.display='none'; document.body.appendChild(eIF);

    var eIFD = eIF.contentDocument ? eIF.contentDocument : eIF.document;
    eIFD.open();eIFD.write('<html><head><title>e-planning</title></head><bo'+'dy></bo'+'dy></html>');eIFD.close();
    var s = eIFD.createElement('SCRIPT'); s.src = 'http://' + (eS2?eS2:eS1) +'/layers/epl-41.js';
    eIFD.body.appendChild(s);
    
    if (!eS2) {
      var ss = eIFD.createElement('SCRIPT');
      ss.src = 'http://ads.us.e-planning.net/egc/4/1fe1';
      eIFD.body.appendChild(ss);
    }

    eplLL = true;
    return false;
  }
}
function eplSetAdM(eID,custF) {
  if (eplCheckStart()) {
    if (custF) {
      document.epl.setCustomAdShow(eID,eplArgs.custom[eID]);
    }
    document.epl.showSpace(eID);
    setTimeout(document.epl.iabResize, iabResizeTimeouts[iabResizeTimeoutsIndex++]);
  } else {
    var efu = 'eplSetAdM("'+eID+'", '+ (custF?'true':'false') +');';
    setTimeout(efu, 250); 
  }
  
}
function eplAD4M(eID,custF) {
  document.write('<div id="eplAdDiv'+eID+'"></div>');
  if (custF) {
      if (!eplArgs.custom) { eplArgs.custom = {}; }
      eplArgs.custom[eID] = custF;
  }
  eplSetAdM(eID, custF?true:false);
}
function eplSetAd(eID) {
  if (eplCheckStart()) {
    var opts = (eplArgs.sOpts && eplArgs.sOpts[eID]) ? eplArgs.sOpts[eID] : {};
    if (opts.custF) { document.epl.setCustomAdShow(eID,opts.custF); }
    document.epl.setSpace(eID, opts);
  } else {
    setTimeout('eplSetAd("'+eID+'");', 250);  
  }
}
function eplAD4(eID, opts) {
  document.write('<div id="eplAdDiv'+eID+'"></div>');
  if (!opts) opts = {t:1};
  if (!eplArgs.sOpts) { eplArgs.sOpts = {}; }
  eplArgs.sOpts[eID] = opts;
  eplSetAd(eID);
}
