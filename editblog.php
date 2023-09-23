<?php
include_once('lib/database.php');
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['sessCustomerID'])) {
  if ($_SESSION['sessCustomerID'] == "7") {
  } else {
    header("Location: profile.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}

if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  $allow = $_SESSION['userallow'];
} else {
  $user = "";
  $allow = "";
}

if ($user == "") {
  header("Location: login.php");
  exit();
} else {
  if ($allow == "") {
  } else {
  }
}
?>



<?php
//   if ($_SERVER['HTTPS'] != "on") {
//     $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//     header("Location: $url");
//     exit;
//   }

$succ = "";
$err = "";

//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = OpenCon();
if ($conn->connect_error) {
  $err = "Error! Try again Later!";
} else {
  $succ = "Connection established";
}



$id = $_GET['id'];

$sql = "Select * FROM blogs WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

$invalid = mysqli_num_rows($result);
if ($invalid == 0) {
  header("location: $url_path");
}
$msg = '';

$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

function createUrlSlug($urlString)
{
  // replace non letter or digits by -
  $urlString = preg_replace('~[^\\pL\d]+~u', '-', $urlString);

  // trim
  $urlString = trim($urlString, '-');

  // transliterate
  $urlString = iconv('utf-8', 'us-ascii//TRANSLIT', $urlString);

  // lowercase
  $urlString = strtolower($urlString);

  // remove unwanted characters
  $urlString = preg_replace('~[^-\w]+~', '', $urlString);

  if (empty($urlString)) {
    return 'n-a';
  }



  return $urlString;
}


if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {

  $title = $_POST['title'];

  $long_desc = htmlspecialchars($_POST['long_desc'], ENT_QUOTES); //$long_desc = $_POST['long_desc'];
  $mdesc = $_POST['mdesc'];

  $keywords = $_POST['keywords'];
  $published = $_POST['published'];
  $author = $_POST['author'];

  $slug = createUrlSlug($title);
  if ($published == 'True') {
    $published = 1;
  } else {
    $published = 0;
  }

  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
  if (in_array($fileType, $allowTypes)) {
    // Upload file to server
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
      // Insert image file name into database
      $insert = $conn->query("UPDATE blogs SET title = '$title' , image = '$fileName', slug='$slug', mdescription = '$mdesc', description='$long_desc', author = '$author', keywords='$keywords' , published = '$published'   WHERE id = $id ");
      if ($insert) {
        $statusMsg = "Blog Updated successfully.";
      } else {
        $statusMsg = "File upload failed, please try again.";
      }
    } else {
      $statusMsg = "Sorry, there was an error uploading your file.";
    }
  } else {
    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, files are allowed to upload.';
  }
} elseif (isset($_POST["submit"]) && empty($_FILES["file"]["name"])) {
  $title = $_POST['title'];

  $long_desc = htmlspecialchars($_POST['long_desc'], ENT_QUOTES); //$long_desc = $_POST['long_desc'];
  $mdesc = $_POST['mdesc'];


  $keywords = $_POST['keywords'];
  $published = $_POST['published'];
  $author = $_POST['author'];

  $slug = createUrlSlug($title);
  if ($published == 'True') {
    $published = 1;
  } else {
    $published = 0;
  }
  $insert = $conn->query("UPDATE blogs SET title = '$title', slug='$slug', mdescription = '$mdesc', description='$long_desc', author = '$author', keywords='$keywords' , published = '$published' WHERE id = $id ");
  $permalink = "p/" . $slug;
  //header("Location: $permalink"); 



} else {
  $statusMsg = 'Please select a file to upload.';
}

// Display status message

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
  <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

  <title>Update Blog | IBR Live</title>

  <?php include_once('include/head.php'); ?>
  <style>
    .ck-editor__editable_inline {
      min-height: 400px;
    }

    label {
      width: 300px;
      font-weight: bold;
      display: inline-block;
      margin-top: 20px;
    }

    label span {
      font-size: 1rem;
    }

    label.error {
      color: red;
      font-size: 1rem;
      display: block;
      margin-top: 5px;
    }

    input.error {
      border: 1px dashed red;
      font-weight: 300;
      color: red;
    }
  </style>
  <meta name="theme-color" content="#ffffff">

</head>

<body>

<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <?php include_once('include/top-menu.php'); ?>

    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Edit Blog</h4>
      </div>
    </div>
  </div>

  <?php //echo $statusMsg; ?>
  <div class="row">
    <div class="col-md-12">

    </div><!-- /.col -->
    <p class="text-center" id="msg"><?php echo $statusMsg; ?></p>
    <br/>
    <div class="col-md-2">
      <div class="list-group">
        <a href="all-blogs.php" class="list-group-item">All Blogs</a>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default panelBorderColor " style="margin: 10px; padding:10px;">
        <?php


        $hsql = "SELECT * FROM blogs WHERE id = '$id'";
        $res = mysqli_query($conn, $hsql);
        $row = mysqli_fetch_assoc($result);

        $id = $row['id'];
        $title = $row['title'];
        $img = $row['image'];
        $description = $row['description'];
        $author = $row['author'];
        $mdescription = $row['mdescription'];
        $keywords = $row['keywords'];
        ?>


        <form method='post' action='' enctype="multipart/form-data" name='create_blog' id='create_blog'>


          <input class="form-control" type="text" required name="title" placeholder="title" value="<?php echo $title; ?>"><br>



          <textarea class="form-control" id='long_desc' name='long_desc'><?php echo $description; ?></textarea><br>
          <input class="form-control" type="file" name="file" id="file-upload"><br>
          <input class="form-control" type="text" name="author" required value="<?php echo $author; ?>" placeholder="Author name *">
          <div class="form-check">
            <input class="form-check-input" value="True" type="checkbox" name="published">
            <label class="form-check-label" for="defaultCheck1">
              Is Published
            </label>
          </div>
          <input class="form-control" type="text" name="keywords" value="<?php echo $keywords; ?>" placeholder="Meta Keywords"><br>



          <textarea class="form-control" id='mdesc' name='mdesc' style="resize:vertical"><?php echo $mdescription; ?></textarea><br>




          <input type="submit" name="submit" value="Submit" class="btn btn-info">
        </form>

        <?php

        ?>

      </div>
    </div>
    <div class="col-md-2"></div>

  </div>



  </div>

  <?php require 'include/footer.php'; ?>


  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

  <script src="js/ckeditor5/build/ckeditor.js"></script>

  <script>
    ClassicEditor
      .create(document.querySelector('#long_desc'), {
        ckfinder: {
          uploadUrl: "ckfileupload",
        }
      })
      .catch(error => {
        console.error(error);
      });

    setTimeout(function() {
      $("#msg").fadeOut('slow');
    }, 5000);
  </script>
  <script>
    function formValidation() {
      var title = document.create_blog.title;
      var author = document.create_blog.author;
      var inputElement = document.getElementById('file-upload');
      if (title.value.length <= 0) {

        alert("Title must be filled out");
        title.focus();
        return false;
      }
      // var files = inputElement.files;
      //     if(files.length==0){
      //         alert("Please choose a file first...");
      //         return false;
      //     }else{
      //         var filename = files[0].name;

      //         /* getting file extenstion eg- .jpg,.png, etc */
      //         var extension = filename.substr(filename.lastIndexOf("."));

      //         /* define allowed file types */
      //         var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif|\.PNG)$/i;

      //         /* testing extension with regular expression */
      //         var isAllowed = allowedExtensionsRegx.test(extension);

      //         if(isAllowed){
      //             alert("File type is valid for the upload");
      //             /* file upload logic goes here... */
      //         }else{
      //             alert("Invalid File Type.");
      //             return false;
      //         }
      // }
      if (author.value.length <= 0) {
        alert("Author must be filled out");
        title.focus();
        return false;
      }

    }
  </script>
</body>

</html>