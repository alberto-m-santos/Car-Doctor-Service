<?php
    session_start();
    $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

    if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }
    $query = "SET SCHEMA 'CarDoctor'";
    pg_exec($query);

    $email = '';
    $codigo='';

    if(isset($_POST['email'])){
        $email =$_POST['email'];
      }
    if(isset($_POST['codigo'])){
        $codigo = $_POST['codigo'];
      }

    $query = "SELECT * FROM utilizador WHERE email ='$email'";
    $result = pg_exec($query);
    $row = pg_fetch_assoc($result);

    $num_registos =  pg_numrows ($result);
     
      if(password_verify($codigo, $row['codigo']))
      {
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['codigo'] = $row['codigo'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['data_nascimento'] = $row['data_nascimento'];
        $_SESSION['cidade'] = $row['cidade'];
        $_SESSION['is_admin'] = $row['is_admin'];
        $_SESSION['erro']="";

        header("Location: ".$_SESSION['previous_location']."");
      }
      else{
        $_SESSION['erro']="User/Password errados";
        $_SESSION['previous_location'] = "login_action.php";
        header("Location: home.php");
      }
?>