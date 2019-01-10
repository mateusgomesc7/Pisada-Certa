const dianteira1 = document.querySelector('#dianteira1')
const centro1 = document.querySelector('#centro1')
const traseira1 = document.querySelector('#traseira1')
const dianteira2 = document.querySelector('#dianteira2')
const centro2 = document.querySelector('#centro2')
const traseira2 = document.querySelector('#traseira2')
const estilo = document.querySelector('style')
const relatorio = document.querySelector('#relatorio')

let dianteira_1 = document.querySelector('#dianteira1').value
let centro_1 = document.querySelector('#centro1').value
let traseira_1 = document.querySelector('#traseira1').value
let dianteira_2 = document.querySelector('#dianteira2').value
let centro_2 = document.querySelector('#centro2').value
let traseira_2 = document.querySelector('#traseira2').value

function mudaCor() {

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
        cor = '255,' + (512 - (valor * 255 / 512)).toFixed(1).toString()
        return cor
    }
}

function porcentagem(valor) {
    let porcent = valor * 100 / 1024
    return porcent.toFixed(2)
}


function gerar() {

    trocaValor(true);

    let report = `<div class="card border-secondary mb-3 mt-3 p-2">
    <div class="card-header">
        <h5 class="card-title hidediv">Relatório da corrida</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Intervalo (metros)</th>
                    <th scope="col">Dianteira</th>
                    <th scope="col">Centro</th>
                    <th scope="col">Traseira</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">0 - 15</th>
                    <td>${porcentagem(dianteira_1)}%</td>
                    <td>${porcentagem(centro_1)}%</td>
                    <td>${porcentagem(traseira_1)}%</td>
                </tr>
                <tr>
                    <th scope="row">15 - 80</th>
                    <td>${porcentagem(dianteira_2)}%</td>
                    <td>${porcentagem(centro_2)}%</td>
                    <td>${porcentagem(traseira_2)}%</td>
                </tr>
                <tr>
                    <th scope="row">80 - 100</th>
                    <td>${porcentagem((parseFloat(dianteira_1) + parseFloat(dianteira_2)) / 2)}%</td>
                    <td>${porcentagem((parseFloat(centro_1) + parseFloat(centro_2)) / 2)}%</td>
                    <td>${porcentagem((parseFloat(traseira_1) + parseFloat(traseira_2)) / 2)}%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer text-muted row">
        <div class="col">
        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary hidediv active" onclick="doisPes()">Dois pés</button>
        <button type="button" class="btn btn-secondary hidediv" onclick="peDireito()">Pé direito</button>
        <button type="button" class="btn btn-secondary hidediv" onclick="peEsquerdo()">Pé esquerdo</button>
      </div>
        </div>
        <div class="col">
            <a href="javascript:genPDF()" class="btn btn-primary hidediv">Salvar</a>
        </div>
    </div>
</div>

<div style="display:none" id="salvaRelatorio">
<h1>Pisada Certa</h1>
<h3>Relatório referente aos dados da Pisada Certa:</h3>
<h2>10/11/2018</h2>
</br>
<h3>Média em relção aos dois pés:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem((parseFloat(dianteira_1) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(centro_1) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(traseira_1) + parseFloat(traseira_2)) / 2)}%</p>
<h3>Pé direito:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<h3>Pé esquerdo:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
</div>

`

    relatorio.innerHTML = report
}

function doisPes() {

    trocaValor(false);

    let report = `<div class="card border-secondary mb-3 mt-3 p-2" id="relatorio">
    <div class="card-header">
        <h5 class="card-title hidediv">Relatório da corrida</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Intervalo (metros)</th>
                    <th scope="col">Dianteira</th>
                    <th scope="col">Centro</th>
                    <th scope="col">Traseira</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">0 - 15</th>
                    <td>${porcentagem(dianteira_1)}%</td>
                    <td>${porcentagem(centro_1)}%</td>
                    <td>${porcentagem(traseira_1)}%</td>
                </tr>
                <tr>
                    <th scope="row">15 - 80</th>
                    <td>${porcentagem(dianteira_2)}%</td>
                    <td>${porcentagem(centro_2)}%</td>
                    <td>${porcentagem(traseira_2)}%</td>
                </tr>
                <tr>
                    <th scope="row">80 - 100</th>
                    <td>${porcentagem((parseFloat(dianteira_1) + parseFloat(dianteira_2)) / 2)}%</td>
                    <td>${porcentagem((parseFloat(centro_1) + parseFloat(centro_2)) / 2)}%</td>
                    <td>${porcentagem((parseFloat(traseira_1) + parseFloat(traseira_2)) / 2)}%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer text-muted row">
        <div class="col">
        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary hidediv active" onclick="doisPes()">Dois pés</button>
        <button type="button" class="btn btn-secondary hidediv" onclick="peDireito()">Pé direito</button>
        <button type="button" class="btn btn-secondary hidediv" onclick="peEsquerdo()">Pé esquerdo</button>
      </div>
        </div>
        <div class="col">
            <a href="javascript:genPDF()" class="btn btn-primary hidediv">Salvar</a>
        </div>
    </div>
</div>

<div style="display:none" id="salvaRelatorio">
<h1>Pisada Certa</h1>
<h3>Relatório referente aos dados da Pisada Certa:</h3>
<h2>10/11/2018</h2>
</br>
<h3>Média em relção aos dois pés:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem((parseFloat(dianteira_1) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(centro_1) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(traseira_1) + parseFloat(traseira_2)) / 2)}%</p>
<h3>Pé direito:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<h3>Pé esquerdo:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
</div>

`
    relatorio.innerHTML = report
}

