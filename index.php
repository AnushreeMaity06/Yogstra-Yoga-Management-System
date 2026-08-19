<?php
session_start();





if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $getStartedLink = "user_panel/overview.php";
} else {
    $getStartedLink = "login.php";
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yogstra</title>
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
   <link rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <style>
    #aboutus {
      padding-top: 60px;
      padding-bottom: 60px;
    }

    .custom-card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      transition: 0.3s ease;
      height: 100%;
      background: #fff;
    }

    .custom-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .custom-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }

    .card-title {
      font-weight: 600;
      font-size: 22px;
      margin-bottom: 10px;
    }

    .card-text {
      font-size: 15px;
      color: #555;
      text-align: justify;
      line-height: 1.7;
    }

    .highlight-red {
      color: #b00b0b;
    }

    :root {
      --bg-cream: #FAF4EE;
      --text-dark: #2B231D;
      --accent-orange: #C85C32;
      --text-muted: #6B6259;
      --font-serif: 'Playfair Display', serif;
      --font-sans: 'Plus Jakarta Sans', sans-serif;
    }

    /* body {
            background-color: var(--bg-cream);
            color: var(--text-dark);
            font-family: var(--font-sans);
        } */

    /* Header Section */
    .journal-title {
      font-family: var(--font-serif);
      font-weight: 700;
      color: var(--text-dark);
    }

    .explore-link {
      color: var(--accent-orange);
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .explore-link:hover {
      color: #a44622;
    }

    /* Card Section */
    .blog-card {
      background: transparent;
      border: none;
    }

    .card-img-container {
      border-radius: 16px;
      overflow: hidden;
      aspect-ratio: 16 / 10;
    }

    .card-img-container img {
      width:100%;
    height:100%;
    object-fit:cover;
    transition:.5s;
    }

    .category-tag {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 700;
      color: var(--accent-orange);
    }

    .read-time {
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    .card-title-custom {
      font-family: var(--font-serif);
      font-size: 1.5rem;
      font-weight: 600;
      margin-top: 0.5rem;
      margin-bottom: 0.75rem;
      color: var(--text-dark);
    }

    .card-desc {
      font-size: 0.9rem;
      color: var(--text-muted);
      line-height: 1.6;
    }

    .read-more-btn {
      color: var(--text-dark);
      text-decoration: none;
      font-weight: 700;
      font-size: 0.85rem;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .read-more-btn:hover {
      color: var(--accent-orange);
    }

    /* Footer Section */
    footer {
      background-color: #ffffff;
      font-size: 0.8rem;
      color: var(--text-muted);
      margin-top: 5rem;
    }

    .footer-brand {
      font-family: var(--font-serif);
      font-weight: 800;
      color: var(--accent-orange);
      font-size: 1.2rem;
    }

    .footer-link {
      color: var(--text-muted);
      text-decoration: none;
      margin-right: 15px;
    }

    .footer-link:hover {
      color: var(--accent-orange);
    }

    .footer-icon-btn {
      color: var(--accent-orange);
      background-color: #FFF3EB;
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      text-decoration: none;
      margin-left: 8px;
      font-size: 0.9rem;
    }

    .footer-icon-btn:hover {
      background-color: var(--accent-orange);
      color: #ffffff;
    }


    .feedback-section {
      background: #f7f2f0;
    }

    .feedback-title {
      font-size: 38px;
      font-weight: 700;
      color: #2c2c2c;
      font-family: 'Playfair Display', serif;
    }

    .feedback-card {
      background: #ba6a4a;
      padding: 30px;
      border-radius: 18px;
      height: 100%;
      transition: 0.3s ease;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .feedback-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .feedback-img {
      width: 55px;
      height: 55px;
      border-radius: 50%;
      object-fit: cover;
    }

    .feedback-text {
      color: #2B231D;
      font-style: italic;
      line-height: 1.8;
      font-size: 16px;
      margin-bottom: 0;
    }

    @media(max-width:768px) {

      .feedback-title {
        font-size: 34px;
      }

      .feedback-card {
        padding: 20px;
      }

    }


    .blog-scroll {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;

    /* scrollbar hide */
    scrollbar-width: none;      /* Firefox */
    -ms-overflow-style: none;   /* IE & Edge */
}

.blog-scroll::-webkit-scrollbar {
    display: none;              /* Chrome, Safari */
}

.blog-card-wrapper {
    flex: 0 0 calc(50% - 10px); /* প্রতি row-তে 2টা card */
}
/* ==============================
   YOGSTRA PREMIUM FOOTER
================================ */

.yogstra-footer {
    background:  #ba6a4a;
    color: #fffefe;
    padding: 70px 0 0;
    margin-top: 80px;
}


/* Brand */

.footer-logo {
    width: 140px;
    height: 55px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
}

.footer-description {
    max-width: 420px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    line-height: 1.8;
    color: #ffffff;
    margin-bottom: 25px;
}


/* Social Icons */

.footer-social {
    display: flex;
    gap: 10px;
}

.social-btn {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #ba6a4a;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: 0.3s ease;
}

.social-btn:hover {
    background: #d48768;
    color: white;
    transform: translateY(-4px);
}


/* Headings */

.footer-heading {
    font-family: 'Playfair Display', serif;
    color: #ffffff;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 22px;
}


/* Links */

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #ffffff;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    transition: 0.3s ease;
}

.footer-links a:hover {
    color: #d48768;
    padding-left: 5px;
}


/* Contact */

.footer-contact {
    display: flex;
    flex-direction: column;
    gap: 17px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #fefefe;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.contact-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 50%;
    background: rgba(186, 106, 74, 0.18);
    color: #d48768;
    display: flex;
    align-items: center;
    justify-content: center;
}


/* Bottom */

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    margin-top: 55px;
    padding: 22px 0;
}

.copyright {
    margin: 0;
    color: #f8f7f7;
    font-size: 13px;
    font-family: 'Poppins', sans-serif;
}

.made-with {
    color: #fefefe;
    font-size: 13px;
    font-family: 'Poppins', sans-serif;
}

.made-with i {
    color: #fc4c07;
    margin: 0 4px;
}


/* ==============================
   RESPONSIVE
================================ */

@media (max-width: 768px) {

    .yogstra-footer {
        padding: 50px 0 0;
        text-align: center;
    }

    .footer-description {
        margin-left: auto;
        margin-right: auto;
    }

    .footer-social {
        justify-content: center;
    }

    .footer-heading {
        margin-top: 10px;
    }

    .contact-item {
        justify-content: center;
    }

    .footer-bottom {
        margin-top: 35px;
    }

    .footer-bottom .text-md-end {
        text-align: center !important;
        margin-top: 8px;
    }

}

@media (max-width: 768px) {
    .blog-card-wrapper {
        flex: 0 0 100%; /* Mobile-এ 1টা card */
    }
}
  </style>

</head>

<body style="background-color:#f7efe9;">

  <!-- ================navbar==================== -->

  


  <?php include('navbar.php'); ?>





  <!-- ===================================banner======================================== -->

  <?php
  global $conn;
  include "db_connect.php";

  $sql = "SELECT * FROM banners WHERE status=1 LIMIT 3";
  $result = mysqli_query($conn, $sql);

  $active = true;
  ?>

  <div id="carouselExampleInterval" class="carousel slide main-carousel" data-bs-ride="carousel">
    <div class="carousel-inner">

      <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="carousel-item <?php if ($active) {
                                    echo 'active';
                                    $active = false;
                                  } ?>" data-bs-interval="3000">

          <img src="uploads/bannerimage/<?php echo $row['image']; ?>"
                       class="d-block w-100 banner-img" alt="banner" >


          <div class="overlay"></div>

          <div class="carousel-caption ">
            <h1 class="text-black" style="font-weight:700; font-family:'Playfair Display', serif;">
              <?php echo $row['title']; ?>
            </h1>

            <h3 class="text-black" style="font-weight:700; font-family:'Poppins', sans-serif;">
              <?php echo $row['subtitle']; ?>
            </h3>
          </div>

        </div>

      <?php } ?>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>


 




  <div class="container" id="aboutus">

    <div class="row g-4">

      <!-- Card 1 -->
      <div class="col-lg-4 col-md-6 col-12">
        <div class="card custom-card shadow-sm">
          <img src="assets/image/pngtree-india-yogi-perform-yoga-png-image_5750673.jpg" alt="Yoga">

          <div class="card-body">
            <h3 class="card-title" style="font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">
              Yoga Consultation
            </h3>
            <p class="card-text" style=" font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;
    line-height: 1.7;text-align: justify;">
              Yoga is not just a practice; it is a journey towards inner peace and balance.
              Through mindful breathing and gentle movement, we reconnect with ourselves,
              letting go of stress and embracing calmness in every moment.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-4 col-md-6 col-12">
        <div class="card custom-card shadow-sm">
          <img src="assets/image/illustration-international-yoga-day-with-space-text_1235831-47038.avif" alt="Training">

          <div class="card-body">
            <h3 class="card-title" style="font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">
              Be<span>st</span> Tra<span>ini</span>ng
            </h3>
            <p class="card-text" style=" font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;
    line-height: 1.7;text-align: justify;">
              In the rhythm of breath and the flow of movement, yoga teaches us to slow down and truly listen to our body.
              It is a space where strength meets serenity and every pose becomes a step closer to self-discovery.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-4 col-md-6 col-12 mx-auto">
        <div class="card custom-card shadow-sm">
          <img src="assets/image/meditation-ppt-background.webp" alt="Meditation">

          <div class="card-body">
            <h3 class="card-title" style="font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">Builds Perfect Body</h3>
            <p class="card-text" style=" font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;
    line-height: 1.7;text-align: justify;">
              Yoga is the art of living with awareness. It reminds us that true harmony comes from within,
              helping us build a deeper connection between mind, body, and soul in everyday life.
            </p>
          </div>
        </div>
      </div>

    </div>

  </div>



  <!-- ===============================About Section2================== -->
  <section class="container pt-5" id="">
    <div class="row">


      <div class="col-md-5">
        <img class="" style="width:398px;height:476px;border-radius:15px;" src="assets/image/philosphy.jpg" />
      </div>
      <div class="col-md-7 " style="padding-top:9%;">
        <span class="" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #ba6a4a;
    letter-spacing: 1px;
    font-weight: 600;
    text-transform: uppercase;">The Yogstra Philosophy</span>
        <h2 class="" style="font-family: 'Playfair Display', serif;
    font-size: 38px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">A Journey Inward, A Life Transformed</h2>
        <p class="" style=" font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;
    line-height: 1.7;text-align: justify;">At Yogstra, we believe that yoga is more than just physical exercise; it is a profound journey of self-discovery and soul-searching. Our method harmonizes ancient wisdom with modern physiological insights.</p>
        <p class="" style=" font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;
    line-height: 1.7;text-align: justify;">We curate every session to ensure a perfect balance of 'Radiant Energy' and 'Soulful Calm', helping you navigate the complexities of modern life with grace and strength.</p>
        <ul class="list-unstyled">
          <li class="" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;">

            <i class="fa-solid fa-leaf" style="color: #f57847;"></i> Sustainable, organic practice standards</span>
          </li>
          <li class="" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;">

            <i class="fa  fa-spa" style="color: #f57847;"></i> Mindfulness integrated into every flow</span>
          </li>
          <li class="" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;">

            <i class="fa  fa-heart" style="color: #f57847;"></i> Compassionate community support</span>
          </li>
        </ul>
      </div>
    </div>
  </section>



  <!-- ========Services=========================== -->
  <section>
    <div class="" id="services" style="background-color:              #ba6a4a;
