<?php
include 'header.php';
require_once('databaseConn.php');


function getTeamLogo($logoFileName)
{
  // Assuming the team logos are stored in the "images/logos/" directory
  $logoPath = "./Admin/images/uploads/" . $logoFileName;

  // Check if the logo file exists
  if (file_exists($logoPath)) {
    return $logoPath;
  } else {
    // If the logo file doesn't exist, you can provide a default logo or handle the situation as per your requirements
    return "./Admin/images/default_logo.png";
  }
}
?>

<body>

  <div class="bodyFlex">

    <div class="mainBody">
      <!-- Banner section ============================ -->
      <div class="aboutBanner">

        <div class="aboutButton flex">Latest
          <a href="#results" class="aboutBtnActive">
            <i class="uil uil-comment-check icon"></i>Results</a>
        </div>
      </div>
      <!-- Banner section ends============================ -->

      <div class="bodyFlex">


        <div class="mainBody">

        </div>
      </div>


      <!-- Results Section ================================ -->
      <div class="section container resultsSection" id="results">
        <div class="sectionContainer">
          <div class="sectionIntro ">
            <h2>Ongoing Season</h2>
            <span class="sectionSubTitle">Our current league stats</span>
          </div>

          <div class="sectionContent grid">
            <!-- Results div ============== -->
            <div class="sectionContainer">
              <div class="fixtureDiv borderTop">


                <?php
                // Execute the first SQL query to get all dates
                $sql = "SELECT DISTINCT date FROM `fixtures`";
                $result = mysqli_query($conn, $sql);

                while ($dateRow = mysqli_fetch_assoc($result)) {
                  $selectedDate = $dateRow["date"]; // Store the date from the first query

                  // Second SQL query to select items for the current date
                  $sql = "SELECT f.id, c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name, c2.logo AS team2_logo, f.date, f.venue, r1.team1Score AS team1_score, r1.team2Score AS team2_score, r1.id AS rId
                        FROM fixtures f 
                        INNER JOIN clubs c1 ON f.team1id = c1.id 
                        INNER JOIN clubs c2 ON f.team2id = c2.id
                        INNER JOIN results r1 on f.id = r1.fixtureId
                        WHERE f.date = '$selectedDate';"; // Filter by the selected date
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
                            <p class="time"><?php echo $row["team1_score"]; ?> -
                              <?php echo $row["team2_score"]; ?></p>
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

            <!-- Table and team of the week ==================== -->
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
                                 ORDER BY l.points DESC , l.fd DESC;";

                          $teamsResult = mysqli_query($conn, $teamsQuery);

                          while ($teamRow = mysqli_fetch_assoc($teamsResult)) {

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
                                  <img src="./Admin/images/uploads/<?php echo $teamRow["team_logo"]  ?>" alt="Team Logo" class="teamLogo" />
                                </div>
                                <div class="name"><?php echo $teamRow["team_name"]  ?></div>
                              </td>
                              <td><?php echo $teamRow["played"]  ?></td>
                              <td><?php echo $teamRow["wins"]  ?></td>
                              <td><?php echo $teamRow["draws"]  ?></td>
                              <td><?php echo $teamRow["loses"]  ?></td>
                              <td><?php echo $teamRow["ff"]  ?></td>
                              <td><?php echo $teamRow["fa"]  ?></td>
                              <td><?php echo $teamRow["fd"]  ?></td>
                              <td class="points"><?php echo $teamRow["points"]  ?></td>
                            </tr>






                          <?php
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


        </div>
      </div>
      <!-- Results Section ends================================ -->

    </div>
  </div>

  <!-- footer section starts here =============================================================-->

  <?php
  include 'footer.php';
  ?>

  <!-- footer section ends here =============================================================-->

  <!-- swiper.js link -->
  <script src="./swiper-bundle.min.js"></script>
  <!-- link javascript -->
  <script src="./main.js"></script>
</body>

</html>