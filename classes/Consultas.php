<?php
include_once("../classes/Conexao.php");
include_once("../classes/Utilidades.php");
include_once("../classes/Cliente.php");

class Consultas
{

    private $id;
    private $data;
    private $observacoes;

    public $retornoBD;
    public $conexaoBD;
    public $consulta;

    public function  __construct()
    {
        $objConexao = new Conexao();
        $this->conexaoBD = $objConexao->getConexao();
        $this->utilidades = new Utilidades();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getObervacao()
    {
        return $this->observacoes;
    }

    public function setId($id)
    {
        //validacao
        return $this->id = $id;
    }
    public function setData($data)
    {
        return $this->data = $data;
    }
    public function setObervacao($observacoes)
    {
        return $this->observacoes = $observacoes;
    }
    
    public function cadastrar()
    {

        if (isset($_POST['cpfClienteAnimal']) && isset($_POST['nomeAnimal'])) {
                $objAnimal = new Animais;
                $objAnimal->selecionarPorNome($_POST['nomeAnimal']);
                $id_animal_cliente = $objAnimal->retornoBD->fetch_object()->id_animal_cliente;
                $objAnimal->selecionarPorNome($_POST['nomeAnimal']);
                $id_consulta_animal = $objAnimal->retornoBD->fetch_object()->id_animal;
                
                $ObjCiente = new Cliente();
                $ObjCiente->selecionarPorId($id_animal_cliente);
                $cpfClienteAnimal = $ObjCiente->retornoBD->fetch_object()->cpf_cliente;
            if ($cpfClienteAnimal == $_POST['cpfClienteAnimal']){
                $interacaoMySql = $this->conexaoBD->prepare("INSERT INTO consultas (id_consulta_animal, observacao_consulta, data_consulta) 
                VALUES (?, ?, ?)");
                $interacaoMySql->bind_param('iss', $id_consulta_animal, $this->getObervacao(), $this->getData());
                $retorno = $interacaoMySql->execute();

                $id = mysqli_insert_id($this->conexaoBD);
            }

            return $this->utilidades->validaRedirecionar($retorno, "$id_consulta_animal", "admin.php?rota=visualizar_animais", "Consulta agendada com sucesso!");
        } else {
            return $this->utilidades->mensagemUsuario("Erro, agendamento não realizado!");
        }
    }

    public function editar()
    {

        if ($this->getId() != null) {

            $interacaoMySql = $this->conexaoBD->prepare("UPDATE consultas SET  observacao_consulta=?, data_consulta=? WHERE id_consulta=?");
            $interacaoMySql->bind_param('iss', $this->getId(), $this->getObervacao(), $this->getData());

            $retorno = $interacaoMySql->execute();
            if ($retorno === false) {
                trigger_error($this->conexaoBD->error, E_USER_ERROR);
            }

            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $this->getId(), "admin.php?rota=visualizar_consulta", "Os dados da consulta foram alterados com sucesso!");
        } else {
            return $this->utilidades->mensagemUsuario("Erro! Não foi possível editar.");
        }
    }

    public function selecionarPorId($id)
    {
        $sql = "select * from consultas where id_consulta='$id'";
        $this->retornoBD = $this->conexaoBD->query($sql);

    }

    public function selecionarPorAnimal($id){
        $sql = "select * from consultas where id_consulta_animal='$id'";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    
    public function selecionarConsultas()
    {
        $sql = "SELECT * FROM `consultas` ORDER BY `data_consulta` DESC;";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }

     public function deletar($id)
    {
        $sql = "DELETE from consultas where id_consulta=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
        $this->utilidades->validaRedirecionaAcaoDeletar($this->retornoBD, 'admin.php?rota=visualizar_consultas', 'O agendamento foi deletado com sucesso!');
    }

}
