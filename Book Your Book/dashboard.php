<?php
session_start();
if(!isset($_SESSION['yr']))
 {echo "<script>window.alert('This page cannot be viewed until you are logged in!');</script>"; 
         echo "<script>window.location.href='index.php';</script>"; }
         ?>
<!DOCTYPE html>
<html>
<head>
	<title>dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <style>
    .table-striped>tbody>tr:nth-child(odd)>td, 
.table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #BD7B62; 
 }</style>
</head>
<body>


<!-- Nav bar -->

<nav class="navbar navbar-light bg-light" style="padding: 1.5vw; padding-bottom: 0.5vw;">
	<a class="navbar-brand" style="font-family: 'Monoton', cursive; letter-spacing: 0.1vw;font-size: 2vw;">
		<img src="images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
	 Book Your Book</a>
    
  <div style="font-family: 'Playfair Display', serif; font-size: 2vw;">Hello, 
    <?php 
    $conn=mysqli_connect("localhost","root","","dbslab")
        or die('Error connecting to MySQL server.'); 
        function err($n)
        {
          $n=trim($n);//remove extra tab spaces
          $n=stripslashes($n);//remove blackslashes from input to avoid xss attack
          $n=htmlspecialchars($n);//convert html to plain text
          return $n;
        }

        $yr=$_SESSION['yr'];
        $batch=$_SESSION['batch'];
        $rollno=$_SESSION['rollno'];
        $sql= "SELECT * FROM users where Yr='$yr' and Batch='$batch' and RollNo='$rollno'";
        $result1=mysqli_query($conn,$sql);
        $row1=mysqli_fetch_array($result1);
        echo $row1['Name'];
        ?>
        </div>

</nav>

<ul class="nav nav-tabs">
  	<li class="nav-item col-lg-2">
    <a class="nav-link active" href="dashboard.php" style="color: #5D2A1E; text-align: center; border-top: 2px solid #AA4E39">HOME</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="about.php" style="color: #5D2A1E;text-align: center;">ABOUT</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="library.php" style="color: #5D2A1E;text-align: center;">LIBRARY</a>
  	</li>
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="discuss.php" style="color: #5D2A1E;text-align: center;">DISCUSS</a>
  	</li>
    <li class="nav-item col-lg-2"></li>
    <li class="nav-item col-lg-1">
    <a class="nav-link" href="profile.php" style="color: #5D2A1E;text-align: right;">PROFILE</a>  
    </li>
    <li class="nav-item col-lg-1">
    <a class="nav-link" href="LOGOUTut.php" style="color: #5D2A1E;text-align: right;">LOGOUT</a>
    </li>
</ul>



<!-- Add a new book -->

<button type="button" class="btn btn-primary btn-lg col-lg-3" data-toggle="modal" data-target="#add" style="margin-top: 3vw;margin-left: 25vw;background-color: #AA4E39;border-color: #5D2A1E;">Share a new book</button>
<button type="button" class="btn btn-primary btn-lg col-lg-3" data-toggle="modal" data-target="#request" style="margin-top: 3vw;background-color: #AA4E39;border-color: #5D2A1E;">Request a new book</button>


<!--Share a new book-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Share a Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="lend.php" method="post">
              <label for="exampleInputPassword1">Name</label>
                    <div class="form-group">
                          <input type="text" class="form-control" id="name" placeholder="Enter the book name"  name="name" required="">
                          <small id="emailHelp" class="form-text text-muted">Write full name of the book</small>
                    </div>
                    <div class="form-group">
                          <label for="Description">Short description of the Book</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Description" name="info" required="">
                    </div>
                    <div class="form-group">
                          <label for="Genre">Genre</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter the genre of the book" name="genre" required="">
                    </div>
                    <div class="form-group">
                          <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
                          <label for="cover">Cover Photo</label><br>
                          <input type="file" id="cover" name="cover" >
                    </div>
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary"  name="submit" style="background-color: #AA4E39;">Share</button>
              </div>
          </form>
       </div>
     </div>
     </div>
  </div>


<!--Request a new book-->
<div class="modal fade" id="request" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Request for a Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="request.php" method="post">
              <label for="exampleInputPassword1">Name</label>
                    <div class="form-group">
                          <input type="text" class="form-control" id="name" placeholder="Enter the book name"  name="name" required="">
                          <small id="emailHelp" class="form-text text-muted">Write full name of the book</small>
                    </div>
                    <div class="form-group">
                          <label for="Description">Short description of the Book</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Description" name="info" required="">
                    </div>
                    <div class="form-group">
                          <label for="Genre">Genre</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter the genre of the book" name="genre" required="">
                    </div>
                    <div class="form-group">
                          <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
                          <label for="cover">Cover Photo</label><br>
                          <input type="file" id="cover" name="cover" >
                    </div>
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary"  name="submit" style="background-color: #AA4E39;">Request</button>
              </div>
          </form>
       </div>
     </div>
     </div>
  </div>


<!-- Pending requests -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw; font-family: 'Playfair Display', serif; ">Notifications</div>

<table class="table table-striped" style="width: 80vw;margin-left: 10vw; ">
  <thead>
    <tr>
      <th scope="col" style="width: 10%">No.</th>
      <th scope="col" style="width: 70%">Notification</th>
      <th scope="col" style="width: 20%">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Guna shekhar lended your book</td>
      <td>-</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Sakshi wants you to return the book</td>
      <td>-</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Your demanded book is now available</td>
      <td>-</td>
    </tr>
  </tbody>
</table>





<!-- books -->
<?php

        $sql= "SELECT * FROM books,lender where books.bookid=lender.bookid LIMIT 4";
        $result1=mysqli_query($conn,$sql);
        ?>
<div class="h1" style="padding: 3vw; padding-bottom: 0vw; font-family: 'Playfair Display', serif; ">Books you might like</div>
<div class="card-deck" style="padding: 3vw; padding-top: 0.5vw;">

          <?php
        while($row1=mysqli_fetch_array($result1))
    {
      echo "<div class='card col-lg-3 col-md-6 col-s-12'>
    <img src='images/" . $row1['cover'] . "' class='card-img-top' alt='...' style='max-height: 25vw;'>
    <div class='card-body'>
      <h5 class='card-title'>" . $row1['name'] . "</h5>
      <p class='card-text'>" . $row1['info'] . "</p>
    </div>
  </div>";
    }
?>
</div>



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
  <!-- Footer -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>