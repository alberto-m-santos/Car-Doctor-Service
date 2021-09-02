<?php
    session_start();
    $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

    if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }

    $query = "SET SCHEMA 'CarDoctor'";
    pg_exec($query);

    

        $nome =$_POST['nome'];

        $material = $_POST['material'];

        $tempo = $_POST['tempo'];

        $procedimento = $_POST['procedimento'];

        $fotografia = $_POST['fotografia'];

    $query = "INSERT INTO reparacao(nome, material, tempo, procedimento, fotografia) values ('$nome', '$material', '$tempo', '$procedimento', '$fotografia')";
    pg_exec($query);

    header("Location: admin_reparacoes.php");
?>