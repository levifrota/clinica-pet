<?php

class Utilidades{

    public function __construct()    {
    }

    public function redireciona($link) {

        if ($link == -1) {
            echo" <script>history.go(-1);</script>";
        } else {
            echo" <script>document.location.href='$link'</script>";
        }
    }
    public function alerta($sucesso) {
        if ($sucesso) {
            echo "<script>alert('Operação executada com sucesso!')</script>";
        } else {
            echo "<script>alert('Operação não foi executada!')</script>";
        }
    }
    
    public function mensagemUsuario($msg) {
        echo "<script>alert('$msg')</script>";
    }

    public function validaRedirecionar($retornoBanco, $id, $pag, $msg)  {
        if ($retornoBanco != 0) {
            $link = $pag . "&id=" . $id . '&msg=' . $msg;
            $this->redireciona($link);
            return true;
        } else {
            $this->alerta(false);
            return false;
        }
    }
    public function validaRedirecionaAcaoDeletar($retornoBanco, $pag, $msg) {
        if ($retornoBanco == 0) {
            $this->mensagemUsuario("O elemento não pode ser deletado!");
         } else {
            $url = $pag . '&msg=' . $msg;
            $this->redireciona($url);
        } 
    }
    public function validaLogin() {
        session_start();
    
        if(!($_SESSION['admin'])) {
            header("Location: ../index.html");
            exit();
        }
    }

}
