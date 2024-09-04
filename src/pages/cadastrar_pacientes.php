<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Cadastro de <strong>Pacientes</strong></h3>
                                <p class="mb-4">Formulario para cadastrar Pacientes</p>
                            </div>
                            <form action="processar_cadastro_paciente.php" method="post">
                                <div class="form-group first mb-4">
                                    <label for="nome_paciente">Nome:</label>
                                    <input type="text" class="form-control" id="nome_paciente"
                                        name="nome_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cpf_paciente">Cpf:</label>
                                    <input type="number" class="form-control" id="cpf_paciente" name="cpf_paciente"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cns_paciente">Cns:</label>
                                    <input type="text" class="form-control" id="cns_paciente"
                                        name="cns_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="logradouro_paciente">Logradouro:</label>
                                    <input type="text" class="form-control" id="logradouro_paciente"
                                        name="logradouro_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="numero_paciente">Numero:</label>
                                    <input type="number" class="form-control" id="numero_paciente"
                                        name="numero_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="complemento_paciente">Complemento:</label>
                                    <input type="text" class="form-control" id="complemento_paciente"
                                        name="complemento_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="bairro_paciente">Bairro:</label>
                                    <input type="text" class="form-control" id="bairro_paciente"
                                        name="bairro_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cidade_paciente">Cidade:</label>
                                    <input type="text" class="form-control" id="cidade_paciente"
                                        name="cidade_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cep_paciente">Cep:</label>
                                    <input type="number" class="form-control" id="cep_paciente"
                                        name="cep_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="estado_paciente">Estado:</label>
                                    <input type="text" class="form-control" id="estado_paciente"
                                        name="estado_paciente" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="celular_paciente">Celular:</label>
                                    <input type="number" class="form-control" id="celular_paciente"
                                        name="celular_paciente" required>
                                </div>


                                </div>
                                <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>