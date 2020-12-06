
var oldImages = [];
// var oldImages = ['https://images.pexels.com/photos/1805164/pexels-photo-1805164.jpeg', 'https://images.pexels.com/photos/731022/pexels-photo-731022.jpeg'];
var newImages = [];

let numberOfImagesAllowed = 3;
let size = 1048576;//equivale a 1MB


if (document.getElementById("multi-upload")) {

    var gallery = document.getElementById("gallery");
    var galleryUpload = document.getElementById("gallery-upload");
    var empty = document.getElementById("empty");
    var imageTempl = document.getElementById("image-template");
    var uploadElem = document.getElementById("upload");

    // click the hidden input of type file if the visible button is clicked
    // and capture the selected files
    const hidden = document.getElementById("hidden-input");

    // renderOldImage(oldImages);
    document.getElementById("upload").onclick = () => hidden.click();

    hidden.onchange = (e) => {
        // console.log(e.target.files);
        while (uploadElem.nextElementSibling.firstChild) uploadElem.nextElementSibling.removeChild(uploadElem.nextElementSibling.firstChild);
        for (const file of e.target.files) {
            var allImages = newImages.concat(oldImages);
            if (allImages.length < numberOfImagesAllowed) {
                if (/\.(jpe?g|png)$/i.test(file.name)) {
                    if (file.size < size) {
                        addImage(file);
                        // while (uploadElem.nextElementSibling.firstChild) uploadElem.nextElementSibling.removeChild(uploadElem.nextElementSibling.firstChild);
                        uploadElem.nextElementSibling.classList.add('hidden');
                    } else {
                        console.log('No cumple con el tamanio');
                        var message = document.createElement("p")
                        message.innerHTML = 'La imagen ' + file.name + ' pesa más del tamaño permitido.';
                        uploadElem.nextElementSibling.append(message);
                    }
                } else {
                    console.log('No es una imágen');
                    var message = document.createElement("p")
                    message.innerHTML = 'El archivo ' + file.name + ' no es una imágen.'
                    uploadElem.nextElementSibling.append(message);
                }
            } else {
                console.log('Superó el límite de imágenes permitidas');
                var message = document.createElement("p")
                message.innerHTML = 'Superó el límite de imágenes permitidas';
                uploadElem.nextElementSibling.append(message);
                break;//se termina el bucle
            }
        }

        uploadElem.nextElementSibling.classList.remove('hidden');
        renderNewImage(newImages);
    };

    // event delegation to caputre delete events
    // fron the waste buckets in the file preview cards
    gallery.onclick = ({ target }) => {
        if (target.classList.contains("delete")) {
            // const group = target.dataset.group;
            const index = target.dataset.index;
            const id = target.dataset.id;//id del elemento li para eliminar
            // console.log(group, index)
            newImages.splice(index, 1);
            document.getElementById(id).remove(id);
            console.log(gallery.children.length);
            renderNewImage(newImages);
            console.log('Viejas imágenes', oldImages);
            console.log('Nuevas imágenes', newImages);
        }
    };

    galleryUpload.onclick = ({ target }) => {
        if (target.classList.contains("delete")) {
            const index = target.dataset.index;
            const id = target.dataset.id;//id del elemento li para eliminar
            oldImages.splice(index, 1);
            document.getElementById(id).remove(id);
            renderOldImage(oldImages);
            console.log('Viejas imágenes', oldImages);
            console.log('Nuevas imágenes', newImages);
        }
    };

}


function addImage(file) {
    newImages.push(file);
}

function renderNewImage(images) {
    // var myNode = document.getElementById("gallery");
    while (gallery.firstChild) gallery.removeChild(gallery.firstChild);

    images.forEach(function (file, index) {
        // console.log(index);
        const objectURL = URL.createObjectURL(file);
        const clone = imageTempl.content.cloneNode(true);
        clone.querySelector("li").id = objectURL;
        clone.querySelector(".delete").dataset.id = objectURL;
        clone.querySelector(".delete").dataset.index = index;
        // clone.querySelector(".delete").dataset.group = 'new';
        Object.assign(clone.querySelector("img"), {
            src: objectURL,
            alt: file.name
        });
        gallery.prepend(clone);
    });

    if (gallery.children.length === 0 && galleryUpload.children.length === 0) {
        // console.log('No hay imágenes')
        empty.classList.remove('hidden');
    } else {
        // console.log('Si hay imágenes')
        empty.classList.add("hidden");
    }
}

function renderOldImage(images) {
    // var myNode = document.getElementById("gallery-upload");
    while (galleryUpload.firstChild) galleryUpload.removeChild(galleryUpload.firstChild);

    images.forEach(function (src, index) {
        // console.log(index);
        const clone = imageTempl.content.cloneNode(true);
        clone.querySelector("li").id = src;
        clone.querySelector(".delete").dataset.id = src;
        clone.querySelector(".delete").dataset.index = index;
        // clone.querySelector(".delete").dataset.group = 'old';
        Object.assign(clone.querySelector("img"), {
            src: src,
            alt: src
        });
        galleryUpload.prepend(clone);
    });

    if (gallery.children.length === 0 && galleryUpload.children.length === 0) {
        // console.log('No hay imágenes')
        empty.classList.remove('hidden');
    } else {
        // console.log('Si hay imágenes')
        empty.classList.add("hidden");
    }
}

export { newImages, numberOfImagesAllowed }

