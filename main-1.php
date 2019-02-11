<!-- Responsável por buscar os arquivos no banco de dados -->
<?php
include_once "conexao.php";

//consultar no banco de dados
$result_usuario = "SELECT * FROM usuarios ORDER BY id ASC";
//Executando a query
$resultado_usuario = mysqli_query($conn, $result_usuario);

//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){

	while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
        $tempo_1[] = $row_usuario['tempo'];
        $dianteira_1[] = $row_usuario['valor1'];
        $centro_1[] = $row_usuario['valor2'];
        $traseira_1[] = $row_usuario['valor3'];
    }
    $tempo_1 = implode('|', $tempo_1);
    $dianteira_1 = implode('|', $dianteira_1);
    $centro_1 = implode('|', $centro_1);
    $traseira_1 = implode('|', $traseira_1);
}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
?>


<script>
//variáveis
var i, array_dianteira, array_centro, array_traseira, array_tempo;
var string_dianteira, string_centro, string_traseira, string_tempo;

//recebe a string com elementos separados, vindos do PHP
string_tempo = "<?php echo $tempo_1; ?>";
string_dianteira = "<?php echo $dianteira_1; ?>";
string_centro = "<?php echo $centro_1; ?>";
string_traseira = "<?php echo $traseira_1; ?>";

//transforma esta string em um array próprio do Javascript
array_tempo = string_tempo.split("|");
array_dianteira = string_dianteira.split("|");
array_centro = string_centro.split("|");
array_traseira = string_traseira.split("|");




// *****************  INICIO CALCULOS COM OS ARRAYS JS *********************
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

var tempoDaCorrida =  array_tempo[--i] - array_tempo[0]
//alert(tempoDaCorrida);

// Somas dos dados iniciais
soma_dianteira = 0; soma_centro = 0; soma_traseira = 0;
var j;
for (j = 0; j < i*0.2; j++)
soma_dianteira += parseFloat(array_dianteira[j])

for (j = 0; j < i*0.2; j++)
soma_centro += parseFloat(array_centro[j])

for (j = 0; j < i*0.2; j++)
soma_traseira += parseFloat(array_traseira[j])
// FIM das somas dos dados iniciais

// Média dos dados iniciais
var media_inicio_dianteira = soma_dianteira/j;
var media_inicio_centro = soma_centro/j;
var media_inicio_traseira = soma_traseira/j;
// alert(media_inicio_dianteira);
// alert(media_inicio_centro);
// alert(media_inicio_traseira);
// FIM da Média dos dados iniciais


// Somas dos dados no meio
soma_dianteira = 0; soma_centro = 0; soma_traseira = 0;
var k;
//alert(j);
for (k = j; k < i*0.8; k++)
soma_dianteira += parseFloat(array_dianteira[k])

for (k = j; k < i*0.8; k++)
soma_centro += parseFloat(array_centro[k])

for (k = j; k < i*0.8; k++)
soma_traseira += parseFloat(array_traseira[k])

//alert(soma_dianteira);
// FIM das somas dos dados no meio

// Média dos dados no meio
//alert(k);
var media_meio_dianteira = soma_dianteira/(k-j);
var media_meio_centro = soma_centro/(k-j);
var media_meio_traseira = soma_traseira/(k-j);
//  alert(media_meio_dianteira);
//  alert(media_meio_centro);
//  alert(media_meio_traseira);
// FIM da Média dos dados no meio


// Somas dos dados do fim
soma_dianteira = 0; soma_centro = 0; soma_traseira = 0;
var l;
//alert(k);
for (l = k; l < i; l++)
soma_dianteira += parseFloat(array_dianteira[l])

for (l = k; l < i; l++)
soma_centro += parseFloat(array_centro[l])

for (l = k; l < i; l++)
soma_traseira += parseFloat(array_traseira[l])

//alert(soma_dianteira);
// FIM das somas dos dados do fim

// Média dos dados do fim
//alert(l);
var media_fim_dianteira = soma_dianteira/(l-k);
var media_fim_centro = soma_centro/(l-k);
var media_fim_traseira = soma_traseira/(l-k);
 //alert(media_fim_dianteira);
 //alert(media_fim_centro);
 //alert(media_fim_traseira);
// FIM da Média dos dados do fim

// *****************  FIM CALCULOS COM OS ARRAYS JS *********************



// *****************  INICIO ANIMACAO *********************
var f = 0;

function animacao(){
    if(f < array_tempo.length){
        setTimeout(animaCor, 100);
    } else {
        alert(f);
        f=0
    }
}

function animaCor() {
        
        let listaValores = `.st0{fill:rgb(${color(array_dianteira[f])},0);}
                            .st1{fill:rgb(${color(array_centro[f])},0);}
                            .st2{fill:rgb(${color(array_traseira[f])},0);}
                            .st3{fill:rgb(${color(dianteira2.value)},0);}
                            .st4{fill:rgb(${color(centro2.value)},0);}
                            .st5{fill:rgb(${color(traseira2.value)},0);}`

        estilo.innerHTML = listaValores

        f++
        animacao();
    }

// *****************  INICIO ANIMACAO *********************



//***************** INÍCIO MUDAR A COR DA PEGADA ************** 
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



//********************** INÍCIO FUNÇÕES AUXILIARES ***************************
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



//********************** INÍCIO FUNÇÕES GERAR ***************************
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



//********************** INÍCIO FUNÇÕES DOIS PÉS ***************************
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



//********************** INÍCIO FUNÇÃO PÉ DIREITO ***************************
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
                    <td>${porcentagem(media_inicio_dianteira)}%</td>
                    <td>${porcentagem(media_inicio_centro)}%</td>
                    <td>${porcentagem(media_inicio_traseira)}%</td>
                </tr>
                <tr>
                    <th scope="row">Meio</th>
                    <td>${porcentagem(media_meio_dianteira)}%</td>
                    <td>${porcentagem(media_meio_centro)}%</td>
                    <td>${porcentagem(media_meio_traseira)}%</td>
                </tr>
                <tr>
                    <th scope="row">Fim</th>
                    <td>${porcentagem(media_fim_dianteira)}%</td>
                    <td>${porcentagem(media_fim_centro)}%</td>
                    <td>${porcentagem(media_fim_traseira)}%</td>
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
    <p>Início: dianteira-${porcentagem(media_inicio_dianteira)}% centro-${porcentagem(media_inicio_centro)}% traseira-${porcentagem(media_inicio_traseira)}%</p>
    <p>Meio: dianteira-${porcentagem(media_meio_dianteira)}% centro-${porcentagem(media_meio_centro)}% traseira-${porcentagem(media_meio_traseira)}%</p>
    <p>Fim: dianteira-${porcentagem(media_fim_dianteira)}% centro-${porcentagem(media_fim_centro)}% traseira-${porcentagem(media_fim_traseira)}%</p>

    <h3>Pé esquerdo:</h3>
    <p>Início: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
    <p>Meio: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
    <p>Fim: dianteira-${porcentagem(dianteira_2)}% centro-${porcentagem(centro_2)}% traseira-${porcentagem(traseira_2)}%</p>
    </div>

    `
    relatorio.innerHTML = report
}
//********************** FIM DA FUNÇÃO PÉ DIREITO ***************************



//********************** INÍCIO FUNÇÃO PÉ ESQUERDO ***************************
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



//********************** INÍCIO FUNÇÃO MOSTRAR LISTA DO BANCO DE DADOS ***************************
function mostraLista(){
    lista.style.display="inline"
}
//********************** FIM DO FUNÇÃO MOSTRAR LISTA DO BANCO DE DADOS ***************************
</script>