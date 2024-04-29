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

                    // Second SQL query to select items for the current date
                    $sql = "SELECT f.id, c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name, c2.logo AS team2_logo, f.date, f.venue 
                    FROM fixtures f 
                    INNER JOIN clubs c1 ON f.team1id = c1.id 
                    INNER JOIN clubs c2 ON f.team2id = c2.id
                    WHERE f.date = '$selectedDate'"; // Filter by the selected date
                    $fixtureResult = mysqli_query($conn, $sql);

                    // Check if there are any fixtures for the date before displaying the date
                    if (mysqli_num_rows($fixtureResult) > 0) {
                ?>

                        <div class="date">
                            <?php echo date('D-d-M-Y', strtotime($selectedDate)); ?>
                        </div>

                        <div class="allFixtures">
                            <?php
                            while ($row = mysqli_fetch_assoc($fixtureResult)) {

                                // Retrieve team logos
                                $team1_logo = getTeamLogo($row["team1_logo"]);
                                $team2_logo = getTeamLogo($row["team2_logo"]);



                            ?>
                                <div class="singleFixture">
                                    <div class="teams flex">
                                        <div class="teamName_teamLogo flex">
                                            <div class="name"><?php echo $row["team1_name"]; ?></div>
                                            <div class="teamLogoDiv">

                                                <img src="<?php echo $team1_logo; ?>" alt="Team Logo" class="teamLogo" />
                                            </div>
                                        </div>
                                        <p class="time"><?php echo date('H-m', strtotime($row["date"])); ?></p>
                                        <div class="teamName_teamLogo flex">
                                            <div class="teamLogoDiv">

                                                <img src="<?php echo $team2_logo; ?>" alt="Team Logo" class="teamLogo" />
                                            </div>
                                            <div class="name"><?php echo $row["team2_name"]; ?></div>
                                        </div>
                                    </div>
                                    <span class="venue"><strong>Venue: </strong><?php echo $row["venue"]; ?></span>
                                </div>
                            <?php } ?>

                        </div>

                        <!-- <small>*All time subjected to change.</small> -->
                    <?php
                    }
                    ?>
                    <?php
                    }
                    ?>
            </div>
        </div>

    </div>
</div>