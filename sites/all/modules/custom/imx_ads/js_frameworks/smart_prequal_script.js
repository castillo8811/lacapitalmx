if (0 < sas_formatids.length) {
    var sas_url = function() {
        return sas_scriptDomain+'/call2/pubjallajax/' + sas_pageid + '/' + sas_formatids + '/' + sas_gtsf() + '/' + escape(sas_target) + '?';
    };

    var l = new (function (d) {
        "use strict";
        this.d = d;
        this.h = d.head || d.getElementsByTagName('head')[0];
        this.load = function(src, callback) {
            var s = this.d.createElement('script');
            s.type = "text/javascript";
            s.async = true;
            s.src = src;
            if ('function' == typeof callback) {
                s.addEventListener('load', callback, false);
            }
            this.h.appendChild(s);
        }
    })(document);

    var hawkeyePreQualUrl = hawkeyePreQualUrl || false;
    if (hawkeyePreQualUrl) {
        var pqRecs=new Array();
        l.load(hawkeyePreQualUrl, function(event) {
            if (
                (typeof asiPlacements !== 'undefined')
                    && (typeof asiPqTag !== 'undefined')
                    && (true == asiPqTag)
                ) {
                for (var p in asiPlacements) {
                    window['ASPQ_' + p] = '';
                    if(typeof asiPlacements[p].data !== 'undefined'){
                        for(var key in asiPlacements[p].data) {
                            window['ASPQ_' + p] += 'PQ_' + p + '_' + key;
                        }
                        if (window['ASPQ_' + p] != '') {
                            pqRecs.push(window['ASPQ_' + p]);
                        }
                    }
                }
            }
            if(pqRecs.length>0){
                sas_target_slot +=";gwd="+pqRecs.join(',');
                console.log('target['+sas_target_slot+']');
            }
            l.load(sas_url());
        });
    } else {
        l.load(sas_url());
    }
}