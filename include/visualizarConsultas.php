<?php
include_once("../classes/Animais.php");
include_once("../classes/Consultas.php");

$objAnimal = new Animais();
$objAnimal->selecionarPorId($_GET['id']);
$nomeAnimal = $objAnimal->retornoBD->fetch_object()->nome_animal;
$nomeCliente = $objAnimal->verCliente($_GET['id']);
?>
<div class="row">
    <div class="col-lg-6">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-8">
            <h3 class="m-0 font-weight-bold">Consultas do(a) <?= $nomeAnimal; ?> filho(a) de <?= $nomeCliente; ?> </h3>
        </div>
    </div>
</div>

<?php
$objConsulta = new Consultas();
$objConsulta->selecionarPorAnimal($_GET['id']);

if ($objConsulta->retornoBD != null) {
?>
    <br/>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th width="5%">#</th>
                    <th width="60%">Observações</th>
                    <th width="30%">Data/Hora</th>
                    <th width="15%">Editar</th>
                    <th width="15%">Deletar</th>
                </tr>

                <?php

                while ($retorno = $objConsulta->retornoBD->fetch_object()) {
                    echo '<tr><td>' . $retorno->id_consulta . '</td>
                        <td>' . $retorno->observacao_consulta . '</td>
                        <td>' . $retorno->data_consulta. '</td>';
 
                    echo '<td><a href="?rota=editar_consulta&id='.$retorno->id_consulta.'" class="btn btn-info btn-circle btn-sm"><i class="fas fa-list"></i></a></td>';
                    echo '<td><a href="#" class="btn btn-danger btn-circle btn-sm" onclick=\'deletarAnimal("' . $retorno->id_consulta . '");\'><i class="fas fa-trash"></i></a></td></tr>';

                }

                ?>
            </table>
        </div>
    </div>
    
<?php
} else{
    $objConsulta->selecionarConsultas();
}
?>