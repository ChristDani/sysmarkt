let date = document.getElementById('date');
let img = document.getElementById('imagen');
let nomove = document.getElementById('nope');


var x = Math.ceil(Math.random()*13);

img.style.background = "url(view/static/imgLoginLib/"+x+".jpg)";
img.style.backgroundPosition = "center";
img.style.backgroundSize = "cover";
img.style.backgroundRepeat = "no-repeat";


(function(){

    var actualizarHora = function(){
        var tiempo = new Date(),
            hora = tiempo.getHours(),
            ampm,
            min = tiempo.getMinutes(),
            second = tiempo.getSeconds();

        var pHora = document.getElementById('hora'),
            pmin = document.getElementById('min'),
            psecond = document.getElementById('second');
            pampm = document.getElementById('pre')

        if (hora >= 13) {
            hora = hora - 12;
            ampm = 'pm';
        } else{
            ampm = 'am';
        }

        if (hora == 0){
            hora == 12;
        };

       
        pampm.textContent = ampm;

        if (hora < 10) { hora = "0" + hora};
        if (min < 10) { min = "0" + min};
        if (second < 10) { second = "0" + second};

        pHora.textContent = hora;
        pmin.textContent = min;
        psecond.textContent = second;
    };

    actualizarHora();

    var intervalo = setInterval(actualizarHora, 100)

}())

nomove.addEventListener("mouseover", move);
// nomove.addEventListener("mouseout", move);
var nose = 0.01;

function move() {

    var mintop = -240;
    var maxtop = 235;

    var minleft = -430;
    var maxleft = 830;

    let limittop = Math.ceil(Math.random()*(maxtop-mintop+1)+mintop);

    let limitleft = Math.ceil(Math.random()*(maxleft-minleft+1)+minleft);

    nomove.style.left = limitleft;
    nomove.style.top = limittop;



}



