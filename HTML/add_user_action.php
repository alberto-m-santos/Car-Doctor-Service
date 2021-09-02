<?php
    session_start();
    $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

    if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }

    $query = "SET SCHEMA 'CarDoctor'";
    pg_exec($query);

    

        $email =$_POST['email'];

        $codigo = $_POST['codigo'];
        $hashed_password = password_hash($codigo, PASSWORD_DEFAULT);

        $nome = $_POST['nome'];

        $data_nascimento = $_POST['data_nascimento'];

        $cidade = $_POST['cidade'];

        if($_POST['is_admin']=='Yes'){
          $is_admin = 'TRUE';
        }
        else{
          $is_admin = 'FALSE';
        }
      

    $query = "INSERT INTO utilizador(email, codigo, nome, data_nascimento, cidade, is_admin) values ('$email', '$hashed_password', '$nome', '$data_nascimento', '$cidade', '$is_admin')";
    pg_exec($query);

    header("Location: admin_users.php");
?>