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
        $dianteira_1[] = $row_usuario['valor1'];
        $centro_1[] = $row_usuario['valor2'];
        $traseira_1[] = $row_usuario['valor3'];
    }
    $dianteira_1 = implode('|', $dianteira_1);
    $centro_1 = implode('|', $centro_1);
    $traseira_1 = implode('|', $traseira_1);
}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>


<script>
//variáveis
var i, array_dianteira, array_centro, array_traseira, string_dianteira, string_centro, string_traseira;
//recebe a string com elementos separados, vindos do PHP
string_dianteira = "<?php echo $dianteira_1; ?>";
string_centro = "<?php echo $centro_1; ?>";
string_traseira = "<?php echo $traseira_1; ?>";

//transforma esta string em um array próprio do Javascript
array_dianteira = string_dianteira.split("|");
array_centro = string_centro.split("|");
array_traseira = string_traseira.split("|");

//varre o array só pra mostrar que tá tudo ok
//  for (i in array_dianteira)
//  alert(array_dianteira[i]);
// alert(array_centro[1]);
// alert(array_traseira[1]);


//Trabalhando com os arrays
var media_dianteira = 0, soma_dianteira = 0;
var media_centro = 0, soma_centro = 0;
var media_traseira = 0, soma_traseira = 0;


for (i in array_dianteira)
soma_dianteira += parseFloat(array_dianteira[i])

for (i in array_centro)
soma_centro += parseFloat(array_centro[i])

for (i in array_traseira)
soma_traseira += parseFloat(array_traseira[i])

i++;
media_dianteira = soma_dianteira/i;
media_centro = soma_centro/i;
media_traseira = soma_traseira/i;
//  alert(soma);
//  alert(media);
//  alert(i);
</script>



<script>


