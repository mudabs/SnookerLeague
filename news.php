<?php
include './header.php';
require_once('./databaseConn.php');



?>

<div class="bodyFlex">

  <div class="mainBody">

    <div class="aboutBanner">

      <div class="aboutButton flex">
        <a href="#" class="newsBtn activeBtn" data-filter="all"> <i class="uil uil-info-circle icon"></i>All News</a>
      </div>
    </div>

    <!-- News section =================================== -->
    <section class="section newsSection container">
      <div class="sectionHeader">
        <span class="newsTitle">Latest News</span>
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
                <span class="title"><?php echo $row['title']  ?></span>

              </a>
              <p> <?php echo $row['feed']  ?></p>
            </div>
          </div>
        <?php } ?>
      </div>

    </section>
    <div class="detailsBox">
    </div>
    <!-- News section ends =================================== -->
  </div>
</div>

<!-- Script to show more all news ======> -->
<script>
  const showNewsLinks = document.querySelectorAll('.showNewsLink')
  const detailsBox = document.querySelector('.detailsBox')
  showNewsLinks.forEach(showNewsLink => {
    showNewsLink.addEventListener('click', addInfo)
  })

  function addInfo(e) {
    e.preventDefault()
    let btn = e.target;

    let img = btn.parentElement.parentElement.parentElement.children[0].children[0]
    //   console.log(img)
    img.classList.add('detailsImg')
    let classedImg = img.src

    let title = btn.parentElement.parentElement.children[0].children[0].innerText

    let text = btn.parentElement.parentElement.children[1].innerText

    let detail = document.createElement('div')
    detail.classList.add('detailsContainer')
    detail.innerHTML = ` 

                    <i class="uil uil-times-circle icon closeDetailsIcon"></i>
                    <img src="${classedImg}" alt="News Image" class="detailsImg">
                    <span class="title">
                        ${title}
                    </span>
                    <span class='desc'>${text}</span>
                    <small>Club Name FC</small>
                  
                  `
    detailsBox.appendChild(detail)
    detailsBox.classList.add('seeDetails')


    const closeDetailsIcons = document.querySelectorAll('.closeDetailsIcon')
    closeDetailsIcons.forEach(closeDetailsIcon => {

      closeDetailsIcon.addEventListener('click', function() {
        detailsBox.classList.remove('seeDetails')
        detail.remove()

      })
    })
  }

  // SCRIPT TO TOGGbLE BETWEEN NEWS AND TRANSFERS......

  const btns = document.querySelectorAll('.newsBtn')
  const newsType = document.querySelectorAll('.singlePost')

  // Add active class(Background to the button) ===============>
  for (let l = 0; l < btns.length; l++) {
    btns[l].addEventListener('click', function() {
      for (let w = 0; w < btns.length; w++) {
        btns[w].classList.remove('activeBtn')
      }
      this.classList.add('activeBtn')

      let dataFilter = this.getAttribute('data-filter')
      for (let y = 0; y < newsType.length; y++) {
        newsType[y].classList.add('hide')
        newsType[y].classList.remove('live')
        if (newsType[y].getAttribute('data-item') == dataFilter || dataFilter == "all") {
          newsType[y].classList.remove('hide')
          newsType[y].classList.add('live')
        }
      }
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