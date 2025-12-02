<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan UNIGA</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style-prefix.css">
  <link rel="stylesheet" href="./assets/css/style.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@6.0.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@6.0.0/dist/ionicons/ionicons.js"></script>


  <!--
    - custom js link
  -->
  <script defer src="./assets/js/script.js"></script>

</head>

<body>


  <div class="overlay" data-overlay></div>


  <div class="modal" data-modal>

    <div class="modal-close-overlay" data-modal-overlay></div>

    <div class="modal-content">

      <button class="modal-close-btn" data-modal-close>
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <div class="newsletter-img">
        <img src="./assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
      </div>


    </div>

  </div>

  <?php include 'header.php'; ?>

  <main>

    <div class="slider-container position-relative overflow-hidden" style="position: relative; max-width: 100%;">

      <div class="slider-wrapper d-flex transition" style="width: 200%; transition: transform 0.5s ease;">

        <!-- Slide 1 -->
        <div class="slider-item w-100" style="flex: 0 0 100%;">
          <img src="./assets/images/banner1.jpg" alt="Banner 1" class="banner-img">
          <div class="banner-content">
            <p class="banner-subtitle text-white" style="text-shadow: 0 4px 8px rgba(0,0,0,0.6);">Read Book For Upgrade Yourself</p>
            <a href="#product" class="banner-btn">Explore now</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="slider-item w-100" style="flex: 0 0 60%;">
          <img src="./assets/images/banner2books.jpg" alt="Banner 2" class="banner-img">
          <div class="banner-content">
            <p class="banner-subtitle">Explore Knowledge, Gear Up!</p>
            <a href="#product" class="banner-btn">Explore now</a>
          </div>
        </div>

      </div>

    </div>

    <script>
      let currentSlide = 0;
      const wrapper = document.querySelector('.slider-wrapper');
      const totalSlides = document.querySelectorAll('.slider-item').length;

      setInterval(() => {
        currentSlide = (currentSlide + 1) % totalSlides;
        wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
      }, 5000);
    </script>


    <?php include './db/koneksi.php'; ?>


    <div id="product" class="d-flex justify-content-center mb-4">
      <h2>Books Showcase</h2>
    </div>
    <div class="container mt-5">
      <div class="row">
        <?php include 'show-book.php';  ?>
      </div>
    </div>

  </main>


  <?php include 'footer.html'; ?>


  <script src="./assets/js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>