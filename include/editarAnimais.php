<?php
include_once("../classes/Animais.php");
$objAnimais = new Animais();
if (isset($_GET['id'])) {
    $objAnimais->selecionarPorId($_GET['id']);
}
$retorno = $objAnimais->retornoBD->fetch_object();
?>

<div class="container">
    <div class="row">
        <div class="col-10">
            <form method="POST" action="">
            <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome-animal" aria-describedby="nomeHelp" name="nomeAnimal" value="<?php echo $retorno->nome_animal; ?>">
                    <div id="nomeHelp" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label for="especie" class="form-label">Espécie</label>
                    <input type="text" class="form-control" id="especie-animal" aria-describedby="especieHelp" name="especieAnimal" value="<?php echo $retorno->especie_animal; ?>">
                    <div id="especie" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <?php 
                        if($retorno->sexo_animal == "Masculino"){
                           echo '<label class="form-label">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexoAnimal" id="sexoMasculino" value="Masculino" checked>
                                <label class="form-check-label" for="sexoMasculino">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexoAnimal" id="sexoFeminino" value="Feminino" >
                                <label class="form-check-label" for="sexoFeminino">
                                    Feminino
                                </label>
                            </div>';
                        }else {
                            echo '<label class="form-label">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexoAnimal" id="sexoMasculino" value="Masculino" >
                                <label class="form-check-label" for="sexoMasculino">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexoAnimal" id="sexoFeminino" value="Feminino" checked>
                                <label class="form-check-label" for="sexoFeminino">
                                    Feminino
                                </label>
                            </div>';
                        }
                    ?>
                    
                </div>
              
                <input type="hidden" value="<?php echo $retorno->id_animal; ?>" name="idAnimal" >
                <input type="hidden" name="formEditarAnimais">
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