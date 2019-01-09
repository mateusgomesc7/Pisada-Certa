const dianteira1 = document.querySelector('#dianteira1')
const centro1 = document.querySelector('#centro1')
const traseira1 = document.querySelector('#traseira1')
const dianteira2 = document.querySelector('#dianteira2')
const centro2 = document.querySelector('#centro2')
const traseira2 = document.querySelector('#traseira2')
const estilo = document.querySelector('style')
const relatorio = document.querySelector('#relatorio')


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


function porcentagem(valor){
    let porcent = valor*100/1024
    return porcent.toFixed(2)
}

function gerar() {
    let report = `<div class="card border-secondary mb-3 mt-3 p-2" id="relatorio">
    <div class="card-header">
        <h5 class="card-title">Relatório da corrida</h5>
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
                    <td>${porcentagem(dianteira1.value)}%</td>
                    <td>${porcentagem(centro1.value)}%</td>
                    <td>${porcentagem(traseira1.value)}%</td>
                </tr>
                <tr>
                    <th scope="row">15 - 80</th>
                    <td>${porcentagem(dianteira2.value)}%</td>
                    <td>${porcentagem(centro2.value)}%</td>
                    <td>${porcentagem(traseira2.value)}%</td>
                </tr>
                <tr>
                    <th scope="row">80 - 100</th>
                    <td>${porcentagem((parseFloat(dianteira1.value) + parseFloat(dianteira2.value))/2)}%</td>
                    <td>${porcentagem((parseFloat(centro1.value) + parseFloat(centro2.value))/2)}%</td>
                    <td>${porcentagem((parseFloat(traseira1.value) + parseFloat(traseira2.value))/2)}%</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer text-muted row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Dois pés</a></li>
                    <li class="page-item"><a class="page-link" href="#">pé direito</a></li>
                    <li class="page-item"><a class="page-link" href="#">pé esquerdo</a></li>
                </ul>
            </nav>
        </div>
        <div class="col">
            <a href="#" class="btn btn-primary">Salvar</a>
        </div>
    </div>
</div>`
    relatorio.innerHTML = report
}