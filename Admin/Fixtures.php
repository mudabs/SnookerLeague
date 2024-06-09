<?php
include './adminHeader.php';
require_once('../databaseConn.php');

function getTeamLogo($logoFileName)
{
    // Assuming the team logos are stored in the "images/logos/" directory
    $logoPath = "../Admin/images/uploads/" . $logoFileName;

    // Check if the logo file exists
    if (file_exists($logoPath)) {
        return $logoPath;
    } else {
        // If the logo file doesn't exist, you can provide a default logo or handle the situation as per your requirements
        return "../Admin/images/default_logo.png";
    }
}

// Create

if (isset($_POST['submit'])) {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $venue = $_POST['venue'];
    $date = $_POST['date'];

    // Assuming you have a table named "fixtures" with the respective columns

    $insertQuery = "INSERT INTO fixtures (team1id, team2id, venue, date) VALUES ('$team1', '$team2', '$venue', '$date')";
    $insertQuery2 = "INSERT INTO old_fixtures (team1id, team2id, venue, date) VALUES ('$team1', '$team2', '$venue', '$date')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('Fixture added successfully')</script>";
        // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
    } else {
        // There was an error inserting the record into the database. You can add any error handling code here.
    }

    if (mysqli_query($conn, $insertQuery2)) {
        echo "<script>alert('Fixture added successfully')</script>";
        // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
    } else {
        // There was an error inserting the record into the database. You can add any error handling code here.
    }
}

//Update
if (isset($_POST['submitEdit'])) {
    $fixtureId = $_POST['id'];
    $team1Edit = $_POST['team1']; // Assuming a hidden field with player ID
    $team2Edit = $_POST['team2'];
    $venueEdit = $_POST['venue'];
    $dateEdit = $_POST['date'];

    // Update query with WHERE clause to specify the player to update
    $updateQuery = "UPDATE `fixtures` SET `team1id`='$team1Edit',`team2id`='$team2Edit',`date`='$dateEdit',`venue`='$venueEdit' WHERE  `id` = '$fixtureId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Fixture updated successfully')</script>";
        // Update successful, additional logic here (e.g., redirect)
    } else {
        // Update failed, error handling here
        echo "Error updating fixture: " . mysqli_error($conn);
    }
}


