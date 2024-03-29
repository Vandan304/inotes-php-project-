<?php
   // connect to the database
  //  INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'buy books', 'please biy books from store.', current_timestamp());
  $insert=false;
  $update=false;
  $delete=false;
   $servername="localhost";
   $username= "root";
   $password= "";
   $dbname= "notes";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if(!$conn)
   {
    die("sorry could not connect". mysqli_error($conn));

   }
  //  echo$_POST['snoEdit'];   
  //  echo$_GET['update'];   
  //  exit();
  if(isset($_GET['delete']))
  {
    $sno = $_GET['delete'];
    $delete = true;
    $sql="DELETE FROM `notes` WHERE `sno`=$sno";
    $result=mysqli_query($conn,$sql);
  }
   if($_SERVER['REQUEST_METHOD']=='POST')
   {
      if(isset($_POST['snoEdit']))
      {
        $sno=$_POST["snoEdit"];
        $title=$_POST["titleEdit"];
        $description=$_POST["descriptionEdit"];
        $sql="UPDATE `notes` SET `title`='$title' , `description`='$description'WHERE `sno`=$sno";
        $result = mysqli_query($conn,$sql);
        if($result)
      {
         $update=true;
      }
      else
      {
        echo "not inserted";
      }
        exit();
      }
      else
      {
        
      
      $title=$_POST["title"];
      $description=$_POST["description"];
      $sql="INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$description')";
      $result = mysqli_query($conn,$sql);
      if($result)
      {
         $insert  = true; 
      }
      else
      {
        echo "not inserted";
      }
    }
  }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes-Notes taking made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
   
    <script>
      $(document).ready(function()
      {
        $('#myTable').DataTable();
      });
    </script>
    
  </head>
  <body>
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this Notes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/phpt/crud/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3 ">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
             
            </div>
           
            
              <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
              </div>
            
            <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
          </div>
          <div class="modal-footer d-block my-4">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="logo.png" height="28px" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              
              
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <?php
      if($insert)
      {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong>Your note has been inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>
      <?php
      if($update)
      {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong>Your note has been updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>
      <?php
      if($delete)
      {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong>Your note has been deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>
      <div class="container my-4">
        <h2>Add a note to iNotes</h2>
        <form action="/phpt/crud/index.php" method="post">
            <div class="mb-3 ">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
             
            </div>
           
            
              <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>
      <div class="container my-4">
       
        <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
          $sql = "SELECT * FROM `notes`";
          $result=mysqli_query($conn,$sql);
          $sno=0;
          while($row=mysqli_fetch_assoc($result))
          {
            $sno=$sno+ 1;
            echo" <tr>
            <th scope='row'>".$sno."</th>
            <td>".$row['title']."</td>
            <td>".$row['description']."</td>
            <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
            
          </tr>";
           
          }
          
        ?>
      
    
  </tbody>
</table>
      </div>
      <hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
     edits= document.getElementsByClassName('edit');
     Array.from(edits).forEach((element)=>
     {
        element.addEventListener("click",(e)=>
          {
          console.log("edit ",e );
          tr=e.target.parentNode.parentNode;
          title=tr.getElementsByTagName("td")[0].innerText;
          description=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description)
          descriptionEdit.value=description;
          titleEdit.value=title;
          snoEdit.value=e.target.id;
          $('#editModal').modal('toggle');
          
          
          
        })
    })
     deletes= document.getElementsByClassName('delete');
     Array.from(deletes).forEach((element)=>
     {
        element.addEventListener("click",(e)=>
          {
          console.log("edit ",e );
          sno=e.target.id.substr(1,)
           if(confirm("Are you sure delete this note!"))
           {
             console.log("Yes");
             window.location=`/phpt/crud/index.php?delete=${sno}`;
           }
          else
          {
            console.log("No")
          }
      
     })
    })
    </script>
  </body>
  
</html>