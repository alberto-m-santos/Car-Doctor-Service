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
      $query = "DELETE FROM reparacao WHERE id=$id";
      pg_exec($query);

      header("Location: admin_reparacoes.php");
    }
    
    if(isset($_POST['editar'])){

      $id=$_POST['editar'];
      $query = "SELECT * FROM reparacao WHERE id=$id";
      $result = pg_exec($query);
      
      $row = pg_fetch_assoc($result);

      $_SESSION['edit_rep_id'] = $id;
      $_SESSION['edit_rep_nome'] = $row['nome'];
      $_SESSION['edit_rep_material'] = $row['material'];
      $_SESSION['edit_rep_tempo'] = $row['tempo'];
      $_SESSION['edit_rep_procedimento'] = $row['procedimento'];
      $_SESSION['edit_rep_fotografia'] = $row['fotografia'];

      header("Location: edit_reparacao.php");
    }
?>