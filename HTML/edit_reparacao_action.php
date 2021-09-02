<?php
    session_start();
    $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

    if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }
    $query = "SET SCHEMA 'CarDoctor'";
    pg_exec($query);

    if($_POST['id']<>''){
      $id =$_POST['id'];
    } 

    if($_POST['nome']<>''){
        $nome =$_POST['nome'];
      }
    else{
        $nome = $_SESSION['edit_rep_nome'];
    }

    if($_POST['material']<>''){
        $material =$_POST['material'];
      }
    else{
        $material = $_SESSION['edit_rep_material'];
    }
    if($_POST['tempo']<>''){
        $tempo = $_POST['tempo'];
      }
    else{
        $tempo = $_SESSION['edit_rep_tempo'];
    }
    if($_POST['procedimento']<>''){
        $procedimento =$_POST['procedimento'];
      }
    else{
        $procedimento = $_SESSION['edit_rep_procedimento'];
    }
    if($_POST['fotografia']<>''){
        $fotografia = $_POST['fotografia'];
      }
    else{
        $fotografia = $_SESSION['edit_rep_fotografia'];
    }
    
    $query = "UPDATE reparacao SET nome='$nome', material='$material', tempo='$tempo', procedimento='$procedimento', fotografia='$fotografia' WHERE id='$id'";
    pg_exec($query);

    header("Location: admin_reparacoes.php");
?>