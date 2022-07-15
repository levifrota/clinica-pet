<?php
include_once("../classes/Animais.php");
include_once("../classes/Consultas.php");
include_once("../classes/Cliente.php");

$objAnimal = new Animais();
$objAnimal->selecionarPorId($_GET['id']);
$nomeAnimal = $objAnimal->retornoBD->fetch_object()->nome_animal;
$objAnimal->selecionarPorId($_GET['id']);
$id_consulta_animal = $objAnimal->retornoBD->fetch_object()->id_animal;
$ObjCiente = new Cliente();
$ObjCiente->selecionarPorId($id_animal_cliente);
$cpfClienteAnimal = $ObjCiente->retornoBD->fetch_object()->cpf_cliente;

$objConsulta = new Consultas();
if (isset($_GET['id'])) {
    $objConsulta->selecionarPorAnimal($_GET['id']);
}
$retorno = $objConsulta->retornoBD->fetch_object();
?>

<div class="container">
    <div class="row">
        <div class="col-10">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Animal</label>
                    <input type="text" class="form-control" id="nome-animal" aria-describedby="nomeHelp" name="nomeAnimal" value="<?=$nomeAnimal; ?>">
                    <div id="nome" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label for="cpfCliente" class="form-label">CPF do Cliente</label>
                    <input type="text" class="form-control" id="cpfCliente-animal" aria-describedby="cpfClienteHelp" name="cpfClienteAnimal" value="<?=$cpfClienteAnimal;?>">
                    <div id="cpfCliente" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label for="dataConsulta" class="form-label">Data</label>
                    <input type="time" class="form-control" id="hora-consulta" aria-describedby="horaConsultaHelp" name="horaConsultaAnimal">
                    <input type="date" class="form-control" id="data-consulta" aria-describedby="dataConsultaHelp" name="dataConsultaAnimal">
                    <div id="dataConsulta" class="form-date"></div>
                </div>
                <div class="mb-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <input type="text" class="form-control" id="observacoes-consulta" aria-describedby="observacoesHelp" name="observacoesConsulta">
                    <div id="observacoes" class="form-text"></div>
                </div>

                <input type="hidden" name="formAgendarConsulta">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
</div>
<?php

// }else{
//     header("Location:../index.html");
// }
?>