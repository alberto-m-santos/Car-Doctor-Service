<?php
    session_start();
    $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

    if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }
    $query = "SET SCHEMA 'CarDoctor'";
    pg_exec($query);

    if($_POST['email']<>''){
        $email =$_POST['email'];
      }
    else{
        $email = $_SESSION['email'];
    }

    if($_POST['codigo']<>''){
        $codigo =$_POST['codigo'];
        $hashed_password = password_hash($codigo, PASSWORD_DEFAULT);
      }
    else{
        $hashed_password = $_SESSION['codigo'];
        
    }
    if($_POST['nome']<>'' and $_POST['nome']<>$_SESSION['nome']){
        $nome = $_POST['nome'];
        $_SESSION['nome'] = $nome;
      }
    else{
        $nome = $_SESSION['nome'];
    }
    if($_POST['data_nascimento']<>'' and $_POST['data_nascimento']<>$_SESSION['data_nascimento']){
        $data_nascimento =$_POST['data_nascimento'];
        $_SESSION['data_nascimento'] = $data_nascimento;
      }
    else{
        $data_nascimento = $_SESSION['data_nascimento'];
    }
    if($_POST['cidade']<>'' and $_POST['cidade']<>$_SESSION['cidade']){
        $cidade = $_POST['cidade'];
        $_SESSION['cidade'] = $cidade;
      }
    else{
        $cidade = $_SESSION['cidade'];
    }
    $query = "UPDATE utilizador SET codigo='$hashed_password', nome='$nome', data_nascimento='$data_nascimento', cidade='$cidade' WHERE email='$email'";
    pg_exec($query);

    header("Location: home.php");
?>