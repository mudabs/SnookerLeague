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
    $result1 = $_POST['result1'];
    $result2 = $_POST['result2'];
    $fixtureId = $_POST['fixtureId'];

    // Assuming you have a table named "fixtures" with the respective columns

    $insertQuery = "INSERT INTO results (`fixtureId`, `team1Score`, `team2Score`) VALUES ('$fixtureId', '$result1', '$result2')";




    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('Result added successfully')</script>";
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



// <!-- Edit -->

if (isset($_POST['submitEdit'])) {
    $resultId = $_POST['resultId'];
    $result1 = $_POST['result1Edit'];
    $result2 = $_POST['result2Edit'];

    // Assuming you have a table named "fixtures" with the respective columns

    $sql = "UPDATE `results` SET `team1Score`='$result1',`team2Score`='$result2' WHERE `id` = $resultId";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Results updated successfully')</script>";
        // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
    } else {
        // There was an error inserting the record into the database. You can add any error handling code here.
    }
}


// <!-- Edit -->

if (isset($_POST['submitEditLog'])) {
    $logId = $_POST['logId'];
    $position = $_POST['position'];
    $clubId = $_POST['clubId'];
    $played = $_POST['playedEdit'];
    $wins = $_POST['winsEdit'];
    $draws = $_POST['drawsEdit'];
    $loses = $_POST['losesEdit'];
    $ff = $_POST['ffEdit'];
    $fa = $_POST['faEdit'];
    $fd = $_POST['fdEdit'];
    $points = $_POST['pointsEdit'];

    // Assuming you have a table named "fixtures" with the respective columns

    $sql = "UPDATE `log` SET `position`='$position',`clubId`='$clubId',`played`='$played',`wins`='$wins',`draws`='$draws',`loses`='$loses',`ff`='$ff',`fa`=' $fa',`fd`=' $fd',`points`='$points' WHERE `id` = '$logId'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Results updated successfully')</script>";
        // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
    } else {
        // There was an error inserting the record into the database. You can add any error handling code here.
    }
}
?>



