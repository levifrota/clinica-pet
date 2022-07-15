<div class="container">
    <div class="row">
        <div class="col-10">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Animal</label>
                    <input type="text" class="form-control" id="nome-animal" aria-describedby="nomeHelp" name="nomeAnimal">
                    <div id="nomeHelp" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label for="especie" class="form-label">Espécie</label>
                    <input type="text" class="form-control" id="especie-animal" aria-describedby="especieHelp" name="especieAnimal">
                    <div id="especie" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sexo</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexoAnimal" id="sexoMasculino" value="Masculino">
                        <label class="form-check-label" for="sexoMasculino">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexoAnimal" id="sexoFeminino" value="Feminino" checked>
                        <label class="form-check-label" for="sexoFeminino">
                            Feminino
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cpfCliente" class="form-label">CPF do Cliente</label>
                    <input type="text" class="form-control" id="cpfCliente-animal" aria-describedby="cpfClienteHelp" name="cpfClienteAnimal">
                    <div id="cpfClienteHelp" class="form-text"></div>
                </div>

                <input type="hidden" name="formCadastrarAnimais">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
</div>