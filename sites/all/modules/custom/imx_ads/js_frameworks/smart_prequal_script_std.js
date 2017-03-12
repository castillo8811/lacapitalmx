var pqRecs=new Array();
if((typeof asiPlacements !== 'undefined') && (typeof asiPqTag !== 'undefined') && (asiPqTag == true)){
  for (var p in asiPlacements) {
    window['ASPQ_' + p] = '';
    if(typeof asiPlacements[p].data !== 'undefined'){
      for(var key in asiPlacements[p].data) {
        window['ASPQ_' + p] += 'PQ_' + p + '_' + key;
      }
      if (window['ASPQ_' + p] != '') {
        pqRecs.push('gwd='+window['ASPQ_' + p]);
      }
    }
  }
}
if(pqRecs.length>0){
  sas_target_slot +=";"+pqRecs.join(';');
  console.log('target['+sas_target_slot+']');
}
