<?php
include './adminHeader.php';
?>


<?php

// Create
require_once('../databaseConn.php');
if (isset($_POST['submit'])) {
    // Get form data
    $clubName = $_POST['clubName'];
    $estDate = $_POST['estDate'];
    $location = $_POST['location'];
    $numPlayers = $_POST['numPlayers'];
    $logo = 'logoss.png';

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

                $allowed_exs = array("jpg", "jpeg", "png", "jfif");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = $clubName . '.' . $img_ex_lc;
                    $img_upload_path = 'images/uploads/' . $new_img_name; // Assuming 'images/uploads' exists within your document root

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
    }

    // Prepare SQL statement (prevents SQL injection) with logo value if uploaded
    $sql = "INSERT INTO `clubs`( `name`, `estdate`, `location`, `numplayers`, `logo`) VALUES ('$clubName', '$estDate', '$location', $numPlayers, '$logo')";

    // Prepare statement
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $clubId = mysqli_insert_id($conn); // Get the ID of the inserted club

        // Insert record into logs table with the club ID as foreign key
        $logSql = "INSERT INTO `log`(`position`, `clubId`, `played`, `wins`, `draws`, `loses`, `ff`, `fa`, `fd`, `points`) VALUES ('0','$clubId','0','0','0','0','0','0','0','0')"; // Initial points set to 0

        $logResult = mysqli_query($conn, $logSql);
        echo "<script>alert('Record created successfully!');</script>";
    } else {
        echo "Failed: " . mysqli_error($conn);
    }

    // Close connection
    // mysqli_close($conn);
}

// Delete

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Basic validation (optional, consider more robust validation)
    if (is_numeric($delete_id)) {

        // Prepare SQL statement with parameter to prevent SQL injection
        $sql = "DELETE FROM `clubs` WHERE `id` = ?";
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

// Update
if (isset($_POST["submitEdit"])) {
    $idEdit = $_POST['idEdit'];
    $nameEdit = $_POST['clubNameEdit'];
    $estdateEdit = $_POST['estDateEdit'];
    $locationEdit = $_POST['locationEdit'];
    $numplayersEdit = $_POST['numPlayersEdit'];
    $logo = $_POST['logo'];

    // Upload Image
    if (isset($_FILES['my_imageEdit'])) {
        // echo "<pre>";
        // print_r($_FILES['my_image']);
        // echo "</pre>";

        $img_name = $_FILES['my_imageEdit']['name'];
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

                $allowed_exs = array("png", "jpg", "jpeg");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = $nameEdit . '.' . $img_ex_lc;
                    $img_upload_path = 'images/uploads/' . $new_img_name; // Assuming 'images/uploads' exists within your document root

                    // Check if upload is successful using move_uploaded_file return value
                    if (move_uploaded_file($tmp_name, $img_upload_path)) {
                        $logo = $new_img_name;
                    } else {
                        $em = "Failed to upload image!";
                        echo "<script>$em</script>";
                    }
                } else {
                    $em = "You can't upload files of this type";
                    echo "<script>alert('$em')</script>";
                }
            }
        } else {
            // Handle potential upload errors here (e.g., using switch statement on $error code)
            $em = "Unknown error occurred during upload!";
            echo "<script>$em</script>";
        }
    }
    $idEdit = (string)$idEdit;
    $sql = "UPDATE `clubs` SET `id`='$idEdit',`name`='$nameEdit',`estdate`='$estdateEdit',`location`='$locationEdit',`numplayers`='$numplayersEdit' ,`logo`='$logo' WHERE `id` = $idEdit";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Record created successfully!');</script>";
    } else {
        echo "<script>alert('Record Edit Failed!');</script>";
    }
}


?>

