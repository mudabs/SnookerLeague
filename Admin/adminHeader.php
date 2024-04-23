<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nppl</title>
    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Link css -->
    <link rel="stylesheet" href="../main.css">
    <!-- link icons -->
    <link rel="stylesheet" href="../release/v4.0.0/css/line.css">
    <!-- link swiper.min.css -->
    <link rel="stylesheet" href="../swiper-bundle.min.css">
    <!-- Link fontawesome -->
    
    <style>
        .fixed-sidebar {
            position: fixed;
            /* Makes the sidebar fixed to its position */
            left: 0;
            /* Positions the sidebar at the left edge of the screen */
            width: 200px;
            /* Set the desired width of the sidebar */
            height: 100vh;
            /* Set the height to 100vh (viewport height) for full-screen */
            background-color: #260229;
            /* Optional: Set a background color */
            padding: 0;
        }

        .navs {
            height: 50px;
            color: white;
            background-color: #260229;
            padding-left: 30px;
            padding-top: 10px;
            font-size:small;
        }

        .logo-navs {
            height: 160px;
        }

        .nav-logo {
            width: 40%;
            margin-left: 55px;
        }

        .logo-on-top {
            position: absolute;
            top: 10px;
            /* Adjust top position as needed */
            left: 55px;
            /* Adjust left position as needed */
            width: 70px;
            /* Adjust width as needed */
            height: 70px;
            /* Adjust height as needed */
        }

        .text-on-top {
            position: absolute;
            top: 70px;
            left: 10px;
            font-size: 10px;
            /* Adjust top position as needed */

        }

        .navs:hover {
            background-color: #fe2883;
            /* Pink color on hover */
        }
    </style>

</head>

<body>


    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="fixed-sidebar">
                <li class="logo-navs">
                    <img src=" ../static/images/vector-bg.jpg" style="height:160px;" alt="">
                    <img src=" ../static/images/logo.png" class="logo-on-top" alt="Logo">
                    <small class="text-on-top"><b> NEVSUN PREMIER POOL LEAGUE</b></small>
                </li>

                <div class="list-group flex-column">
                    <a href="adminIndex.php">
                        <li class="navs"><i class="fa-solid fa-gauge"></i> Dashboard </li>
                    </a>
                    <a href="Teams.php">
                        <li class="navs"><i class="fas fa-users"></i> Teams </li>
                    </a>
                    <a href="Fixtures.php">
                        
                        <li class="navs"><i class="fas fa-calendar-alt"></i> Fixtures </li>
                    </a>
                    <a href="Results.php">
                        
                        <li class="navs"><i class="fas fa-trophy"></i> Results </li>
                    </a>
                    
                    <a href="Player.php">
                        
                        <li class="navs"><i class="fas fa-users"></i> Players </li>
                    </a>

                    <a href="Managers.php">
                        
                        <li class="navs"><i class="fas fa-briefcase"></i> Managers </li>
                    </a>
                    <a href="News.php">
                        
                        <li class="navs"><i class="fas fa-newspaper"></i> News </li>
                    </a>
                    <a href="History.php">
                        
                        <li class="navs"><i class="fas fa-history"></i> History </li>
                    </a>
                    <a href="Gallery.php">
                        
                        <li class="navs"><i class="fas fa-images"></i> Gallery </li>
                    </a>
                    <a href="Communication.php">
                        
                        <li class="navs"><i class="fas fa-envelope"></i> Communication </li>
                    </a>
                    <a href="LeagueAnalysis.php">
                        
                        <li class="navs"><i class="fas fa-chart-line"></i> League Analysis </li>
                    </a>
                    <a href="Settings.php">
                        
                        <li class="navs"><i class="fas fa-cog"></i> Settings </li>
                    </a>
                </div>

            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" ></script>

</body>