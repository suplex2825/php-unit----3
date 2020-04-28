<?php 
    try {
      $db = new PDO("sqlite:".__DIR__."/journal.db");
    } catch (Exception $e) {
       $e->getMessage();
       exit;
    }
?>