<div class="container" style="margin-left: 200px;">



    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs">
        <div class="sectionHeader flex">
            <div class="seasonYear">
                <h6>Leaague Teams</h6>
            </div>
            <div class="logoDiv">
                <img src="../static/images/logo.png" alt="Logo Image">
            </div>
        </div>
        <div style="width: 100%; height:15px;background-color:#37003c; ;">
        </div>
        <div class="sectionHeader flex" style="background-color: #f3f0f2; ">
            <div class="seasonYear">
                <h6 style="color:#37003c;"><?php $currentYear = date('Y'); echo $currentYear; ?></h6>
            </div>
        </div>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClubModal">Add Club</button>

        <!-- Create -->
        <div class="modal fade" id="addClubModal" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClubModalLabel">Add Club</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="clubName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="clubName" id="clubName" required>
                            </div>
                            <div class="mb-3">
                                <label for="establishmentDate" class="form-label">Establishment Date</label>
                                <input type="date" class="form-control" name="estDate" id="establishmentDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="hostLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="hostLocation" required>
                            </div>
                            <div class="mb-3">
                                <label for="numPlayers" class="form-label">Number of Players</label>
                                <input type="number" class="form-control" name="numPlayers" id="numPlayers" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="my_image" class="form-label">Club Image</label>
                                <input type="file" name="my_image" class="form-control" id="my_image" aria-describedby="clubImageHelp">
                                <small id="clubImageHelp" class="form-text text-muted">Upload an image for the club.</small>
                            </div>
                            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="clubsContainer container">
            <?php
            $sql = "SELECT * FROM `clubs`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="singleClub">
                    <div class="singleClubTop flex">
                        <div class="leftRow flex">

                            <div class="teamLogoDiv">

                                <img alt="Team Logo" class="teamLogo" src="./images/uploads/<?php echo $row["logo"] ?>">

                            </div>



                            <div class="clubName">
                                <span class="name"><?php echo $row["name"] ?></span>
                                <span class="classYear">Established <?php echo date('Y', strtotime($row["estdate"]));  ?></span>
                            </div>


                        </div>
                        <div class="rightRow">
                            <i class="uil uil-angle-down icon"></i>
                        </div>
                    </div>
                    <div class="singleClubHidden">
                        <span class="title">Stat Summary</span>
                        <div class="stat">
                            <span><i class="uil uil-football icon"></i>League Position</span>
                            <span class="res">1st</span>
                        </div>
                        <!-- <div class="stat">
                            <span><i class="uil uil-user-nurse icon"></i> Manager</span>
                            <span class="res">Manager Name</span>
                        </div> -->
                        <div class="stat">
                            <span><i class="uil uil-building icon"></i>Base Location</span>
                            <span class="res"><?php echo $row["location"] ?></span>
                        </div>
                        <div class="stat">
                            <span><i class="uil uil-user-arrows icon"></i>Number of
                                players</span>
                            <span class="res"><?php echo $row["numplayers"] ?> Players</span>
                            <div class="detailsLink">
                                <a href="clubs.php">

                                    <!-- Edit -->
                                    <a data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square fs-5"></i> </a>

                                    <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addClubModalLabel">Edit Club</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="idEdit" value="<?php echo $row["id"] ?>">
                                                        <input type="hidden" name="logo" value="<?php echo $row["logo"] ?>">


                                                        <div class="mb-3">
                                                            <label for="clubName" class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="clubNameEdit" id="clubName" value="<?php echo $row["name"] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="establishmentDate" class="form-label">Establishment Date</label>
                                                            <input type="date" class="form-control" name="estDateEdit" id="establishmentDate" value="<?php echo $row["estdate"] ?>" required>
                                                            <small>Set Date: <?php echo $row["estdate"] ?></small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="hostLocation" class="form-label">Location</label>
                                                            <input type="text" class="form-control" name="locationEdit" id="hostLocation" value="<?php echo $row["location"] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="numPlayers" class="form-label">Number of Players</label>
                                                            <input type="number" class="form-control" name="numPlayersEdit" id="numPlayers" min="1" value="<?php echo $row["numplayers"] ?>" required>
                                                        </div>

                                                        <div class="alb">
                                                            <img style="width: 50px;" src="./images/uploads/<?php echo $row["logo"] ?>">
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="my_imageEdit" class="form-label">Club Image</label>
                                                            <input type="file" name="my_imageEdit" class="form-control" id="my_imageEdit" aria-describedby="clubImageHelp">
                                                            <small id="clubImageHelp" class="form-text text-muted">Upload an image for the club.</small>
                                                        </div>

                                                        <input type="submit" value="Submit" name="submitEdit" class="btn btn-primary">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete -->
                                    <a href="" class="link-dark" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row["id"] ?>"><i class="fa-solid fa-trash fs-5"></i></a>

                                    <div class="modal fade" id="deleteModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete <?php echo $row["name"] ?>? This action cannot be undone.</p>
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
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>

    <tr>
        <td>



        </td>
    </tr>


    <!-- Clubs section ends =================================== -->

    <script>
        // Toggle clubs' details by arrow click======>
        /*=============== ACCORDION ===============*/
        const accordion = document.getElementsByClassName('singleClub')
        for (let i = 0; i < accordion.length; i++) {
            accordion[i].addEventListener('click', function() {
                this.classList.toggle('active')
            })
        }
    </script>

</div>