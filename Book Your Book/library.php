<?php
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>library</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">



  	<style type="text/css">
  	div.scrollmenu {
  		background-color: #333;
  		overflow: auto;
  		white-space: nowrap;
	}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}
  	</style>
</head>
<body>

  <?php
  $conn=mysqli_connect("localhost","root","","dbslab")
        or die('Error connecting to MySQL server.'); 
        function err($n)
        {
          $n=trim($n);//remove extra tab spaces
          $n=stripslashes($n);//remove blackslashes from input to avoid xss attack
          $n=htmlspecialchars($n);//convert html to plain text
          return $n;
        }?>


<!-- Nav Bar -->

<nav class="navbar navbar-light bg-light" style="padding: 1.5vw; padding-bottom: 0.5vw;">
	<a class="navbar-brand" style="font-family: 'Monoton', cursive; letter-spacing: 0.1vw;font-size: 2vw;">
		<img src="images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
	 Book Your Book</a>
  

  <?php
  
  if(isset($_SESSION['yr']))
  { $yr=$_SESSION['yr'];
        $batch=$_SESSION['batch'];
        $rollno=$_SESSION['rollno'];
        $sql= "SELECT * FROM users where Yr='$yr' and Batch='$batch' and RollNo='$rollno'";
        $result1=mysqli_query($conn,$sql);
        $row1=mysqli_fetch_array($result1);

        ?><div style="font-family: 'Playfair Display', serif; font-size: 2vw;"> Hello,<?php echo $row1['Name'] . "</div></nav>"; }
  else
  {
    echo "<form class='form-inline'>
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#login' style='margin-right: 1vw;background-color: #AA4E39; border-color: #5D2A1E;font-size: 1.5vw;z-index: 100;'>
      Login
    </button>
    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#register' style='background-color: #AA4E39; border-color: #5D2A1E;font-size: 1.5vw;z-index: 100;'>
      Register
    </button>
    </form>
  </nav>";
  }
  ?>
  <!-- Login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Sign In</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="Login.php" method="post">
              <label for="exampleInputPassword1">Roll No.</label>
                    <div class="form-inline">
                          <input type="text" class="form-control" id="yr" placeholder=" " style="width: 30%;" name="yr" required=""> -
                          <input type="text" class="form-control" id="batch" placeholder=" " style="width: 30%;" name="batch" required=""> -
                          <input type="text" class="form-control" id="rollno" placeholder=" " style="width: 30%;" name="rollno" required="">
                          <small id="emailHelp" class="form-text text-muted">Enter in format: 20XX-XXX-000</small>

              </div><br>
              <div class="form-group">
                    <label for="Password">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required="">
              </div>
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary"  name="submit" style="background-color: #AA4E39;">Login</button>
              </div>
              <a href="forgotpass.php" style="color: #AA4E39;">Forgot Password?</a>
          </form>
       </div>
     </div>
     </div>
  </div>

  <!-- Register -->
  <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Register</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="Register.php" method="post">
              <div class="form-group">
                    <label for="Name">Name</label>
                          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name" name="name" required="">
              </div>
                    <label for="exampleInputPassword1">Roll No.</label>
                    <div class="form-inline">
                          <input type="text" class="form-control" id="yr" placeholder=" " style="width: 30%;" name="yr" required=""> -
                          <input type="text" class="form-control" id="batch" placeholder=" " style="width: 30%;" name="batch" required=""> -
                          <input type="text" class="form-control" id="rollno" placeholder=" " style="width: 30%;" name="rollno" required="">
                          <small id="emailHelp" class="form-text text-muted">Enter in format: 20XX-XXX-000</small>

              </div><br>
              <div class="form-group">
                    <label for="Name">Institute Name</label>
                          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Institute Name" name="institute" required="">
              </div>
              <!-- <div class="form-group">
                    <label for="Password">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required="">
              </div>
              <div class="form-group">
                    <label for="Password">Confirm Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass2" required="">
              </div> -->
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary" name="submit" style="background-color: #AA4E39;">Register</button>
              </div>
          </form>
       </div>
     </div>
     </div>
  </div>


<ul class="nav nav-tabs">
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="<?php if(isset($_SESSION['yr'])) echo 'dashboard.php'; else echo 'index.php';?>" style="color: #5D2A1E; text-align: center;">HOME</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="about.php" style="color: #5D2A1E;text-align: center;">ABOUT</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link active" href="library.php" style="color: #5D2A1E;text-align: center; border-top: 2px solid #AA4E39">LIBRARY</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="discuss.php" style="color: #5D2A1E;text-align: center;">DISCUSS</a>
  	</li>
    <li class="nav-item col-lg-2"></li>
        <li class="nav-item col-lg-1">
      <a class="nav-link" href="profile.php" style="color: #5D2A1E;text-align: right;"><?php if(isset($_SESSION['yr'])) echo "PROFILE" ; else echo " ";?></a>
    </li>
    <li class="nav-item col-lg-1">
    <a class="nav-link" href="logout.php" style="color: #5D2A1E;text-align: right;"><?php if(isset($_SESSION['yr'])) echo "LOGOUT" ; else echo " ";?></a>
    </li>
