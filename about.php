<?php
include 'header.php';
require_once('databaseConn.php');
?>

<div class="bodyFlex">
  <div class="sideBody">


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

  </div>

  <div class="mainBody">
    <div class="aboutBanner">
      
      <div class="aboutButton flex">
        <a href="#info" class="aboutBtnActive">
          <i class="uil uil-info-circle icon"></i>Info</a>
        </div>
    </div>

    <!-- About Information starts here =================================== -->
    <div class="container">
      <div class="mainInfo section" id="info">
        <div class="sectionHeader flex">
          <span class="newsTitle">Nevsun Premier Pool League</span>
          <i class="uil uil-ellipsis-h icon"></i>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ex
          laudantium, expedita nostrum obcaecati ducimus. Debitis ea, iusto
          ullam neque quisquam necessitatibus, expedita voluptate nobis
          doloribus eum soluta illo quam!
        </p>
        <br />
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ex
          laudantium, expedita nostrum obcaecati ducimus. Debitis ea, iusto
          ullam neque quisquam necessitatibus, expedita voluptate nobis
          doloribus eum soluta illo quam!
        </p>
        <div class="detailsLink">
          <a href="clubs.php">
            <span>Clubs <i class="uil uil-arrow-right icon"></i></span>
          </a>
        </div>
      </div>

    </div>
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