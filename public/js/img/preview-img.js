
function previewFiles() {

    let preview         = document.querySelector('#preview');
    let files           = document.querySelector('input[type=file]').files;
    let imgContainer    = document.createElement('div');

    if(files.length > 0){
        while (preview.hasChildNodes()) {
            preview.removeChild(preview.firstChild);
        }
    }

    preview.appendChild(imgContainer);

    function readAndPreview(file) {

        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            let reader = new FileReader();

            reader.addEventListener("load", function () {
                let image = new Image();
                image.src = this.result;                
                imgContainer.appendChild( image );
            }, false);

            reader.readAsDataURL(file);
        }
    }

    if (files) {
        [].forEach.call(files, readAndPreview);
    }
}