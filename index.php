﻿<?php
include 'header.php';
require_once('databaseConn.php');
?>

<div class="bodyFlex">
    <div class="sideBody">
        <!-- Clubs section =================================== -->
        <div class="clubsSection section" id="clubs">
            <div class="sectionHeader flex">
                <div class="seasonYear">
                    <h6>2022/5</h6>
                </div>
                <div class="seasonYear">
                    <h6>Featured Club</h6>
                </div>
            </div>
            <div class="clubsContainer container">
                <div class="singleClub">
                    <div class="singleClubTop flex">
                        <div class="leftRow flex">
                            <?php
                            $sql = "SELECT c.name AS team_name, c.logo AS team_logo, c.estdate AS estdate, MAX(l.points) AS max_points
                            FROM log l 
                            INNER JOIN clubs c ON l.clubid = c.id
                            GROUP BY c.id
                            ORDER BY max_points DESC
                            LIMIT 1;";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="teamLogoDiv">

                                    <img src="./Admin/images/uploads/<?php echo $row["team_logo"] ?>" alt="Team Logo" class="teamLogo">
                                </div>
                                <div class="clubName">
                                    <span class="name"><?php echo $row["team_name"] ?></span>
                                    <span class="classYear">Established: <?php echo date('Y', strtotime($row["estdate"])) ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="rightRow">
                            <a href="clubs.php"><i class="uil uil-angle-right icon"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Clubs section ends =================================== -->

        <!-- League Logs Section -->
        <section class="section container logSection sectionDesign">
            <div class="sectionContainer">
                <div class="sectionIntro">
                    <h2>Ongoing Season</h2>
                    <span class="sectionSubTitle">Our current league stats</span>
                </div>

                <div class="sectionContent grid">
                    <div class="resultsDiv borderTop">
                        <span class="matchNumber"> Matchweek 1 Results </span>
                        <div class="leagueLogo">
                            <img src="./static/images/logo.png"" alt=" Logo" class="logo">
                        </div>
                        <small>Results from week 1</small>
                        <div class="date">Sunday 21 April</div>
                        <div class="teams flex">
                            <div class="teamName_teamLogo flex">
                                <div class="name">Team 9</div>
                                <div class="teamLogoDiv">
                                    <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                </div>
                            </div>
                            <p class="results">2-0</p>
                            <div class="teamName_teamLogo flex">
                                <div class="teamLogoDiv">
                                    <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                </div>
                                <div class="name">Team 3</div>
                            </div>
                        </div>
                        <span class="venue"><strong>Venue: </strong>Harare</span>
                        <div class="teams flex">
                            <div class="teamName_teamLogo flex">
                                <div class="name">Team 1</div>
                                <div class="teamLogoDiv">
                                    <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                </div>
                            </div>
                            <p class="results">1-4</p>
                            <div class="teamName_teamLogo flex">
                                <div class="teamLogoDiv">
                                    <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                </div>
                                <div class="name">Team 5</div>
                            </div>
                        </div>
                        <span class="venue"><strong>Venue: </strong>Harare</span>

                        <div class="detailsLink">
                            <a href="results.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>

                    <div class="fixtureDiv borderTop">
                        <span class="matchNumber"> Upcoming Fixtures </span>

                       

                        <div class="leagueLogo">
                            <img src="./static/images/logo.png"" alt=" Logo" class="logo">
                        </div>
                        <?php


                        // Execute the first SQL query to get all dates
                        $sql = "SELECT DISTINCT date FROM `fixtures` LIMIT 1";
                        $result = mysqli_query($conn, $sql);

                        while ($dateRow = mysqli_fetch_assoc($result)) {
                            $selectedDate = $dateRow["date"]; // Store the date from the first query

                            // Second SQL query to select items for the current date
                            $sql = "SELECT f.id, c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name, c2.logo AS team2_logo, f.date, f.venue 
       FROM fixtures f 
       INNER JOIN clubs c1 ON f.team1id = c1.id 
       INNER JOIN clubs c2 ON f.team2id = c2.id
       WHERE f.date = '$selectedDate'
       ORDER BY f.date ASC
       LIMIT 1"; // Fetch only the first row

                            $fixtureResult = mysqli_query($conn, $sql);

                            // Check if there are any fixtures for the date before displaying the date
                            if (mysqli_num_rows($fixtureResult) > 0) {
                        ?>

                                <div class="date">
                                    <?php echo date('D-d-M-Y', strtotime($selectedDate)); ?>
                                </div>

                                <div class="teamsflex">
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

                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>

                        <div class="detailsLink">
                            <a href="fixtures.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- League Logs Section end -->

        <!-- Weekly Team Section Starts -->
        <!-- <section class="section container weeklyTeam sectionDesign">
            <div class="sectionIntro">
                <h2 class="title">Executives</h2>
                <span class="subTitle"> They were unstoppable! </span>
            </div>
            <div class="menDiv grid">
                <div class="topScorer borderTop">
                    <span class="matchNumber"> Matchweek 1 </span>
                    <div class="leagueLogo">
                        <img src="./static/images/logo.png"" alt="Logo" class="logo">
                    </div>
                    <small></small>
                    <div class="menTitle">Top Scorer</div>
                    <div class="imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Top Scorer image">
                    </div>
                    <div class="infoDiv">
                        <span class="honor">He's been exeptional over the weekend</span>
                        <span class="topScorerText">
                            Name who plays for Team 1 is the league leading goal scorer
                            with a maximum of 5 goals in 1 game.
                        </span>
                    </div>
                </div>
                <div class="pow borderTop">
                    <span class="matchNumber"> Matchweek 1 </span>
                    <div class="leagueLogo">
                        <img src="./static/images/logo.png"" alt="Logo" class="logo">
                    </div>
                    <small></small>
                    <div class="menTitle">Player of the week</div>
                    <div class="imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Top Scorer image">
                    </div>
                    <div class="infoDiv">
                        <span class="honor">He's been exeptional over the weekend</span>
                        <span class="topScorerText">
                            Name who plays for Team 1 is the league leading goal scorer
                            with a maximum of 5 goals in 1 game.
                        </span>
                    </div>
                </div>
                <div class="tow borderTop">
                    <span class="matchNumber"> Matchweek 1 </span>
                    <div class="leagueLogo">
                        <img src="./static/images/logo.png"" alt="Logo" class="logo">
                    </div>
                    <small></small>
                    <div class="menTitle">Team of the week</div>
                    <div class="imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Top Scorer image">
                    </div>
                    <div class="infoDiv">
                        <span class="honor">They been exeptional in their respective teams</span>
                        <span class="topScorerText">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Veritatis, modi!
                        </span>
                    </div>
                </div>

                <div class="detailsLink">
                    <a href="results.php">
                        <span>View More <i class="uil uil-arrow-right icon"></i></span>
                    </a>
                </div>
            </div>
        </section> -->
        <!-- Weekly Team section ends here -->

        <!-- Social Platform Section ========================== -->
        <section class="section container twitterSection">
            <div class="sectionIntro borderTop ">
                <h2>Social Account</h2>
                <span class="sectionSubTitle">Follow us on Facebook</span>
            </div>
            <div class="sectionHeader">
                <span class="newsTitle">Recent Posts <i class="uil uil-facebook icon"></i></span>
            </div>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D100054418333702&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=974562837372460" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </section>
        <!-- Social Platform Section ends ========================== -->

        <!-- News section =================================== -->
        <section class="section newsSection container">
            <div class="sectionHeader">
                <span class="newsTitle">Club News</span>
            </div>
            <div class="newContent grid">


                <?php
                $sql = "SELECT * FROM news";
                $result = mysqli_query($conn, $sql);

                $fixtureCount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="singlePost flex">
                        <div class="postImg">
                            <img src="./static/images/news/<?php echo $row['coverImage'] ?>" alt="Cover Image" class="">
                        </div>
                        <div class="newsTxt">
                            <a href="news.php">
                                <span style="position: absolute; right:13%;"><?php echo date('D-d-M-Y', strtotime($row["date"])) ?> </span>
                                <span class="title"><?php echo $row['title']  ?></span>

                            </a>
                            <p> <?php echo $row['feed']  ?></p>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>
        <!-- News section ends =================================== -->
    </div>

    <div class="mainBody">
        <!-- banner section -->
        <div class="bannerSection" style="background:url(./static/images/pooltable2.webp);background-repeat: no-repeat;">
            <h1 class="title">Nevsun Premier Pool League</h1>
            <!-- <span class="subTitle">We exist for a reason!</span> -->
            <div class="button">
                <a href="about.php">About Us</a>
            </div>

            <!-- <div class="advert" id="advert">
                <div class="advertContainer grid">
                    <div class="advertImgDiv">
                        <img src="./assets/1.png" alt="Image" style="width: 100px;">
                    </div>
                    <!-- <div class="advertText">
                        <h2>SPECIAL NOTE</h2>
                        <span>This project is still under development and any copy is not final. <br> Contact developer for more information.</span>
                        <div class="countdown">

                            00 <span>/ Days</span> :
                            00 <span>/ Hours</span> :
                            00 <span>/ Minutes</span> :
                            00 <span>/ Seconds</span>
                        </div>
                        <span class="moreBtn"><a href="mailto:abagraphicx@gmail.com" style="color: white;">Contact Developer</a></span>
                    </div> -->
            <!-- <div class="closeIconDiv" id="closeAdvertIconDiv">
                        <i class="uil uil-times-circle icon"></i>
                    </div> -->
            <!-- </div>
            </div> -->
        </div>
        <!-- banner ends -->

        <!-- About Us Section  -->
        <section class="section container aboutSection">
            <div class="sectionContainer grid">
                <div class="textDiv">
                    <h2>Drugs and Doping!</h2>
                    <p>
                        The Nevsun Premier Pool League is committed to maintaining a doping-free environment for all our
                        players. We believe in fair play and achieving success through hard work and dedication. <br> <br>

                        Performance-enhancing drugs have no place in our sport. Doping is cheating and can have
                        serious health consequences. <br>

                    </p>

                    <div class="button">
                        <a href="about.php">Read More <i class="uil uil-angle-right-b icon"></i></a>
                    </div>
                </div>
                <div class="aboutSectionImageDiv">
                    <img src="./static/images/drugsanddoping.jpg" style="width: 550px;" alt="">
                </div>
            </div>
        </section>
        <!-- About section end -->

        <!-- League Logs Section -->
        <section class="section container logSection sectionDesign">
            <div class="sectionContainer">
                <div class="sectionIntro">
                    <h2>Ongoing Season</h2>
                    <span class="sectionSubTitle">Our current league stats</span>
                </div>

                <div class="sectionContent grid">
                    <div class="fixtureDiv borderTop">
                        <span class="matchNumber"> Upcoming Fixtures </span>
                        <div class="leagueLogo">
                            <img src="./static/images/logo.png" alt="Logo" class="logo">
                        </div>
                        <?php


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

                        // Execute the first SQL query to get all dates
                        $sql = "SELECT DISTINCT date FROM `fixtures` LIMIT 1";
                        $result = mysqli_query($conn, $sql);

                        while ($dateRow = mysqli_fetch_assoc($result)) {
                            $selectedDate = $dateRow["date"]; // Store the date from the first query

                            // Second SQL query to select items for the current date
                            $sql = "SELECT f.id, c1.name AS team1_name, c1.logo AS team1_logo, c2.name AS team2_name, c2.logo AS team2_logo, f.date, f.venue 
       FROM fixtures f 
       INNER JOIN clubs c1 ON f.team1id = c1.id 
       INNER JOIN clubs c2 ON f.team2id = c2.id
       WHERE f.date = '$selectedDate'
       ORDER BY f.date ASC
       LIMIT 1"; // Fetch only the first row

                            $fixtureResult = mysqli_query($conn, $sql);

                            // Check if there are any fixtures for the date before displaying the date
                            if (mysqli_num_rows($fixtureResult) > 0) {
                        ?>

                                <div class="date">
                                    <?php echo date('D-d-M-Y', strtotime($selectedDate)); ?>
                                </div>

                                <div class="teamsflex">
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

                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>


                        <div class="detailsLink">
                            <a href="fixtures.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="resultsDiv borderTop">
                        <span class="matchNumber"> Past Results </span>
                        <div class="leagueLogo">
                            <img src="./static/images/logo.png" alt="Logo" class="logo">
                        </div>
                        
                        <?php
                // Execute the first SQL query to get all dates
                $sql = "SELECT DISTINCT date FROM `fixtures` LIMIT 1";
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
                  if (mysqli_num_rows($fixtureResult) == 0) {
                    echo "No Results to display";
                  }

                  elseif (mysqli_num_rows($fixtureResult) > 0) {
                ?>

                    <div class="date">
                      <?php echo date('D-d-M-Y', strtotime($selectedDate)); ?>
                    </div>

                    <div class="teamsflex">
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

                        <div class="detailsLink">
                            <a href="results.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>
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
                                                -- ORDER BY l.points DESC
                                                ORDER BY l.points DESC, l.fd DESC
                                                LIMIT 4;"; // Use $fixture_id here

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

                            <div class="detailsLink">
                                <a href="results.php">
                                    <span>View Full Table <i class="uil uil-arrow-right icon"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- League Logs Section end -->

        <!-- Weekly Team Section end -->
        <section class="section container weeklyTeam sectionDesign">
            <div class="sectionIntro">
                <h2 class="title">Executives</h2>
                <span class="subTitle"> Our Board of Directors! </span>
            </div>
            <div class="menDiv grid">
                <?php
                $sql = "SELECT * FROM executives";
                $result = mysqli_query($conn, $sql);

                $fixtureCount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="topScorer borderTop">
                        <div class="imgDiv">
                            <img src="./Admin/images/executives/<?php echo $row["image"] ?>" alt=" Logo">
                        </div>
                        <div class="infoDiv">
                            <span class="honor" style="width: 100%;"><?php echo $row["name"] ?></span>
                            <span class="topScorerText">
                                Secretary General
                            </span>
                        </div>
                    </div>
                <?php } ?>


                <!-- <div class="detailsLink">
                    <a href="results.php">
                        <span>View More <i class="uil uil-arrow-right icon"></i></span>
                    </a>
                </div> -->
            </div>
        </section>
        <!-- Weekly Team section ends here -->

        <!-- Middle banner section -->
        <section class="section container middleBanner grid">
            <div class="sectionText">
                <h1>Advertise With Us</h1>
                <div class="button">
                    <a href="about.php">Find Out</a>
                </div>
            </div>
        </section>
        <!-- Middle banner section ends -->

        <!-- league  sponsors section =============================-->
        <div class="sponsors container">
            <div class="sponsorsContainer swiper">
                <div class="swiper-wrapper">
                    <div class="sponsor swiper-slide">
                        <img src="./static/images/hppa.png" alt="sponsor logo" class="swiperImg" style="width: 70px; margin: auto">
                    </div>
                    <div class="sponsor swiper-slide">
                        <img src="./static/images/hppa.png" alt="sponsor logo" class="swiperImg" style="width: 70px; margin: 1rem auto 0">
                    </div>
                    <div class="sponsor swiper-slide">
                        <img src="./static/images/hppa.png" alt="sponsor logo" class="swiperImg" style="width: 70px; margin: auto">

                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- league  sponsors section ends =============================-->

        <!-- News section =================================== -->
        <!-- <section class="section newsSection container">
            <div class="sectionHeader">
                <span class="newsTitle">Latest News</span>
            </div>
            <div class="newContent grid">
                <div class="singlePost flex">
                    <div class="postImg">

                        <img src="uploads/PERSON.jpg" alt="Team Logo" class="">
                    </div>
                    <div class="newsTxt">
                        <a href="news.php">
                            <span class="title">
                                Article Title 1 </span>
                        </a>
                        <p> It is a long established fact that a reader will be distracted by the readable content
                            of a page when looking at its layout. The point of using Lorem I</p>
                    </div>
                </div>
                <div class="singlePost flex">
                    <div class="postImg">

                        <img src="uploads/PERSON.jpg" alt="Team Logo" class="">
                    </div>
                    <div class="newsTxt">
                        <a href="news.php">
                            <span class="title">
                                Article Title 2 </span>
                        </a>
                        <p> There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't
                            look even slightly believable. If you are going to use a passage of Lorem Ipsum, yo</p>
                    </div>
                </div>
                <div class="singlePost flex">
                    <div class="postImg">

                        <img src="uploads/PERSON.jpg" alt="Team Logo" class="">
                    </div>
                    <div class="newsTxt">
                        <a href="news.php">
                            <span class="title">
                                Article Title 3 </span>
                        </a>
                        <p> There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't
                            look even slightly believable. If you are going to use a passage of Lorem Ipsum, yo</p>
                    </div>
                </div>
                <div class="singlePost flex">
                    <div class="postImg">

                        <img src="uploads/PERSON.jpg" alt="Team Logo" class="">
                    </div>
                    <div class="newsTxt">
                        <a href="news.php">
                            <span class="title">
                                Article Title 4 </span>
                        </a>
                        <p> It is a long established fact that a reader will be distracted by the readable content
                            of a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                            more-or-less normal distribution of letters, as opposed </p>
                    </div>
                </div>

            </div>
        </section> -->
        <!-- News section ends =================================== -->

        <!-- gallery section  starts-->
        <section class="section container gallerySection sectionDesign">
            <div class="sectionIntro">
                <h2>Photo Galleries</h2>
                <span class="sectionSubTitle">Photos from the weekend action.</span>
            </div>
            <div class="sectionHeader">
                <span class="newsTitle">Best Images</span>
            </div>
            <div class="galleryContainer grid">
                <div class="mainImage">
                    <div class="imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Action Image">
                        <div class="iconDiv flex">
                            <i class="uil uil-camera icon"></i>
                            <span>11</span>
                        </div>
                    </div>
                    <div class="infoDiv">
                        <span class="honor">What we learned from the weekend clash</span>
                        <span class="imgDesc">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro
                            magnam illum quia rerum officia assumenda ab voluptatem.
                        </span>
                    </div>
                </div>
                <div class="smallImages grid">
                    <div class="small_imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Action Image">
                        <div class="iconDiv flex">
                            <i class="uil uil-camera icon"></i>
                            <span>9</span>
                        </div>
                    </div>
                    <div class="small_imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Action Image">
                        <div class="iconDiv flex">
                            <i class="uil uil-camera icon"></i>
                            <span>11</span>
                        </div>
                    </div>
                    <div class="small_imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Action Image">
                        <div class="iconDiv flex">
                            <i class="uil uil-camera icon"></i>
                            <span>17</span>
                        </div>
                    </div>
                    <div class="small_imgDiv">
                        <img src="uploads/PERSON.jpg" alt="Action Image">
                        <div class="iconDiv flex">
                            <i class="uil uil-camera icon"></i>
                            <span>21</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- gallery section ends here  -->

        <!-- funZone Section css ========================== -->
        <!-- <section class="section container funZone sectionDesign">
      <div class="sectionIntro">
        <h2>Fun Zone</h2>
        <span class="sectionSubTitle">We love to hear from you</span>
      </div>
      <div class="sectionHeader">
        <span class="newsTitle"
          >Recent Comments <i class="uil uil-comment-alt-dots icon"></i
        ></span>
      </div>
      <div class="sectionContent">
        <div class="comments swiper">
          <div class="swiper-wrapper">
            <div class="slideComment swiper-slide">
              <div class="singleComment">
                <div class="topDiv flex">
                  <div class="commentImg">
                    <img src="./assets/bahrain/emptyImage.jpg" alt="Person Image" />
                  </div>
                  <div class="commentorName">
                    <span>@obaar</span>
                  </div>
                  <div class="iconDiv">
                    <i class="uil uil-comments icon"></i>
                  </div>
                </div>
                <div class="commentTxt">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Nam, ratione!
                  </p>
                </div>
              </div>
            </div>
            <div class="slideComment swiper-slide">
              <div class="singleComment">
                <div class="topDiv flex">
                  <div class="commentImg">
                    <img src="./assets/bahrain/teamImage3.png" alt="Person Image" />
                  </div>
                  <div class="commentorName">
                    <span>@benja</span>
                  </div>
                  <div class="iconDiv">
                    <i class="uil uil-comments icon"></i>
                  </div>
                </div>
                <div class="commentTxt">
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Debitis, cupiditate.
                  </p>
                </div>
              </div>
            </div>
            <div class="slideComment swiper-slide">
              <div class="singleComment">
                <div class="topDiv flex">
                  <div class="commentImg">
                    <img src="./assets/bahrain/emptyImage.jpg" alt="Person Image" />
                  </div>
                  <div class="commentorName">
                    <span>@Linda</span>
                  </div>
                  <div class="iconDiv">
                    <i class="uil uil-comments icon"></i>
                  </div>
                </div>
                <div class="commentTxt">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Nam, ratione!
                  </p>
                </div>
              </div>
            </div>
            <div class="slideComment swiper-slide">
              <div class="singleComment">
                <div class="topDiv flex">
                  <div class="commentImg">
                    <img src="./assets/bahrain/emptyImage.jpg" alt="Person Image" />
                  </div>
                  <div class="commentorName">
                    <span>@emma</span>
                  </div>
                  <div class="iconDiv">
                    <i class="uil uil-comments icon"></i>
                  </div>
                </div>
                <div class="commentTxt">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Nam, ratione!
                  </p>
                </div>
              </div>
            </div>
            <div class="slideComment swiper-slide">
              <div class="singleComment">
                <div class="topDiv flex">
                  <div class="commentImg">
                      <img src="./assets/bahrain/emptyImage.jpg" alt="Person Image" />
                  </div>
                  <div class="commentorName">
                    <span>@mishare</span>
                  </div>
                  <div class="iconDiv">
                    <i class="uil uil-comments icon"></i>
                  </div>
                </div>
                <div class="commentTxt">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Nam, ratione!
                  </p>
                </div>
              </div>
            </div>
            <div class="slideComment swiper-slide">
              <div class="singleComment">
                <div class="topDiv flex">
                  <div class="commentImg">
                    <img src="./assets/bahrain/emptyImage.jpg" alt="Person Image" />
                  </div>
                  <div class="commentorName">
                    <span>@podo</span>
                  </div>
                  <div class="iconDiv">
                    <i class="uil uil-comments icon"></i>
                  </div>
                </div>
                <div class="commentTxt">
                  <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Nam, ratione!
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="newComment">
          <div class="sectionHeader">
            <span class="newsTitle">Add Comments</span>
          </div>
          <div class="formContainer">
            <div class="formBanner">
              <span class="bannerText">
                <p>The Crane</p>
                <h2>funZone.</h2>
                <i class="uil uil-comment-dots icon"></i>
              </span>
            </div>
            <div class="form">
              <div class="row">
                <label for="name">User Name</label>
                <input
                  type="text"
                  id="name"
                  placeholder="E.g; obaar"
                  required
                />
              </div>
              <div class="row">
                <label class="image" for="image"
                  >Your Image <i class="uil uil-camera-plus icon"></i>
                </label>
                <input
                  type="file"
                  id="image"
                  placeholder="E.g; obaar"
                  required
                />
              </div>
              <div class="row">
                <label for="desc">Your Comment</label>
                <textarea
                  name=""
                  id="desc"
                  style="width: 100%; height: 100px"
                  maxlength="100"
                  required
                ></textarea>
              </div>
              <div class="row">
                <input type="submit" value="Submit" class="submitBtn" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
        <!-- funZone Section ends ========================== -->

        <!-- Social Platform Section ========================== -->
        <!-- <section class="section container twitterSection sectionDesign">
            <div class="sectionIntro">
                <h2>Social Account</h2>
                <span class="sectionSubTitle">Follow us on twitter</span>
            </div>
            <div class="sectionHeader">
                <span class="newsTitle">Recent Tweets <i class="uil uil-twitter icon"></i></span>
            </div>
            <div class="pageDiv">

                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D100054418333702&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=974562837372460" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
        </section> -->
        <!-- Social Platform Section ends ========================== -->

        <!-- swiper.js link -->
        <script src="swiper-bundle.min.js"></script>
        <!-- link javascript -->
        <script src="main.js"></script>
    </div>
</div>

<!-- footer section starts here =============================================================-->
<?php
include 'footer.php';
?>

<!-- footer section ends here =============================================================-->

<!-- swiper.js link -->
<script src="swiper-bundle.min.js"></script>
<!-- link javascript -->
<script src="main.js"></script>


</body>

</html>