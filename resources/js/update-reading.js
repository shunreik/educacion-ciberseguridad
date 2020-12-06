import { newImages, oldImages, numberOfImagesAllowed, resetOldImages, resetRenderOldImages} from './multi-image-upload';
const axios = require('axios');

var sendNewImages = newImages;
var sendOldImages = oldImages;
//Se verifica que tenga el formulario de creación de lectura
if (document.getElementById("form-update-reading")) {

    //Se verifica que el elemento que contiene las imágenes antiguas exista
    if(document.getElementById("infOldImages")){
        // let infOldImages = document.getElementById("infOldImages");
        var info = document.querySelectorAll('#infOldImages > span');
        let pathImages = [];//se almacenan las dirección de la imágen en el servidor
        let srcImages = [];//se obtiene el elace de la imagen pública en el servidor
        info.forEach(function(element){
            pathImages.push(element.dataset.path);
            srcImages.push(element.textContent);
        });
        // console.log(pathImages, srcImages);
        resetOldImages(pathImages);
        resetRenderOldImages(srcImages);
        sendOldImages = oldImages;
        // console.log(oldImages);
        // console.log(sendOldImages);
    }

}