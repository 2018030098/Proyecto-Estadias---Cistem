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

    /**
     * Estructura de la previsualizacion de las imagenes
     */
    let carousel = document.createElement('div');
        carousel.setAttribute('class','carousel slide');
        carousel.setAttribute('data-bs-ride','carousel');
        carousel.setAttribute('id','carousel');
    let indicator = document.createElement('div');
        indicator.setAttribute('class','carousel-indicators');

    let inner = document.createElement('div');
        inner.classList.add('carousel-inner');

    let prev = document.createElement('button');
        prev.classList.add('carousel-control-prev');
        prev.setAttribute('type','button');
        prev.setAttribute('data-bs-target','#carousel');
        prev.setAttribute('data-bs-slide','prev');
    let prev_span = document.createElement('span');
        prev_span.setAttribute('class','carousel-control-prev-icon bg-dark bg-opacity-75');
        prev_span.setAttribute('aria-hidden','true');
    let prev_span2 = document.createElement('span');
        prev_span2.classList.add('visually-hidden');

    let next = document.createElement('button');
        next.classList.add('carousel-control-next');
        next.setAttribute('type','button');
        next.setAttribute('data-bs-target','#carousel');
        next.setAttribute('data-bs-slide','next');
    let next_span = document.createElement('span');
        next_span.setAttribute('class','carousel-control-next-icon bg-dark bg-opacity-75');
        next_span.setAttribute('aria-hidden','true');
    let next_span2 = document.createElement('span');
        next_span2.classList.add('visually-hidden');
    
    if (files) {
        for (let inc = 0; inc < files.length; inc++) {
            let btn = document.createElement('button');
                btn.setAttribute('type','button');
                btn.setAttribute('data-bs-target','#carousel');
                btn.setAttribute('data-bs-slide-to',inc);
                btn.setAttribute('aria-label','Slide '+inc);
            if(inc == 0){
                btn.setAttribute('aria-current','true');
                btn.classList.add('active');
            }
            indicator.appendChild(btn);
        }
        prev.appendChild(prev_span);
        prev.appendChild(prev_span2);
        next.appendChild(next_span);
        next.appendChild(next_span2);

        [].forEach.call(files, readAndPreview);
        inner.firstChild.classList.add('active');

        carousel.appendChild(indicator);
        carousel.appendChild(inner);
        carousel.appendChild(prev);
        carousel.appendChild(next);

        preview.appendChild(carousel);
    }

    function readAndPreview(file) {
        
        let item = document.createElement('div');
        item.setAttribute('class','carousel-item');

        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            let reader = new FileReader();

            reader.addEventListener("load", function () {
                let image = new Image();
                image.src = this.result;          
                image.classList.add('img-fluid');
                image.setAttribute('alt','image');
                image.setAttribute('style','width: fit-content; height: 80vh; margin: 0 auto;');
                item.appendChild( image );
            }, false);

            inner.appendChild(item);

            reader.readAsDataURL(file);
        }
    }
}