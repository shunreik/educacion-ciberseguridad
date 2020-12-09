import { newImages, oldImages, numberOfImagesAllowed, resetOldImages, resetRenderOldImages } from './multi-image-upload';
const axios = require('axios');

var sendNewImages = newImages;
var sendOldImages = oldImages;
//Se verifica que tenga el formulario de creación de lectura
if (document.getElementById("form-update-reading")) {

    //Se verifica que el elemento que contiene las imágenes antiguas exista
    if (document.getElementById("infOldImages")) {
        var info = document.querySelectorAll('#infOldImages > span');
        let pathImages = [];//se almacenan las dirección de la imágen en el servidor
        let srcImages = [];//se obtiene el elace de la imagen pública en el servidor
        info.forEach(function (element) {
            pathImages.push(element.dataset.path);
            srcImages.push(element.textContent);
        });
        resetOldImages(pathImages);
        resetRenderOldImages(srcImages);
        sendOldImages = oldImages;

        //se obtiene al formulario
        var fromUpdate = document.getElementById("form-update-reading");
        //Se obtiene hacia donde esta enrutado el formulario
        var url = fromUpdate.getAttribute('action');

        //Se obtienen los elementos inputs o textArea del formulario
        var topicElem = document.getElementById("topic");
        var levelElem = document.getElementById("level");
        var titleElem = document.getElementById("title");
        var descriptionElem = document.getElementById("description");
        var uploadElem = document.getElementById("upload");

        //Al enviar el formulario
        fromUpdate.addEventListener('submit', function (e) {
            e.preventDefault();//Se espera que se llenen los campos requeridos

            //Se agrega el data del formData
            var formData = new FormData(fromUpdate);
            sendNewImages.forEach(function (image) {
                formData.append('newImages[]', image)
            });
            sendOldImages.forEach(function (image) {
                formData.append('oldImages[]', image)
            });


            let confing = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            };
            axios.post(url, formData, confing).then(function (response) {
                // handle success
                console.log(response.data);
                document.getElementById("save").disabled = true;
                topicElem.nextElementSibling.classList.add('hidden');
                levelElem.nextElementSibling.classList.add('hidden');
                titleElem.nextElementSibling.classList.add('hidden');
                descriptionElem.nextElementSibling.classList.add('hidden');
                uploadElem.nextElementSibling.classList.add('hidden');
                console.log('Registro actualizado');
                // funciona como una redirección HTTP
                if (response.data.redirect) {
                    window.location.replace(response.data.redirect);
                }

            }).catch(function (error) {
                console.log(error.response);
                if (error.response) {
                    if (error.response.data.errors) {//se obtienen los errores de validaciones de laravel (Request)
                        var errorsForm = error.response.data.errors;
                        console.log(error.response.data.errors);
                        if (errorsForm.hasOwnProperty('topic_id')) {
                            topicElem.nextElementSibling.classList.remove('hidden');
                            topicElem.nextElementSibling.innerHTML = errorsForm['topic_id'][0];
                        } else {
                            topicElem.nextElementSibling.classList.add('hidden');
                        }
                        if (errorsForm.hasOwnProperty('level_id')) {
                            levelElem.nextElementSibling.classList.remove('hidden');
                            levelElem.nextElementSibling.innerHTML = errorsForm['level_id'][0];
                        } else {
                            levelElem.nextElementSibling.classList.add('hidden');
                        }
                        if (errorsForm.hasOwnProperty('title')) {
                            titleElem.nextElementSibling.classList.remove('hidden');
                            titleElem.nextElementSibling.innerHTML = errorsForm['title'][0];
                        } else {
                            titleElem.nextElementSibling.classList.add('hidden');
                        }
                        if (errorsForm.hasOwnProperty('description')) {
                            descriptionElem.nextElementSibling.classList.remove('hidden');
                            descriptionElem.nextElementSibling.innerHTML = errorsForm['description'][0];
                        } else {
                            descriptionElem.nextElementSibling.classList.add('hidden');
                        }
                        if (errorsForm.hasOwnProperty('newImages')) {
                            uploadElem.nextElementSibling.classList.remove('hidden');
                            uploadElem.nextElementSibling.innerHTML = errorsForm['newImages'][0];
                        } else {
                            uploadElem.nextElementSibling.classList.add('hidden');
                        }
                        if (errorsForm.hasOwnProperty('numberOfImagesAllowed')) {
                            uploadElem.nextElementSibling.classList.remove('hidden');
                            uploadElem.nextElementSibling.innerHTML = errorsForm['numberOfImagesAllowed'][0];
                        } else {
                            uploadElem.nextElementSibling.classList.add('hidden');
                        }

                        for (let index = 0; index < numberOfImagesAllowed; index++) {
                            // const element = array[index];
                            console.log('newImages.' + index);
                            if (errorsForm.hasOwnProperty('newImages.' + index)) {
                                console.log(errorsForm['newImages.' + index][0]);
                                uploadElem.nextElementSibling.classList.remove('hidden');
                                uploadElem.nextElementSibling.innerHTML = errorsForm['newImages.' + index][0];
                            }
                        }
                    }
                }
            });
        });
    }
}