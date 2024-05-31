<?php
include './adminHeader.php';
require_once('../databaseConn.php');



?>

<!-- Create -->
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $image = "image.png";

    // Upload Image
    if (isset($_FILES['my_image'])) {
        // Extract the original filename without extension
        $originalFilename = pathinfo($_FILES['my_image']['name'], PATHINFO_FILENAME);

        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Sorry, your file is too large.";
                echo "<script>$em</script>";
            } else {
                $img_ex = pathinfo($_FILES['my_image']['name'], PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = $title . '.' . $img_ex_lc;
                    $img_upload_path = 'images/executives/' . $new_img_name; // Assuming 'images/uploads' exists within your document root

                    // Check if upload is successful using move_uploaded_file return value
                    if (move_uploaded_file($tmp_name, $img_upload_path)) {
                        $image = $new_img_name;
                    } else {
                        $em = "Failed to upload image!";
                        echo "<script>$em</script>";
                    }
                } else {
                    $em = "You can't upload files of this type";
                    echo "<script>$em</script>";
                }
            }
        } else {
            // Handle potential upload errors here (e.g., using switch statement on $error code)
            $em = "Unknown error occurred during upload!";
            echo "<script>$em</script>";
        }


        // Assuming you have a table named "fixtures" with the respective columns

        $insertQuery = "INSERT INTO `executives`(`name`,`role`, `image`) VALUES ('$name','$role','$image')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Executive added successfully')</script>";
            // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
        } else {
            // There was an error inserting the record into the database. You can add any error handling code here.
        }
    }
}


// <!-- Edit -->

if (isset($_POST['submitEdit'])) {
    $idEdit = $_POST['id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $image = $_POST['my_imageEdit'];

    // Upload Image
    if (isset($_FILES['my_imageEdit'])) {
        // Extract the original filename without extension
        $originalFilename = pathinfo($_FILES['my_imageEdit']['name'], PATHINFO_FILENAME);

        $img_size = $_FILES['my_imageEdit']['size'];
        $tmp_name = $_FILES['my_imageEdit']['tmp_name'];
        $error = $_FILES['my_imageEdit']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Sorry, your file is too large.";
                echo "<script>$em</script>";
            } else {
                $img_ex = pathinfo($_FILES['my_imageEdit']['name'], PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = $name . '.' . $img_ex_lc;
                    $img_upload_path = 'images/executives/' . $new_img_name; // Assuming 'images/uploads' exists within your document root

                    // Check if upload is successful using move_uploaded_file return value
                    if (move_uploaded_file($tmp_name, $img_upload_path)) {
                        $image = $new_img_name;
                    } else {
                        $em = "Failed to upload image!";
                        echo "<script>$em</script>";
                    }
                } else {
                    $em = "You can't upload files of this type";
                    echo "<script>$em</script>";
                }
            }
        } else {
            // Handle potential upload errors here (e.g., using switch statement on $error code)
            $em = "Unknown error occurred during upload!";
            echo "<script>$em</script>";
        }


        // Assuming you have a table named "fixtures" with the respective columns

        $sql = "UPDATE `executives` SET `name`='$name',`role`='$role',`image`='$image' WHERE `id` = '$idEdit';";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Executive updated successfully')</script>";
            // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
        } else {
            // There was an error inserting the record into the database. You can add any error handling code here.
        }
    }
}


// Delete

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Basic validation (optional, consider more robust validation)
    if (is_numeric($delete_id)) {

        // Prepare SQL statement with parameter to prevent SQL injection
        $sql = "DELETE FROM `executives` WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $delete_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Record deleted successfully!');</script>";
        } else {
            echo "<script>alert('Failed to delete record: " . mysqli_error($conn) . "');</script>";
        }

        // Close statement and connection
    } else {
        echo "<script>alert('Invalid delete request!');</script>";
    }

    // mysqli_stmt_close($stmt);
    // mysqli_close($conn);
}

?>





<div class="" style="margin-left: 200px;">
    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs" style="margin-left: 10px;">
        <div class="sectionHeader flex">
            <div class="seasonYear">
                <h6>League Executives</h6>
            </div>
            <div class="logoDiv">
                <img src="../static/images/logo.png" alt="Logo Image">
            </div>
        </div>
        <div style="width: 100%; height:15px;background-color:#37003c;"></div>
        <div class="sectionHeader flex" style="background-color: #f3f0f2;">
            <div class="seasonYear">
                <h6 style="color:#37003c; text-align:center;"><?php $currentYear = date('Y'); echo $currentYear; ?></h6>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success mb-2 " data-bs-toggle="modal" data-bs-target="#addNewsModal" style="margin-left: 10px;">Add Executive</button>

    <div class="menDiv grid" style="margin-left: 10px; margin-right: 10px;">
        <div class="row">
            <?php
            $sql = "SELECT * FROM executives";
            $result = mysqli_query($conn, $sql);

            $fixtureCount = 0;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>


                <div class="col-md-3">
                    <div class="topScorer borderTop">
                        <div class="imgDiv">
                            <img src="./images/executives/<?php echo $row["image"] ?>" alt=" Logo">
                        </div>
                        <div class="infoDiv">
                            <span class="honor" style="width: 100%;"><?php echo $row["name"] ?></span>
                            <span class="topScorerText">
                                Secretary General
                            </span>
                        </div>
                        <form style="margin: 0 auto;" action="" method="post"><input type="hidden" name="id" value="<?php ($row["id"]) ?>"> </form>
                        <input type="button" class="btn btn-submit" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" value="Edit" style="width: 100%;">

                    </div>
                </div>



                <!-- Edit -->
                <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addClubModalLabel">Edit Executive</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" value="<?php echo $row["name"] ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <input type="text" name="role" value="<?php echo $row["role"] ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <img src="./images/executives/<?php echo $row["image"] ?>" style="width: 200px;" alt="">
                                        <input type="file" class="form-control" id="my_image" name="my_imageEdit" value="<?php echo $row["image"] ?>">
                                    </div>
                                    <input type="hidden" name="id" value="<?php ($row["id"]) ?>">
                                    <button type="submit" name="submitEdit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }

            ?>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addExecutivesModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add Executives</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" name="role" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="my_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="my_image" name="my_image" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>