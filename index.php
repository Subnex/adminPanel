<?php

require_once __DIR__ . '/indexCls.php';
$indexClsObj = new indexCls();
$search='';
$faqList = $indexClsObj->getAllFAQ($search);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"> 
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SubNex</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="site_assets/img/favicon.png" rel="icon">
  <link href="site_assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="site_assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="site_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="site_assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="site_assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="site_assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="site_assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="site_assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <!-- Template Main CSS File -->
  <link href="site_assets/css/style.css" rel="stylesheet">
  <style>

    .popup {
      background: white;
      /*padding: 20px;*/
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
      min-width: 700px;
      max-width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top:90px;
            min-height: 550px;
            max-height: 750px;
            overflow: auto;
            font-family: sans-serif;
    }
   
        h1, h2 {
            color: #0056b3;
        }
        ul {
            padding-left: 20px;
        }
        #termAndCondition {
        display: none; /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
        backdrop-filter: blur(5px); /* Blur effect */

      }
      #aboutUs {
        display: none; /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
        backdrop-filter: blur(5px); /* Blur effect */

      }
      #privacyPolicy {
        display: none; /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
        backdrop-filter: blur(5px); /* Blur effect */

      }
      .closepopupCss
      {
        position: fixed;
        margin-left: 85%;
      }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <a href="index.html" class="logo me-auto"><img src="site_assets/img/SubNexLogo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link   scrollto" href="#portfolio">Portfolio</a></li>
         <!-- <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
          <!--<li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" target="_blank" href="/finalwork/console/login.php">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">


     




    <div class="container">
    <div class="row">


  <!--  <div class="container">
        <h2>Carousel Example</h2>  
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

        
          <div class="carousel-inner">
            <div class="item active">
              <img src="site_assets/img/portfolio/gamingConsole.png" alt="Los Angeles" style="width:100%;height:200px;">
            </div>

            <div class="item">
              <img src="site_assets/img/portfolio/medical.png" alt="Chicago" style="width:100%;height:200px;">
            </div>
          
            <div class="item">
              <img src="site_assets/img/fitness.png" alt="New york" style="width:100%;height:200px;">
            </div>
          </div>

        
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
     -->
   


      <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h5>
          We're thrilled to have you here. <b>SubNex</b> is designed to make your renting experice easier by showing you a lots of products are available your near by for renting. Whether you’re looking to RENT OUT or List OUT someting, SubNex is a right place for you. 

        </h5><br/>
        <h5>Explore our features, and let us know how we can help you get the most out of SubNex. Download the app right now. Happy Renting.</h5>
        <br/><br/>
        <div class="d-flex justify-content-center justify-content-lg-start">
          <a href="https://play.google.com/store/apps?hl=en_IN"  target="_blank"><img src="site_assets/img/gpstore.png" class="img-fluid " alt="" height="50px" width="150px" ></a>
          <a href="https://www.apple.com/in/app-store/" target="_blank"><img src="site_assets/img/appstore1.png" class="img-fluid " height="50px" width="150px" alt="" style="margin-top:-8%;">  </a> 
         
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="100">
        <img src="site_assets/img/comingsoon.png" class="img-fluid animated" alt="">
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Skills Section ======= -->
   <!-- <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="site_assets/img/skills.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>

            <div class="skills-content">

              <div class="progress">
                <span class="skill">HTML <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">CSS <i class="val">90%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">JavaScript <i class="val">75%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Photoshop <i class="val">55%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section> --><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p> Elevate your digital presence with our comprehensive mobile app services. <b>SubNex</b> is a platform where user can 
             enhance user experiences of renting application and drive individual/business success. Whether you're looking 
             to list out a product for renting or looking to rent out some product on temprory basis, <b>SubNex</b> is a one place 
             to fullfill all your needs.</p>
          </div>

        <div class="row">
          <div class="serviceSecCss col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon">
              <img src="site_assets/img/home-appliance.png" class="img-service" alt="" height="50px" width="50px">
              </div>
              <h4><a href="">Electronics</a></h4>
              <p>Got home appliances you no longer need? Whether it's a microwave, coffee maker, vacuum cleaner, or a like-new air fryer, now’s the perfect time to list it and make some extra cash!
                Connect with people in your area who are looking for quality home appliances at great prices.Connect with people in your area who are looking for quality home appliances at great prices.
              </p>
            </div>
          </div>

          <div class="serviceSecCss col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><img src="site_assets/img/books.png" class="img-service" alt="" height="50px" width="50px"></div>
              <h4><a href="">Education</a></h4>
              <p>Whether it’s novels, poetry collections, textbooks, or study guides, your books deserve a new reader! List your items here and connect with people looking for their next great read or essential study resource. 🌟
                Upload photos and a brief description on SubNex, and your listing is ready in minutes!
                Turn your unused books into extra cash while freeing up space on your shelves.
              </p>
            </div>
          </div>

          <div class="serviceSecCss col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"> <img src="site_assets/img/camping.png" class="img-service" alt="" height="50px" width="50px"></div>
              <h4><a href="">Camping</a></h4>
              <p>Do you have extra camping or trekking gear that’s not being used? From tents and sleeping bags to backpacks and hiking boots, give your gear a new adventure by listing it here! 🌲
                Creating a listing is easy—just snap a few photos, add details, and you’re ready to go.Make space at home and turn unused items into cash instead of letting them sit in storage.
              </p>
            </div>
          </div>
          <div style="height:20px;"></div>
          <div class="serviceSecCss col-xl-3 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon">
                <img src="site_assets/img/sports.png" class="img-service" alt="" height="50px" width="50px">
                <!--<i class="bx bx-layer"></i> -->
              </div>
              <h4><a href="">Sports</a></h4>
              <p>Whether you have a pair of barely-used sneakers, a premium cricket bat, or a set of golf clubs, this is your chance to find them a new home and make some cash!
                Listing takes just a few taps. Upload photos, add a description, and you're done!Clear out unused items and turn them into money instead of letting them gather dust.
              </p>
            </div>
          </div>

          
          <div class="serviceSecCss col-xl-3 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon">
                <img src="site_assets/img/freelancer.png" class="img-service" alt="" height="50px" width="50px">
                <!--<i class="bx bx-layer"></i> -->
              </div>
              <h4><a href="">Freelancing</a></h4>
              <p>Are you a freelancer looking to connect with clients? Whether you specialize in graphic design, web development, content writing, digital marketing, or any other service, this platform is the perfect place to showcase your skills and grow your business. 🌟
                Connect with people actively searching for skilled professionals like you.Creating a profile and listing your services is quick and straightforward. Just add your skills, experience, and portfolio to get started.
              </p>
            </div>
          </div>

          <div class="serviceSecCss col-xl-3 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon">
                <img src="site_assets/img/portfolio/medical.png" class="img-service" alt="" height="50px" width="50px">
                <!--<i class="bx bx-layer"></i> -->
              </div>
              <h4><a href="">Medical Equipment</a></h4>
              <p><!--You can list out your music equipments ie. Music system, Portable Speaker ,Headphones for renting on temprory basis. Your near one is might looking for these equipments on temprory basis and might be he interested to rent out.-->

                Whether you’re a healthcare provider, clinic, or individual looking to sell or rent medical equipment, 
                SubNex is the perfect platform for you.Connect with peoples and healthcare professionals actively seeking quality medical devices to rent out.
                Posting your items takes just a few minutes. Upload photos, provide details, and start renting!
              </p>
            </div>
          </div>

          <div style="height:20px;"></div>
          <div class="serviceSecCss sscol-xl-3 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon">
                <img src="site_assets/img/travel.png" class="img-service" alt="" height="50px" width="50px">
                <!--<i class="bx bx-layer"></i> -->
              </div>
              <h4><a href="">Travel</a></h4>
              <p>Do you have travel essentials like suitcases, backpacks, bike helmets or travel accessories sitting unused? List them here and connect with travelers eager to gear up for their next journey! 🏝️.
                In just a few minutes, you can upload photos and details to showcase your items.Free up space at home while turning your unused items into extra cash.
              </p>
            </div>
          </div>

          
          <div class="serviceSecCss col-xl-3 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon">
                <img src="site_assets/img/fitness.png" class="img-service" alt="" height="50px" width="50px">
                <!--<i class="bx bx-layer"></i> -->
              </div>
              <h4><a href="">Fitness</a></h4>
              <p>Got fitness gear gathering dust? Whether it’s dumbbells, yoga mats, treadmills, or resistance bands, list your equipment and connect with people looking to upgrade their home gym. 🏠💪
                Connect with buyers actively searching for quality exercise gear.Free up space and make extra cash while helping someone else kickstart their fitness journey.
              </p>
            </div>
          </div>

          <div class=" serviceSecCss col-xl-3 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon">
                <img src="site_assets/img/gaming.png" class="img-service" alt="" height="50px" width="50px">
                <!--<i class="bx bx-layer"></i> -->
              </div>
              <h4><a href="">Gaming</a></h4>
              <p><!--You can list out your music equipments ie. Music system, Portable Speaker ,Headphones for renting on temprory basis. Your near one is might looking for these equipments on temprory basis and might be he interested to rent out.-->

                Got an extra gaming console you’re not using? Whether it’s a PlayStation, Xbox, Nintendo Switch, or a retro classic, list it now and connect with gamers who can’t wait to play! 🕹️💸
                upload photos, add a description, and you’re good to go!.Connect with a community of gaming enthusiasts actively searching for their next console.
              </p>
            </div>
        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>Welcome to our curated collection of household items, where function meets style and quality. 
            Our portfolio showcases a diverse range of products available for rent to enhance your home or events with 
            practicality and elegance. From Household, Sports, Electronics, Consulting , outing and many more.. 
             we offer solutions that blend seamlessly into any lifestyle with ease and in budget.</p>
        </div>

       <!-- <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">Electronics</li>
          <li data-filter=".filter-card">Camping</li>
          <li data-filter=".filter-web">Sports</li>
          <li data-filter=".filter-web">Medical</li>
          <li data-filter=".filter-web">Multimedia</li>
        </ul>
    -->
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/gamingConsole.png" class="img-fluid" alt=""></div>
           
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/bp_machine.jpg" class="img-fluid" alt=""></div>
           
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/soundbar.webp" class="img-fluid" alt=""></div>
           
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/guitar.jpeg" class="img-fluid" alt=""></div>
            
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/waveline.png" class="img-fluid" alt=""></div>
            
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/voccume_cleaner.webp" class="img-fluid" alt=""></div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/cycle.jpg" class="img-fluid" alt=""></div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-img"><img src="site_assets/img/portfolio/printer.png" class="img-fluid" alt=""></div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
           
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/camping1.png" class="img-fluid" alt=""></div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/oxygen.png" class="img-fluid" alt=""></div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="site_assets/img/portfolio/trolley_bag.jpg" class="img-fluid" alt=""></div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <!--<section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="site_assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
              <div class="pic"><img src="site_assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
              <div class="pic"><img src="site_assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
              <div class="pic"><img src="site_assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> --><!-- End Team Section -->

   

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Welcome to our curated collection of household items, where function meets style and quality. Our portfolio showcases a diverse range of products available for rent to enhance your home or events with practicality and elegance. From Household, Sports, Electronics, Consulting , outing and many more.. we offer solutions that blend seamlessly into any lifestyle with ease and in budget.</p>
        </div>

        <div class="faq-list">
          <ul>
            <?php $index =0; $totalRecords = count($faqList);  while ($index < $totalRecords): $row = $faqList[$index] ; $index++?>
          
          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1"><?php echo $row['question']?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p>
              <?php echo $row['answer']?>
              </p>
            </div>
          </li>
          <?php endwhile; ?> 

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact Us</h2>
          <p>Got questions, feedback, or just want to say hi? Our team is here to help! Reach out to us and we’ll get back to you as soon as possible. Your thoughts and inquiries are important to us.</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>Noida Extention <br>
                    Uttar Pradesh<br>
                    India</p>
                </div>

                <div class="email">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>dev@subnex.in</p>
                </div>

                <div class="phone">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+91-9718614760</p>
                </div>

              <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                -->
           
              </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form id="contactUsForm"  method="post" role="form" class="php-email-form">
           
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
               
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
              <div class="message" id="responseMessage"></div>
              <script> 
                  $(document).ready(function () {
                    $('#contactUsForm').on('submit', function (event) {
                     
                        event.preventDefault(); // Prevent default form submission
                        $.ajax({
                        url: 'contactUs.php',
                        type: 'POST',
                        data: $(this).serialize(), // Serialize form data
                        success: function (response) {
                            $('#responseMessage').text(response).removeClass('error').addClass('success');
                           $('#contactUsForm')[0].reset(); // Clear the form
                          //alert(response);
                        },
                        error: function () {
                           $('#responseMessage').text('An error occurred. Please try again.').removeClass('success').addClass('error');
                         // alert('fail');
                        }
                      
                    });
                });
              });

              </script>
            </form>
          </div>

        </div>
       

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <!--<div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Don’t miss out on the latest updates, exclusive content, and special offers. Join our newsletter and be the first to know what’s happening. Sign up now for a dose of inspiration, news, and insights delivered straight to your inbox!</p>
           
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
            -->
    <div class="footer-top">
    <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>DeltaSolver Services Pvt. Ltd.</h3>
            <p>
              Noida Extention <br>
              Uttar Pradesh<br>
              India<br><br>
              <strong>Phone:</strong> +91-8882383921<br>
              <strong>Email:</strong> dev@subnex.in<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#" onclick="openAboutUs();return false;">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#" id="termsAndCondition" onclick="openTerms();return false;" >Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#" onclick="openPrivacyPolicy();return false;">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Renting</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Brand Promotion</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Freelancing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 s">
            <h4>Our Social Networks</h4>
            <p>Connect with us on social media and be part of our growing community! Follow us for the latest updates, behind-the-scenes content, and interactive conversations. Let’s stay connected and share the journey together!</p>
            <div class="social-links mt-3">
              <!--<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> 
              -->
              <a href="https://www.facebook.com/profile.php?id=61569192090756" target="_blank" style="background: none;"><img src="site_assets/img/facebook.png" style="height: 25px;width:25px;    border-radius: 5px;"/></a>
              <a href="https://www.instagram.com/subnexofficial/" target="_blank" style="background: none;"><img src="site_assets/img/instagram.png" style="height: 30px;width:30px;    border-radius: 5px;" /></a>
              <a href="#"  style="background: none;"><img src="site_assets/img/linkedin.png" style="height: 25px;width:25px;    border-radius: 5px;" /></a>
            
            </div>
          </div>

        </div>
      </div>
    </div>
    
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright '2024 <strong><span>Deltasolver Services Pvt. Ltd</span></strong>. All Rights Reserved
      </div>
    </div>
    
    <div id="privacyPolicy" style="display:none;" class="editFormDiv overlay">
               
        <div class="popup">
          <a class="closepopupCss" href="#" onclick="closePrivacyPopup();return false;" >close</a>
              <h2>Privacy Policy for SubNex</h2>
              <span>Effective Date: 01/11/2024</span> 

          <h1>1.Introduction</h1>
            <p>Welcome to <b>Subnex</b>,We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our mobile application <b>Subnex</b>.
            </p>
          
            <h2>2.Information We Collect</h2>  
            <ul>
               
                <li><b>Personal Information:</b> We may collect personal information that you voluntarily provide to us, such as your name, email address, phone number, and product  information.</li>
                <li><b>Usage Data:</b> We collect information about how you interact with our app, including your IP address, device type, operating system, app version, and usage patterns.</li>
                <li><b>Location Data:</b> If you permit the app to access your location, we may collect information about your geographical location.</li>
            </ul>
            <h2>3.How We Use Your Information    </h2>
                <p>We use your information for various purposes, including:</p>
                <ul>
                  <li>Providing and maintaining our app.</li>
                  <li>Processing transactions and managing your Deals.</li>
                  <li>Communicating with you, including sending notifications and updates.</li>
                  <li>Improving our app and services</li>
                  <li>Analyzing app usage and trends
                  </li>
                  <li>Complying with legal obligations
                  </li>
                 
                </ul>
              
            <h2>4.How We Share Your Information</h2>  
            <p>We do not sell, trade, or otherwise transfer your personal information to outside parties except in the following cases:</p>
            <ul>
               
                <li><b>With Service Providers:</b> We may share information with third-party service providers who assist us in operating our app and providing services to you.</li>
                <li><b>For Legal Reasons:</b> We may disclose your information if required to do so by law or in response to valid requests by public authorities.
                </li>
                <li><b>Business Transfers: </b> In the event of a merger, acquisition, or sale of assets, your information may be transferred to the new entity.
                </li>
            </ul>
            <h2>5.Data Security</h2>  
            <p>We implement reasonable security measures to protect your personal information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is completely secure, so we cannot guarantee absolute security.</p>
            <h2>6.Your Rights</h2>  
            <p>Under Indian law, you have the following rights regarding your personal information:</p>
            <ul>
               
                <li><b>Access:</b> You can request access to the personal information we hold about you.</li>
                <li><b>Correction:</b> You can request correction of any inaccurate or incomplete information.
                </li>
                <li><b> Deletion: </b> You can request deletion of your personal information, subject to certain legal obligations.
                </li>
                <li><b> Opt-Out: </b> You can opt-out of receiving promotional communications from us.
                </li>
            </ul>
            <h2>7.Changes to This Privacy Policy</h2>  
            <p>We may update this Privacy Policy from time to time. We will notify you of any significant changes by posting the new policy on our app and updating the effective date. We encourage you to review this policy periodically to stay informed about how we are protecting your information.</p>
            
            <h2>8.Contact Us</h2>  
            <p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:info@subnex.com.</p>
            <h2>Address:</h2>
            <p><h3>Deltasolver Services Private Limited</h3></p>
            <p>1825/17F, SKA Green Arch, Sector-16B, Greater Noida, Gautam Buddha Nagar- 201318, Uttar Pradesh<br>
