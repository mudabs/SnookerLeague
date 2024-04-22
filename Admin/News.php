<?php
include './adminHeader.php';
require_once('../databaseConn.php');



?>

<!-- Create -->
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $feed = $_POST['feed'];
    $date = $_POST['date'];

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
                    $img_upload_path = 'images/uploads/' . $new_img_name; // Assuming 'images/uploads' exists within your document root
                    $image = $new_img_name;

                    // Check if upload is successful using move_uploaded_file return value
                    if (move_uploaded_file($tmp_name, $img_upload_path)) {
                        $logo = $new_img_name;
                        echo "Image uploaded successfully!";
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

        $insertQuery = "INSERT INTO `news`(`title`, `feed`, `date`, `coverImage`) VALUES ('$title','$feed','$date','$image')";

        if (mysqli_query($conn, $insertQuery)) {
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
        $sql = "DELETE FROM `news` WHERE `id` = ?";
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





<div class="container" style="margin-left: 200px;">
    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs">
        <div class="sectionHeader flex">
            <div class="seasonYear">
                <h6>League Teams</h6>
            </div>
            <div class="logoDiv">
                <img src="../static/images/logo.png" alt="Logo Image">
            </div>
        </div>
        <div style="width: 100%; height:15px;background-color:#37003c;"></div>
        <div class="sectionHeader flex" style="background-color: #f3f0f2;">
            <div class="seasonYear">
                <h6 style="color:#37003c; text-align:center;">Latest News</h6>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewsModal">Add News Feed</button>
    <hr>



    <?php
    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);

    $fixtureCount = 0;
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="row">
            <div class="col-md-1">
                <img src="../static/images/logo.png" alt="">
            </div>

            <div class="col">

                <h5><?php echo $row["title"] ?></h5>

                <p><?php echo $row["feed"] ?></p>
                <p style="position: relative; left:85%; bottom:50%;"><?php echo date('D-d-M-Y', strtotime($row["date"])) ?></p>
                <p style="position: relative; left:85%; bottom:55%;"><?php echo date('H-m', strtotime($row["date"])) ?></p>
            </div>

            <div class="col-md-2">
                <a class="btn btn-primary mb-1" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>">Edit Post</a>

                <!-- Edit -->
                <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addClubModalLabel">Add Fixture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" value="<?php echo $row["title"] ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="feed" class="form-label">Feed</label>
                                        <textarea type="text" name="feed" value="<?php echo $row["feed"] ?>" class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" value="<?php echo $row["date"] ?> id=" date" name="date" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="my_image" class="form-label">Cover Image</label>
                                        <input type="file" class="form-control" id="my_image" name="my_image" required>
                                        <img src="./images/news/<?php echo $row["coverImage"] ?>" alt="Image">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete -->
                <a href="" class="btn btn-primary" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row["id"] ?>">Delete Feed</a>

                <div class="modal fade" id="deleteModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this News feed? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="" method="post"> <input type="hidden" name="delete_id" value="<?php echo $row["id"] ?>"> <button type="submit" class="btn btn-danger">Delete</button> </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    <?php }

    ?>
    <hr>
</div>


<div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add News Feed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="team2" class="form-label">Feed</label>
                        <textarea type="text" name="feed" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="mb-3">
                        <label for="my_image" class="form-label">Cover Image</label>
                        <input type="file" class="form-control" id="my_image" name="my_image" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>