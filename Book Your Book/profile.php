
<?php
session_start();
if(!isset($_SESSION['yr']))
 {echo "<script>window.alert('This page cannot be viewed until you are logged in!');</script>"; 
         echo "<script>window.location.href='index.php';</script>"; }
         ?>
<!DOCTYPE html>
<html>
<head>
	<title>profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Nav bar -->

<nav class="navbar navbar-light bg-light" style="padding: 1.5vw; padding-bottom: 0.5vw;">
	<a class="navbar-brand" style="font-family: 'Monoton', cursive; letter-spacing: 0.1vw; font-size: 2vw;">
		<img src="images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
	 Book Your Book</a>
    
  <div style="font-family: 'Playfair Display', serif; font-size: 2vw;">Hello, <?php 
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
        </div></div>

</nav>

<ul class="nav nav-tabs">
  	<li class="nav-item col-lg-2">
    <a class="nav-link" href="dashboard.php" style="color: #5D2A1E; text-align: center;">HOME</a>
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
      <a class="nav-link active" href="profile.php" style="color: #5D2A1E;text-align: right; border-top: 2px solid #AA4E39">PROFILE</a>
    </li>
    <li class="nav-item col-lg-1">
    <a class="nav-link" href="logout.php" style="color: #5D2A1E;text-align: right;">LOGOUT</a>
    </li>
</ul>

<!-- profile -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">PROFILE</div>

<div class="card mb-3" style="padding: 5vw; padding-top: 1vw;">
  	<div class="row no-gutters">
    <div class="col-md-6">
     <img src="images/<?php echo $row1['pic'];?>" class="card-img" alt="..." style="max-height: 25vw; max-width: 25vw;padding-top: 1.5vw; height: 25vw;margin-left: 15vw; border-radius: 40%;">
    </div>
    <div class="col-md-6">
      	<div class="card-body">
      	<table class="table table-borderless">
		<tbody>
    	<tr>
      		<th width="25%;">Name</th>
      		<td width="75%;"><?php echo $row1['Name'];?></td>
    	</tr>
    	<tr>
      		<th width="25%;">Roll Number</th>
      		<td width="25%;"><?php echo $row1['Yr'] . $row1['Batch'] . "-" . $row1['RollNo'];?></td>
    	</tr>
    	<tr>
      		<th width="25%;">Institute Name</th>
      		<td width="25%;">ABV-IIITM Gwalior</td>
    	</tr>
    	<tr>
      		<th width="25%;">Email Id</th>
      		<td width="25%;"><?php echo $row1['Batch'] . "_" .  $row1['Yr'] . $row1['RollNo'];?>@iiitm.ac.in</td>
    	</tr>
    	<tr>
      		<th width="25%;">Total Points</th>
      		<td width="25%;"><?php echo $row1['Points'];?></td>
    	</tr>
    	<tr>
      		<th width="25%;">Total Borrowed Books</th>
      		<td width="25%;"><?php 
          $query="SELECT count(*) FROM transactions where byr='$yr' and bbatch='$batch' and brollno='$rollno'";
          $result1=mysqli_query($conn,$query);
          $row1=mysqli_fetch_array($result1);
          echo $row1['count(*)'];?>
          </td>
    	</tr>
    	<tr>
      		<th width="25%;">Total Lended Books</th>
      		<td width="25%;"><?php 
          $query="SELECT count(*) FROM transactions where lyr='$yr' and lbatch='$batch' and lrollno='$rollno'";
          $result1=mysqli_query($conn,$query);
          $row1=mysqli_fetch_array($result1);
          echo $row1['count(*)'];?></td>
    	</tr>
  		</tbody>
		</table>

		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  			Change Profile Photo
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        ...
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

    	</div>
  	</div>
	</div>
</div>

<!-- Borrowed  and Lend books -->

