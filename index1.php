<?php
// INSERT INTO `crud_notes` (`sno`, `title`, `description`, `tistamp`) VALUES (NULL, 'Buy Books', 'Hey Bittu,\r\nGo to market and get science and maths books', current_timestam);
   //connecting to database
   $insert = false;
   $update = false;
   $delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud2";

//Create a connection
$conn = mysqli_connect($servername,$username,$password,$database);

//die if connection was not successfull
if(!$conn){
    die("Sorry we failed to connect:". mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `student_tbl` WHERE `student_tbl`.`sno` = $sno";
  $result = mysqli_query($conn,$sql);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(isset($_POST['snoEdit'])){
     //update the record
     $sno = $_POST['snoEdit'];
     $name = $_POST['nameEdit'];
     $email = $_POST['emailEdit'];
     $contact = $_POST['contactEdit'];
     $address = $_POST['addressEdit'];
     
 
     //Sql query to be executed
   $sql = "UPDATE `student_tbl` SET `name` = '$name' , `email` = '$email' ,`contact` = '$contact' , `address` = '$address' WHERE `student_tbl`.`sno` = $sno";
   $result = mysqli_query($conn,$sql);
   if($result){
    $update = true;
   }
   }
   else{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    //Sql query to be executed
  $sql = "INSERT INTO `student_tbl` (`name`, `email`, `contact`, `address`) VALUES ('$name', '$email', '$contact', '$address')"; 
  $result = mysqli_query($conn,$sql);

  //Add a new data in tble
  if($result){
      // echo "The record has been inserted successfull! <br>";
      $insert = true;
  }
  else{
      echo "The record was not inserted ---->". mysqli_error($conn);
  }
}
}

   ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    
    <script>
          $(document).ready( function () {
          $('#myTable').DataTable();
        } );
    </script>

  <title>CRUD APP</title>
  
</head>

<body>
  <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
        <form action="/student/index1.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="mb-3">
        <label for="nameEdit" class="form-label">Name</label>
        <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="emailEdit" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailEdit" name="emailEdit" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="contactEdit" class="form-label">Contact</label>
        <input type="number" class="form-control" id="contactEdit" name="contactEdit" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="addressEdit" class="form-label">Address</label>
        <textarea class="form-control" id="addressEdit" name="addressEdit" row="3"></textarea>
      </div>
          <button type="submit" class="btn btn-primary">Update Form</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CRUD Registration form</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
   if($insert){
     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success!</strong> Your form has been inserted successfully!
     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   </div>";
   }

  ?>

<?php
   if($update){
     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success!</strong> Your form has been Updated successfully!
     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   </div>";
   }

  ?>

<?php
   if($delete){
     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success!</strong> Your form has been deleted successfully!
     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   </div>";
   }

  ?>

  <div class="container my-4">
    <h2><u>Students Registration Form</u></h2>
    <form action="/student/index1.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="number" class="form-control" id="contact" name="contact" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" row="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <div class="container my-4">
    
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">SNo</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Contact</th>
          <th scope="col">Address</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
            $sql = "SELECT * FROM `student_tbl`";
            $result = mysqli_query($conn,$sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
              $sno = $sno + 1;
              echo "<tr>
              <th scope='row'>". $sno . "</th>
              <td>". $row['name'] . "</td>
              <td>". $row['email'] . "</td>
              <td>". $row['contact'] . "</td>
              <td>". $row['address'] . "</td>
              <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
            </tr>";
              // echo $row['sno'] .  ". Title ". $row['title'] ." Desc is ". $row['description'];
              // echo "<br>";
            }
            
            
            ?>

      </tbody>
    </table>
  </div>
  <hr>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>
    <script>
      let edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click", (e)=>{
         console.log("edit", );
         tr = e.target.parentNode.parentNode;
         name = tr.getElementsByTagName("td")[0].innerText;
         email = tr.getElementsByTagName("td")[1].innerText;
         contact = tr.getElementsByTagName("td")[2].innerText;
         address = tr.getElementsByTagName("td")[3].innerText;
         console.log(name, email);
         nameEdit.value = name;
         emailEdit.value = email;
         contactEdit.value = contact;
         addressEdit.value = address;
         snoEdit.value = e.target.id;
         console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })

      let deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click", (e)=>{
         console.log("edit", );
         sno = e.target.id.substr(1,);

         if(confirm("Are you sure you want to delete this note!")){
           console.log("yes");
           window.location = `/student/index1.php?delete=${sno}`;
         }else{
           console.log("No");
         }
        })
      })
    </script>
</body>

</html>