<!-- Responsável por buscar os arquivos no banco de dados -->
<?php
include_once "conexao.php";

//consultar no banco de dados
$result_usuario = "SELECT * FROM usuarios ORDER BY id DESC";
//Executando a query
$resultado_usuario = mysqli_query($conn, $result_usuario);

//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){

	while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
        echo "<script> var dianteira_1 = '" . $row_usuario['valor1'] . "' </script> ";
        echo "<script> var centro_1 = '" . $row_usuario['valor2'] . "' </script> ";
        echo "<script> var traseira_1 = '" . $row_usuario['valor3'] . "' </script> ";
    }

}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>





<script>



//***************** MUDAR A COR DA PEGADA ************** 
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
//***************** FIM DO MUDAR A COR DA PEGADA ************** 




//********************** FUNÇÕES AUXILIARES ***************************
    function porcentagem(valor) {
        let porcent = valor * 100 / 1024
        return porcent.toFixed(2)
    }

    function trocaValor(trocar) {
        if (trocar) {
            dianteira_2 = dianteira2.value
            centro_2 = centro2.value
            traseira_2 = traseira2.value
        }
    }
//********************** FIM DE FUNÇÕES AUXILIARES ***************************




//********************** FUNÇÕES GERAR ***************************
   function gerar(){
    
        alert(dianteira_1+centro_1+traseira_1);
        
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
//********************** FIM DE FUNÇÕES GERAR ***************************





//********************** FUNÇÕES DOIS PÉS ***************************
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
//********************** FIM DE FUNÇÃO DOIS PÉS ***************************




//********************** FUNÇÃO PÉ DIREITO ***************************
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
//********************** FIM DA FUNÇÃO PÉ DIREITO ***************************


//********************** FUNÇÃO PÉ ESQUERDO ***************************
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
//********************** FIM DA FUNÇÃO PÉ ESQUERDO ***************************





//********************** FUNÇÃO MOSTRAR LISTA DO BANCO DE DADOS ***************************
function mostraLista(){
    lista.style.display="inline"
}
//********************** FIM DO FUNÇÃO MOSTRAR LISTA DO BANCO DE DADOS ***************************
</script>