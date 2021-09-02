<?php
session_start();
?>

<html>
<head>
  	<title>Car Doctor Service</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/stylepage.css">
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Mukta+Malar:wght@600&family=Raleway&display=swap');
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>

    <body>
		
  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active">
      <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
      </div>
      <div class="p-4">
      <a href="home.php" class="logo"><img src="imgs/logo-white.png" id="landing-logo"></a>

        <ul class="list-unstyled components mb-5">
        <li>
        <a href="home.php"><span class="fa fa-home mr-3"></span>Home</a>
        </li>
        <li>
          <a href="reparacoes.php"><span class="fa fa-briefcase mr-3"></span>Reparações</a>
        </li>
        <li>
          <a href="downloads.php"><span class="fa fa-sticky-note mr-3"></span>Downloads</a>
        </li>
    <li>
      <a href="sobre.php"><span class="fa fa-user mr-3"></span> About</a>
    </li>
    <?php
				if(isset($_SESSION['nome']) and ($_SESSION['is_admin']=='t')){?>
			<li class="active">
				<a href="admin_users.php"><span class="fa fa-wrench mr-3"></span>Admin Tools</a>
			</li><?php }?>
        </ul>

        <div class="mb-5">
				<?php
				if(isset($_SESSION['nome'])){?>
					<h3 class="h6 mb-3">Logged as <a href="infopessoal.php"><?php echo $_SESSION['nome']; ?></a></h3>
					<form action="logout.php" class="subscribe-form" method="POST"><div class="form-group d-flex"><input type="submit" value="Logout"></div></form>
				<?php
				}
				else{?>
					<h3 class="h6 mb-3">Login</h3>
					<form action="login_action.php" class="subscribe-form" method="POST">
						<div class="form-group d-flex">
							<div class="icon"><span class="icon-paper-plane"></span></div>
							<input type="text" name="email" class="form-control" placeholder="Enter Email Address">
						</div>
						<div class="form-group d-flex">
							<div class="icon"><span class="icon-paper-plane"></span></div>
							<input type="password" name ="codigo" class="form-control" placeholder="Enter password">
						</div>
						<div class="form-group d-flex">
							<input type="submit" value="Entrar">
						</div>
					</form>
				<?php }
				?>
			</div>

      </div>
    </nav>

  <!-- Page Content  -->
  <div id="content" class="p-4cont p-md-5 pt-5">
    <?php
    if(isset($_SESSION['nome']) and ($_SESSION['is_admin']=='t')){?>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light";>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="admin_users.php" class="nav-link">Users</a>
            </li>
            <li class="nav-item">
                <a href="admin_reparacoes.php" class="nav-link active">Reparações</a>
            </li>
        </ul>
</nav>

<div class="container my-4">
<h3> Consultar reparações</h3>

<?php

  $conn = pg_connect("host=db dbname=siem2002 user=siem2002 password=BQWTVJhw");

      if(!$conn)
      {
        echo "Ligação não foi estabelecida";
      }

      $query = "SET SCHEMA 'CarDoctor'";
      pg_exec($query);

      $query = "SELECT * FROM reparacao";

      $result = pg_exec($query);

      $row = pg_fetch_assoc($result);

     ?>
<div class="container"> 
<input class="form-control" id="myInput" type="text" placeholder="Procurar..">

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Material</th>
      <th scope="col">Tempo</th>
      <th scope="col">Procedimento</th>
      <th scope="col">Fotografia</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody id="myTable">
  <?php while(isset($row['id'])){ ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['nome']; ?></td>
      <td><?php echo $row['material']; ?></td>
      <td><?php echo $row['tempo']; ?></td>
      <td><?php echo $row['procedimento']; ?></td>
      <td><?php echo $row['fotografia']; ?></td>
      <td>
        <form action="edit_remove_reparacao_action.php" method="POST">
        <button type="submit" name="editar" value="<?php echo $row['id']; ?>"class="btn btn-warning"><i class="fa fa-pencil"></i></button>
        <button type="submit" name="remover" value="<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-remove"></i></button>
        </form>
      </td>
    </tr>
  <?php
    $row = pg_fetch_assoc($result);
    } ?>
  </tbody>
</table>
</div>
<a href="add_reparacao.php"><button type="submit" action="infopessoal.php" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar</button></a>

</div>
    
<?php } else{ ?>
      
      <p><h3> Reservado a administradores</h3></p>
      <p><h5> Por favor autentique-se</h5></p>
      <div class="container">
       <div class="row">
          <div class="col-md-12">
            <div class="text-xs-center text-lg-center">
           <img src="imgs/lock2.png">
           </div>
          </div>
       </div>
      </div>
      <br>

    <?php } ?>
    <div class="footer">
      <h3>Contactos</h3>
      <div class="flex-wrap" id="footer-container">
          <div class="flex-column" id="info">
              <h4>Car Doctor Service</h4>
              <p><img src="../imgs/location.png" id="logo-cont"><a id="title-link"> Morada: </a><a href="https://goo.gl/maps/WpdboXJdn3gjr3c59" id="link"> R. Dr. Roberto Frias, s/n 4200-465 Porto</a></p>
              <p><img src="../imgs/phone.png" id="logo-cont"><a id="title-link"> Telemóvel: </a><a href="tel:(+351912359655)" id="link">(+351) 912 359 655</a></p>
              <p><img src="../imgs/mail.png" id="logo-cont"><a id="title-link"> Email: </a><a href="mailto:cardoctor@mail.pt" id="link">cardoctor@mail.pt</a></p>
          </div>
          <div class="flex-column" id="footer-container">
              <h4>Redes Sociais</h4>
              <div class="logo-container">
                  <a href="#"><img src="../imgs/linkedin.png" id="logo-social"></a>
                  <a href="#"><img src="../imgs/twitter.png" id="logo-social"></a>
                  <a href="#"><img src="../imgs/google.png" id="logo-social"></a>
              </div>
          </div>
      </div>
      <p id="author">Copyright &copy; <a><b>Alberto Santos</b></a> SIEM 2020</p>
  </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
      
      <script>
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
      </script>

      <script> 
       $(document).ready(function(){ 
          $(window).scroll(function(){ 
              $('front').css("opacity", 1- $(window).scrollTop() / 700) 
          }) 
      }) 
      </script>
</body>
<script>
  // Material Select Initialization
  $(document).ready(function() {
  $('.mdb-select').materialSelect();
  });
</script>
<?php $_SESSION['previous_location'] = "admin_reparacoes.php"; ?>
</html>