//***************** MUDAR A COR DA PEGADA ************** 
   function mudaCor() {
        let listaValores = `.st0{fill:rgb(${color(media_dianteira)},0);}
        .st1{fill:rgb(${color(media_centro)},0);}
        .st2{fill:rgb(${color(media_traseira)},0);}
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
    
        //alert(dianteira_1+centro_1+traseira_1);
        
        trocaValor(true);
        mudaCor();
        
        let report = `<div class="card border-secondary mb-3 mt-3 p-2">
        <div class="card-header">
            <h5 class="card-title hidediv">Relatório da corrida</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Etapas</th>
                        <th scope="col">Dianteira</th>
                        <th scope="col">Centro</th>
                        <th scope="col">Calcanhar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Início</th>
                        <td>${porcentagem(media_dianteira)}%</td>
                        <td>${porcentagem(media_centro)}%</td>
                        <td>${porcentagem(media_traseira)}%</td>
                    </tr>
                    <tr>
                        <th scope="row">Meio</th>
                        <td>${porcentagem(dianteira_2)}%</td>
                        <td>${porcentagem(centro_2)}%</td>
                        <td>${porcentagem(traseira_2)}%</td>
                    </tr>
                    <tr>
                        <th scope="row">Fim</th>
                        <td>${porcentagem((parseFloat(media_dianteira) + parseFloat(dianteira_2)) / 2)}%</td>
                        <td>${porcentagem((parseFloat(media_centro) + parseFloat(centro_2)) / 2)}%</td>
                        <td>${porcentagem((parseFloat(media_traseira) + parseFloat(traseira_2)) / 2)}%</td>
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
    </br>
    
    <h3>Média em relção aos dois pés:</h3>
    <p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
    <p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
    <p>Fim: dianteira-${porcentagem((parseFloat(media_dianteira) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(media_centro) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(media_traseira) + parseFloat(traseira_2)) / 2)}%</p>
    
    <h3>Pé direito:</h3>
    <p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
    <p>Meio: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
    <p>Fim: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
    
    <h3>Pé esquerdo:</h3>
    <p>Início: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
    <p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
    <p>Fim: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
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
                <th scope="col">Etapas</th>
                <th scope="col">Dianteira</th>
                <th scope="col">Centro</th>
                <th scope="col">Calcanhar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Início</th>
                <td>${porcentagem(media_dianteira)}%</td>
                <td>${porcentagem(media_centro)}%</td>
                <td>${porcentagem(media_traseira)}%</td>
            </tr>
            <tr>
                <th scope="row">Meio</th>
                <td>${porcentagem(dianteira_2)}%</td>
                <td>${porcentagem(centro_2)}%</td>
                <td>${porcentagem(traseira_2)}%</td>
            </tr>
            <tr>
                <th scope="row">Fim</th>
                <td>${porcentagem((parseFloat(media_dianteira) + parseFloat(dianteira_2)) / 2)}%</td>
                <td>${porcentagem((parseFloat(media_centro) + parseFloat(centro_2)) / 2)}%</td>
                <td>${porcentagem((parseFloat(media_traseira) + parseFloat(traseira_2)) / 2)}%</td>
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
</br>

<h3>Média em relção aos dois pés:</h3>
<p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Fim: dianteira-${porcentagem((parseFloat(media_dianteira) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(media_centro) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(media_traseira) + parseFloat(traseira_2)) / 2)}%</p>

<h3>Pé direito:</h3>
<p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Meio: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Fim: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>

<h3>Pé esquerdo:</h3>
<p>Início: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Fim: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
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
                <th scope="col">Etapas</th>
                <th scope="col">Dianteira</th>
                <th scope="col">Centro</th>
                <th scope="col">Calcanhar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Início</th>
                <td>${porcentagem(media_dianteira)}%</td>
                <td>${porcentagem(media_centro)}%</td>
                <td>${porcentagem(media_traseira)}%</td>
            </tr>
            <tr>
                <th scope="row">Meio</th>
                <td>${porcentagem(media_dianteira)}%</td>
                <td>${porcentagem(media_centro)}%</td>
                <td>${porcentagem(media_traseira)}%</td>
            </tr>
            <tr>
                <th scope="row">Fim</th>
                <td>${porcentagem(media_dianteira)}%</td>
                <td>${porcentagem(media_centro)}%</td>
                <td>${porcentagem(media_traseira)}%</td>
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
</br>

<h3>Média em relção aos dois pés:</h3>
<p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Fim: dianteira-${porcentagem((parseFloat(media_dianteira) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(media_centro) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(media_traseira) + parseFloat(traseira_2)) / 2)}%</p>

<h3>Pé direito:</h3>
<p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Meio: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Fim: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>

<h3>Pé esquerdo:</h3>
<p>Início: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Fim: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
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
                <th scope="col">Etapas</th>
                <th scope="col">Dianteira</th>
                <th scope="col">Centro</th>
                <th scope="col">Calcanhar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Início</th>
                <td>${porcentagem(dianteira_2)}%</td>
                <td>${porcentagem(centro_2)}%</td>
                <td>${porcentagem(traseira_2)}%</td>
            </tr>
            <tr>
                <th scope="row">Meio</th>
                <td>${porcentagem(dianteira_2)}%</td>
                <td>${porcentagem(centro_2)}%</td>
                <td>${porcentagem(traseira_2)}%</td>
            </tr>
            <tr>
                <th scope="row">Fim</th>
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
</br>

<h3>Média em relção aos dois pés:</h3>
<p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Fim: dianteira-${porcentagem((parseFloat(media_dianteira) + parseFloat(dianteira_2)) / 2)}% centro-${porcentagem((parseFloat(media_centro) + parseFloat(centro_2)) / 2)}% traseira-${porcentagem((parseFloat(media_traseira) + parseFloat(traseira_2)) / 2)}%</p>

<h3>Pé direito:</h3>
<p>Início: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Meio: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>
<p>Fim: dianteira-${porcentagem(media_dianteira)}% centro-${porcentagem(media_centro)}% traseira-${porcentagem(media_traseira)}%</p>

<h3>Pé esquerdo:</h3>
<p>Início: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
<p>Fim: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
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