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


$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = OpenCon();
if ($conn->connect_error) {
  $err = "Error! Try again Later!";
} else {
  $succ = "Connection established";
}

$msg = '';

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

  $targetDir = "images/blogs/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  $title = $_POST['title'];

  //$long_desc = $_POST['long_desc'];
  $long_desc = htmlspecialchars($_POST['long_desc'], ENT_QUOTES);
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

  $allowTypes = array('jpg', 'png', 'PNG', 'JPG', 'jpeg', 'gif');
  if (in_array($fileType, $allowTypes)) {
    // Upload file to server
  //   if (is_writable($targetFilePath)) {
  //     echo 'The file is writable';
  // } else {
  //     echo 'The file is not writable';
  // }
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
      // Insert image file name into database
      $insert = $conn->query("INSERT into blogs (title, slug, description, image, image_path, published, author, keywords, mdescription) VALUES ('" . $title . "','" . $slug . "','" . $long_desc . "','" . $fileName . "','" . $targetFilePath . "','" . $published . "', '" . $author . "','" . $keywords . "','" . $mdesc . "' )");
      if ($insert) {
        $statusMsg = "Blog created successfully.";
      } else {
        // echo "INSERT into blogs (title, slug, description, image, image_path, published, posted_by, author, keywords, mdescription) VALUES ('".$title."','".$slug."','".$long_desc."','".$fileName."','".$targetFilePath."','".$published."', '".$author."', '".$author."','".$keywords."','".$mdesc."' )";
        //print_r(mysqli_error($conn));
        $statusMsg = "File upload failed, please try again.";
      }
    } else {
      //echo "<b>Error : ". $_FILES["file"]["error"] .
      $statusMsg = "Sorry, there was an error uploading your file.".$_FILES["file"]["error"];
    }
  } else {
    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, files are allowed to upload.';
  }
} else {
  $statusMsg = '';
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

  <title>Create Blogs | IBR Live</title>

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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Create Blog</h4>
      </div>
    </div>
  </div>

  <div class="row" style="padding-top: 135px;">

    <p class="text-center" id="msg"><?php echo $statusMsg; ?></p>
    <div class="col-md-1" style="margin-left: 10px;">
      <div class="list-group" style="padding: 8px 0px 0px 0px;">
        <a href="all-blogs.php" class="list-group-item" style="padding: 14px 0px 15px 20px;">All Blogs</a>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default panelBorderColor " style="margin: 10px; padding: 10px;">

        <form method='post' action='' name='create_blog' id='create_blog' enctype="multipart/form-data">

          <input class="form-control" type="text" name="title" placeholder="Title *" id="title" required><br>



          <textarea class="form-control" id='long_desc' name='long_desc' rows="50"></textarea><br>
          <!-- Create the editor container -->
          <div id="editor">
          </div>
          <label>Only .jpg, .png, .jpeg, .gif allows</label>
          <input class="form-control" type="file" id="image" name="file" id="file-upload" required><br>
          <input class="form-control" type="text" name="author" id="author" placeholder="Author name *" required>
          <div class="form-check">
            <input class="form-check-input" value="True" type="checkbox" name="published">
            <label class="form-check-label" for="defaultCheck1">
              Is Published
            </label>
          </div>
          <input class="form-control" type="text" name="keywords" placeholder="Meta Keywords"><br>



          <textarea class="form-control" id='mdesc' name='mdesc' placeholder="Enter meta description" style="resize:vertical"></textarea><br>




          <input type="submit" name="submit" value="Submit" class="btn btn-info">
        </form>

      </div>
    </div>
    <div class="col-md-2">
      <h4>Featured Image:</h4>
      <div id="preview"></div>
    </div>

  </div><!--/Left Column-->
  <?php
  ?>

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
  <!-- <script src="js/ckeditor/ckeditor.js"></script> -->
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script> -->

  <script>
    ClassicEditor
      .create(document.querySelector('#long_desc'), {
        ckfinder: {
          uploadUrl: "ckfileupload",
        }
      });
    // CKEDITOR.replace( 'long_desc' );
    $(document).ready(function() {
      $("#create_blog").validate({
        ignore: ".ck-editor *"
      });
    });
    setTimeout(function() {
      $("#msg").fadeOut('slow');
    }, 5000);
  </script>
  <script>
    // function formValidation() {
    //   var title = document.create_blog.title;
    //   var author = document.create_blog.author;
    //   var inputElement = document.getElementById('file-upload');
    //   if(title.value.length <= 0) {

    //     alert("Title must be filled out");
    //     title.focus();  
    //      return false; 
    //   }
    //   var files = inputElement.files;
    //       if(files.length==0){
    //           alert("Please choose a file first...");
    //           return false;
    //       }else{
    //           var filename = files[0].name;

    //           /* getting file extenstion eg- .jpg,.png, etc */
    //           var extension = filename.substr(filename.lastIndexOf("."));

    //           /* define allowed file types */
    //           var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif|\.PNG)$/i;

    //           /* testing extension with regular expression */
    //           var isAllowed = allowedExtensionsRegx.test(extension);

    //           if(isAllowed){
    //               alert("File type is valid for the upload");
    //               /* file upload logic goes here... */
    //           }else{
    //               alert("Invalid File Type.");
    //               return false;
    //           }
    //   }
    //   if(author.value.length <= 0) {
    //     alert("Author must be filled out");
    //     title.focus();  
    //       return false; 
    //   }

    // }

    function imagePreview(fileInput) {
      if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function(event) {
          $('#preview').html('<img src="' + event.target.result + '" width="300" height="auto"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
      }
    }

    $("#image").change(function() {
      imagePreview(this);
    });
  </script>

</body>

</html>