<div class="card mb-3" style="padding: 5vw; padding-top: 1vw;">
  	<div class="row no-gutters">
    <div class="col-md-4">
    	<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Borrowed Books</div>
    	<img src="images/9.jpg" class="card-img" alt="..." width="10vw" height="10vw" style="padding: 1.5vw; padding-top: 1.5vw; height: 30vw; width: 20vw; margin-left: 5vw;">
      	<div class="list-group" style="margin-left: 4vw;margin-right: 4vw;">
          <?php 
          $query="SELECT books.name FROM books,transactions WHERE transactions.byr='$yr' and transactions.bbatch='$batch' and transactions.brollno='$rollno' and transactions.bookid=books.bookid";
          $result1=mysqli_query($conn,$query);
          while($row1=mysqli_fetch_array($result1))
          {
            echo "<button type='button' class='list-group-item list-group-item-action'>" . $row1['name'] . "</button>";  
          }?>


  		<!-- <button type="button" class="list-group-item list-group-item-action" style="background-color: #AA4E39;color: white;">Cras justo odio</button>
  		<button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in</button>
  		<button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
  		<button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
  		<button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button> -->
		</div>
  	</div>
  	<div class="col-md-4">
  		<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Lended Books</div>
    	<img src="images/10.jpeg" class="card-img" alt="..." width="10vw" height="10vw" style="padding: 1.5vw; padding-top: 1.5vw; height: 30vw; width: 20vw; margin-left: 5vw;">
      	<div class="list-group" style="margin-left: 4vw;margin-right: 4vw;">
          <?php 
          $query="SELECT books.name FROM books,transactions WHERE transactions.lyr='$yr' and transactions.lbatch='$batch' and transactions.lrollno='$rollno' and transactions.bookid=books.bookid and transactions.status=0";
          $result1=mysqli_query($conn,$query);
          while($row1=mysqli_fetch_array($result1))
          {
            echo "<button type='button' class='list-group-item list-group-item-action'>" . $row1['name'] . " <a href='' style='text-align: right; color: #AA4E39' data-toggle='modal' data-target='#login'>(RETURNED)</a></button>";  
            
          }?>




  		<!-- <button type="button" class="list-group-item list-group-item-action" style="background-color: #AA4E39;color: white;">Cras justo odio</button> -->
  		<button type="button" class="list-group-item list-group-item-action">Harry Potter and the chamber of secrets <a href='' style="text-align: right; color: #AA4E39" data-toggle="modal" data-target="#login" >(RETURNED)</a></button>
  		<!-- <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
  		<button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
  		<button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button> -->
		</div>
    </div>
    <div class="col-md-4">
      <div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Available books</div>
      <img src="images/4.jpg" class="card-img" alt="..." width="10vw" height="10vw" style="padding: 1.5vw; padding-top: 1.5vw; height: 30vw; width: 20vw; margin-left: 5vw;">
        <div class="list-group" style="margin-left: 4vw;margin-right: 4vw;">

          <?php 
          $query="SELECT books.name FROM books,lender WHERE lender.yr='$yr' and lender.batch='$batch' and lender.rollno='$rollno' and lender.bookid=books.bookid";
          $result1=mysqli_query($conn,$query);
          while($row1=mysqli_fetch_array($result1))
          {
            echo "<button type='button' class='list-group-item list-group-item-action'>" . $row1['name'] . "</button>";  
          }?>


      <!-- <button type="button" class="list-group-item list-group-item-action" style="background-color: #AA4E39;color: white;">Cras justo odio</button>
      <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in</button>
      <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
      <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
      <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button> -->
    </div>
    </div>
	</div>
</div>


<!-- Exchange history -->

<div class="h1" style="padding: 3vw; padding-bottom: 1vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Transaction History</div>

<table class="table table-striped" style="margin-top: 0vw; width: 90%; margin-left: 5%;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">No.</th>
      <th scope="col" style="width: 50%;">Book Name</th>
      <th scope="col" style="width: 20%;">Borrowed From</th>
      <th scope="col" style="width: 20%;">Lend to</th>
      <!-- <th scope="col" style="width: 5%;">Points</th> -->
    </tr>
  </thead>
  <tbody>
    <?php 
    $query="SELECT * FROM transactions where lyr='$yr' and lbatch='$batch' and lrollno='$rollno' union SELECT * FROM transactions where byr='$yr' and bbatch='$batch' and brollno='$rollno'";
     $result1=mysqli_query($conn,$query);
     $i=1;
      while($row1=mysqli_fetch_array($result1))
      {
        $a=$row1['bookid'];
        $b=$row1['lyr'];
        $c=$row1['lbatch'];
        $d=$row1['lrollno'];
        $e=$row1['byr'];
        $f=$row1['bbatch'];
        $g=$row1['brollno'];
        $query2="SELECT name from books where bookid='$a'";
        $result2=mysqli_query($conn,$query2);
        $row2=mysqli_fetch_array($result2);
        $query3="SELECT Name from users where yr='$b' and batch='$c' and rollno='$d'";
        $result3=mysqli_query($conn,$query3);
        $row3=mysqli_fetch_array($result3);
        $query4="SELECT Name from users where yr='$e' and batch='$f' and rollno='$g'";
        $result4=mysqli_query($conn,$query4);
        $row4=mysqli_fetch_array($result4);
        echo "<tr>
          <th>" . $i . "</th>
          <td>" . $row2['name'] . "</td>
          <td>" . $row3['Name'] . "</td>
          <td>" . $row4['Name'] . "</td>
        </tr>";
        $i=$i+1;
      }?>

    <!-- <tr>
      <th>1</th>
      <td>Harry Potter and the goblet of fire</td>
      <td>TEST USER 1</td>
      <td>-</td>
      <td>+0</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Kurose And Ross</td>
      <td>-</td>
      <td>TEST USER 2</td>
      <td>+1</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Harry Potter and the chamber of secrets</td>
      <td>-</td>
      <td>TEST USER 1</td>
      <td>+1</td>
    </tr> -->
  </tbody>