// Delete
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Basic validation (optional, consider more robust validation)
    if (is_numeric($delete_id)) {

        // Prepare SQL statement with parameter to prevent SQL injection
        $sql = "DELETE FROM `fixtures` WHERE `id` = ?";
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
                <h6>League Fixtures</h6>
            </div>
            <div class="logoDiv">
                <img src="../static/images/logo.png" alt="Logo Image">
            </div>
        </div>
        <div style="width: 100%; height:15px;background-color:#37003c;"></div>
        <div class="sectionHeader flex" style="background-color: #f3f0f2;">
            <div class="seasonYear">
                <h6 style="color:#37003c; text-align:center;"><?php $currentYear = date('Y');
                                                                echo $currentYear; ?></h6>
            </div>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClubModal">Add Fixture</button>
        <br><br>

        <div class="section fixturesSection container">
            <div class="sectionContainer">
                <div class="sectionContent  grid">
                    <div class="fixtureDiv borderTop">
                        <?php

                        // Execute the first SQL query to get all dates
                        $sql = "SELECT DISTINCT date FROM `fixtures`";
                        $result = mysqli_query($conn, $sql);

                        while ($dateRow = mysqli_fetch_assoc($result)) {
                            $selectedDate = $dateRow["date"]; // Store the date from the first query
                        ?>
                            <div class="date">
                                <?php echo date('D-d-M-Y', strtotime($selectedDate)); ?>
                            </div>

                            <div class="row" style="height: 200px;">
                                <?php

                                $sql = "SELECT f.*, c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name, c2.logo AS team2_logo, c1.id AS team1_id, c2.id AS team2_id, f.date, f.venue 
                                FROM fixtures f 
                                INNER JOIN clubs c1 ON f.team1id = c1.id 
                                INNER JOIN clubs c2 ON f.team2id = c2.id
                                WHERE f.date = '$selectedDate';";
                                $fixtureResult = mysqli_query($conn, $sql);

                                $fixtureCount = 0;
                                while ($row = mysqli_fetch_assoc($fixtureResult)) {

                                    if (mysqli_num_rows($fixtureResult) > 0) {
                                ?>


                                    <?php
                                    }

                                    // Retrieve team logos
                                    $team1_logo = getTeamLogo($row["team1_logo"]);
                                    $team2_logo = getTeamLogo($row["team2_logo"]);
                                    ?>

                                    <div class="col-md-4">
                                        <div class="card" style="margin-bottom: 15px;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="<?php echo $team1_logo; ?>" alt="" style="width: 100px;">
                                                        <div class="team-name"><?php echo $row["team1_name"]; ?></div>
                                                    </div>
                                                    <div class="col game-time" style="text-align: center;">
                                                        <div class="mt-4 pt-2 ml-2" style="background-color: #f3f0f2; height:40px; width:70px; margin:0 auto;">
                                                            <?php echo date('H-m', strtotime($row["date"])); ?>
                                                        </div>

                                                    </div>
                                                    <div class="col">
                                                        <img src="<?php echo $team2_logo; ?>" alt="" style="width: 100px;">
                                                        <div class="team-name"><?php echo $row["team2_name"]; ?></div>
                                                    </div>
                                                </div>
                                                <div class="row" style="text-align: center;">
                                                    <h6>Venue: <?php echo $row["venue"]; ?></h6>
                                                </div>
                                                <div class="row">
                                                    <a class="btn btn-primary" style="width: 50%; margin:0 auto;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" style="margin-right: 10px;">Edit Fixture</a>

                                                </div>

                                                <!-- Edit -->
                                                <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addClubModalLabel">Add Fixture</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="">
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                                                                        <label for="team1" class="form-label">Team 1</label>
                                                                        <select class="form-select" id="team1" name="team1" required>
                                                                            <option value="">Select Team 1</option>
                                                                            <?php
                                                                            $teamsQuery = "SELECT f.*, c1.name AS team1_name, c2.name AS team2_name
                                                                            FROM fixtures f
                                                                            INNER JOIN clubs c1 ON f.team1id = c1.id
                                                                            INNER JOIN clubs c2 ON f.team2id = c2.id";

                                                                            $teamsResult = mysqli_query($conn, $teamsQuery);
                                                                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                                                                $selected = ($row["team1_id"] == $teamRow["team1id"]) ? 'selected' : '';
                                                                                echo "<option value='" . $row["team1_id"] . "' $selected>" . $teamRow["team1_name"] . "</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="team2" class="form-label">Team 2</label>
                                                                        <select class="form-select" id="team2" name="team2" required>
                                                                            <option value="">Select Team 2</option>
                                                                            <?php
                                                                            $teamsQuery = "SELECT f.*, c1.name AS team1_name, c2.name AS team2_name
                                                                            FROM fixtures f
                                                                            INNER JOIN clubs c1 ON f.team1id = c1.id
                                                                            INNER JOIN clubs c2 ON f.team2id = c2.id";
                                                                            $teamsResult = mysqli_query($conn, $teamsQuery);
                                                                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                                                                $selected = ($row["team2_id"] == $teamRow["team2id"]) ? 'selected' : '';
                                                                                echo "<option value='" . $row["team2_id"] . "' $selected>" . $teamRow["team2_name"] . "</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="venue" class="form-label">Venue</label>
                                                                        <input type="text" class="form-control" id="venue" name="venue" value="<?php echo $row['venue'] ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="date" class="form-label">Date</label>
                                                                        <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['date'] ?>" required>
                                                                    </div>
                                                                    <button type="submit" name="submitEdit" class="btn btn-primary">Edit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                                <br>
                                                <div class="row">
                                                    <!-- Delete -->
                                                    <a href="" class="btn btn-primary" style="width: 55%; margin:0 auto; background-color:#fe2883;" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row["id"] ?>">Delete Fixture</a>

                                                    <div class="modal fade" id="deleteModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this Fixture? This action cannot be undone.</p>
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
                                    $fixtureCount++;
                                }
                            }
                            ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addClubModal" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add Fixture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="team1" class="form-label">Team 1</label>
                        <select class="form-select team1" id="team1" name="team1" required>
                            <option>Select Team 1</option>
                            <?php
                            $teamsQuery = "SELECT id, name FROM clubs";
                            $teamsResult = mysqli_query($conn, $teamsQuery);
                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                echo '<option value="' . $teamRow["id"] . '">' . $teamRow["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="team2" class="form-label">Team 2</label>
                        <select class="form-select team2" id="team2" name="team2" required>
                            <option value="">Select Team 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="venue" class="form-label">Venue</label>
                        <input type="text" class="form-control" id="venue" name="venue" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        $(".team1").change(function() {
            var selectedTeam = $(this).val();
            $(".team2").empty(); // Clear existing options in team2
            $(".team2").append('<option value="">Select Team 2</option>'); // Add default option

            // Fetch remaining teams excluding the selected one
            $.each($(".team1 option"), function() {
                if ($(this).val() != selectedTeam && $(this).val() != "" && $(this).val() != "Select Team 1") {
                    $(".team2").append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
                }
            });
        });
    });
</script>