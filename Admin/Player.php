<?php
include './adminHeader.php';
require_once('../databaseConn.php');



?>

<!-- Create -->
<?php
if (isset($_POST['submit'])) {
    $clubid = $_POST['clubid'];
    $name = $_POST['name'];

    $insertQuery = "INSERT INTO `players`(`clubid`,`name`) VALUES ('$clubid','$name')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Executive added successfully')</script>";
            // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
        } else {
            // There was an error inserting the record into the database. You can add any error handling code here.
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





<div class="container" style="margin-left: 200px;">
    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs">
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
                <h6 style="color:#37003c; text-align:center;">Club Players</h6>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewsModal">Add Players</button>



    <?php
    $sql = "SELECT * FROM players";
    $result = mysqli_query($conn, $sql);

    $fixtureCount = 0;
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="row">
            <div class="col-md-3">
                <h5 style="text-align: center;"><?php echo $row["name"] ?></h5>
                
                <h5 style="text-align: center;"><?php echo $row["clubid"] ?></h5>

                <form style="margin: 0 auto;" action="" method="post"><input type="hidden" name="id" value="<?php ($row["id"]) ?>"> </form>
                <input type="button" class="btn btn-submit" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" value="Edit" style="width: 100%;">
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
                                        <input type="text" name="name"  value="<?php echo $row["name"] ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <img src="./images/executives/<?php echo $row["image"] ?>" style="width: 200px;" alt="">
                                        <input type="file" class="form-control" id="my_image" name="my_imageEdit" value="<?php echo $row["image"] ?>" >
                                    </div>
                                    <input type="hidden" name="id" value="<?php ($row["id"]) ?>"> 
                                    <button type="submit" name="submitEdit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    <?php }

    ?>
</div>


<div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addExecutivesModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add Players</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                <select class="form-select" id="team1" name="fixture" required>
                            <option>Select Club</option>
                            <!-- Populate the team 1 options dynamically -->
                            <?php
                            $teamsQuery = "SELECT * FROM clubs";
                            $teamsResult = mysqli_query($conn, $teamsQuery);
                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                echo '<option name='."clubid".' value="' .$teamRow["id"]. '">' . $teamRow["name"] . ' </option>';
                            }
                            ?>
                        </select>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>