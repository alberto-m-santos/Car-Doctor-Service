<?php
    session_start();
    $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

    if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }
    $query = "SET SCHEMA 'CarDoctor'";
    pg_exec($query);

    $id = '';
    
    if(isset($_POST['remover'])){

      $id=$_POST['remover'];
      $query = "DELETE FROM utilizador WHERE id=$id";
      pg_exec($query);

      header("Location: admin_users.php");
    }
    
    if(isset($_POST['editar'])){

      $id=$_POST['editar'];
      $query = "SELECT * FROM utilizador WHERE id=$id";
      $result = pg_exec($query);
      
      $row = pg_fetch_assoc($result);

      $_SESSION['edit_id'] = $id;
      $_SESSION['edit_nome'] = $row['nome'];
      $_SESSION['edit_codigo'] = $row['codigo'];
      $_SESSION['edit_email'] = $row['email'];
      $_SESSION['edit_data_nascimento'] = $row['data_nascimento'];
      $_SESSION['edit_cidade'] = $row['cidade'];
      if($row['is_admin']=='t'){
        $_SESSION['edit_is_admin'] = 'TRUE';
      }
      else{
        $_SESSION['edit_is_admin'] = 'FALSE';
      }
      

      header("Location: edit_user.php");
    }
?>