var tiposValidos = [
  'image/jpeg',
  'image/png',
  'image/jpg'
];

function validarTipos(file){
  for( var i=0;i<tiposValidos.length;i++){
    if(file.type==tiposValidos[i]){
      return true;
    }
  }
  return false;
}
function onChange(event){

  //fichero elegido por el usuario
 var file=event.target.files[0];
 //console.log(file);
  //vamos a comprobar que es un jpg o png
 if(validarTipos(file)){
   var tapaMiniatura = document.getElementById("tapaThumb");
   tapaMiniatura.src=window.URL.createObjectURL(file);
 }
}
