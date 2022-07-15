<?php
include_once("../classes/Cliente.php");
include_once("../classes/Animais.php");

if(isset($_POST['idClienteDeletar'])){
    $objCliente = new Cliente();
    $objCliente->deletar($_POST['idClienteDeletar']);
}else if(isset($_POST['idAnimalDeletar'])) {
    $objAnimal = new Animais();
    $objAnimal->deletar($_POST['idAnimalDeletar']);

}

