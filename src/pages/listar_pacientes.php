<?php
    // Inclui o arquivo de conexão com o banco de dados
    $servername = "localhost"; // ou o endereço do seu servidor
    $username = "root"; // seu usuário do banco de dados
    $password = ""; // sua senha do banco de dados
    $dbname = "trabalho_final"; // nome do seu banco de dados

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM pacientes";
    $result = $conn->query($sql);
?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Fonte Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Titulo -->
    <link rel="shortcut icon" href="../../assets/images/favico.ico">
    <title>Remover Pacientes</title>
</head>

<body>
    <?php include('navbar.php'); ?>

    <a href="cadastrar_pacientes.php" class="btn btn-primary mt-5 mb-5 text-white">Cadastrar pacientes</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Cns</th>
                <th scope="col">Logradouro</th>
                <th scope="col">Número</th>
                <th scope="col">Complemento</th>
                <th scope="col">Bairro</th>
                <th scope="col">Cidade</th>
                <th scope="col">Cep</th>
                <th scope="col">Estado</th>
                <th scope="col">Celular</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($row['cod_paciente']); ?></th>
                        <td><?php echo htmlspecialchars($row['nome_paciente']); ?></td>
                        <td><?php echo htmlspecialchars($row['cpf_paciente']); ?></td>
                        <td><?php echo htmlspecialchars($row['cns_paciente']); ?></td>
                        <td><?php echo htmlspecialchars($row['logradouro']); ?></td>
                        <td><?php echo htmlspecialchars($row['numero']); ?></td>
                        <td><?php echo htmlspecialchars($row['complemento']); ?></td>
                        <td><?php echo htmlspecialchars($row['bairro']); ?></td>
                        <td><?php echo htmlspecialchars($row['cidade']); ?></td>
                        <td><?php echo htmlspecialchars($row['cep']); ?></td>
                        <td><?php echo htmlspecialchars($row['estado']); ?></td>
                        <td><?php echo htmlspecialchars($row['celular']); ?></td>
                        <td><a href="deletar_pacientes.php?id_paciente=<?php echo urlencode($row['cod_paciente']); ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="12">Nenhum paciente encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <?php include('footer.php'); ?>

    <?php $conn->close(); ?>
</body>

</html>
