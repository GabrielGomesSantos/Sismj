
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Cadastro de <strong>medicos</strong></h3>
                                <p class="mb-4">Formulario para cadastrar medicos</p>
                            </div>
                            <form action="cadastrar_medico.php" method="post">
                                <div class="form-group first mb-4">
                                    <label for="nome_medico">Nome:</label>
                                    <input type="text" class="form-control" id="nome_medico"
                                        name="nome_medico" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="cpf_medico">Cpf:</label>
                                    <input type="text" class="form-control" id="cpf_medico" name="cpf_medico"
                                        required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="crm">CRM:</label>
                                    <input type="text" class="form-control" id="crm"
                                        name="crm" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="especialidade">Especialidade:</label>
                                    <input type="text" class="form-control" id="especialidade"
                                        name="especialidade" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="celular">Celular:</label>
                                    <input type="text" class="form-control" id="celular"
                                        name="celular" required>
                                </div>
                                <input type="submit" value="Cadastrar" class="btn text-white btn-block btn-info mt-5">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require_once('../../config/config.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_medico = $_POST['nome_medico'];
    $cpf_medico = $_POST['cpf_medico'];
    $crm = $_POST['crm'];
    $especialidade = $_POST['especialidade'];
    $celular = $_POST['celular'];


    $sql = "INSERT INTO medicos (nome_medico, cpf_medico, crm, especialidade, celular) VALUES ('$nome_medico', '$cpf_medico', '$crm', '$especialidade', '$celular')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Médico Cadastrado');
        window.location.href='dashboard.php?pag=3'
      
        </script>";
    } else {
        echo "Erro ao cadastrar medico: " . $conn->error;
    }



}
