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
        echo "<script>alert('Player added successfully')</script>";
    } else {
        // There was an error inserting the record into the database. You can add any error handling code here.
    }
}

//Update
if (isset($_POST['submitEdit'])) {
    $playerId = $_POST['id']; // Assuming a hidden field with player ID
    $clubidEdit = $_POST['clubidEdit'];
    $nameEdit = $_POST['nameEdit'];

    // Update query with WHERE clause to specify the player to update
    $updateQuery = "UPDATE `players` SET `clubid`='$clubidEdit', `name`='$nameEdit' WHERE `id` = '$playerId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Player updated successfully')</script>";
        // Update successful, additional logic here (e.g., redirect)
    } else {
        // Update failed, error handling here
        echo "Error updating player: " . mysqli_error($conn);
    }
}


// Delete

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Basic validation (optional, consider more robust validation)
    if (is_numeric($delete_id)) {

        // Prepare SQL statement with parameter to prevent SQL injection
        $sql = "DELETE FROM `players` WHERE `id` = ?";
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
                <h6>League Players</h6>
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
    <button type="button" style="margin-left: 10px;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewsModal">Add Players</button>
    <br> <br>


    <!-- Edit -->
    <?php
    $sql = "SELECT * FROM players";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="row">
            <div class="col-md-3">


                <!-- Edit -->
                <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addClubModalLabel">Edit Player</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Club</label>
                                        <select class="form-select" id="team1" name="clubidEdit" required>
                                            <option>Select Club</option>
                                            <!-- Populate the team 1 options dynamically -->
                                            <?php
                                            $teamsQuery = "SELECT * FROM clubs";
                                            $teamsResult = mysqli_query($conn, $teamsQuery);
                                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                                $selected = ($row["clubid"] == $teamRow["id"]) ? 'selected' : '';
                                                echo "<option  value='" . $row["clubid"] . "' $selected>" . $teamRow["name"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="nameEdit" value="<?php echo $row["name"] ?>" class="form-control">
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
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


<!-- Create -->
<div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addExecutivesModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add Players</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <select class="form-select" id="team1" name="clubid" required>
                        <option>Select Club</option>
                        <!-- Populate the team 1 options dynamically -->
                        <?php
                        $teamsQuery = "SELECT * FROM clubs";
                        $teamsResult = mysqli_query($conn, $teamsQuery);
                        while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                            // echo '<option name='."clubid".' value="' .$teamRow["id"]. '">' . $teamRow["id"] . ' </option>';
                        ?>
                            <option value="<?php echo $teamRow["id"] ?>"><?php echo $teamRow["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <div class="mb-3">
                        <label for="name" class="form-label">Player Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="container" style="margin-left: 200px;">

    <table id="myTable" class="table table-striped table-bordered tble-hover" style="width:100%; margin-left:10px; margin-right:10px;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Club</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM players";
            $result = mysqli_query($conn, $sql);
            $fixtureCount = 0;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row["name"] ?></td>
                    <?php
                    $cid = $row["clubid"];
                    $sqls = "SELECT * FROM `clubs` WHERE id = '$cid'";
                    $resul = mysqli_query($conn, $sqls);
                    while ($rows = mysqli_fetch_assoc($resul)) {
                    ?>
                        <td>
                            <img alt="Team Logo" class="teamLogo" src="./images/uploads/<?php echo $rows["logo"] ?>">
                            <?php echo $rows["name"] ?>


                        </td>
                    <?php
                    } ?>
                    <td>
                        <button class="btn btn-submit" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" style="margin-right: 10px;">Edit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row["id"] ?>">Delete</button>
                    </td>
                </tr>


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


            <?php }
            ?>

        </tbody>
    </table>





</div>