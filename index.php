<?php

$servername="localhost";
$username="root";
$password="";
$database="notes";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
  echo "Connection is not done successfully";
}

$insertCheck=false;
$deleteCheck=false;

if(isset($_GET['btn']))
{
  $title=$_GET['title'];
  $desc=$_GET['desc'];

  $insert="INSERT INTO `Notes` (`Title`, `Description`) VALUES ('$title','$desc')";
  $result=mysqli_query($conn,$insert);
  if($result)
  {
    $insertCheck=true;
  }
}


if(isset($_GET['delete']))
{
  $title=$_GET['delete'];
  $delete="DELETE FROM `Notes` WHERE `Title` = '$title'";
  $result=mysqli_query($conn,$delete);
  $deleteCheck=true;
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Hello, world!</title>
</head>







<body>








    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="btn">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
        
        if($insertCheck)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success</strong> Your data is successfully inserted.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        if($deleteCheck)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success</strong> Your data is successfully deleted.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
      ?>
    <div class="container my-4 ">
        <form action="/Project3-PHP">
            <h1>Add a Note</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Note Tite</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-floating">
                <div>Note area</div>
                <textarea class="form-control" placeholder="Leave a comment here" id="textarea" name="desc"></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" name="btn">Add a Note</button>
        </form>
    </div>

    <div class="container">


        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Titile</th>
                    <th scope="col">Descrption</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $sql = "SELECT * FROM `Notes`";
            $result = mysqli_query($conn, $sql);

          $no=1;
        while($row = mysqli_fetch_assoc($result)){
            echo "
            <tr>
            <th scope='row'>".$no."</th>
            <td>".$row['Title']."</td>
            <td>".$row['Description']."</td>
            <td><button type='button' class='btn btn-warning edit'>Edit</button><span>  </span><button type='button' class='btn btn-danger mx-4 delete'name='delete'>Delete</button> </td>
          </tr>";
          $no=$no+1;
        }
    ?>


            </tbody>
        </table>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script>

    deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
          element.addEventListener("click", (e) => {
            console.log("echo");
            tr = e.target.parentNode.parentNode;
           title = tr.getElementsByTagName("td")[0].innerText;
          description = tr.getElementsByTagName("td")[1].innerText;
            if(confirm("Are you sure to delete"))
            {
              console.log("Yes");
              location=`/Project3-PHP/index.php?delete=${title}`;
            }
            else
            {
              console.log("No");
            }
          })
        })
  </script>
</body>
</html>