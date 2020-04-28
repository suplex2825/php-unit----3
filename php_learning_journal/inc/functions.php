<?php 
    function add_project($title,$date,$time_spent,$learned,$resources,$id = null) {
     include "connection.php";
     
     if($id) {
       $sql = "UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ? WHERE id = ?";
     }
      else {
        $sql = "INSERT INTO entries(title,date,time_spent,learned,resources) VALUES(?, ?, ?, ?, ?)";
     }
      
     try {
        $results = $db->prepare($sql);
        $results->bindValue(1,$title,PDO::PARAM_STR);
        $results->bindValue(2,$date,PDO::PARAM_STR);
        $results->bindValue(3,$time_spent,PDO::PARAM_STR);
        $results->bindValue(4,$learned,PDO::PARAM_STR);
        $results->bindValue(5,$resources,PDO::PARAM_STR);
       if($id) {
         $results->bindValue(6,$id,PDO::PARAM_INT);
       }
        $results->execute();
     } catch(Exception $e) {
       echo "Error message ". $e->getMessage();
       return false;
     }
     return true;
  }  




  function get_project_list() {
      include "connection.php";  
  
      try {
         $result = $db->query("SELECT * FROM entries ORDER BY date DESC");
         return $result;
      } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        return array();
      }
  }



  function get_project($id) {
     include "connection.php";
     
     $sql = "SELECT * FROM entries WHERE id = ?";
    
     try {
        $results = $db->prepare($sql);
        $results->bindValue(1,$id,PDO::PARAM_INT);
        $results->execute();
     } catch(Exception $e) {
       echo "Error: " . $e->getMessage();
     }
    
     return $results->fetchAll();
  }




  function project_delete($id) {
     include "connection.php";
     
     $sql = "DELETE FROM entries WHERE id = ?";
    
     try {
        $results = $db->prepare($sql);
        $results->bindValue(1,$id,PDO::PARAM_INT);
        $results->execute();
     } catch(Exception $e) {
        $e->getMessage();
        return false;
     }
     return true;
  }
?>