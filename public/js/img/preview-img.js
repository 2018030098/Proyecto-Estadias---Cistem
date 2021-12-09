function previewFiles() {

    let value = 0;
    let preview = document.querySelector('#preview');
    let files = document.getElementById('image[]');
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

    if (files.files) {
        for (let inc = 0; inc < (files.files).length; inc++) {
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

        [].forEach.call(files.files, readAndPreview);

        if(value != (files.files).length){
            let div = document.getElementById('divImg');
            let errorImg = document.getElementById('errorImg');
            div.removeChild(files);

            let inputFile = document.createElement('input');
                inputFile.setAttribute('type','file');
                inputFile.setAttribute('name','image[]');
                inputFile.setAttribute('id','image[]');
                inputFile.setAttribute('accept','image/jpeg, image/jpg, image/png, image/gif, image/svg, image/webp');
                inputFile.setAttribute('class','form-control border-gray-300 rounded-md shadow-sm');
                inputFile.setAttribute('value',"@if($cnd) @if($publication['image'] != @null) @foreach($publication['image'] as $img) {{ asset('storage/'.$img) }} @endforeach @endif @endif");
                inputFile.setAttribute('onChange','previewFiles()');
                inputFile.setAttribute('multiple','');

                div.appendChild(inputFile);
                if (errorImg.classList.contains('d-none')) {
                    errorImg.classList.remove('d-none');
                }

        }else{
            if (!errorImg.classList.contains('d-none')) {
                    errorImg.classList.add('d-none');
            }
            inner.firstChild.classList.add('active');

            carousel.appendChild(indicator);
            carousel.appendChild(inner);
            carousel.appendChild(prev);
            carousel.appendChild(next);
            
            preview.appendChild(carousel);
        }
    }

    function readAndPreview(file) {
        
        let item = document.createElement('div');
        item.setAttribute('class','carousel-item');

        if ( /\.(jpe?g|png|gif|svg|webp|bmp|eps)$/i.test(file.name) ) {
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
            value++;
        }
    }
}

