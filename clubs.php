<?php
include 'header.php';
require_once('databaseConn.php');
?>

<div class="bodyFlex">


  <div class="mainBody">
    <div class="aboutBanner">
      <div class="aboutButton flex">
        <i class="uil uil-trophy icon"></i>Clubs
      </div>
    </div>


    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs">
      <div class="sectionHeader flex">
        <div class="seasonYear">
          <h6>2024</h6>
        </div>
      </div>

      <div class="clubsContainer container">

        <?php
        $sql = "SELECT * FROM `clubs`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <div class="singleClub">
            <div class="singleClubTop flex">
              <div class="leftRow flex">

                <div class="teamLogoDiv">

                  <img alt="Team Logo" class="teamLogo" src="./Admin/images/uploads/<?php echo $row["logo"] ?>">

                </div>



                <div class="clubName">
                  <span class="name"><?php echo $row["name"] ?></span>
                  <span class="classYear">Established <?php echo date('Y', strtotime($row["estdate"]));  ?></span>
                </div>


              </div>
              <div class="rightRow">
                <i class="uil uil-angle-down icon"></i>
              </div>
            </div>
            <div class="singleClubHidden">
              <span class="title">Stat Summary</span>
              <div class="stat">
                <span><i class="uil uil-football icon"></i>League Position</span>
                <span class="res">1st</span>
              </div>
              <!-- <div class="stat">
                            <span><i class="uil uil-user-nurse icon"></i> Manager</span>
                            <span class="res">Manager Name</span>
                        </div> -->
              <div class="stat">
                <span><i class="uil uil-building icon"></i>Base Location</span>
                <span class="res"><?php echo $row["location"] ?></span>
              </div>
              <div class="stat">
                <span><i class="uil uil-user-arrows icon"></i>Number of
                  players</span>
                <span class="res"><?php echo $row["numplayers"] ?> Players</span>
                <div class="detailsLink">

                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>





      </div>
    </div>
    <!-- Clubs section ends =================================== -->


  </div>
</div>
<script>
  // Toggle clubs' details by arrow click======>
  /*=============== ACCORDION ===============*/
  const accordion = document.getElementsByClassName('singleClub')
  for (let i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener('click', function() {
      this.classList.toggle('active')
    })
  }
</script>

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