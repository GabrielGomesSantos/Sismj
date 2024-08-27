<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Cadastro de <strong>Funcionarios</strong></h3>
                            <p class="mb-4">Formulario para cadastrar Funcionarios</p>
                        </div>
                        <form action="cadastrar_funcionario.php" method="post">
                            <div class="form-group first mb-4">
                                <label for="nome_funcionario">Nome:</label>
                                <input type="text" class="form-control" id="nome_funcionario" name="nome_funcionario"
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="cpf_funcionario">Cpf:</label>
                                <input type="text" class="form-control" id="cpf_funcionario" name="cpf_funcionario"
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="matricula_funcionario">Matricula:</label>
                                <input type="text" class="form-control" id="matricula_funcionario" 0
                                    name="matricula_funcionario" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email_funcionario">Email:</label>
                                <input type="email" class="form-control" id="email_funcionario" name="email_funcionario"
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="senha_funcionario">Senha:</label>
                                <input type="password" class="form-control" id="senha_funcionario"
                                    name="senha_funcionario" required>
                            </div>

                            <div class="form-group form-floating-label mt-2">

                                <label for="perfil_funcionario">Perfil</label>
                                <select class="form-select form-control" id="perfil_funcionario"
                                    name="perfil_funcionario" required>
                                    <option value="" selected disabled></option>
                                    <option value="1">Gestor</option>
                                    <option value="2">Atendente</option>
                                </select>

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
    $nome_funcionario = $_POST['nome_funcionario'];
    $cpf_funcionario = $_POST['cpf_funcionario'];
    $matricula_funcionario = $_POST['matricula_funcionario'];
    $email_funcionario = $_POST['email_funcionario'];
    $senha_funcionario = $_POST['senha_funcionario'];
    $perfil_funcionario = $_POST['perfil_funcionario'];


    $sql = "INSERT INTO funcionarios (nome_funcionario, cpf_funcionario, matricula, email_funcionario, senha, perfil) VALUES ('$nome_funcionario', '$cpf_funcionario', '$matricula_funcionario', '$email_funcionario', '$senha_funcionario', '$perfil_funcionario')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Funcionario Cadastrado');
        window.location.href='dashboard.php?pag=2'
        </script>";
    } else {
        echo "Erro ao cadastrar funcionario: " . $conn->error;
    }


   
}