<div class="" style="margin-left: 200px;">
    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs" style="margin-left: 10px;">
        <div class="sectionHeader flex">
            <div class="seasonYear">
                <h6>League Results</h6>
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
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClubModal">Add Result</button>
        <br><br>
        <div class="section fixturesSection container">
            <div class="sectionContainer">
                <div class="sectionContent  grid">
                    <div class="fixtureDiv borderTop">
                        <?php
                        // Execute the first SQL query to get all dates
                        $sql = "SELECT DISTINCT date FROM `fixtures`";
                        $resul = mysqli_query($conn, $sql);

                        while ($dateRow = mysqli_fetch_assoc($resul)) {
                            $selectedDate = $dateRow["date"]; // Store the date from the first query
                        ?>
                            <div class="date">
                                <?php echo date('D-d-M-Y', strtotime($selectedDate)); ?>
                            </div>
                            <div class="row">
                            <?php

                            $sql = "SELECT f.id, c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name, c2.logo AS team2_logo, f.date, f.venue, r1.team1Score AS team1_score, r1.team2Score AS team2_score, r1.id AS rId
                            FROM fixtures f 
                            INNER JOIN clubs c1 ON f.team1id = c1.id 
                            INNER JOIN clubs c2 ON f.team2id = c2.id
                            INNER JOIN results r1 on f.id = r1.fixtureId
                            WHERE f.date = '$selectedDate';";
                            $result = mysqli_query($conn, $sql);

                            $fixtureCount = 0;
                            while ($row = mysqli_fetch_assoc($result)) {

                                if (mysqli_num_rows($result) > 0) {
                            ?>


                                    <?php
                                    

                                    $fixture_id = $row["id"];
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
                                                    <div class="col game-time" style="text-align: center; text-align: center; padding-left: 30px; padding-right: 0px;">
                                                        <div class="mt-4 pt-2" style="background-color: #f3f0f2; height:40px; width:70px; ">
                                                            <?php echo $row["team1_score"]; ?> -
                                                            <?php echo $row["team2_score"]; ?>
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
                                                    <a class="btn btn-primary" style="width: 50%; margin:0 auto;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row["id"] ?>" style="margin-right: 10px;">Edit Result</a>

                                                </div>

                                                <!-- Edit -->
                                                <div class="modal fade" id="editModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addClubModalLabel">Edit Result</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="">
                                                                    <input type="hidden" name="resultId" value="<?php echo $row['rId'] ?>">
                                                                    <div class="mb-3">
                                                                        <!-- Populate the team 1 options dynamically -->
                                                                        <?php
                                                                        // $teamsQuery = "SELECT * FROM fixtures";
                                                                        $teamsQuery = "SELECT f.id, c1.name AS team1_name, c2.name AS team2_name
                                                                    FROM fixtures f 
                                                                    INNER JOIN clubs c1 ON f.team1id = c1.id 
                                                                    INNER JOIN clubs c2 ON f.team2id = c2.id
                                                                    WHERE f.id = $fixture_id"; // Use $fixture_id here

                                                                        $teamsResult = mysqli_query($conn, $teamsQuery);

                                                                        while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                                                            $selected = ""; // Flag to mark the selected option
                                                                            if ($teamRow["id"] == $fixture_id) { // Check if current row ID matches fixture ID
                                                                                $selected = "selected";
                                                                            }

                                                                            echo '<div class="form-control" style = "text-align:center">' . $teamRow["team1_name"] . ' vs ' . $teamRow["team2_name"] . '</div>';
                                                                        }
                                                                        ?>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="mb-3 col">
                                                                            <label for="result1" class="form-label"><?php echo $row['team1_name'] ?> Score </label>
                                                                            <input type="text" class="form-control" id="result1" name="result1Edit" value="<?php echo $row['team1_score'] ?>" required>
                                                                        </div>
                                                                        <div class="mb-3 col">
                                                                            <label for="result2" class="form-label"><?php echo $row['team2_name'] ?> Score </label>
                                                                            <input type="text" class="form-control" id="result2" name="result2Edit" value="<?php echo $row['team2_score'] ?>" required>
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" name="submitEdit" class="btn btn-primary">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <br>
                                                <div class="row">
                                                    <!-- Delete -->
                                                    <a href="" class="btn btn-primary" style="width: 55%; margin:0 auto; background-color:#fe2883;" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row["id"] ?>">Delete Result</a>

                                                    <div class="modal fade" id="deleteModal<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this Fixture Result? This action cannot be undone.</p>
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
                            }
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Table -->
    <section class="section container logSection ">
        <div class="sectionContainer">

            <div class="sectionContent ">
                <div class="table__WeekPlayers grid">
                    <div class="tableDiv">
                        <div class="tableLogoDiv">
                            <h2 style="color: white;">Results Log</h2>
                        </div>
                        <div class="table">
                            <table>
                                <tr>
                                    <th>Pos</th>
                                    <th>Club</th>
                                    <th>P</th>
                                    <th>W</th>
                                    <th>D</th>
                                    <th>L</th>
                                    <th>FF</th>
                                    <th>FA</th>
                                    <th>FD</th>
                                    <th>Pts</th>
                                    <th></th>
                                </tr>

                                <?php

                                $countQuery = "SELECT COUNT(*) AS total_items FROM log;"; // Get item count
                                $countResult = mysqli_query($conn, $countQuery);

                                if ($countResult) {
                                    $rowCount = mysqli_fetch_assoc($countResult)['total_items']; // Get count from result
                                } else {
                                    echo "Error getting item count: " . mysqli_error($conn);
                                    // Handle error gracefully (e.g., display a default message)
                                }

                                $counter = 1;

                                $teamsQuery = "SELECT l.*, c.name AS team_name, c.logo AS team_logo
                                 FROM log l
                                 INNER JOIN clubs c ON l.clubid = c.id
                                 ORDER BY l.points DESC;";

                                $teamsResult = mysqli_query($conn, $teamsQuery);

                                while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                    $played = 0;
                                    $fa = 0;
                                    $ff = 0;
                                    $fd = 0;
                                    $wins = 0;
                                    $draws = 0;
                                    $loses = 0;
                                    $points = 0;

                                ?>



                                    <tr class="tr" style="padding: 1rem 0">

                                        <?php
                                        if ($counter < 3) { ?>

                                            <td class="pos green leader"><?php echo $counter ?></td>
                                        <?php
                                        } else if ($rowCount - 2 <= $counter) {
                                        ?>
                                            <td class="pos red"><?php echo $counter ?></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td class="pos"><?php echo $counter ?></td>
                                        <?php

                                        }
                                        ?>

                                        <?php $counter++ ?>


                                        <td class="flex">
                                            <div class="teamLogoDiv">
                                                <img src="./images/uploads/<?php echo $teamRow["team_logo"]  ?>" alt="Team Logo" class="teamLogo" />
                                            </div>
                                            <div class="name"><?php echo $teamRow["team_name"]  ?></div>
                                        </td>
                                        <td>
                                            <?php

                                            $playedQuery = "SELECT COUNT(*) AS total_matches
                                                        FROM fixtures f
                                                        INNER JOIN results r ON f.id = r.fixtureId
                                                        WHERE f.team1Id = $teamRow[clubId] OR f.team2Id = $teamRow[clubId];";

                                            $playedResult = mysqli_query($conn, $playedQuery);

                                            while ($playedRow = mysqli_fetch_assoc($playedResult)) {

                                                $played = $playedRow['total_matches'];
                                                echo $playedRow['total_matches'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php


                                                $winsQuery = "SELECT COUNT(*) AS total_wins
                                            FROM results r
                                            INNER JOIN fixtures f ON r.fixtureId = f.id
                                            WHERE (f.team1Id = $teamRow[clubId] AND r.team1Score > r.team2Score)
                                            OR (f.team2Id = $teamRow[clubId] AND r.team2Score > r.team1Score);";

                                                $winsResult = mysqli_query($conn, $winsQuery);

                                                while ($winsRow = mysqli_fetch_assoc($winsResult)) {

                                                    $wins = $winsRow['total_wins'];
                                                    echo $winsRow['total_wins'];
                                                }
                                            ?>


                                        </td>
                                        <td>
                                            <?php


                                                $winsQuery = "SELECT COUNT(*) AS total_draws
                                            FROM results r
                                            INNER JOIN fixtures f ON r.fixtureId = f.id
                                            WHERE (f.team1Id = $teamRow[clubId] AND r.team1Score = r.team2Score)
                                            OR (f.team2Id = $teamRow[clubId] AND r.team2Score = r.team1Score);";

                                                $winsResult = mysqli_query($conn, $winsQuery);

                                                while ($winsRow = mysqli_fetch_assoc($winsResult)) {

                                                    $draws = $winsRow['total_draws'];
                                                    echo $winsRow['total_draws'];
                                                }
                                            ?>


                                        </td>
                                        <td>
                                            <?php


                                                $winsQuery = "SELECT COUNT(*) AS total_draws
                                                FROM results r
                                                INNER JOIN fixtures f ON r.fixtureId = f.id
                                                WHERE (f.team1Id = $teamRow[clubId] AND r.team1Score < r.team2Score)
                                                OR (f.team2Id = $teamRow[clubId] AND r.team2Score < r.team1Score);";

                                                $winsResult = mysqli_query($conn, $winsQuery);

                                                while ($losesRow = mysqli_fetch_assoc($winsResult)) {

                                                    $loses = $losesRow['total_draws'];
                                                    echo $losesRow['total_draws'];
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php


                                                $ffQuery = "SELECT SUM(CASE WHEN f.team1Id = $teamRow[clubId] THEN r.team1Score ELSE 0 END) + 
                                                SUM(CASE WHEN f.team2Id = $teamRow[clubId] THEN r.team2Score ELSE 0 END) AS total_team_score
                                                FROM results r
                                                INNER JOIN fixtures f ON r.fixtureId = f.id;";

                                                $ffResult = mysqli_query($conn, $ffQuery);

                                                while ($ffRow = mysqli_fetch_assoc($ffResult)) {
                                                    $ff = $ffRow["total_team_score"];
                                                    echo $ffRow["total_team_score"];
                                                }
                                            ?>

                                        </td>
                                        <td>
                                            <?php


                                                $faQuery = "SELECT SUM(CASE WHEN f.team1Id != $teamRow[clubId] AND f.team2Id = $teamRow[clubId] THEN r.team1Score 
                                                WHEN f.team2Id != $teamRow[clubId] AND f.team1Id = $teamRow[clubId] THEN r.team2Score 
                                                ELSE 0 END) AS total_opposing_score
                                                FROM results r
                                                INNER JOIN fixtures f ON r.fixtureId = f.id;";

                                                $faResult = mysqli_query($conn, $faQuery);

                                                while ($faRow = mysqli_fetch_assoc($faResult)) {
                                                    $fa =  $faRow["total_opposing_score"];
                                                    echo $faRow["total_opposing_score"];
                                                }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                                $fd = $ff - $fa;
                                                echo $fd;
                                            ?>
                                        </td>
                                        <td class="points"><?php $points = ($wins * 3) + $draws;
                                                            echo $points ?></td>

                                        <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $teamRow["id"] ?>">Modify</button></td>

                                        <?php

                                                $sqlQuery = "UPDATE `log` SET `position`='1',`played`='$played',`wins`='$wins',`draws`='$draws',`loses`='$loses',`ff`='$ff',`fa`=' $fa',`fd`=' $fd',`points`='$points' WHERE `clubId` = '$teamRow[clubId]'";

                                                if (mysqli_query($conn, $sqlQuery)) {
                                                    // echo "<script>alert('Results updated successfully')</script>";
                                                    // The record was successfully inserted intothe database. You can add any additional code or logic here, such as displaying a success message or redirecting the user to another page.
                                                } else {
                                                    // There was an error inserting the record into the database. You can add any error handling code here.
                                                }

                                        ?>

                                    </tr>

                                    <!-- Edit Log -->
                                    <div class="modal fade" id="editModal<?php echo $teamRow["id"] ?>" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addClubModalLabel">Edit Result</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="logId" value="<?php echo $teamRow['id'] ?>">
                                                        <input type="hidden" name="position" value="<?php echo $counter ?>">
                                                        <input type="hidden" name="clubId" value="<?php echo $teamRow['clubId'] ?>">
                                                        <div class="mb-3">
                                                            <label for="playedEdit" class="form-label">Played </label>
                                                            <input type="number" class="form-control" id="playedEdit" name="playedEdit" value="<?php echo $teamRow['played'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="winsEdit" class="form-label">Wins </label>
                                                            <input type="number" class="form-control" id="winsEdit" name="winsEdit" value="<?php echo $teamRow['wins'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="drawsEdit" class="form-label">Draws </label>
                                                            <input type="number" class="form-control" id="drawsEdit" name="drawsEdit" value="<?php echo $teamRow['draws'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="losesEdit" class="form-label">Loses </label>
                                                            <input type="number" class="form-control" id="losesEdit" name="losesEdit" value="<?php echo $teamRow['loses'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="ffEdit" class="form-label">FF </label>
                                                            <input type="number" class="form-control" id="ffEdit" name="ffEdit" value="<?php echo $teamRow['ff'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="faEdit" class="form-label">Frames Against </label>
                                                            <input type="number" class="form-control" id="faEdit" name="faEdit" value="<?php echo $teamRow['fa'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fdEdit" class="form-label">FD </label>
                                                            <input type="number" class="form-control" id="fdEdit" name="fdEdit" value="<?php echo $teamRow['fd'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pointsEdit" class="form-label">Points </label>
                                                            <input type="number" class="form-control" id="pointsEdit" name="pointsEdit" value="<?php echo $teamRow['points'] ?>" required>
                                                        </div>



                                                        <button type="submit" name="submitEditLog" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                            <?php
                                            }
                                        }
                            ?>
                            </table>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>




</div>
<div class="modal fade" id="addClubModal" tabindex="-1" aria-labelledby="addClubModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClubModalLabel">Add Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="team1" class="form-label">Select Fixture</label>
                        <select class="form-select" id="team1" name="fixtureId" required>
                            <!-- Populate the team 1 options dynamically -->
                            <option>Select Fixture</option>
                            <?php
                            // $teamsQuery = "SELECT * FROM fixtures";
                            $teamsQuery = "SELECT f.id, c1.name AS team1_name, c2.name AS team2_name
                            FROM fixtures f
                            INNER JOIN clubs c1 ON f.team1id = c1.id
                            INNER JOIN clubs c2 ON f.team2id = c2.id
                            LEFT JOIN results r ON f.id = r.fixtureId
                            WHERE r.fixtureId IS NULL;";


                            $teamsResult = mysqli_query($conn, $teamsQuery);
                            while ($teamRow = mysqli_fetch_assoc($teamsResult)) {
                                echo '<option  value="' . $teamRow["id"] . '">' . $teamRow["team1_name"] . ' vs ' . $teamRow["team2_name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="result1" class="form-label">Team 1 Result</label>
                            <input type="text" class="form-control" id="result1" name="result1" required>
                        </div>
                        <div class="mb-3 col">
                            <label for="result2" class="form-label">Team 2 Result</label>
                            <input type="text" class="form-control" id="result2" name="result2" required>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>