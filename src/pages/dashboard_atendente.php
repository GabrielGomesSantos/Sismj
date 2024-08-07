

    <div class="container">
        <div class="row mb-5">
            <div class="col-1"  >
                    
                <div style="background-color: #17a2b8; width: 50px; height: 100%;">
                    a
                </div>
                    
            </div>
            <div class="col-10 ">
            <div class="row mt-5" >
                        <div class="col mt-3" >
                            <header class=" text-white btn-block btn-info" style=" padding: 5px; padding-left: 15px;    ">Entregas:
                            </header>
                        </div>
                    </div>

                 <div class="row">
                        <div class="col-2 offset-10"><input type="submit" value="Teste" class="btn text-white btn-block     btn-info mt-5">
                    </div>
                </div>
                 <div class="row" ><div style="display: flex; justify-content: center;" class="col-10 offset-1">

                         <?php $data = [
                            ['n' => 1, 'medicamento' => 'Paracetamol', 'tipo' => 'Comprimido', 'categoria' =>   'Analgesico',         'laboratorio' => 'Lab A', 'lote' => 'L123', 'validade' => '2024-12-31',     'quantidade' => 50],
                            ['n' => 2, 'medicamento' => 'Ibuprofeno', 'tipo' => 'Comprimido', 'categoria' =>    'Antiinflamatório',        'laboratorio' => 'Lab B', 'lote' => 'L456', 'validade' =>   '2025-06-30', 'quantidade' => 100],
                            // Adicione mais dados conforme necessário
                        ];
                        ?>

                    
                            <table class="table mt-5">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Medicamento</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Laboratório</th>
                                        <th scope="col">Lote</th>
                                        <th scope="col">Validade</th>
                                        <th scope="col">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['n']; ?></th>
                                            <td><?php echo $row['medicamento']; ?></td>
                                            <td><?php echo $row['tipo']; ?></td>
                                            <td><?php echo $row['categoria']; ?></td>
                                            <td><?php echo $row['laboratorio']; ?></td>
                                            <td><?php echo $row['lote']; ?></td>
                                            <td><?php echo $row['validade']; ?></td>
                                            <td><?php echo $row['quantidade']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    
    