</table>

<br>
<hr>


<!-- Login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #AA4E39;" >
          <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="return.php" method="post">
              <div class="form-group">
                    <label for="Password">Was your book damaged?</label>
                          <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="pass" required="">
                          <small id="emailHelp" class="form-text text-muted">If No, enter 0. If Yes, rate the damage on a scale of 1 to 3.</small>

              </div>
              <div class="form-group">
                    <label for="Password">Was your book returned late?</label>
                          <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="pass" required="">
                          <small id="emailHelp" class="form-text text-muted">If No, enter 0. If Yes, rate the time delay on a scale of 1 to 3.</small>

              </div>
              <div class="modal-footer">
                     <button type="submit" class="btn btn-secondary"  name="submit" style="background-color: #AA4E39;">Submit</button>
              </div>
          </form>
       </div>
     </div>
     </div>
  </div>

<!-- Completed books -->

<div class="h1" style="padding: 3vw; padding-bottom: 0vw;padding-top: 1vw; font-family: 'Playfair Display', serif; text-align: center;">Completed Books</div>

<div class="container" style="padding-top: 1vw;">
  	<div class="row">
    	<div class="col-lg-2">
     		<div class="card mb-3" style="height: 5vw;">
  				<div class="row no-gutters">
    				<div class="col-lg-4 col-md-4">
      					<img src="images/9.jpg" class="card-img" alt="..." height="100%">
    				</div>
    				<div class="col-lg-8 col-md-8">
      					<div class="card-body" style="padding: 0.4vw;">
        					<h6 class="card-title">Card title</h6>
        					<div class="progress">
  								<div class="progress-bar" role="progressbar" style="width: 55%; background-color: #AA4E39" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">55%
  								</div>
      						</div>
    					</div>
  					</div>
				</div>
			</div>
		</div>
    	<div class="col-lg-2">
    		<div class="card mb-3" style="height: 5vw;">
  				<div class="row no-gutters">
    				<div class="col-lg-4 col-md-4">
      					<img src="images/9.jpg" class="card-img" alt="..." height="100%">
    				</div>
    				<div class="col-lg-8 col-md-8">
      					<div class="card-body" style="padding: 0.4vw;">
        					<h6 class="card-title">Card title</h6>
        					<div class="progress">
  								<div class="progress-bar" role="progressbar" style="width: 85%; background-color: #AA4E39" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">85%
								</div>
      						</div>
    					</div>
  					</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-2">
    		<div class="card mb-3" style="height: 5vw;">
  				<div class="row no-gutters">
    				<div class="col-lg-4 col-md-4">
      					<img src="images/9.jpg" class="card-img" alt="..." height="100%">
    				</div>
    				<div class="col-lg-8 col-md-8">
      					<div class="card-body" style="padding: 0.4vw;">
        					<h6 class="card-title">Card title</h6>
        					<div class="progress">
  								<div class="progress-bar" role="progressbar" style="width: 35%; background-color: #AA4E39" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">35%
								</div>
      						</div>
    					</div>
  					</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-2">
    		<div class="card mb-3" style="height: 5vw;">
  				<div class="row no-gutters">
    				<div class="col-lg-4 col-md-4">
      					<img src="images/9.jpg" class="card-img" alt="..." height="100%">
    				</div>
    				<div class="col-lg-8 col-md-8">
      					<div class="card-body" style="padding: 0.4vw;">
        					<h6 class="card-title">Card title</h6>
        					<div class="progress">
  								<div class="progress-bar" role="progressbar" style="width: 95%; background-color: #AA4E39" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">95%
								</div>
      						</div>
    					</div>
  					</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-2">
    		<div class="card mb-3" style="height: 5vw;">
  				<div class="row no-gutters">
    				<div class="col-lg-4 col-md-4">
      					<img src="images/9.jpg" class="card-img" alt="..." height="100%">
    				</div>
    				<div class="col-lg-8 col-md-8">
      					<div class="card-body" style="padding: 0.4vw;">
        					<h6 class="card-title">Card title</h6>
        					<div class="progress">
  								<div class="progress-bar" role="progressbar" style="width: 40%; background-color: #AA4E39" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">40%
								</div>
      						</div>
    					</div>
  					</div>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-2">
    		<div class="card mb-3" style="height: 5vw;">
  				<div class="row no-gutters">
    				<div class="col-lg-4 col-md-4">
      					<img src="images/9.jpg" class="card-img" alt="..." height="100%">
    				</div>
    				<div class="col-lg-8 col-md-8">
      					<div class="card-body" style="padding: 0.4vw;">
        					<h6 class="card-title">Card title</h6>
        					<div class="progress">
  								<div class="progress-bar" role="progressbar" style="width: 75%; background-color: #AA4E39" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">75%
								</div>
      						</div>
    					</div>
  					</div>
    			</div>
    		</div>
    	</div>
  	</div>
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
  <!-- Footer -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>