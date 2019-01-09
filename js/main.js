const dianteira1 = document.querySelector('#dianteira1')
const centro1 = document.querySelector('#centro1')
const traseira1 = document.querySelector('#traseira1')
const dianteira2 = document.querySelector('#dianteira2')
const centro2 = document.querySelector('#centro2')
const traseira2 = document.querySelector('#traseira2')
const estilo = document.querySelector('style')

function mudaCor() {
    // let dianteira_1 = color(dianteira1.value)
    // let dianteira_2 = color(dianteira2.value)
    // let centro_1 = color(centro1.value)
    // let centro_2 = color(centro2.value)
    // let traseira_1 = color(traseira1.value)
    // let traseira_2 = color(traseira2.value)

    let listaValores = `.st0{fill:rgb(${color(dianteira1.value)},0);}
.st1{fill:rgb(${color(centro1.value)},0);}
.st2{fill:rgb(${color(traseira1.value)},0);}
.st3{fill:rgb(${color(dianteira2.value)},0);}
.st4{fill:rgb(${color(centro2.value)},0);}
.st5{fill:rgb(${color(traseira2.value)},0);}`

    estilo.innerHTML = listaValores
}

function color(valor) {
    let cor
    if (valor <= 512) {
        cor = (valor * 255 / 512).toFixed(1).toString() + ',255'
        return cor
    }
    if (valor > 512) {
        cor = '255,' + (512 - (valor*255/512)).toFixed(1).toString()
        return cor
    }
}

// var slider = document.getElementById("myRange");
// var output = document.getElementById("demo");
// estilo.innerHTML = `.st1{fill:#${centro_1};}.st4{fill:#${centro2.value + 1010};}`;

// centro2.oninput = function() {    
// estilo.innerHTML = `.st1{fill:#${centro1.value + 1010};}.st4{fill:#${centro2.value + 1010};}`;
// }