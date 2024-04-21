<?php
$target_dir = "./upload/"; // Change this to your desired upload directory
$max_file_size = 5000000; // 5 MB in bytes
$_FILES["fileToUpload"] = '';

$uploadOk = 1;
$message = "";

// Check if image name is provided
if (empty($_POST["imageName"])) {
  $message = "Please provide a name for the image.";
  $uploadOk = 0;
}

// Check if image file is uploaded
if (isset($_FILES["fileToUpload"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    $message = "File is an image - " . $check["mime"] . ".";
  } else {
    $message = "File is not an image.";
    $uploadOk = 0;
  }
} else {
  $message = "No image file selected.";
  $uploadOk = 0;
}

// Check if file already exists (optional)
// if (file_exists($target_dir . $_POST["imageName"] . "." . pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION))) {
//   $message = "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > $max_file_size) {
  $message = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Check allowed file types
$allowed_extensions = array("jpg", "jpeg", "png", "svg");
$file_extension = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
if (!in_array($file_extension, $allowed_extensions)) {
  $message = "Sorry, only JPG, JPEG, PNG & SVG files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  $message = "Sorry, your file was not uploaded." . $message;
  // if everything is ok, try to upload file
} else {
  $target_file = $target_dir . $_POST["imageName"] . "." . $file_extension;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $message = "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  } else {
    $message = "Sorry, there was an error uploading your file.";
  }
}

echo $message;
?>



<!DOCTYPE html>
<html>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">Select image to upload:</label>
    <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*">
    <br>
    <label for="imageName">Image Name:</label>
    <input type="text" id="imageName" name="imageName" required>
    <br>
    <button type="submit">Upload Image</button>
    <br>
    <img id="preview" src="" alt="Image Preview">
  </form>

  <script>
    document.getElementById('fileToUpload').addEventListener('change', function(e) {
      var target = document.getElementById('preview');
      var file = e.target.files[0];

      if (file) {
        var reader = new FileReader();

        reader.onloadend = function() {
          target.src = reader.result;
        };

        reader.readAsDataURL(file);
      } else {
        target.src = "";
      }
    });
  </script>

</body>

</html>





















