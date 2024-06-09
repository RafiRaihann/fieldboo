<?php
session_start();
require '../function.php';

if (!isset($_SESSION['login'])) {
  header('Location: ../logres/login.php');
}

$emailUser = $_SESSION["email"];
$result = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$emailUser'");

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);

  $nama = $row['nama'];
  $email = $row['email'];
  $foto = $row['foto'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS -->
  <link rel="stylesheet" href="index.css" />
  <!-- CSS -->

  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- AOS -->

  <!-- FONTAWESOME -->
  <link rel="stylesheet" href="/landing/fontawasome.css" />
  <!-- FONTAWESOME -->

  <title>fieldboo-Booking</title>
</head>

<body>
  <!-- HEADER -->

  <header>
    <div class="container flex-row">
      <div class="header__logo">
        <h1>FieldBoo</h1>
      </div>
      <nav>
        <ul class="header__menu flex-row">
          <li>
            <a href="#hero">Home</a>
          </li>
          <li>
            <a href="#about">About Us</a>
          </li>
          <li>
            <a href="#service">Service</a>
          </li>
          <li>
            <a href="#lapang">Informasi Lapang</a>
          </li>
          <li>
            <a href="#team">Team</a>
          </li>
          <li>
            <a href="#contact">Contact</a>
          </li>

        </ul>
      </nav>
      <div class="right flex-center">
        <link rel="stylesheet" href="propil.css">
        <div class="navbar">
          <div class="profile">
            <a href="../Profile/Profile.php"><button id="profile-btn">
                <img src="../logres/images/<?php echo $row['foto']; ?>" width="55px" height="60px" style="border-radius: 50%;">
          </div>
          <!-- Tambahkan item navbar lainnya sesuai kebutuhan -->
        </div>

        <!-- Konten halaman lainnya -->

        <script src="script.js"></script>
</body>

</html>

<div class="menu-btn">
  <i class="fas fa-bars"></i>
</div>
</div>
</div>

</header>

<!-- HEADER -->

<!-- HERO -->

<section id="hero" class="container flex-row">
  <div class="hero__content">
    <h1 class="title">Field Booking Online by GTR</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, similique.</p>
    <a href="../jadwallapang/jadwal.php" class="btn btn-secondary">Booking</a>
  </div>
  <div class="hero__img">
    <img src="assets/Group.png" alt="">
  </div>
</section>

<!-- HERO -->

<!-- ABOUT -->

<section id="about" class="container flex-center flex-column">
  <h5 class="section-subheading">Build Trust First</h5>
  <h2 class="section-heading text-center">Control your business with a single tap</h2>
  <div class="features text-center">
    <div class="feature">
      <div class="feature__icon">
        <i class="fas fa-anchor"></i>
      </div>
      <h3 class="feature__title">Complete business control</h3>
      <p class="feature__text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus possimus nulla, vitae praesentium quam
        deserunt impedit magnam laboriosam eos minima.
      </p>
    </div>
    <div class="feature">
      <div class="feature__icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <h3 class="feature__title">Business Growth</h3>
      <p class="feature__text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus possimus nulla, vitae praesentium quam
        deserunt impedit magnam laboriosam eos minima.
      </p>
    </div>
    <div class="feature">
      <div class="feature__icon">
        <i class="fa-regular fa-file-lines"></i>
      </div>
      <h3 class="feature__title">Critical analytics and reports</h3>
      <p class="feature__text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus possimus nulla, vitae praesentium quam
        deserunt impedit magnam laboriosam eos minima.
      </p>
    </div>
  </div>
</section>

<!-- ABOUT -->

<!-- SERVICES -->

<section id="service" style="background-image: linear-gradient(#fff, #DAD0C9);">
  <div class="container">
    <h5 class="section-subheading">What we do</h5>
    <h2 class="section-heading">Service to solve all kind of business problems</h2>
    <div class="services">
      <div class="service">
        <div class="service__icon">
          <img src="assets/field.png">
        </div>
        <h3 class="services__title">Lapangan UPI Kampus Cibiru</h3>
        <p class="service__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit voluptate est earum
          explicabo animi praesentium excepturi illo accusamus quae corporis!</p>
        <div class="arrow-icon">
          <i class="fa fa-arrow-right"></i>
        </div>
      </div>
      <div class="service">
        <div class="service__icon">
          <img src="assets/lab.png">
        </div>
        <h3 class="services__title">LAB UPI Kampus Cibiru</h3>
        <p class="service__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit voluptate est earum
          explicabo animi praesentium excepturi illo accusamus quae corporis!</p>
        <div class="arrow-icon">
          <i class="fa fa-arrow-right"></i>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->

<!-- PROJECTS -->
<section id="lapang" style="background-image: linear-gradient(#DAD0C9, #fff);">
  <div class="container">
    <h5 class="section-subheading">Informasi</h5>
    <h2 class="section-heading">Lapang UPI Kampus Cibiru</h2>
    <div class="projects">
      <div class="project">
        <div class="project__img">
          <img src="assets/lapang.png" style="width: 500px;" alt="">
        </div>
        <div class="project__content">
          <h3 class="project__category">Informasi</h3>
          <h3 class="project__title">Lapang UPI Kampus Cibiru</h3>
          <p class="project__text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat nam aperiam beatae quos at iure alias
            quidem corporis ipsam corrupti saepe distinctio placeat et vel id eveniet, tenetur minima nulla.
          </p>
          <a href="#" class="btn btn-secondary">View Details</a>
        </div>
      </div>
      <div class="project">
        <div class="project__img">
          <!-- <img src="/assets/maps.png" alt=""> -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15842.3442610173!2d107.7244107!3d-6.9399725!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c383e2fa5745%3A0xf179d6e5e90bd5e7!2sLapangan%20Basket%20UPI%20Kampus%20Cibiru!5e0!3m2!1sen!2sid!4v1701423871552!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="project__content">
          <h3 class="project__category">Informasi</h3>
          <h3 class="project__title">Lokasi Lapang UPI Kampus Cibiru</h3>
          <p class="project__text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat nam aperiam beatae quos at iure alias
            quidem corporis ipsam corrupti saepe distinctio placeat et vel id eveniet, tenetur minima nulla.
          </p>
          <a href="https://maps.app.goo.gl/QUwdaARWRiYKeqzm6" class="btn btn-secondary">View Details</a>
        </div>
      </div>
      <div class="project">
        <div class="project__img">
          <img src="assets/jadwal.png" style="width: 500px;" alt="">
        </div>
        <div class="project__content">
          <h3 class="project__category">Informasi</h3>
          <h3 class="project__title">Jadwal Lapang UPI Kampus Cibiru</h3>
          <p class="project__text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat nam aperiam beatae quos at iure alias
            quidem corporis ipsam corrupti saepe distinctio placeat et vel id eveniet, tenetur minima nulla.
          </p>
          <a href="../jadwallapang/jadwal.php" class="btn btn-secondary">View Details</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- PROJECTS -->

<!-- TEAM -->

<section id="team" style="background-image: linear-gradient(#fff, #DAD0C9);">
  <h5 class="section-subheading text-center">Meet our Team</h5>
  <h2 class="section-heading text-center right left">Awesome People with great Inovation</h2>
  <div class="members">
    <div class="member">
      <div class="member__img">
        <img src="assets/G.png" alt="">
      </div>
      <div class="member__content">
        <h1>Ghifarialdhy RN</h1>
        <p>Full-Stack Developer</p>
      </div>
    </div>
    <div class="member">
      <div class="member__img">
        <img src="assets/Raka.png" style="width: 900px;" alt="">
      </div>
      <div class="member__content">
        <h1>M Lutfi Raka Wibowo</h1>
        <p>UI/UX Designer</p>
      </div>
    </div>
    <div class="member">
      <div class="member__img">
        <img src="assets/Rafi.png" style="width: 900px;" alt="">
      </div>
      <div class="member__content">
        <h1>Rafi Raihan</h1>
        <p>Front-End Developer</p>
      </div>
    </div>
    <div class="member">
      <div class="member__img">
        <img src="assets/Zain.jpg" alt="">
      </div>
      <div class="member__content">
        <h1>Rizky Zain Fadhilah</h1>
        <p>Back-End Developer</p>
      </div>
    </div>
  </div>
</section>

<!-- TEAM -->

<!-- CONTACT -->

<section id="contact" style="background-image: linear-gradient(#DAD0C9, #fff);">
  <div class="container">
    <h5 class="section-subheading text-center">Contact Us</h5>
    <h2 class="section-heading text-center right left">Stay Connected with us for any reason</h2>
    <div class="contact">
      <form action="" class="contact__form">
        <h1>Write us a message</h1>
        <input type="text" placeholder="Your Name" required>
        <input type="email" placeholder="Your Email" required>
        <input type="number" placeholder="Your Telephone" required>
        <input type="text" placeholder="Subject" required>
        <textarea rows="5" required> Your Message</textarea>
        <button class="btn btn-primary">Send Message</button>
      </form>
      <div class="contact__details">
        <p class="text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim accusamus, architecto dolore repellendus
          temporibus placeat sed voluptatibus animi impedit distinctio.
        </p>
        <div class="details">
          <div class="detail">
            <div class="detail__icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="detail__content">
              <h3>Phone</h3>
              <p>+123456789</p>
            </div>
          </div>
          <div class="detail">
            <div class="detail__icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="detail__content">
              <h3>Email</h3>
              <p>aksdhak@#kajshdkasjdh.com</p>
            </div>
          </div>
          <div class="detail">
            <div class="detail__icon">
              <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="detail__content">
              <h3>Address</h3>
              <p>jl. dulu aja sapa tau jodoh</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->

<!-- FOOTER -->

<footer>
  <div class="container">
    <div class="footer__content">
      <div class="footer__details">
        <div class="footer__logo">
          <h1>FieldBoo</h1>
        </div>
        <p class="footer__text">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam optio repellendus nihil. Distinctio
          animi tempore sunt tenetur saepe voluptas necessitatibus!
        </p>
        <div class="footer__newletter">
          <form action="#" class="footer__newsletter-form">
            <input type="email" placeholder="Submit email" required>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
          </form>
        </div>
      </div>
      <div class="footer__menu">
        <h3 class="footer__menu-title">Quick Links</h3>
        <ul class="footer__menu-list">
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#service">Service</a></li>
          <li><a href="#lapang">Informasi Lapang</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
      <div class="footer__menu">
        <h3 class="footer__menu-title">Service</h3>
        <ul class="footer__menu-list">
          <li><a href="#service">Lapangan UPI Kampus Cibiru</a></li>
          <li><a href="#service">LAB UPI Kampus Cibiru</a></li>
        </ul>
      </div>
      <div class="footer__menu">
        <h3 class="footer__menu-title">Social Media</h3>
        <ul class="footer__menu-list">
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">LinkedIn</a></li>
        </ul>
      </div>
    </div>
    <div class="footer__bottom">
      <div class="footer__bottom-icons">
        <p>Follow us</p>
        <a href="#" class="instagram">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#" class="twitter">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="facebook">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="linkein">
          <i class="fab fa-linkedin"></i>
        </a>
      </div>
      <p>&copy; 2023 GTR. All rights reserved.</p>
    </div>
  </div>
</footer>
<!-- FOOTER -->

<!-- FONTAWESOME -->
<script src="/landing/fontawasome.js"></script>
<!-- FONTAWESOME -->

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- AOS -->

<!-- SCRIPTS -->
<script src="/landing/index.js"></script>
<!-- SCRIPTS -->

<script>
  AOS.init();
</script>
</body>

</html>