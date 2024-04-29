<?php
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
                            <div class="teamLogoDiv">

                                <img src="uploads/smlateam%20%282%29.png" alt="Team Logo" class="teamLogo">
                            </div>
                            <div class="clubName">
                                <span class="name">HIT</span>
                                <span class="classYear">Established: 2016</span>
                            </div>
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
                        <span class="matchNumber"> Matchweek 2 Fixtures </span>

                        <div class="leagueLogo">
                            <img src="./static/images/logo.png"" alt=" Logo" class="logo">
                        </div>
                        <small>All times shown are local</small>
                        <div class="date">Thursday 28 April</div>
                        <div class="singleFixture">
                            <div class="teams flex">
                                <div class="teamName_teamLogo flex">
                                    <div class="name">Hyundai FC</div>
                                    <div class="teamLogoDiv">

                                        <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                    </div>
                                </div>
                                <p class="time">13:17</p>
                                <div class="teamName_teamLogo flex">
                                    <div class="teamLogoDiv">

                                        <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                    </div>
                                    <div class="name">Victory FC</div>
                                </div>
                            </div>
                            <span class="venue"><strong>Venue: </strong>Harare</span>

                        </div>
                        <div class="singleFixture">
                            <div class="teams flex">
                                <div class="teamName_teamLogo flex">
                                    <div class="name">Ellusion 73</div>
                                    <div class="teamLogoDiv">

                                        <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                    </div>
                                </div>
                                <p class="time">21:15</p>
                                <div class="teamName_teamLogo flex">
                                    <div class="teamLogoDiv">

                                        <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                    </div>
                                    <div class="name">UZ Vikings</div>
                                </div>
                            </div>
                            <span class="venue"><strong>Venue: </strong>Harare</span>

                        </div>

                        <!-- <div class="singleFixture">
              <div class="teams flex">
                <div class="teamName_teamLogo flex">
                  <div class="name">Team 1</div>
                  <div class="teamLogoDiv">
                    <img
                      src="./assets/logos/team (1).png"
                      alt="Team Logo"
                      class="teamLogo"
                    />
                  </div>
                </div>
                <p class="time">11:15</p>
                <div class="teamName_teamLogo flex">
                  <div class="teamLogoDiv">
                    <img
                      src="./assets/logos/team (4).png"
                      alt="Team Logo"
                      class="teamLogo"
                    />
                  </div>
                  <div class="name">Team 4</div>
                </div>
              </div>
              <span class="venue"><strong>Venue: </strong>Pitch One</span>
            </div>
            <div class="singleFixture">
              <div class="teams flex">
                <div class="teamName_teamLogo flex">
                  <div class="name">Team 7</div>
                  <div class="teamLogoDiv">
                    <img
                      src="./assets/logos/team (7).png"
                      alt="Team Logo"
                      class="teamLogo"
                    />
                  </div>
                </div>
                <p class="time">11:15</p>
                <div class="teamName_teamLogo flex">
                  <div class="teamLogoDiv">
                    <img
                      src="./assets/logos/team (2).png"
                      alt="Team Logo"
                      class="teamLogo"
                    />
                  </div>
                  <div class="name">Team 2</div>
                </div>
              </div>
              <span class="venue"><strong>Venue: </strong>Pitch One</span>
            </div> -->

                        <div class="detailsLink">
                            <a href="fixtures.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>

                    <div class="tableDiv">
                        <div class="tableLogoDiv">
                            <img src="./static/images/logo.png"" alt=" Logo" class="logo">
                        </div>
                        <div class="table">
                            <table>
                                <tr>
                                    <th>Pos</th>
                                    <th>Club</th>
                                    <th>Pl</th>
                                    <th>GD</th>
                                    <th>Pts</th>
                                </tr>
                                <tr class="tr" style="padding: 1rem 0">
                                    <td class="pos green leader">1</td>
                                    <td class="flex">
                                        <div class="teamLogoDiv">
                                            <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                        </div>
                                        <div class="name">Team 1</div>
                                    </td>
                                    <td>1</td>
                                    <td>+5</td>
                                    <td class="points">3</td>
                                </tr>
                                <tr class="tr">
                                    <td class="pos green">2</td>
                                    <td class="flex">
                                        <div class="teamLogoDiv">
                                            <img src="assets/logos/team%20%282%29.png" alt="Team Logo" class="teamLogo">
                                        </div>
                                        <div class="name">Team 2</div>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="points">0</td>
                                </tr>
                                <tr class="tr">
                                    <td class="pos">3</td>
                                    <td class="flex">
                                        <div class="teamLogoDiv">
                                            <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                        </div>
                                        <div class="name">Team 3</div>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="points">0</td>
                                </tr>
                                <tr class="tr">
                                    <td class="pos">4</td>
                                    <td class="flex">
                                        <div class="teamLogoDiv">
                                            <img src="assets/logos/team%20%284%29.png" alt="Team Logo" class="teamLogo">
                                        </div>
                                        <div class="name">Team 4</div>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="points">0</td>
                                </tr>
                                <!-- <tr class="tr">
                                            <td class="pos">5</td>
                                            <td class="flex">
                                                <div class="name">Team 5</div>
                                                <div class="teamLogoDiv">
                                                    <img src="./assets/logos/team (5).png" alt="Team Logo" class="teamLogo">
                                                </div>
                                            </td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="points">0</td>
                                        </tr>
                                        <tr class="tr">
                                            <td class="pos">6</td>
                                            <td class="flex">
                                                <div class="name">Team 6</div>
                                                <div class="teamLogoDiv">
                                                    <img src="./assets/logos/team (6).png" alt="Team Logo" class="teamLogo">
                                                </div>
                                            </td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="points">0</td>
                                        </tr>
                                        <tr class="tr">
                                            <td class="pos">7</td>
                                            <td class="flex">
                                                <div class="name">Team 7</div>
                                                <div class="teamLogoDiv">
                                                    <img src="./assets/logos/team (7).png" alt="Team Logo" class="teamLogo">
                                                </div>
                                            </td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="points">0</td>
                                        </tr>
                                        <tr class="tr">
                                            <td class="pos">8</td>
                                            <td class="flex">
                                                <div class="name">Team 8</div>
                                                <div class="teamLogoDiv">
                                                    <img src="./assets/logos/team (8).png" alt="Team Logo" class="teamLogo">
                                                </div>
                                            </td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="points">0</td>
                                        </tr>
                                        <tr class="tr">
                                            <td class="pos red">9</td>
                                            <td class="flex">
                                                <div class="name">Team 9</div>
                                                <div class="teamLogoDiv">
                                                    <img src="./assets/logos/team (9).png" alt="Team Logo" class="teamLogo">
                                                </div>
                                            </td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="points">0</td>
                                        </tr>
                                        <tr class="tr">
                                            <td class="pos red">10</td>
                                            <td class="flex">
                                                <div class="name">Team 10</div>
                                                <div class="teamLogoDiv">
                                                    <img src="./assets/logos/team (10).png" alt="Team Logo" class="teamLogo">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>-5</td>
                                            <td class="points">0</td>
                                        </tr> -->
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
                        <span class="matchNumber"> Matchweek 2 </span>
                        <div class="leagueLogo">
                            <img src="./static/images/logo.png" alt="Logo" class="logo">
                        </div>
                        <small>All times shown are local</small>
                        <div class="date">Thursday 28 April</div>
                        <div class="singleFixture">
                            <div class="teams flex">
                                <div class="teamName_teamLogo flex">
                                    <div class="name">Ellusion 73</div>
                                    <div class="teamLogoDiv">

                                        <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                    </div>
                                </div>
                                <p class="time">21:15</p>
                                <div class="teamName_teamLogo flex">
                                    <div class="teamLogoDiv">

                                        <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                    </div>
                                    <div class="name">Uplands</div>
                                </div>
                            </div>
                            <span class="venue"><strong>Venue: </strong>Harare</span>

                        </div>


                        <div class="detailsLink">
                            <a href="fixtures.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="resultsDiv borderTop">
                        <span class="matchNumber"> Matchweek 1 Results </span>
                        <div class="leagueLogo">
                            <img src="./static/images/logo.png" alt="Logo" class="logo">
                        </div>
                        <small>Results from week 1</small>
                        <div class="date">Sunday 21 April</div>
                        <div class="teams flex">
                            <div class="teamName_teamLogo flex">
                                <div class="name">Team 3</div>
                                <div class="teamLogoDiv">
                                    <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                </div>
                            </div>
                            <p class="results">2-0</p>
                            <div class="teamName_teamLogo flex">
                                <div class="teamLogoDiv">
                                    <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
                                </div>
                                <div class="name">Team 4</div>
                            </div>
                        </div>
                        <span class="venue"><strong>Venue: </strong>Gweru</span>

                        <div class="detailsLink">
                            <a href="results.php">
                                <span>View All <i class="uil uil-arrow-right icon"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="tableDiv">
                        <div class="tableLogoDiv">
                            <img src="./static/images/logo.png"" alt=" Logo" class="logo">
                        </div>

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
                                            <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
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
                                            <img src="assets/logos/team%20%284%29.png" alt="Team Logo" class="teamLogo">
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

                                </tr>
                                <tr class="tr">
                                    <td class="pos">3</td>
                                    <td class="flex">
                                        <div class="teamLogoDiv">
                                            <img src="static/images/logo.png" alt="Team Logo" class="teamLogo">
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
                                            <img src="assets/logos/team%20%284%29.png" alt="Team Logo" class="teamLogo">
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
                                            <img src="assets/logos/team%20%285%29.png" alt="Team Logo" class="teamLogo">
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
                                <!--<tr class="tr">-->
                                <!--  <td class="pos">6</td>-->
                                <!--  <td class="flex">-->
                                <!--    <div class="teamLogoDiv">-->
                                <!--      <img-->
                                <!--        src="../assets/logos/team (6).png"-->
                                <!--        alt="Team Logo"-->
                                <!--        class="teamLogo"-->
                                <!--      />-->
                                <!--    </div>-->
                                <!--    <div class="name">Team 6</div>-->
                                <!--  </td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td class="points">0</td>-->
                                <!--</tr>-->
                                <!--<tr class="tr">-->
                                <!--  <td class="pos">7</td>-->
                                <!--  <td class="flex">-->
                                <!--    <div class="teamLogoDiv">-->
                                <!--      <img-->
                                <!--        src="../assets/logos/team (7).png"-->
                                <!--        alt="Team Logo"-->
                                <!--        class="teamLogo"-->
                                <!--      />-->
                                <!--    </div>-->
                                <!--    <div class="name">Team 7</div>-->
                                <!--  </td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td class="points">0</td>-->
                                <!--</tr>-->
                                <!--<tr class="tr">-->
                                <!--  <td class="pos">8</td>-->
                                <!--  <td class="flex">-->
                                <!--    <div class="teamLogoDiv">-->
                                <!--      <img-->
                                <!--        src="../assets/logos/team (8).png"-->
                                <!--        alt="Team Logo"-->
                                <!--        class="teamLogo"-->
                                <!--      />-->
                                <!--    </div>-->
                                <!--    <div class="name">Team 8</div>-->
                                <!--  </td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td class="points">0</td>-->
                                <!--</tr>-->
                                <!--<tr class="tr">-->
                                <!--  <td class="pos red">9</td>-->
                                <!--  <td class="flex">-->
                                <!--    <div class="teamLogoDiv">-->
                                <!--      <img-->
                                <!--        src="../assets/logos/team (9).png"-->
                                <!--        alt="Team Logo"-->
                                <!--        class="teamLogo"-->
                                <!--      />-->
                                <!--    </div>-->
                                <!--    <div class="name">Team 9</div>-->
                                <!--  </td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td>0</td>-->
                                <!--  <td class="points">0</td>-->
                                <!--</tr>-->
                                <!--<tr class="tr">-->
                                <!--  <td class="pos red">10</td>-->
                                <!--  <td class="flex">-->
                                <!--    <div class="teamLogoDiv">-->
                                <!--      <img-->
                                <!--        src="../assets/logos/team (10).png"-->
                                <!--        alt="Team Logo"-->
                                <!--        class="teamLogo"-->
                                <!--      />-->
                                <!--    </div>-->
                                <!--    <div class="name">Team 10</div>-->
                                <!--  </td>-->
                                <!--  <td>1</td>-->
                                <!--  <td>-5</td>-->
                                <!--  <td>-5</td>-->
                                <!--  <td>-5</td>-->
                                <!--  <td>-5</td>-->
                                <!--  <td>-5</td>-->
                                <!--  <td>-5</td>-->
                                <!--  <td class="points">0</td>-->
                                <!--</tr>-->
                            </table>
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
                        <img src="./Admin/images/executives/<?php echo $row["image"] ?>" alt=" Logo" >
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