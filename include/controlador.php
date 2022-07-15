<?php
include_once("../classes/Cliente.php");
include_once("../classes/Animais.php");
include_once("../classes/Consultas.php");

//Get
if (isset($_GET['rota'])) {
    switch ($_GET['rota']) {
        case "cadastrar_cliente":
            include("../include/cadastrarCliente.php");
            break;

        case "visualizar_cliente":
            include("../include/visualizarCliente.php");
            break;

        case "editar_cliente":
            include("../include/editarCliente.php");
            break;

        case "cadastrar_animais":
            include("../include/cadastrarAnimais.php");
            break;

        case "visualizar_animais":
            include("../include/visualizarAnimais.php");
            break;

        case "editar_animal":
            include("../include/editarAnimais.php");
            break;
        case "cadastrar_consulta":
            include("../include/cadastrarConsultas.php");
            break;
        case "visualizar_consulta":
            include("../include/editarConsulta.php");
            break;
    }
}


//Post
if (isset($_POST['formCadastrarCliente'])) {
    $objCliente = new Cliente();
    $objCliente->setNome($_POST['nomeCliente']);
    $objCliente->setCelular($_POST['celularCliente']);
    $objCliente->setEndereco($_POST['enderecoCliente']);
    $objCliente->setCPF($_POST['cpfCliente']);
    $objCliente->setEmail($_POST['emailCliente']);

    $objCliente->cadastrar();
} else if (isset($_POST['formEditarCliente'])) {
    $objCliente = new Cliente();
    $objCliente->setNome($_POST['nomeCliente']);
    $objCliente->setCelular($_POST['celularCliente']);
    $objCliente->setEndereco($_POST['enderecoCliente']);
    $objCliente->setCPF($_POST['cpfCliente']);
    $objCliente->setEmail($_POST['emailCliente']);
    $objCliente->setID($_POST['idCliente']);

    $objCliente->editar();
} else if (isset($_POST['formCadastrarAnimais'])) {
    $objAnimal = new Animais();
    $objAnimal->setNome($_POST['nomeAnimal']);
    $objAnimal->setEspecie($_POST['especieAnimal']);
    $objAnimal->setSexo($_POST['sexoAnimal']);
    $objAnimal->setCliente($_POST['cpfClienteAnimal']);

    $objAnimal->cadastrar();
} else if (isset($_POST['formEditarAnimais'])) {
    $objAnimal = new Animais();
    $objAnimal->setNome($_POST['nomeAnimal']);
    $objAnimal->setEspecie($_POST['especieAnimal']);
    $objAnimal->setSexo($_POST['sexoAnimal']);
    $objAnimal->setId($_POST['idAnimal']);

    $objAnimal->editar();
} else if(isset($_POST['formAgendarConsulta'])) {
    $objConsulta = new Consultas();
    $objConsulta->setData($_POST['dataConsultaAnimal'] .' '. $_POST['horaConsultaAnimal']);
    $objConsulta->setObervacao($_POST['observacoesConsulta']);
    $objConsulta->cadastrar();
}
