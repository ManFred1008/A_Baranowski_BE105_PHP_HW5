<?php

require_once './pagesData.php';

$key = 'home';

      if(!empty($_GET['p'])) {
         $key = $_GET['p'];
      }
      
      echo $data[$key];

?>