function peDireito() {

    trocaValor(false);

    let report = `<div class="card border-secondary mb-3 mt-3 p-2" id="relatorio">
    <div class="card-header">
        <h5 class="card-title hidediv">Relatório da corrida</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Intervalo (metros)</th>
                    <th scope="col">Dianteira</th>
                    <th scope="col">Centro</th>
                    <th scope="col">Traseira</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">0 - 15</th>
                    <td>${porcentagem(dianteira_1)}%</td>
                    <td>${porcentagem(centro_1)}%</td>
                    <td>${porcentagem(traseira_1)}%</td>
                </tr>
                <tr>
                    <th scope="row">15 - 80</th>
                    <td>${porcentagem(dianteira_1)}%</td>
                    <td>${porcentagem(centro_1)}%</td>
                    <td>${porcentagem(traseira_1)}%</td>
                </tr>
                <tr>
                    <th scope="row">80 - 100</th>
                    <td>${porcentagem(dianteira_1)}%</td>
                    <td>${porcentagem(centro_1)}%</td>
                    <td>${porcentagem(traseira_1)}%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer text-muted row">
        <div class="col">
        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary hidediv" onclick="doisPes()">Dois pés</button>
        <button type="button" class="btn btn-secondary hidediv active" onclick="peDireito()">Pé direito</button>
        <button type="button" class="btn btn-secondary hidediv" onclick="peEsquerdo()">Pé esquerdo</button>
      </div>
        </div>
        <div class="col">
            <a href="javascript:genPDF()" class="btn btn-primary hidediv">Salvar</a>
        </div>
    </div>
</div>

<div style="display:none" id="salvaRelatorio">
<h1>Pisada Certa</h1>
<h3>Relatório referente aos dados da Pisada Certa:</h3>
<h2>10/11/2018</h2>
</br>
<h3>Média em relção aos dois pés:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem((parseFloat(dianteira_1) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(centro_1) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(traseira_1) + parseFloat(traseira_2)) / 2)}%</p>
<h3>Pé direito:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<h3>Pé esquerdo:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
</div>

`
    relatorio.innerHTML = report
}

function peEsquerdo() {

    trocaValor(false);

    let report = `<div class="card border-secondary mb-3 mt-3 p-2" id="relatorio">
    <div class="card-header">
        <h5 class="card-title hidediv">Relatório da corrida</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Intervalo (metros)</th>
                    <th scope="col">Dianteira</th>
                    <th scope="col">Centro</th>
                    <th scope="col">Traseira</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">0 - 15</th>
                    <td>${porcentagem(dianteira_2)}%</td>
                    <td>${porcentagem(centro_2)}%</td>
                    <td>${porcentagem(traseira_2)}%</td>
                </tr>
                <tr>
                    <th scope="row">15 - 80</th>
                    <td>${porcentagem(dianteira_2)}%</td>
                    <td>${porcentagem(centro_2)}%</td>
                    <td>${porcentagem(traseira_2)}%</td>
                </tr>
                <tr>
                    <th scope="row">80 - 100</th>
                    <td>${porcentagem(dianteira_2)}%</td>
                    <td>${porcentagem(centro_2)}%</td>
                    <td>${porcentagem(traseira_2)}%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer text-muted row">
        <div class="col">
        <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary hidediv" onclick="doisPes()">Dois pés</button>
        <button type="button" class="btn btn-secondary hidediv" onclick="peDireito()">Pé direito</button>
        <button type="button" class="btn btn-secondary hidediv active" onclick="peEsquerdo()">Pé esquerdo</button>
      </div>
        </div>
        <div class="col">
            <a href="javascript:genPDF()" class="btn btn-primary hidediv">Salvar</a>
        </div>
    </div>
</div>

<div style="display:none" id="salvaRelatorio">
<h1>Pisada Certa</h1>
<h3>Relatório referente aos dados da Pisada Certa:</h3>
<h2>10/11/2018</h2>
</br>
<h3>Média em relção aos dois pés:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem((parseFloat(dianteira_1) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(centro_1) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(traseira_1) + parseFloat(traseira_2)) / 2)}%</p>
<h3>Pé direito:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_1)}% centro-${porcentagem(centro_1)}% traseira-${porcentagem(traseira_1)}%</p>
<h3>Pé esquerdo:</h3>
<p>Intervalo(minutos)</p>
<p>Entre 0 - 15: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 15 - 80: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Entre 80 - 100: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
</div>

`
    relatorio.innerHTML = report
}



// Para que a troca de janela entre os botões de dois pés, pé esquerdo e 
// pé direito mantenham sempre os mesmos valores e 
// o botão gerar, troque se necessário 
function trocaValor(trocar) {
    if (trocar) {
        dianteira_1 = dianteira1.value
        centro_1 = centro1.value
        traseira_1 = traseira1.value
        dianteira_2 = dianteira2.value
        centro_2 = centro2.value
        traseira_2 = traseira2.value
    }
}