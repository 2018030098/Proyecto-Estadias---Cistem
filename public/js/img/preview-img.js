
function previewFiles() {

    let preview = document.querySelector('#preview');
    let files = document.querySelector('input[type=file]').files;
    let title = document.querySelector('#imgTitle');

    while (preview.hasChildNodes()) { // Eliminar las imagenes existentes al seleccionar nuevas
        preview.removeChild(preview.firstChild);
        if (title.className === 'd-block') {
            title.className = 'd-none'
        }
    }
    if (title.className === 'd-none') {
        title.className = 'd-block'
    }
    
    function readAndPreview(file) {
        let imgContainer    = document.createElement('div');
        imgContainer.classList.add('col-auto');
        preview.appendChild(imgContainer);

        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            let reader = new FileReader();

            reader.addEventListener("load", function () {
                let image = new Image();
                image.src = this.result;          
                image.classList.add('img-thumbnail');      
                imgContainer.appendChild( image );
            }, false);

            reader.readAsDataURL(file);
        }
    }
    
    if (files) {
        [].forEach.call(files, readAndPreview);
    }
}