;">
      <h2 class="mt-5 pt-5 " style="margin:auto;text-align:center;font-family: 'Playfair Display', serif;
    font-size: 38px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">Curated Practices</h2>
      <p class="font-body-md text-body-md text-on-surface-variant" style="margin:auto;text-align:center;font-family: 'Poppins', sans-serif;">Explore our signature yoga styles designed to meet you exactly where you are on your path.</p>

      <div class="container py-5">
        <div class="row g-4">

          <!-- Card 1 -->
          <div class="col-md-4">
            <div class="card-custom card" style="padding:20px;">

              <h5 class="card-title" style="font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">
                <p><i class="fa  fa-spa" style="color: #f57847;border:2px solid #f57847;padding:10px;border-radius:10px;"></i> </p>Vinyasa Flow
              </h5>
              <p class="card-text" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;text-align:justify;">
                A dynamic, breath-to-movement practice designed to build heat,
                strength, and cardiovascular health while finding focus.
              </p>
              <a href="login.php" class="learn-more " style="text-decoration:none;color: #f57847;font-weight:700;font-size:20px;font-family: 'Poppins', sans-serif;">Learn more →</a>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col-md-4">
            <div class="card-custom card" style="padding:20px;">

              <h5 class="card-title" style="font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">
                <p><i class="fa  fa-heart" style="color: #f57847;border:2px solid #f57847;padding:10px;border-radius:10px;"></i> </p>Hatha Alignment
              </h5>
              <p class="card-text" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;text-align:justify;">
                Focus on foundational postures and anatomical alignment.
                Perfect for building a solid, safe, and powerful practice.
              </p>
              <a href="login.php" class="learn-more" style="text-decoration:none;color: #f57847;font-weight:700;font-size:20px;font-family: 'Poppins', sans-serif;">Learn more →</a>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col-md-4">
            <div class="card-custom card" style="padding:20px;">

              <h5 class="card-title" style="font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">
                <p><i class="fa  fa-leaf" style="color: #f57847;border:2px solid #f57847;padding:10px;border-radius:10px;"></i> </p>Restorative Bliss
              </h5>
              <p class="card-text" style="font-family: 'Poppins', sans-serif;
    font-size: 16px;
    color: #444;text-align:justify;">
                Surrender into deep relaxation with long-held, supported poses
                that soothe the nervous system and quiet the mind.
              </p>
              <a href="login.php" class="learn-more"
                style="text-decoration:none;color: #f57847;font-weight:700;font-size:20px;font-family: 'Poppins', sans-serif;">Learn more →</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <!-- <section class="feedback-section py-5">

    <div class="container">

      <h2 class="text-center feedback-title mb-5">
        Voices of Transformation
      </h2>

      <div class="row g-4">

        <?php
        $query = mysqli_query($conn, "SELECT feedback.message,users.name,users.image FROM feedback INNER JOIN users
             ON feedback.user_id=users.id WHERE users.role='student' ORDER BY feedback.created_at DESC LIMIT 6");

        //  echo mysqli_num_rows($query);

        while ($row = mysqli_fetch_assoc($query)) {
        ?>

          <div class="col-lg-4 col-md-6">

            <div class="feedback-card">

              <div class="d-flex align-items-center mb-3">

                <img src="uploads/image/<?php echo $row['image']; ?>"
                  class="feedback-img"
                  alt="User">

                <div class="ms-3">
                  <h5 class="mb-0 fw-bold">
                    <?php echo htmlspecialchars($row['name']); ?>
                  </h5>

                  <small class="text-muted">
                    Student
                  </small>
                </div>




              </div>

              <p class="feedback-text">
                "<?php echo htmlspecialchars($row['message']); ?>"
              </p>

            </div>

          </div>

        <?php } ?>

      </div>

    </div>


  </section> -->












  <!-- <section class="py-xl">
      <div class="max-w-[1200px] mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
          <div>
            <h2 class="font-h2 text-h2 mb-4">Upcoming Journeys</h2>
            <p class="font-body-md text-on-surface-variant">Live sessions and new on-demand arrivals this week.</p>
          </div>
          <button class="text-primary font-semibold border-b-2 border-primary pb-1">View Full Calendar</button>
        </div>
        <div class="grid md:grid-cols-4 gap-6">
          <div class="group cursor-pointer">
            <div class="overflow-hidden rounded-xl mb-4">
              <img class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-500" data-alt="woman performing a graceful yoga stretch in a sun-drenched minimalist living room" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCH_no3XEcqpIocMcE6vKmPxtIPm8AVO9-468EC4g6LDBZiBJR_YPImTEv6Puoy8pGsGQy13MY74Ry7vPJX-KxyDG9KnLk-1zfrjS057zePqD6AMWpv2GkKqGBsIvavBlUVKeiboMIF-kcp5dZ8GvXdgMB_rDTHfaXfo3mwC4-hUFpveigXTtTl4wb2dpEE_DRDM001lEJiODbW58cbuLWo5hX2PSgYfj2EUS1YpJlUiRLwgeUMuHTp4hb64iVHj0yNFwurfpY34CDg" />
            </div>
            <div class="flex justify-between items-start">
              <div>
                <h4 class="font-semibold text-lg">Sunset Flow</h4>
                <p class="text-sm text-on-surface-variant">Live • 45 mins</p>
              </div>
              <span class="bg-surface-container text-xs px-2 py-1 rounded">Intense</span>
            </div>
          </div>
          <div class="group cursor-pointer">
            <div class="overflow-hidden rounded-xl mb-4">
              <img class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-500" data-alt="close-up of yoga hands in mudra position with soft natural lighting and warm tones" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBSnu6uT5z5xqD8cEZqXJP9hdOI5ydOGj9-4xi5Af7mC63g61GVtG1HksmQNc-24xSZGhPOg48mUGM_5zZI1h-HGLyDoBC1IzxPFol915dIQpo-6n1K09_4VJqWSChNfxNt8ApvwYu6-SBO27ZbuRjjfCqVqqx5p__ITt96ywpxX1HLCqdnhU_8ml7pJwCKNjgKR20cMmOYgCH0L89Q8psnaA9NBuCubWlB-3CbajY7y5zudn1wpCM4vXuDIXbKzKaAKa2LD6N5SrDp" />
            </div>
            <div class="flex justify-between items-start">
              <div>
                <h4 class="font-semibold text-lg">Pranayama Basics</h4>
                <p class="text-sm text-on-surface-variant">On-Demand • 20 mins</p>
              </div>
              <span class="bg-surface-container text-xs px-2 py-1 rounded">Gentle</span>
            </div>
          </div>
          <div class="group cursor-pointer">
            <div class="overflow-hidden rounded-xl mb-4">
              <img class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-500" data-alt="group of diverse people practicing yoga in a bright open airy studio space" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_N7VlWFveFZlh8qETYzBX0_VHaRcsPUMjKSd4gd_ypnhBxvDxng1F3fviO_rr-v7h9t1U21wr8QIs9_GxvOX_lPirFwkaDfKQP1Y3ZUGn6TyWyFqbUvkSoHfoSNGhNH4Ora7PRQ6jLuBRwxZw1NtchpwXb_iwhE5umNHkhuvYkhSQnhbph8vflx2Lr_bLQ9m3TZxyy4gSnlFfcciSWlBITQxVSl4LX6WOAh_RzebNF6USqPOZKiGp0ajqhQjpEporGqG1E6HEJl0g" />
            </div>
            <div class="flex justify-between items-start">
              <div>
                <h4 class="font-semibold text-lg">Power Vinyasa</h4>
                <p class="text-sm text-on-surface-variant">Live • 60 mins</p>
              </div>
              <span class="bg-surface-container text-xs px-2 py-1 rounded">Advanced</span>
            </div>
          </div>
          <div class="group cursor-pointer">
            <div class="overflow-hidden rounded-xl mb-4">
              <img class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-500" data-alt="serene mountain landscape at dawn with soft mist and golden light for meditation backdrop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxFTN6x79jbwxSHXzU06KltPzngZOS_7Si9UEFYlxVTeaOl_BD6eVVKKqvj6sSw8qfinOSYJp1oX9h_i_o4U7X4wxS47_1W4iKqKu1li_lAUG0CShiFehQ5CXMjaPPvkc-1YM3du92EckyNyHw9rFC6fKSrIkPoPK4fsnYHx4S65SbwphgSKGCKbp15yry_KHVhx3qEtDT4OFmu6VEypGzUVbF2yoKV7u4UodQhwNQq_x0pXmFXDsOiR4FYQzuVVM986k6YkeraLnz" />
            </div>
            <div class="flex justify-between items-start">
              <div>
                <h4 class="font-semibold text-lg">Morning Ritual</h4>
                <p class="text-sm text-on-surface-variant">On-Demand • 30 mins</p>
              </div>
              <span class="bg-surface-container text-xs px-2 py-1 rounded">Moderate</span>
            </div>
          </div>
        </div>
      </div>
    </section> -->



  <section class="mt-5" id="pricing">
    <div>
      <h2 style=" margin:auto;text-align:center;font-family: 'Playfair Display', serif;
    font-size: 38px;
    font-weight: 600;
    color: #2c2c2c;
    line-height: 1.2;">Membership Tiers</h2>
      <p class="font-body-md text-on-surface-variant" style="text-align:center;">Select the path that best supports your practice goals.</p>

      <div class="container py-5">

        <div class="slider-wrapper">

          <!-- Left Button -->
          <button class="scroll-btn left" onclick="scrollLeftbtn()">‹</button>

          <!-- Right Button -->
          <button class="scroll-btn right" onclick="scrollRightbtn()">›</button>

          <!-- Scroll Container -->
          <div class="scroll-container" id="cardContainer">

            <?php
            $query = mysqli_query($conn, "SELECT * FROM membership_plans");

            while ($row = mysqli_fetch_assoc($query)) {
            ?>
              <div class="membership-card">

                <h3><?= $row['title']; ?></h3>

                <p><?= $row['description']; ?></p>

                <p>
                  <span style="
                font-family:'Playfair Display', serif;
                font-size:20px;
                font-weight:700;
                color:#2c2c2c;">
                    ₹<?= $row['price']; ?>/mon
                  </span>
                </p>

                <p>
                  <i class="fa-regular fa-circle-check" style="color:#f57847;"></i>
                  <?= $row['feature1']; ?>
                </p>

                <p>
                  <i class="fa-regular fa-circle-check" style="color:#f57847;"></i>
                  <?= $row['feature2']; ?>
                </p>

                <p>
                  <i class="fa-regular fa-circle-check" style="color:#f57847;"></i>
                  <?= $row['feature3']; ?>
                </p>

                <a href="<?php echo $getStartedLink; ?>"
   class="button"
   style="text-decoration:none;">
   Get Started
</a>

              </div>

            <?php
            }
            ?>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================team======================== -->







  <!--  -->

  <section class="team-section" id="team">
    <div class="container">

      <div class="section-title">
        <h1>Meet Your Guides</h1>
        <p>
          Our instructors are lifelong students of yoga, bringing decades of
          collective wisdom to every class.
        </p>
      </div>

      <div class="team-scroll">

        <?php
        $teacher_query = mysqli_query(
          $conn,
          "SELECT * FROM users WHERE role='teacher'"
        );

        while ($teacher = mysqli_fetch_assoc($teacher_query)) {
        ?>

          <div class="team-card">

            <div class="team-img">
              <img src="images/<?php echo $teacher['image']; ?>" alt="">
            </div>

            <div class="team-content">
              <h3><?php echo htmlspecialchars($teacher['name']); ?></h3>


              <!--  -->
            </div>

          </div>

        <?php } ?>

      </div>

    </div>
  </section>





  <?php
  $blog_query = mysqli_query($conn, "SELECT * FROM `blogs` ORDER BY id DESC LIMIT 4");
  ?>

  <div class="container py-5">
    <header class="d-flex justify-content-between align-items-center mb-5">
      <h1 class="journal-title h2 m-0">The Wellness Journal</h1>
      <!-- <a href="#" class="explore-link">Explore All Insights</a> -->
    </header>

    <div class="blog-scroll">

      <?php while ($row = mysqli_fetch_assoc($blog_query)) { ?>

        <div class="blog-card-wrapper">
          <article class="blog-card">
            <div class="card-img-container mb-3">
              <img src="uploads/blog_image/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
            </div>

            <div>
              <span class="category-tag"><?php echo $row['category']; ?></span>
              <span class="read-time">&bull; <?php echo $row['read_time']; ?></span>

              <h2 class="card-title-custom">
                <?php echo substr ($row['title'] ,0,25).'....'?>
              </h2>

              <p class="card-desc">
                <?php echo substr($row['description'],0,150 ).'....';?>
              </p>

              <a href="blog_details.php?id=<?php echo $row['id'] ;?>" class="read-more-btn">
                Read More <i class="bi bi-box-arrow-up-right"></i>
              </a>
            </div>
          </article>
        </div>

      <?php } ?>

    </div>
  </div>

  <!-- <footer class="py-4 border-top">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-4 text-center text-md-start">
                    <span class="footer-brand d-block mb-1">Yogstra</span>
                    <span>&copy; 2024 Yogstra Wellness. All rights reserved.</span>
                </div>
                
                <div class="col-12 col-md-5 text-center my-3 my-md-0">
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                    <a href="#" class="footer-link">Cookie Policy</a>
                    <a href="#" class="footer-link">Contact Us</a>
                </div>

                <div class="col-12 col-md-3 text-center text-md-end">
                    <a href="#" class="footer-icon-btn" aria-label="Share"><i class="bi bi-share"></i></a>
                    <a href="#" class="footer-icon-btn" aria-label="Email"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
        </div>
    </footer> -->


  <?php
  // include('db_connect.php');
  // session_start();



  if (isset($_POST['submit_feedback'])) {
    // echo $_SESSION['user_id'];
    //   exit;
    $user_id = $_SESSION['student_id'];

    $message = mysqli_real_escape_string($conn, $_POST['message']);

    mysqli_query($conn, "
        INSERT INTO feedback(user_id,message)
        VALUES('$user_id','$message')
    ");

    echo "<script>
            alert('Feedback Submitted Successfully!');
            window.location.href=window.location.href;
          </script>";
  } ?>

  <!-- ================= PREMIUM FOOTER ================= -->

<footer class="yogstra-footer">

    <div class="container">

        <div class="row gy-5">

            <!-- Brand & About -->
            <div class="col-lg-5 col-md-6">

                <div class="footer-brand-box">

                    <img src="assets/image/f4faab5c-a29f-4582-8c93-6be2c62fee75.jpeg"
                         class="footer-logo"
                         alt="Yogstra">

                    <p class="footer-description">
                        At Yogstra, we believe yoga is more than a practice.
                        It is a journey towards balance, mindfulness and a
                        healthier way of living.
                    </p>

                    <div class="footer-social">

                        <a href="#" class="social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#" class="social-btn">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="#" class="social-btn">
                            <i class="fab fa-youtube"></i>
                        </a>

                        <a href="#" class="social-btn">
                            <i class="fab fa-twitter"></i>
                        </a>

                    </div>

                </div>

            </div>


            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">

                <h5 class="footer-heading">
                    Quick Links
                </h5>

                <ul class="footer-links">

                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li>
                        <a href="#aboutus">About Us</a>
                    </li>

                    <li>
                        <a href="#services">Services</a>
                    </li>

                    <li>
                        <a href="#pricing">Membership</a>
                    </li>

                    <li>
                        <a href="#team">Our Teachers</a>
                    </li>

                </ul>

            </div>


            <!-- Support -->
            <div class="col-lg-2 col-md-6">

                <h5 class="footer-heading">
                    Support
                </h5>

                <ul class="footer-links">

                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>

                    <li>
                        <a href="#">Terms of Service</a>
                    </li>

                    <li>
                        <a href="#">Cookie Policy</a>
                    </li>

                    <li>
                        <a href="#">Help Center</a>
                    </li>

                    <li>
                        <a href="#">Contact Us</a>
                    </li>

                </ul>

            </div>


            <!-- Contact -->
            <div class="col-lg-3 col-md-6">

                <h5 class="footer-heading">
                    Get In Touch
                </h5>

                <div class="footer-contact">

                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <span>
                            Yogstra Wellness Center
                        </span>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <span>
                            support@yogstra.com
                        </span>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <span>
                            +91 98765 43210
                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- Bottom Footer -->

        <div class="footer-bottom">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <p class="copyright">
                        © 2024 Yogstra Wellness.
                        All rights reserved.
                    </p>

                </div>

                <div class="col-md-6 text-md-end">

                    <span class="made-with">
                        Made with
                        <i class="fa-solid fa-heart"></i>
                        for a healthier life
                    </span>

                </div>

            </div>

        </div>

    </div>

</footer>




  <!-- <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
    function scrollRightbtn() {
      const container = document.getElementById("cardContainer");
      container.scrollBy({
        left: 300,
        behavior: "smooth"
      });
    }

    function scrollLeftbtn() {
      const container = document.getElementById("cardContainer");
      container.scrollBy({
        left: -300,
        behavior: "smooth"
      });
    }
  </script>





</body>

</html>