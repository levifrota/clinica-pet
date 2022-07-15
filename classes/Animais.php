<?php
include_once("../classes/Conexao.php");
include_once("../classes/Utilidades.php");
include_once("../classes/Cliente.php");
class Animais
{
    private $nome;
    private $id;
    private $sexo;
    private $especie;
    private $utilidades;

    public $retornoBD;
    public $conexaoBD;
    public $animais;

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
    public function getNome()
    {
        return $this->nome;
    }
    public function getEspecie()
    {
        return $this->especie;
    }
    public function getSexo()
    {
        return $this->sexo;
    }
    public function getCliente()
    {
        return $this->cpf_cliente;
    }


    public function setNome($nome)
    {
        //validacao
        return $this->nome =  mb_strtoupper($nome, 'UTF-8');
    }
    public function setId($id)
    {
        //validacao
        return $this->id = $id;
    }
    public function setEspecie($especie)
    {
        return $this->especie = $especie;
    }
    public function setSexo($sexo)
    {
        return $this->sexo = $sexo;
    }
    public function setCliente($cpf_cliente)
    {
        return $this->cpf_cliente = $cpf_cliente;
    }
    
    public function cadastrar()
    {

        if ($this->getCliente() != null) {
                $objCliente = new Cliente;
                $objCliente->selecionarPorCPF($this->getCliente());
                $cliente_id = $objCliente->retornoBD->fetch_object()->id_cliente;
            if ($cliente_id){
                $interacaoMySql = $this->conexaoBD->prepare("INSERT INTO animais (id_animal_cliente, nome_animal, especie_animal, sexo_animal) 
                VALUES (?, ?, ?, ?)");
                $interacaoMySql->bind_param('isss', $cliente_id, $this->getNome(), $this->getEspecie(), $this->getSexo());
                $retorno = $interacaoMySql->execute();

                $id = mysqli_insert_id($this->conexaoBD);
            }

            return $this->utilidades->validaRedirecionar($retorno, $id, "admin.php?rota=visualizar_animais", "Cadastro feito com sucesso!");
        } else {
            return $this->utilidades->mensagemUsuario("Não encontramos nada na nossa base de dados.");
        }
    }

    public function editar()
    {

        if ($this->getId() != null) {

            $interacaoMySql = $this->conexaoBD->prepare("UPDATE animais SET nome_animal=?, especie_animal=?, sexo_animal=? WHERE id_animal=?");
            $interacaoMySql->bind_param('ssssi', $this->getNome(), $this->getEspecie(), $this->getSexo(), $this->getId());
            $retorno = $interacaoMySql->execute();
            if ($retorno === false) {
                trigger_error($this->conexaoBD->error, E_USER_ERROR);
            }

            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $this->getId(), "admin.php?rota=visualizar_animais", "Os dados do animal foram alterados com sucesso!");
        } else {
            return $this->utilidades->mensagemUsuario("Erro! nome não foi infomado.");
        }
    }

    public function selecionarPorId($id)
    {
        $sql = "select * from animais where id_animal='$id'";
        $this->retornoBD = $this->conexaoBD->query($sql);

    }
    public function selecionarPorNome($nome)
    {
        $sql = "SELECT * FROM `animais` WHERE `nome_animal`='$nome'";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarPorEspecie($especie)
    {
        $sql = "select * from animais where especie_animal='$especie'";
        $this->retornoBD = $this->conexaoBD->query($sql);

    }
    
    public function selecionarAnimais()
    {
        $sql = "select * from animais order by data_cadastro_animal DESC";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }

       public function verCliente($id)
    {
        $ObjCiente = new Cliente();
        $animal = new Animais();
        $animal->selecionarPorId($id);
        $ObjCiente->selecionarPorId((int)$animal->retornoBD->fetch_object()->id_animal_cliente);
        $nomeCliente = $ObjCiente->retornoBD->fetch_object()->nome_cliente;

        return $nomeCliente;
    }

    public function deletar($id)
    {
        $sql = "DELETE from animais where id_animal=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
        $this->utilidades->validaRedirecionaAcaoDeletar($this->retornoBD, 'admin.php?rota=visualizar_animais', 'O animal foi deletado com sucesso!');
    }

}
