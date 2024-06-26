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


// Delete


if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Basic validation (optional, consider more robust validation)
    if (is_numeric($delete_id)) {

        // Prepare SQL statement with parameter to prevent SQL injection
        $sql = "DELETE FROM `results` WHERE `id` = ?";
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
                <h6>League Teams</h6>
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
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addResultsModal">Add Results</button>
        <br><br>
        <?php
        $sql = "SELECT c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name,
        f.date AS rdate, f.venue AS venue, r.team1Score AS team1Score, r.team2Score AS team2Score
        FROM fixtures f
        INNER JOIN clubs c1 ON f.team1Id = c1.id
        INNER JOIN clubs c2 ON f.team2Id = c2.id
        INNER JOIN results r ON f.id = r.fixtureId;";
        $result = mysqli_query($conn, $sql);

        $fixtureCount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($fixtureCount % 3 == 0) {
                if ($fixtureCount != 0) {
                    echo '</div>'; // Close previous row
                }
                echo '<div class="row">'; // Start new row
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
                                <p style="font-size: 10px;" class="mb-0"><b>Time Played</b> </p>
                                <div class="pt-2" style="background-color: #f3f0f2; height:40px; width:70px; ">
                                    <?php echo date('H-m', strtotime($row["rdate"])); ?>
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

                        <div class="row" style="text-align: center;">
                            <p style="font-size: 10px;" class="mb-0"><b>Results</b> </p>
                            <div class="col">
                                <p style="background-color: grey;">10</p>
                            </div>
                            <div class="col">
                                <p style="background-color: grey;">10</p>
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-primary" style="width: 50%; margin:0 auto;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" style="margin-right: 10px;">Edit Results</a>

                        </div>

                        <!-- Edit -->
                        <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addClubModalLabel">Edit Results</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="">

                                            <div class="mb-3">
                                                <label for="team1" class="form-label">Team 1</label>
                                                <input type="text" class="form-control" value="<?php echo $row['team1Score'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="team2" class="form-label">Team 2</label>
                                                <input type="text" class="form-control" value="<?php echo $row['team2Score'] ?>">
                                            </div>

                                            <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <br>


                    </div>
                </div>
            </div>

        <?php
            $fixtureCount++;
        }
        echo '</div>'; // Close the last row
        ?>

        <?php
        if (isset($_POST['submit'])) {
            $fixtureId = $_POST['fixture'];
            $team1Score = $_POST['team1Score'];
            $team2Score = $_POST['team2Score'];

            // Assuming you have a table named "fixtures" with the respective columns

            $insertQuery = "INSERT INTO `results`(`fixtureId`, `team1Score`, `team2Score`) VALUES ('$fixtureId', '$team1Score', '$team2Score')";

            if (mysqli_query($conn, $insertQuery)) {
                // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
            } else {
                // There was an error inserting the record into the database. You can add any error handling code here.
            }
        }
        ?>
    </div>
</div>

<!-- Create -->
<div class="modal fade" id="addResultsModal" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="team1" class="form-label">Fixture</label>
                        <select class="form-select" id="team1" name="fixture" required>
                            <option>Select Fixture</option>
                            <!-- Populate the team 1 options dynamically -->
                            <?php
                            $teamsQuery = "SELECT id FROM fixtures";
                            $teamsResult = mysqli_query($conn, $teamsQuery);
                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                echo '<option value="' . $teamRow["id"] . '">' . $teamRow["id"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="team1Score" class="form-label">Team 1 Score</label>
                        <input type="text" name="team1Score" id="team1Score" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="team2Score" class="form-label">Team 2 Score</label>
                        <input type="text" name="team2Score" id="team1Score" class="form-control">
                    </div>
                   
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>