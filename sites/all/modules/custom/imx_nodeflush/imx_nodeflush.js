jQuery('#edit-submit').click(function(event){
  event.preventDefault();
  if(confirm('Confirma que deseas borrar la cache de este nodo...')){
    return true;
  }else{
    return false;
  }
});
