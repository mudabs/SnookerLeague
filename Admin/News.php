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
                    $new_img_name = substr($title,0,10) . '.' . $img_ex_lc;
                    $img_upload_path = '../static/images/news/' . $new_img_name; // Assuming 'images/uploads' exists within your document root

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

        $insertQuery = "INSERT INTO `news`(`title`, `feed`, `date`, `coverImage`) VALUES ('$title','$feed','$date','$image')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('News feed added successfully')</script>";
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



    <?php
    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);

    $fixtureCount = 0;
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="row">

            <div class="col-md-2">

                <!-- Edit -->
                <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addClubModalLabel">Edit News Feed</h5>
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
                                        <textarea  name="feed" rows="10" class="form-control"><?php echo $row["feed"] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" value="<?php echo $row["date"] ?>" id="date" name="date" required>
                                        <small><?php echo date('D-d-M-Y', strtotime($row["date"])) ?> </small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="my_image" class="form-label">Cover Image</label>
                                        <input type="file" class="form-control" id="my_image" name="my_image" required>
                                        <img src="./images/news/<?php echo $row["coverImage"] ?>" alt="Image">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete -->

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

                <!-- View -->

                <div class="modal fade" id="viewModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addClubModalLabel"><?php echo $row["title"] ?></h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <small class="ml-3"><?php echo date('D-d-M-Y', strtotime($row["date"])) ?> </small>
                                <br> <br>
                                <h4><?php echo $row["feed"] ?></h4>
                                <br> <br>
                                <img src="../static/images/news/<?php echo $row["coverImage"] ?>" alt="Image">
                                <br> <br>
                                <button type="submit" name="submit" class="btn btn-primary">Add</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    <?php }

    ?>
    <hr>


    <section class="section newsSection container">
        <div class="sectionHeader">
            <span class="newsTitle">Club News</span>



            <span style="position: absolute; right:2%;"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewsModal">Add News Feed</button></span>
        </div>

        <!-- Search Feature -->

        <div class="container mt-5">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" placeholder="Search News..." aria-label="Search News">
                <button class="btn btn-outline-primary" type="button" disabled>Search</button>
            </div>
            <div id="search-results"></div>
        </div>

        <!-- Search Feature -->
        <div class="pb-5">

        </div>
        <div class="newContent grid">
            <?php
            $sql = "SELECT * FROM news ORDER BY `date` DESC";
            $result = mysqli_query($conn, $sql);

            $fixtureCount = 0;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="singlePost flex">
                    <div class="postImg">
                        <img src="../static/images/news/<?php echo $row['coverImage'] ?>" alt="Cover Image" class="">
                    </div>
                    <div class="newsTxt">
                        <a data-bs-toggle='modal' data-bs-target='#viewModal<?php echo $row["id"] ?>'>
                            <span style="position: absolute; right:13%;"><?php echo date('D-d-M-Y', strtotime($row["date"])) ?> </span>
                            <span class="title"><?php echo $row['title']  ?></span>

                        </a>
                        <p> <?php echo $row['feed']  ?></p>
                    </div>
                    <div class="postImg">
                        <a class="btn btn-primary mb-1" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>">Edit Post</a>
                        <a href="" class="btn btn-primary" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row["id"] ?>">Delete </a>

                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
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
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="feed" class="form-label">Feed</label>
                        <textarea type="text" id="feed" name="feed" class="form-control" rows="10"></textarea>
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

<script>
    $(document).ready(function() {
        $("#search").keyup(function() {
            var searchTerm = $(this).val();
            if (searchTerm) {
                $("#search-results").html("Loading...");
                $.ajax({
                    url: "newsQuery.php",
                    type: "POST",
                    data: {
                        search: searchTerm
                    },
                    success: function(response) {
                        $("#search-results").html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                        $("#search-results").html("An error occurred!");
                    }
                });
            } else {
                $("#search-results").html("");
            }
        });
    });
</script>