</ul>



<!-- Recent Added Books -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Recently Added Books</div>


<div class="container" style="padding-top: 1vw;">
  	<div class="row">
      <?php
        $sql= "SELECT * FROM books,lender where books.bookid=lender.bookid order by entry desc limit 6";
        $result1=mysqli_query($conn,$sql);
        while($row1=mysqli_fetch_array($result1))
        {
          echo "<div class='col-lg-2'>
          <a href='book.php?name=" . $row1['name'] . "'><img src='images/" . $row1['cover'] . "' class='d-block w-100' alt='...'' style='height: 15vw;''></a>
          <h6 style='text-align: center; color: #AA4E39'>" . $row1['name'] . "</h6>
        </div>";
        }
        ?>
       </div>
</div>

<br>
<hr>

<!-- Available Books -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Available Books</div>
<br>
<hr>

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif;">Fiction</div>
<div class="scrollmenu" style="background-color: white;width: 90vw;margin-left: 5vw;">

<?php
        $sql= "SELECT * FROM books,lender where books.bookid=lender.bookid and books.genre='fiction'";
        $result1=mysqli_query($conn,$sql);
        while($row1=mysqli_fetch_array($result1))
        {
          echo "<a href='book.php?name=" . $row1['name'] . "''><img src='images/" . $row1['cover'] . "' style='height: 15vw; width: 12vw;'></a>";
        }
        ?>
</div>

<br>
<hr>

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif;">Academics</div>
<div class="scrollmenu" style="background-color: white; width: 90vw;margin-left: 5vw;">
  <?php
        $sql= "SELECT * FROM books,lender where books.bookid=lender.bookid and books.genre='academics'";
        $result1=mysqli_query($conn,$sql);
        while($row1=mysqli_fetch_array($result1))
        {
          echo "<a href='book.php?name=" . $row1['name'] . "''><img src='images/" . $row1['cover'] . "' style='height: 15vw; width: 12vw;'></a>";
        }
        ?>
</div>

<br>
<hr>

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif;">Comics</div>
<div class="scrollmenu" style="background-color: white;width: 90vw;margin-left: 5vw;">
 <?php
        $sql= "SELECT * FROM books,lender where books.bookid=lender.bookid and books.genre='comics'";
        $result1=mysqli_query($conn,$sql);
        while($row1=mysqli_fetch_array($result1))
        {
          echo "<a href='book.php?name=" . $row1['name'] . "''><img src='images/" . $row1['cover'] . "' style='height: 15vw; width: 12vw;'></a>";
        }
        ?>
</div>

<br>
<hr>

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif;">Auto Biography</div>
<div class="scrollmenu" style="background-color: white;width: 90vw;margin-left: 5vw;">
  <?php
        $sql= "SELECT * FROM books,lender where books.bookid=lender.bookid and books.genre='autobiography'";
        $result1=mysqli_query($conn,$sql);
        while($row1=mysqli_fetch_array($result1))
        {
          echo "<a href='book.php?name=" . $row1['name'] . "''><img src='images/" . $row1['cover'] . "' style='height: 15vw; width: 12vw;'></a>";
        }
        ?>
</div>

<br>
<hr>

<!-- Footer -->
<footer class="page-footer font-small unique-color-dark" style="background-color: #AA4E39; color: white;padding-top: 0.1vw;">

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

      <!-- Grid row -->
      <div class="row mt-3">

        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <!-- Content -->
          <h6 class="text-uppercase font-weight-bold">Book Your Book</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>Open source book sharing community, for free and efficient exchange of books between peers.</p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Our Members</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="#!" style="color: white;">ABV-IIITM Gwalior</a>
          </p>
          <p>
            <a href="#!" style="color: white;">RJIT Gwalior</a>
          </p>
          <p>
            <a href="#!" style="color: white;">MITS Gwalior</a>
          </p>
          <p>
            <a href="#!" style="color: white;">ITM UNiversity</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Useful links</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <a href="#!" style="color: white; font-weight: bold;">HOME</a>
          </p>
          <p>
            <a href="#!" style="color: white; font-weight: bold;">ABOUT</a>
          </p>
          <p>
            <a href="#!" style="color: white; font-weight: bold;">LIBRARY</a>
          </p>
          <p>
            <a href="#!" style="color: white;font-weight: bold;">CONTACT</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Contact</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>
            <i class="fas fa-home mr-3"></i> Gwalior , India</p>
          <p>
            <i class="fas fa-envelope mr-3"></i>bookyourbook@gmail.com</p>
          <p>
            <i class="fas fa-phone mr-3"></i> +91 989 989 9899</p>
          <p>
            <i class="fas fa-print mr-3"></i> +91 686 686 6866</p>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- Footer -->

</body>
</html>