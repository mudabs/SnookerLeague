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
          <div class="sectionIntro borderBottom">
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
                              <p class="time">5-0</p>
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
            <div class="table__WeekPlayers grid">
              <div class="tableDiv">
                <div class="tableLogoDiv">
                  <h2 style="color: white;">Results Log</h2>
                </div>
                <!--<div class="table">-->
                <!--  <table>-->
                <!--    <tr>-->
                <!--      <th>Pos</th>-->
                <!--      <th>Club</th>-->
                <!--      <th>Pl</th>-->
                <!--      <th>GD</th>-->
                <!--      <th>Pts</th>-->
                <!--    </tr>-->
                <!--    <tr class="tr" style="padding: 1rem 0">-->
                <!--      <td class="pos green leader">1</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (1).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 1</div>-->
                <!--      </td>-->
                <!--      <td>1</td>-->
                <!--      <td>+5</td>-->
                <!--      <td class="points">3</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos green">2</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (2).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 2</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos">3</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (3).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 3</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos">4</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (4).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 4</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos">5</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (5).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 5</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos">6</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (6).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 6</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos">7</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (7).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 7</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos">8</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (8).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 8</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos red">9</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (9).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 9</div>-->
                <!--      </td>-->
                <!--      <td>0</td>-->
                <!--      <td>0</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--    <tr class="tr">-->
                <!--      <td class="pos red">10</td>-->
                <!--      <td class="flex">-->
                <!--        <div class="teamLogoDiv">-->
                <!--          <img-->
                <!--            src="./assets/logos/team (10).png"-->
                <!--            alt="Team Logo"-->
                <!--            class="teamLogo"-->
                <!--          />-->
                <!--        </div>-->
                <!--        <div class="name">Team 10</div>-->
                <!--      </td>-->
                <!--      <td>1</td>-->
                <!--      <td>-5</td>-->
                <!--      <td class="points">0</td>-->
                <!--    </tr>-->
                <!--  </table>-->
                <!--</div>-->
                <div class="table">
                  <table>
                    <tr>
                      <th>Pos</th>
                      <th>Club</th>
                      <th>PL</th>
                      <th>W</th>
                      <th>L</th>
                      <th>D</th>
                      <th>GF</th>
                      <th>GA</th>
                      <th>GD</th>
                      <th>Pts</th>
                    </tr>


                    <tr class="tr" style="padding: 1rem 0">
                      <td class="pos green leader">1</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (1).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 1</div>
                      </td>
                      <td>1</td>
                      <td>1</td>
                      <td>0</td>
                      <td>0</td>
                      <td>5</td>
                      <td>0</td>
                      <td>+5</td>
                      <td class="points">3</td>
                    </tr>
                    <tr class="tr" style="padding: 1rem 0">
                      <td class="pos green leader">2</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (4).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 2</div>
                      </td>
                      <td>1</td>
                      <td>0</td>
                      <td>1</td>
                      <td>0</td>
                      <td>0</td>
                      <td>5</td>
                      <td>-5</td>
                      <td class="points">0</td>

                    <tr class="tr">
                      <td class="pos">3</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (3).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 3</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos">4</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (4).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 4</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos">5</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (5).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 5</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos">6</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (6).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 6</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos">7</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (7).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 7</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos">8</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (8).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 8</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos red">9</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (9).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 9</div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td class="points">0</td>
                    </tr>
                    <tr class="tr">
                      <td class="pos red">10</td>
                      <td class="flex">
                        <div class="teamLogoDiv">
                          <img src="../assets/logos/team (10).png" alt="Team Logo" class="teamLogo" />
                        </div>
                        <div class="name">Team 10</div>
                      </td>
                      <td>1</td>
                      <td>-5</td>
                      <td>-5</td>
                      <td>-5</td>
                      <td>-5</td>
                      <td>-5</td>
                      <td>-5</td>
                      <td class="points">0</td>
                    </tr>
                  </table>
                </div>
              </div>

            </div>
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