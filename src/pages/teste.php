<?php 

     $qualquer = json_dcode($_POST['dado'],true);
     file_put_contents('debug.log', print_r($qualquer,true));



?>