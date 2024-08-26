<?php 

     $qualquer = json_dcode($_POST['dado'],true);
     file_put_contents('debug.log', print_r($qualquer,true));

     file_put_contents('error_log.txt', $e->getMessage(), FILE_APPEND);



?>