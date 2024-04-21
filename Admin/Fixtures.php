<?php
include './adminHeader.php';
?>


<div class="container" style="margin-left: 200px;">



    <!-- Clubs section =================================== -->
    <div class="clubsSection section" id="clubs">
        <div class="sectionHeader flex">
            <div class="seasonYear">
                <h6>Leaague Teams</h6>
            </div>
            <div class="logoDiv">
                <img src="../static/images/logo.png" alt="Logo Image">
            </div>
        </div>
        <div style="width: 100%; height:15px;background-color:#37003c; ;">
        </div>
        <div class="sectionHeader flex" style="background-color: #f3f0f2; ">
            <div class="seasonYear">
                <h6 style="color:#37003c; text-align:center;">2023/4</h6>
            </div>
        </div>

        <?php
            $sql = "SELECT f.*,t.name FROM `fixtures` FROM fixtures f INNER JOIN team u ON f.user_id = u.id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
        <div class="row">
            <div class="card" style="width: 30%; margin:15px"">
                <div class="card-body">
                    <div class="row">
                        <img src="<?php echo $row["id"] ?>" alt="">
                        <div class="col"><?php echo $row["id"] ?></div>
                        <div class="col"><?php echo $row["id"] ?></div>
                        <img src="<?php echo $row["id"] ?>" alt="">
                        <div class="col"><?php echo $row["id"] ?></div>
                    </div>
                    <div class="row" style="text-align: center;">
                        <h6>Venue: <?php echo $row["id"] ?></h6>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" style="width: 50%; margin:0 auto;">Edit Fixture</button>
                    </div>
                    <br>
                    <div class="row">
                        <button class="btn btn-primary" style="width: 55%; margin:0 auto; background-color:#fe2883;">Delete Fixture</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClubModal">Add Club</button>