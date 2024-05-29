

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nppl</title>
    <!-- Link css -->
    <link rel="stylesheet" href="./main.css">
    <!-- link icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- link swiper.min.css -->
    <link rel="stylesheet" href="./swiper-bundle.min.css">

</head>
<body>
    <div class="header">
        <!-- club logos -->
        <div class="topSection">
                                     <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (1).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (2).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (6).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (4).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (5).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (7).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (10).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (8).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (9).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                                                 <a href="clubs.php"
                        >                                          
                                          <img
                                            src="https://slma.isratechyt.com/uploads/smlateam (3).png"
                                            alt="Team Logo"
                                            class="teamLogo"
                                          />
                                          </a>
                        
        </div>
        <div class="lowerSection">
            
            <div class="logoDiv">
               <img src="./static/images/logo.png" alt="Logo" class="logo">
            </div>
            
            <div class="navBar">
                <ul class="navList">
                    <li class="navItem"><a href="index.php" class="navLink">Home</a></li>
                    <li class="navItem"><a href="about.php" class="navLink">About</a></li>
                    <li class="navItem"><a href="clubs.php" class="navLink">Clubs</a></li>
                    <li class="navItem"><a href="fixtures.php" class="navLink">Fixtures</a></li>
                    <li class="navItem"><a href="results.php" class="navLink">Results</a></li>
                    <li class="navItem"><a href="news.php" class="navLink">News</a></li>
                    <!-- <li class="navItem"><a href="funZone.php" class="navLink">Fun Zone</a></li> -->
                  </ul>
                  <div class="button">
                      <a href="login.php">LOG IN</a>
                  </div>
                  <small>*Only club representatives.</small>
            </div>
           

            <div class="navBarBtn">
                <i class="uil uil-bars icon"></i>
            </div>
        </div>
    </div>        
<div class="aboutBanner" style="padding: 10rem 0 5rem;">
    
<span class="bannerText">
    <i class="uil uil-constructor icon"></i>
    <p>The Crane</p>
        <h2>Admin Login</h2>
</span>
</div>

<!-- Login Section ======================== -->
<section class=" loginSection section">
<div class="sectionIntro">
    <h2 class="title">
        Club Admin
    </h2>
    <span class="subTitle" style='margin-bottom: .5rem'>
        Be authentic, only admins.
    </span>
     </div>
<div class="formContainer">
    <div class="overlay"></div>
    <form method = 'POST'>
        <div class="rows grid">
           

            <div class="row">
                <label for="username">User Name</label>
                <input type="text" id="username" name="adun" placeholder="Enter your User Name" required>
            </div>

            <div class="row">
                <label for="password">Password</label>
                <input type="password" id="password" name="adpswd" placeholder="Enter Password" required>
            </div>

            <div class="row">
                <!-- <input type="button" name="submit" class="submitBtn" value="Login"> -->
                <a href="./Admin/adminIndex.php"  name="submit" class="submitBtn btn flex">Login <i class="uil uil-arrow-up-right icon"></i></a>
            </div>
            <span class='forgotPass flex'>Forgot Password!</span>
            <div class="infoCard">
                <div class="info">
                     <i class="uil uil-exclamation-triangle icon exclamation"></i>
                     <h6>We're Notified!</h6>
                     <p>
                        This feature will be available in the next few versions.
                        <br> <br>
                        Kindly reach out to your Administrator to reset your password!
                     </p>
                     <button class='btn flex' id='closeCard'>Close</button>
                </div>
            </div>

        </div>
    </form>
</div>
</section>
<!-- Login Section ends ======================== -->

<script>
// Show Alert
const calink = document.querySelector(".forgotPass");
console.log(calink)
const card = document.querySelector(".infoCard");
const close = document.getElementById("closeCard");

calink.addEventListener('click', function () {
  card.classList.add('flowIn')
})
close.addEventListener('click', function () {
  card.classList.remove('flowIn')
})
</script>
     
 <!-- footer section starts here =============================================================-->
<div class="footer">
    <div class="footerContent container grid">
      <div class="col firstCol">
          <img src="./static/images/logo.png" alt="Logo Image" class="footerLogo">
          
          <span class="text">
            Nevsun Premier Pool League
          </span>
          <p>We celebrate our Soccer and generations!</p>
          <div class="socials flex">
              <a href="https://www.facebook.com/aba.graphicx" target="_blank">
                <i class="uil uil-facebook-f icon"></i>
              </a>
              <a href="mailto:abagraphicx@gmail.com" target="_blank">
                <i class="uil uil-envelope-heart icon"></i>
              </a>
              <a href="https://api.whatsapp.com/send?phone=+971524312309&text=Hello, IsraTech!" target="_blank">
                <i class="uil uil-whatsapp icon"></i>
              </a>
              <a href="https://www.youtube.com/c/IsraTech1" target="_blank">
                <i class="uil uil-youtube icon"></i>
              </a>
              
          </div>
      </div>
      <div class="col">
          <h6>MAIN LINKS</h6>
          <a href="index.php" class="footerLink">Home</a>
          <a href="about.php" class="footerLink">About</a>
          <a href="clubs.php" class="footerLink">Clubs</a>
          <a href="news.php" class="footerLink"> News</a>
      </div>
      <div class="col">
          <h6>STATS</h6>
          <a href="results.php" class="footerLink">Table</a>
          <a href="results.php" class="footerLink">Results</a>
          <a href="fixtures.php" class="footerLink">Fixtures</a>
          <a href="news.php" class="footerLink">Transfers</a>
          
        
        
      </div>
      <div class="col">
          <h6>COMMUNITIIES</h6>
          <a href="" class="footerLink">Sponsors</a>
          <a href="" class="footerLink">Fun Zone</a>
         
          <a href="" class="footerLink">Galleries</a>
          <a href="" class="footerLink">Partnerships</a>
        
      </div>
    </div>
    <div class="copyRight">
        <div class="copyRightDiv">
            <span class="left">&copy; NPPL <?php $currentYear = date('Y'); echo $currentYear; ?></span>
            <span class="middle">CONTACT US FOR FAIR & LEGAL USE OF THIS PROJECT</span>
            <span class="right flex">
                <img src="./assets/1.png" alt="" style="width:30px; height:auto;">
                <h3 style="color:rgb(71, 51, 166)">NPPL</h3>
            </span>
        </div>
    </div>
</div>

<!-- footer section ends here =============================================================-->

    <!-- swiper.js link -->
     <script src="./swiper-bundle.min.js"></script>
    <!-- link javascript -->
    <script src="./main.js"></script>
</body>
</html>

