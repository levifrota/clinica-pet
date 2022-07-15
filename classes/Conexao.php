<?php
class Conexao{

    private $url;
    private $usuario;
    private $senha;
    private $baseDeDados;


    public function __construct() {
        $this->url = "127.0.0.1";
        $this->usuario = "root";
        $this->senha = '';
        $this->baseDeDados = 'clinicapetgideao';
    }

    public function getConexao() {
        return  new mysqli( 
            $this->url, 
            $this->usuario, 
            $this->senha, 
            $this->baseDeDados
        );
    }
}

$conexao = mysqli_connect("127.0.0.1", "root", "", "clinicapetgideao") or die ("Conexão perdida");
