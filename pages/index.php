<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Delivery</title>
    <link rel="stylesheet" href="../css/quick_delivery_landing_page.css">
    <link rel="stylesheet" href="quick_delivery_landing_page_responsive.css">
    <link rel="stylesheet" href="animation.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
</head>


<?php 

include '../process/login_process.php';

?>

<body>

    <header>
        <div class="container">
            <div class="header-flex">
                <div class="logo-flex">
                    <div class="logo">
                        <img src="../assets/img/logo2.png" alt="logo">
                    </div>
                    <div class="logo-text">
                        <h1>Quick Delivery</h1>
                    </div>
                </div>

                <nav>
                    <ul>
                        <li><a class="sticky-nav" href="index.php">Home</a></li>
                        <li><a class="sticky-nav" href="#">Services</a></li>
                        <li><a class="sticky-nav" href="#">Contact Us</a></li>
                        <?php if(isset($_SESSION['success']) == true) { ?>
                        <li><a class="btn sign-up" href="dashboard.php">Dashboard</a></li>
                        <?php    } else { ?>
                        <li><a class="btn login" href="login.php">Login</a></li>
                        <li><a class="btn sign-up" href="user_registration.php">Sign up</a></li>
                        <?php   } ?>

                    </ul>
                </nav>

                <div class="menu-open">
                    <i class="fa fa-bars menu-open" onclick="OpenSideMenu()"></i>
                </div>
            </div>
        </div>
    </header>


    <!---Side menu for a smaller screen-->
    <div id="side-menu" class="menu">
        <ul>
            <li><a href="#" class="menu-close" onclick="CloseSideMenu()">&times;</a></li>
            <li><a class="sticky-nav" href="index.php">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact Us</a></li>
            <?php if(isset($_SESSION['success']) == true) { ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <?php    } else { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="user_registration.php">Sign up</a></li>
            <?php   } ?>
        </ul>
    </div>



    <section class="showcase">
        <div class="container">
            <div class="showcase-text">
                <h1>
                    We Offer Package <br> Delivery Service across <br> all the state in Nigeria
                </h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. <br> Nesciunt repellat neque doloremque
                    deleniti, sit soluta minus eum</p>
            </div>

            <div class="showcase-btn">
                <a class="btn btn-primary" href="#">Get Started</a>
            </div>
        </div>
    </section>


    <section class="our-services">
        <div class="container">
            <h1>OUR SERVICES</h1>
            <p>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, animi rerum? <br> Reiciendis, nulla
                quod illo voluptate delectus aperiam enim cum a
            </p>

            <div class="card">
                <div class="card-flex">
                    <div class="col card1">
                        <h1>Domestic Delivery</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde modi illo dolor corporis
                            nostrum aliquid architecto neque ab sed, animi accusamus odit velit est ea beatae delectus
                            blanditiis quis laboriosam.</p>
                    </div>

                    <div class="col card2">
                        <h1>Domestic Delivery</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde modi illo dolor corporis
                            nostrum aliquid architecto neque ab sed, animi accusamus odit velit est ea beatae delectus
                            blanditiis quis laboriosam.</p>
                    </div>

                    <div class="col card3">
                        <h1>Domestic Delivery</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde modi illo dolor corporis
                            nostrum aliquid architecto neque ab sed, animi accusamus odit velit est ea beatae delectus
                            blanditiis quis laboriosam.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="our-process">
        <div class="container">
            <h1>OUR PROCESS</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> Aperiam eum id atque, similique maiores cum
                beatae velit possimus, assumenda sed accusamus quae unde numquam officia </p>

            <div class="our-process-flex">
                <div class="col ">
                    <div class="img">
                        <img src="../assets/img/Vector (5).png" alt="note">
                    </div>
                    <h1>Step: 1</h1>
                    <h2>Create Your Account</h2>
                </div>
                <div class="col ">
                    <div class="img">
                        <img src="../assets/img/Vector (5).png" alt="note">
                    </div>
                    <h1>Step: 2</h1>
                    <h2>Place Your Order</h2>
                </div>

                <div class="col ">
                    <div class="img">
                        <img src="../assets/img/Vector (5).png" alt="note">
                    </div>
                    <h1>Step: 3</h1>
                    <h2>We Collect It</h2>
                </div>

                <div class="col ">
                    <div class="img">
                        <img src="../assets/img/Vector (5).png" alt="note">
                    </div>
                    <h1>Step: 4</h1>
                    <h2>We Deliver</h2>
                </div>
                <span class="line"></span>
            </div>

        </div>
    </section>

    <section class="about">
        <h1>About us</h1>
        <div class="about-showcase">
            <div class="about-text">
                <h1>Why we are the best</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi repellat cumque alias provident nisi
                    inventore <br> voluptate earum est accusantium, quam, tempore voluptatum, aspernatur rem.
                    Repudiandae minima ipsa minus obcaecati ratione.
                </p>

                <a class="btn btn-primary" href="#">Learn More</a>
            </div>
        </div>

    </section>

    <section class="contact">
        <div class="container">
            <h1>Contact Us</h1>
            <div class="contact-flex">
                <div class="card">
                    <div class="col">
                        <div class="col-flex">
                            <img src="../assets/img/Vector (7).png" alt="address">
                            <h1>Address</h1>
                        </div>
                        <p>Eliozu, PortHarcourt, Rivers state</p>
                    </div>
                    <div class="col">
                        <div class="col-flex">
                            <img src="../assets/img/Vector (7).png" alt="phone">
                            <h1>Call Us</h1>
                        </div>
                        <p>+234-9847744774</p>
                        <p>+234-4747646466</p>
                    </div>
                    <div class="col">
                        <div class="col-flex">
                            <img src="../assets/img/email icon.png" alt="email">
                            <h1>Email</h1>
                        </div>
                        <p>info@quickdelivery.com</p>
                    </div>
                    <div class="col">
                        <div class="col-flex">
                            <img src="../assets/img/clock.png" alt="clock">
                            <h1>Open Hours</h1>
                        </div>
                        <p>Monday-Saturday</p>
                        <p>9:00AM-05:00PM</p>
                    </div>
                </div>

                <div class="form">
                    <h1>Get In Touch</h1>
                    <form action="">
                        <div class="col">
                            <input type="text" name="" id="" placeholder="Name">
                        </div>
                        <div class="col">
                            <input type="email" name="" id="" placeholder="Email">
                        </div>
                        <div class="col">
                            <input type="text" name="" id="" placeholder="Phone">
                        </div>
                        <div class="col">
                            <textarea name="" id="" cols="30" rows="10" placeholder="Your Message Here"></textarea>
                        </div>
                        <a class="btn btn-primary" href="#">Summit</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="footer-flex">
                <div class="col col1">
                    <div class="logo-flex">
                        <div class="logo">
                            <img src="../assets/img/logo2.png" alt="logo">
                        </div>
                        <div class="logo-text">
                            <h1>Quick Delivery</h1>
                        </div>
                    </div>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. <br> Consectetur tenetur, facilis
                        veritatis optio, <br> aut nostrum porro perferendis in repudiandae possimus illum enim,
                        assumenda
                    </p>

                    <div class="social">
                        <a href=""> <img src="../assets/img/facebook.png" alt="facebook"></a>
                        <a href=""><img src="../assets/img/twitter.png" alt="twitter"></a>
                        <a href=""><img src="../assets/img/instgram.png" alt="instgram"></a>
                        <a href=""><img src="../assets/img/linkedin.png" alt="linkin"></a>

                    </div>
                </div>

                <div class="col col2">
                    <h1>Links</h1>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col col3">
                    <h1>Our Services</h1>
                    <ul>
                        <li>Domestic delivery</li>
                        <li>E-commerce delivery</li>
                        <li>Corporate delivery</li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>

    <div class="copyright">
        <p>Copyright @ Quick Delivery 2022. All Right Reserved</p>
    </div>


</body>

<script src="../js/scripts.js"></script>

</html>

<script src="../js/scripts.js"></script>

</html>