Email :info@subnex.com<br/>
Mobile :+91-9718614760
</p>
       
          </div>
    </div>




    <div id="aboutUs" style="display:none;" class="editFormDiv overlay">
               
        <div class="popup">
          <a class="closepopupCss" href="#" onclick="closeaboutPopup();return false;" >close</a>
          <h1>Vision</h1>
            <p>At <b>SubNex</b>, we envision a world where ownership is optional, and access is effortless. We aim to transform how people use everyday items by creating a thriving, sustainable rental ecosystem.
            </p>
          
            <h2>Mission</h2>  
            <p>
            At <b>SubNex</b>, our mission is to simplify access to everyday needs by creating a seamless platform for temporary rentals. Whether it’s a home appliance, sports equipment, or travel essentials, we connect people to the items they need, when they need them, without the burden of ownership.
            </p>  
            <h2>About Us</h2>

            <p>Welcome to SubNex, your go-to platform for renting anything, anytime! We are dedicated to making life simpler by offering a seamless, reliable, and affordable way to access everyday items without the hassle of ownership.
                Whether you need a home appliance, fitness equipment, camping gear, or the latest gadgets, our app connects you to a wide range of items available for temporary rental. 
            </p>
            <ul>
                What We Offer
                <li>Convenience: Find and rent what you need with just a few taps.</li>
                <li>Affordability: Enjoy access to premium items without the cost of buying.</li>
                <li>Sustainability: Reduce clutter and waste by embracing a sharing economy.</li>
                <li>Community: Build trust and connections with verified users in your near by.</li>
            </ul>
          
            <p>At <b>SUBNEX</b>, we believe in providing solutions that are flexible, eco-friendly, and community-driven. Join us in transforming the way we share, use, and experience the things we need every day. 
            </p>
            <b>Website  :</b><a href="https://www.subnex.in">www.subnex.in</a><br/>
            <b>Facebook  : -</b><a href="https://www.facebook.com/profile.php?id=61569192090756">Facebook</a><br/>
            <b>Instagram  :</b><a href="https://www.instagram.com/subnexofficial">Instagram</a><br/>
           <!-- <b>Twitter URL -</b><a href="https://www.subnex.in">www.subnex.in</a>
            <b>Linkedin URL -</b><a href="https://www.subnex.in">www.subnex.in</a> -->
        </div>
    </div>
              <!-- term and condition  -->
    <div id="termAndCondition" style="display:none;" class="editFormDiv overlay">
               
      <div class="popup">
      <a class="closepopupCss" href="#" onclick="closePopup();return false;" >close</a>
              <h1>Terms and Conditions</h1>
        <p>Last Updated: November 22, 2024</p>
        <p>
        Welcome to SubNex, These are the Terms and Conditions administering your utilization of the Website ("hereinafter referred to as 
        Acceptable Use Policy "AUP"). By getting to SubNex either through the website or some other electronic gadget, you recognize, 
        acknowledge and consent to the accompanying terms of the AUP, which are intended to ensure that SubNex works for everybody. 
        This AUP is compelling from the time you sign in to SubNex. By tolerating this AUP, you are likewise tolerating and consenting to be
         limited by the Privacy Policy and the Listing Policy. 
        </p>
        <h2>1. Using SubNex</h2>  
        <p>
        You agree and understand that SubNex app is a technology-enabled electronic platform that facilitates communication for advertising 
        information about products and services. You further agree and understand that we do not endorse, market, or guarantee any of the 
        Products or Services nor do we at any point in time come into possession of or engage in the distribution of any of the products or 
        services you have posted, listed or provided information about the same on our site. While interacting with other users on our site, 
        with respect to any Ad listing, posting, or information we strongly encourage you to exercise reasonable diligence as you would in 
        traditional offline channels and practice judgment and common sense before renting or renting out any products or hiring or getting 
        hired for any services or exchange of information. While making use of SubNex classifieds and other services such as the discussion 
        forums, comments and feedback, and other services inter alia, you will post in the appropriate category or area and you agree that 
        your use of the site shall be strictly governed by this AUP including the policy for listing of your Classifieds which shall not 
        violate the prohibited and restricted items policy hereinafter referred to as the "Ad Posting Policy" which is defined in detail below.

        </p>  
        <h2>2. Use of the Service</h2>
        <ul>
            <li>You must be at least 18 years old to use this service.</li>
            <li>You agree not to misuse or exploit the platform in any way.</li>
        </ul>
        <h2>3. SubNex ID</h2>
        <p>On successful login, System will allot a 6 digit Numeric ID ,which will be issued to you without rental cost. 
        </p>
        <ul>
            <li>Your SubNex id will remain with you forever and it will act as your identification on SubNex APP.</li>
            <li>Anyone can search you by entering the SubNex ID on the search bar on Android/iOS app will  display only the Ads pertaining to that corresponding SubNex ID.</li>
        </ul>
        <h2>2. Ad Posting Policy</h2>
        <p>For use of our app and other services, you confirm and declare that you shall not list or post or provide information in relation
             to the Rental or exchange of products and services, content or information that are illegal under the laws of the 
             Republic of India are not permitted as per the prohibited items policy listed below. 
        </p>
        <h2>2A. Ad/Banners Posting, information, Advertisement</h2>
        <p> Shall not be defamatory, trade libelous, unlawfully threatening, or unlawfully harassing. Further shall not be fraudulent, 
            misrepresenting, misleading, or pertaining to the promotion of any illegal, counterfeit, stolen products and or services which 
            do not belong to you or you do not have the authority for. Further still shall not infringe any intellectual property, 
            trade secret, or other proprietary rights or rights of publicity or privacy of any third party.</p>
        <ul>
            <li>"Pyramid schemes" and "Multilevel Marketing" and or similar scams which are solely listed for the purpose of defrauding users. </li>
            <li>Any kind of promotion or sale of any commodity or any product.</li>
        </ul>
        <p>Shall not be allowed to libel anyone or include hate, derogatory, slanderous speech directed at individuals or groups. You should not advocate violence against other users or individuals or groups.
        </p>
        <h2>2B. Prohibited Items Policy </h2>
        <p>SubNex specifically prohibits any listing or posting of classifieds or information in relation to the following items.      </p>
        <ul>
            <li>
            Alcoholic Beverages, Liquor, tobacco products, drugs, psychotropic substances, narcotics, intoxicants of any description, medicines, palliative/curative substances nor shall you provide link directly or indirectly to or include descriptions of items, products or services that are prohibited under any applicable law for the time being in force including but not limited to the Drugs and Cosmetics Act, 1940, the Drugs and Magic Remedies (Objectionable Advertisements) Act, 1954 Narcotic Drug and Prohibited Substances Act and the Indian Penal Code, 1860.
            </li>
            <li>Dead person and/or the whole or any part of any human which has been kept or preserved by any means whether artificial or natural including any blood, bodily fluids and/ or body parts.</li>
            <li>Dead creatures and/or the whole or any part of any animal which has been kept or preserved by any means whether artificial or natural including rugs, skins, specimens of animals, antlers, horns, hair, feathers, nails, teeth, musk, eggs, nests, other animal products of any description the sale and purchase of which is prevented or restricted in any manner by applicable laws (including those prohibited under The Wildlife Protection Act, 1972 and or The Environment Protection Act, 1986)
            </li>
            <li>Prostitution or any other service in nature there purports to violate the provisions of Immoral Act or Indecent representation of women which violates the contemporary standards of morality and decency in Indian society.
            </li>
            <li>Idols of any religion belong to Temples/Religious institutions, artifacts, etc., or any information, description of any such item that is likely to affect the religious sentiments of any person or group.</li>
            <li>Mature Audiences Policy includes films that do not have a certificate for public exhibition issued by the Central Board of Film Certification and or described and depict or otherwise deal with matters which are revolting or repulsive and or tend to deprave a person mind in such a way that they tend to offend against the standards of morality, decency and propriety generally accepted by reasonable adults.</li>
            <li>Obscene Items include items that contain an indecent representation of women within the meaning of the Indecent Representation of Women (Prohibition) Act, 1986. Any publication or film or item that describes or depicts a minor who is, or who appears to be, under 18 (whether the minor is engaged in sexual activity or not) and any computer games not suitable for minors to see or play.  
            </li>
            <li>Offensive Material intended for use in a sexual setting (including "bondage" and "fetish" items,) displaying sexual activity or portraying human genitalia in a "life-like" or realistic fashion.</li>
            <li>"Antiquities" and "Art Treasures" in violation of the provisions of the Antiquities and Art Treasures Act, 1972 ("the Act").
            </li>
            <li>Products or Services that are defamatory, libelous, threatening, or abusive in nature.  
            </li>
            <li>Fraudulent information, misrepresenting the nature and use of the products or the services.  
            </li>
            <li>Counterfeit, Pirated, and stolen products or unauthorized illegal services (services for which you are not licensed or permitted to do or do not have the authority to undertake).</li>
            <li>Products and services that infringe or attempt to pass off any third party's intellectual property or rights of publicity or moral rights and/ purports to breach any person's right to privacy.
            </li>
            <li>Electronically transmitting through any medium computer viruses of any type or any computer program that facilitates hacking of a computer system with the intent to damage a computer or computer network or intercept any personal data.</li>
            <li>Your Ad post shall not include any hate content, that is derogatory or slanderous in nature that may be directed to any individual or group or advocate violence against any users’ individuals and or animals.
            </li>
            <li>Hazardous chemicals and pesticides and/ or items in violation of Hazardous Chemicals Act, 1985.</li>
            <li>Destructive Devices and Explosives including any material that enables the triggers blast and explosive devices.
            </li>
            <li>Identity Documents, Personal Financial Records & Personal Information (in any form, including mailing lists).
            </li>
            <li>"Securities" within the meaning of the Securities Contract Regulation Act, 1956, including shares, bonds, debentures, etc., and/or any other financial instruments/assets of any description.</li>
            <li>Products listed in violation of the Food Adulteration Act, 1954.
            </li>
            <li>Government emblems, insignia, and/ or items in violation of Emblems and Names (Prevention of improper use) Act, 1950 and/ or Flag Codes of India Act, 2002.</li>
            <li>Weapons and related items (such as firearms, firearm parts, and magazines, ammunition, tear gas, stun guns, switchblade knives), or any other item which is prohibited under the Indian Arms Act, 1959.
            </li>
            <li>Spam, abusive, duplicate, listing, fraud schemes (e.g. "Get rich" "Double the Money" scams which are solely listed to dupe users).
            </li>
            <li>Shall not contain any viruses, Trojan horses, worms, time bombs, cancelbots, easter eggs, or other computer programming routines that may damage, detrimentally interfere with, surreptitiously intercept or expropriate any system, data, or personal information.
            </li>
        </ul>
        <h2>2C. Chat Functionality and Internal Communication Features</h2>
            <h3>2C.1. Permitted Uses</h3>
            <p>SubNex offers a communication platform (with "Chat Functionality") to facilitate strictly business-related communication between users regarding products or services listed on the platform. Users may utilize the Chat Functionality to:
                </p>
                <ul>
                    <li>Send text messages.</li>
                    <li>Share files (subject to size and type limitations as defined by SubNex).</li>
                    <li>Share audio notes (limited to a maximum of three (3) minutes per note).</li>
                    <li>Share contact information (telephone number only).</li>
                  
                </ul>
            <h3>2C.2. User Conduct and Prohibited Content</h3>
            <p>Users are solely responsible for the content they transmit through the Chat Functionality. SubNex prohibits the following within the Chat Functionality:</p>
            <ul>
                <li>Content that violates SubNex's Terms of Service, including, but not limited to, content that is:
                    <ul>
                    <li>Defamatory, harassing, threatening, hateful, abusive, or invasive of another user's privacy.</li>
                    <li>Obscene, indecent, or sexually suggestive.</li>
                    <li>Infringing on any intellectual property rights.</li>
                    <li>Illegal or promotes illegal activity.</li>
                    </ul>
                </li>
                <li>Spam or unsolicited commercial communications.</li>
                <li>False or misleading information.</li>
            </ul>
            <h3>2C.3. Data Retention and Privacy</h3>
                <p>Chat messages are retained for a maximum period of ninety (90) days. User-deleted messages are permanently removed from SubNex's servers within thirty (30) days.
                </p>
                <p>SubNex does not access the content of user chats, except for limited purposes such as investigating reports of violations of this Agreement or as required by law.</p>
            <h3>2C.4. Reporting and Blocking</h3>
            <p>Users are encouraged to report any inappropriate or prohibited content encountered within the Chat Functionality. SubNex reserves the right to investigate all reports and take appropriate action, which may include suspending or terminating a user's account.</p>
            <p>Users may also block other users from contacting them through the Chat Functionality.</p>
            <h3>2D.5: Others</h3>
                <p>In addition to the above and for the purposes of clarity, all Users shall be expected to adhere to and comply with the following Policies while listing items.
                </p>
                <ul>
                    <li>Restricted Item Policy: In addition to the above-prohibited items policy users shall also adhere to and comply with the restricted items policy while listing, posting or providing information in relation to any products or services.</li>
                    <li>Duplicate Ad listings are not allowed. Any ad posted more than once with the same content or Title in the same city and category would be considered as a Duplicate Ad. We advise you to post multiple ads only if you have different items for rent or different services for hire. All duplicate ads would be deleted and posters penalized if the problem persists.
                    </li>
                    <li>Mature Audience/Sexually oriented material: Classifieds relating to items that include items intended for use in sexual activity would not be permitted. (Examples of such classifieds relating to an item not normally permitted would be classified as “Sex toys for Rent”).
                    </li>
                   
                </ul>
            <h2>3 :Consequences of Breach of Listing Policy</h2>
            <p>Users who violate the prohibited items policy and or the restricted items policy may be subject to the following actions
            </p>
            <ul>
                <li>Suspension or termination of SubNex ID/membership.
                </li>
                <li>Permanent blocking of access to the site/app.
                </li>
                <li>Reporting to Law Enforcement or Appropriate Authorities.
                </li>    
            </ul>
            <h3>3A</h3>
            <p>"Your Information" is defined as any information you provide to us or other users of the Site during the registration, posting, listing, or replying process of classifieds, in the feedback area (if any), through the discussion forums or in the course of using any other feature of the Services. You agree that you are the lawful owner having all rights, title, and interest in your information, and further agree that you are solely responsible and accountable for Your Information and that we act as a mere platform for your online distribution and publication of Your Information.</p>
            <h3>3B:You agree that your Ad listing, posting, and/or Information</h3>
                <ul>
                <li>Shall not be fraudulent, misrepresent, mislead or pertain to the sale of any illegal, counterfeit, stolen products and/or services.
                </li>
                    <li>Shall not pertain to Products or Services of which you are not the lawful owner or you do not have the authority or consent to 'list' which do not belong to you or you do not have the authority for.</li>
                    <li>Shall not infringe any intellectual property, trade secret, or other proprietary right or rights of publicity or privacy of any third party.
                    </li>
                    <li>Shall not consist of material that is an expression of bigotry, racism, or hatred based on age, gender, race, religion, caste, class, lifestyle preference, and nationality and/or is in the nature of being derogatory, slanderous to any third party.
                    </li>
                    <li>Shall not be obscene, contain pornography, or contain “indecent representation of women” within the meaning of the Indecent Representation of Women (Prohibition) Act, 1986.</li>
                    <li>Shall not distribute or contain spam, multiple / chain letters, or pyramid schemes in any of its forms.</li>
                    <li>Shall not distribute viruses or any other technologies that may harm SubNex or the interests or property of SubNex users or impose an unreasonable load on the infrastructure or interfere with the proper working of SubNex.
                    </li>
                    <li>Shall not, directly or indirectly, offer, attempt to offer, trade, or attempt to trade in any products and services, the dealing of which is prohibited or restricted in any manner under the provisions of any applicable law, rule, regulation, or guideline for the time being in force.
                    </li>
                    <li>Shall not list or post or pertain to information that is either prohibited or restricted under the laws of the Republic of India and such listing, posting or information shall not violate SubNex's Ad Posting Policy.</li>
                    <li>You consent to receive communications by email, SMS, call, or by such other mode of communication, electronic or otherwise related to the services provided through the website.
                    </li>
                    

                </ul>
                <p>You agree that your Ad listing, posting, and/or Information: If you are registering on the Website/App, you are responsible for maintaining the confidentiality of your User ID, password, email address and for restricting access to your computer, computer system, computer network, and your SubNex account, and you are responsible for all activities that occur under your User ID and password. If you access the Site using any electronic device other than by registration on the Site, the AUP remains applicable to you in the same manner as if you are a registered user on the Site.</p>
               <h3>3c.Value Added Services</h3>     
               <p>SubNex has few value-added services for the users who want to promote their Products or Service to get special attention from the viewers as well as to receive more business inquiries. The value-added services are optional and SubNex never urges any user to avail the facility any time.</p>
                <p>SubNex reserves the complete rights to edit, modify, remove or introduce new value-added services in the future.</p>  
                <p>be issued to you without rental cost. You will have the rights to rent a fancy ID </p>  
                <h3>4A. Banner Promotions</h3>
                <ul>
                    <li>Individual or Business entities indulging in Rental Products or Freelancing Services can promote their business by obtaining the Banner space by paying the fixed cost.
                    </li>
                    <li>Banners can be created for future dates only that is from the next day onwards to a maximum of 30 days.
                    </li>
                    <li> Individual Users or Business entities having a minimum of one valid live ad can only create Banner advertisements.</li>
                    <li>Banners will be visible to all users logging in to the Application/Website from the respective cities for which the Banner was hoisted by the advertiser.</li>
                    <li>The cost of the Banner will be different for each city and SubNex holds the full rights over the rental fee of the Banner for respective cities.
                    </li>
                    <li>Individuals or Companies can only Promote the Business and relevant details on Banners and SubNex holds the authority to edit, modify and remove the content as per the Ad posting policy in section 2.</li>
                    <li>Company Logo or Products image of the respective advertiser will only be published, photos of any person will not be allowed on the Banner.</li>
                    <li>SubNex holds the authority to publish or reject any banners based on the guidelines mentioned in sections 2 and 2A.</li>
                    <li>Banner posted for the particular day will be auto hoisted by the system and the user has rights to edit the content as well as to deactivate the Banner by his will. The rental fee paid for the Banner is not entitled to be refunded on this occasion.</li>
                    <li>A banner hoisted for any day will be displayed on the SubNex front end from 12 AM to 11.59 PM of the appropriate day.   </li>
                    <li>SubNex holds the right to reject the Banner which is not complying with the Banner posting protocols as per the SubNex admin team and the fee paid by the user will be refunded in this scenario.   </li>
                    <li>SubNex never guarantees the surge of Business inquiries to the party who availed Banner space since business inquiries to the particular product or service is depending upon the market demands of the appropriate cities.</li>
                </ul>
                <h3>4B. Boost Ads</h3>
                    <ul>
                        <li>There are two options in the Boost Ads segment. 1. Top of the Page. 2. Premium Ads.
                        </li>
                        <li>Any Active ads could be Boosted by the user to the Top of the Page or Premium according to their choices.</li>
                        <li> Individual Users or Business entities having a minimum of one valid live ad can avail of this value-added service.</li>
                        <li>The top of the Page option can be only availed for 2,4 and 6 days maximum whereas the Premium option can be chosen for 3,5 and 7 days only. SubNex reserves the right to edit, modify and change the pattern that includes charges, no of days, and everything pertaining to this module.</li>
                        <li>The "top of the page" boosted ad will be pinned on top of the page in the appropriate Product or Service category for the selected dates and will be visible to all users logging in to the Application/Website from the respective cities of the base city of the particular ad.
                        </li>
                        <li>The cost of the Top of the Page and Premium options will be different for each city and SubNex holds full rights over the charges of the value-added services.
                        </li>
                        <li> Any existing ads can be boosted to Top of the Page or Premium and the same will be effective in real-time. The user has the option to boost the Ad from the current date. The charges paid for the Boost Ad are not entitled to be refunded on any occasion.</li>
                        <li>The tenure of the boost ad is calculated on a daily basis and not in hours. Ad Boosted for one day will be promoted on the home of Product/service category pages till same day 11.59 PM only. Similarly, Ads for any number of days will have a cut-off time till 11.59 PM only on the last day of the range picked for boost.</li>
                        <li>SubNex never guarantees the surge of Business inquiries to the party who has promoted their ad since business inquiries to the particular product or service is depending upon the market demands of the appropriate cities.</li>
                    </ul>
                <h2>5.Eligibility</h2>
                    <p>Use of SubNex APP, either by registration or by any other means, is available only to persons, who are Citizens of the Republic of India, who are 18 yrs of age and above, and persons who can enter into a legally binding contract, and or are not barred by any law for the time being in force. If you access SubNex, either by registration on the Site or by any other means, not as an individual but on behalf of a legal entity, you represent that you are fully authorized to do so and the listing, posting or information placed on the site on behalf of the legal entity is your responsibility and you agree to be accountable for the same to other users of the Site</p>
                <h2>6.Abuse of SubNex</h2>
                    <p>You agree to inform us if you come across any listing or posting that is offensive or violates our listing policy or infringes any intellectual property rights by clicking on the following link support@SubNex.in to enable us to keep the site working efficiently and in a safe manner. We reserve the right to take down any posting, listing or information and or limit or terminate our services and further take all reasonable technical and legal steps to prevent the misuse of the Site in keeping with the letter and spirit of this AUP and the listing policy. In the event, you encounter any problems with the use of our APP or services you are requested to report the problem through the APP.
                    </p>
                <h2>7.Violations by User</h2>
                    <p>You agree that in the event your listing, posting, or your information violates any provision of this AUP or the listing policy, we shall have the right to terminate and or suspend your membership of the Site and refuse to provide you or any person acting on your behalf, access to the APP.
                    </p>
                <h2>8.Content</h2>
                    <p>The Site contains content that includes your information, SubNex's information, and information from other users. You agree not to copy, modify, or distribute such content (other than your information), SubNex's copyrights, or trademarks. When you give us any content as part of your information, you are granting us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sub-licensable right and license to use, reproduce, publish, translate, distribute, perform and display such content (in whole or part) worldwide through the Site as well as on any of our affiliates or partners websites, publications, and mobile platform. We need these rights with respect to the content in your information in order to host and display your content. If you believe that there is a violation, please notify us by sending email on info@SubNex.in. We reserve the right to remove any such content where we have grounds for suspecting the violation of these terms and our Listing Policy or any party's rights.</p>
                <h2>9.Liability</h2>
                    <p>You agree not to hold SubNex or any of its officers, employees, agents responsible or accountable for any of your Ad postings or information, and nor shall we, our officers, employees, or agents be liable for any misuse, illegal activity or third party content as most postings, listings or information are generated by various users directly. We do not have any role in the creation of the content.</p>
                    <p>You understand and agree that we do not guarantee the accuracy or legitimacy of any Ad posting, information by other users. You further agree that we are not liable for any loss of money, goodwill, or reputation, or any special, indirect, or consequential damages arising out of your use of the site or as a result of any rental deal of products and services with other users of the site.</p>
                <h2>10.Personal Information</h2>
                    <p>By using SubNex, you agree to the collection, transfer, storage, and use of any personal information provided by you on the Site by SubNex. The data is stored and controlled on servers located in India as further described in our Privacy Policy. By submitting your Ad listings or Freelance Job Postings, you permit SubNex to publicly display your information which can be freely accessed by anyone. You also agree to receive marketing communications from us unless you specifically indicate otherwise in writing to us through support@subnex.in. You may send questions about this policy to support@subnex.com.
                    You agree that SubNex may use information shared by you to provide customer services and to understand if any other services or advertisements listed on SubNex website may interest you. You agree that we may share personally identifiable data of any individual to our Affiliates defined as any person directly or indirectly controlling, controlled by, or under direct or indirect common control with, SubNex, including its subsidiaries and associate companies.</p>
                <h2>11.General</h2>
                    <p>We may update this AUP or the listing policy at any time and may notify you of such updates via soft Notifications or through email communications. The modified AUP and /or Listing Policy shall come into effect either at the time you place your next Ad posting, listing, or information on the Site or after a period of 14 days from the date of the update, whichever is sooner. If we or our corporate affiliates are involved in a merger or acquisition, we may share personal information with another company, but this AUP shall continue to apply.</p>
                <h2>12.Third Party Content and Services</h2>
                    <p>SubNex may provide, on its site, links to sites operated by other entities. If the user decides to view this site, they shall do so at their own risk, subject to that site’s terms and conditions of use and privacy policy that may be different from those of this site. It is the user’s responsibility to take all protective measures to guard against viruses or other destructive elements they may encounter on these sites. SubNex makes no warranty or representation regarding and does not endorse any linked website or the information appearing thereon or any of the products or services described thereon.
                    Further, user’s interactions with organizations and/or individuals found on or through the service, including payment and delivery of products and services, and any other terms, conditions, warranties, or representations associated with such dealings, are solely between the user and such organization and/or individual. The user should make whatever investigation they feel necessary or appropriate before proceeding with any offline or online transaction with any of these third parties.</p>
                <h2>13.Indemnity</h2>
                    <p>The User should agree to indemnify and hold SubNex, its officers, subsidiaries, affiliates, successors, assigns, directors, officers, agents, service providers, suppliers, and employees, harmless from any claim or demand, including reasonable attorney fees and court costs, made by any third party due to or arising out of content submitted by the user, users use of the service, violation of the Terms and Conditions, breach by the user of any of the representations and warranties herein, or user’s violation of any rights of another.</p>
                <h2>14.Governing Law & Jurisdiction</h2>
                    <p>This AUP and the Listing Policy shall be governed and construed in accordance with the laws of the Republic of India and the courts of Tamilnadu shall have exclusive jurisdiction on all matters and disputes arising out of and relating to the Site.
                    </p>
                <h2>15.No Guarantee of Business</h2>
                    <p>SubNex does not guarantee business from the leads generated. SubNex shall not be responsible or liable at all to the Advertiser if no business or business leads are generated for the Advertiser through Top of the Page/ Premium ads on the Website. Advertiser understands that SubNex’s only obligation is to place the Top of the Page/Premium Ads on the Website in the manner provided for in these Terms. Accuracy of the information/content provided is the advertiser's responsibility and SubNex will not be held responsible for false claims made by the advertiser.</p>
                <h2>16.Advertiser Obligations</h2>
                    <p>Advertiser represents and warrants that (i) it is a bonafide business organization or individual carrying on business in relation to the items disclosed to SubNex, (ii) it has the right to use the trademarks it claims to have the right to use (iii) the business carried on by Advertiser does not violate or infringe upon any law or regulation and all registrations required for carrying on business have been procured by it and (iv) all Classified(s) provided to SubNex is/are and shall at all times be accurate and complete, and entirely lawful. The Advertiser shall bear complete responsibility for the quality of its products and/or services, and SubNex shall bear no responsibility for the same. The Advertiser agrees to be bound by all applicable policies of SubNex relating to Classifieds and the Website, and the Advertiser grants to SubNex a worldwide intellectual property license (including a copyright and trademark license) relating to all intellectual property rights in the Classified(s) to do any acts in relation to the Classified(s) which SubNex may deem necessary to fulfill its obligations.</p>
                <h2>17.Notice of Infringement of Intellectual Property</h2>
                    <ul>
                        <li>SubNex is not liable for any infringement of intellectual property rights arising out of Products & Services posted on the site by end-users or any other third parties</li>
                        <li>If you are an owner of intellectual property rights or an agent who is fully authorized to act on behalf of the owner of intellectual property rights and believe that any Content or other content infringes upon your intellectual property right or intellectual property right of the owner on whose behalf you are authorized to act, you may write to us at info@subnex.in to delete the relevant Content in good faith.
                        </li>
                       

                    </ul>
                <h2>18.Cautions & Disclaimers</h2>
                    <ul>
                        <li>
                        We strongly recommend our users exercise their discretion & due diligence about all relevant aspects prior to availing of any products/services. Please note that SubNex does not implicitly or explicitly endorse any product/s or services provided by advertisers/service providers. 
                        </li>
                        <li>The information related to the name, address, contact details of the business establishments has been verified as existing at the time of verification of any advertiser with SubNex. This verification is solely based on the documents as supplied by an advertiser/s or as per the details contained in the User verification page.
                        </li>
                        <li>Service providers at all times ensure that all the applicable laws that govern their profession are followed while rendering their services.</li>
                        <li>We strongly recommend our users exercise their discretion & due diligence about all relevant aspects before availing of any products/services. Please note that SubNex does not implicitly or explicitly endorse any product/s or services provided by advertisers/service providers.</li>
                        <li>SubNex is not responsible for any disputes arising due Fraudulent activities/Deceptive/Misleading Misbehaving /Cheating by the other User and SubNex is nowhere responsible for any of these consequences however User can escalate to support@SubNex.in to complain about the particular Post/User and SubNex reserves the sole authority to take action in favor of same.</li>
                       
                    </ul>
                <h2>19.Miscellaneous</h2>
                    <ul>
                        <li>"If all premium ads available to the advertiser under the subscription scheme are not used/availed of during the period of these terms, the unutilized units shall be forfeited - no refund shall be made, and neither can the unutilized credits be carried forward."
                        </li>
                        <li>Premium ads are prioritized over free ads on the website on the search and browse pages. The sequence in which premium ads are displayed will be controlled by SubNex's search algorithm which is SubNex's sole prerogative. The advertiser shall not have a say in determining the sequence in which ads are displayed within the set of premium ads matching a user's search query/browsing intent.
                        </li>
                        <li>The banner shall be dynamically created by Users from their dashboard. Banner hoisting is a paid service and the banners will be displayed on a rotational basis. SubNex reserves the right to approve/Reject the banner and SubNex retains the rights of allotting “N no of banners on the particular time slot on user preferred destination cities. SubNex does not provide any guarantees of impressions or clicks on the banners.</li>
                        <li>The advertiser acknowledges that any liability/claim in respect of the products or services promoted through the Banners/Advertisements under the scope of this Agreement shall be solely to the account of the advertiser. It is agreed that in case of any claims in respect of the same against SubNex, the advertiser shall indemnify SubNex against all such claims and damages
                        </li>
                        <li>Advertiser shall procure and keep valid all necessary licenses, permissions, authorizations, consents, approvals, and registrations with/from any government department, agency, or authority required for it to perform the Services in accordance with this Agreement and bear sole and exclusive responsibility for all compliances with such license’s permissions, authorizations, consents, approvals, and registrations.
                        </li>
                    </ul>
      </div>        
    </div>
  </footer><!-- End Footer -->
  <script>

    function openTerms() {
        document.getElementById('termAndCondition').style.display = 'block';
        document.getElementById('termAndCondition').style.display = 'flex';
        
    }

    function closePopup() {
        
        document.getElementById('termAndCondition').style.display = 'none';
    }
    function openAboutUs() {
        document.getElementById('aboutUs').style.display = 'block';
        document.getElementById('aboutUs').style.display = 'flex';
        
    }

    function closeaboutPopup() {
        
        document.getElementById('aboutUs').style.display = 'none';
    }
    function openPrivacyPolicy() {
        document.getElementById('privacyPolicy').style.display = 'block';
        document.getElementById('privacyPolicy').style.display = 'flex';
        
    }

    function closePrivacyPopup() {
        
        document.getElementById('privacyPolicy').style.display = 'none';
    }
    
    
</script>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="site_assets/vendor/aos/aos.js"></script>
  <script src="site_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="site_assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="site_assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="site_assets/vendor/php-email-form/validate.js"></script>
  <script src="site_assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="site_assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="site_assets/js/main.js"></script>

</body>

</html>