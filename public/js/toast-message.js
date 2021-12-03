let time = (1000 * (5)); // tiempo en segundos de lo que durara el toast en pantalla

function toastmessage() {
    let mytoast = document.getElementById('loadToast');
    mytoast.classList.add('fadeInRight');
    setTimeout(function () {
        mytoast.classList.remove('d-none');
    },1000)

    setTimeout(function (){
        removeToast()
    }, time);
}

function removeToast() {
    let mytoast = document.getElementById('loadToast');
    mytoast.classList.add('fadeOutRight');
    setTimeout(function () {
        mytoast.classList.add('d-none');
    },1000)
}

function closeToast() {
    let toast = document.getElementById("loadToast");

    toast.classList.add("d-none");
    time = 0;
}
