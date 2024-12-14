]<?php
// PHP code to handle dynamic paths for images if necessary
$image1 = "http://localhost/webproject/images/pexels-thisisengineering-3912953.jpg";
$image2 = "images/WhatsApp Image 2024-12-05 at 2.08.57 AM.jpeg";
$image3 = "images/athletic-woman-pumping-up-muscles-with-dumbbells-gym-club.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Website</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <h1 class="logo">WORLD GYM</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about-us">About</a></li>
          <li><a href="#our-classes">Classes</a></li>
          <li><a href="#trainers">Trainers</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="hero">
    <div class="hero-content">
      <h2>Transform Your Body, Transform Your Life</h2>
      <p>Join us today and achieve your fitness goals!</p>
      <a href="login.php" class="btn">Get Started</a>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about-us" class="about-us">
    <div class="about-us-content">
      <h2>Our Gym is Committed to Helping You Reach Your Fitness Goals</h2>
      <p>With state-of-the-art equipment and top trainers, we provide the best environment to help you succeed. Join us today!</p>
    </div>
  </section>

  <!-- Classes Section -->
  <section id="our-classes" class="our-classes">
    <div class="classes-heading">
      <h2>Our Classes</h2>
    </div>
    <div class="classes-container">
      <div class="class-card">
        <h3>Fitness</h3>
        <p>Fitness is not just about lifting weights or running miles; it’s about developing a healthy lifestyle. Regular physical activity helps improve strength, flexibility, endurance, and mental well-being. Whether you're aiming to build muscle, increase endurance, or simply stay active, our fitness programs cater to all levels. Join our fitness classes today and start your journey to a healthier you!</p>
      </div>
      <div class="class-card">
        <h3>Fat-loss</h3>
        <p>Achieving fat-loss requires a combination of exercise, nutrition, and consistency. Our fat-loss programs focus on burning excess fat through a well-rounded approach.</p>
      </div>
      <div class="class-card">
        <h3>Weightlifting</h3>
        <p>Build strength and power with our expert-led weightlifting sessions.</p>
      </div>
      <div class="class-card">
        <h3>Cardio</h3>
        <p>Improve your endurance with our cardio-focused workouts.</p>
      </div>
    </div>
  </section>

  <!-- Trainers Section -->
  <section id="trainers" class="trainers">
    <div class="trainers-heading">
      <h2>Meet Our Trainers</h2>
      <p>Our expert trainers are dedicated to helping you achieve your fitness goals.</p>
    </div>
    <div class="trainers-container">
      <div class="trainer-card">
        <img src="<?php echo $image1; ?>" alt="Trainer 1">
        <h3>Michael Lee</h3>
        <p>Cardio Specialist</p>
        <p>Helping clients build cardiovascular endurance through fun and dynamic workouts</p>
      </div>
      <div class="trainer-card">
        <img src="<?php echo $image2; ?>" alt="Trainer 2">
        <h3>Youssef Sherif</h3>
        <p>Power Lifting</p>
        <p>Specializing in weightlifting and strength training.</p>
      </div>
      <div class="trainer-card">
        <img src="<?php echo $image3; ?>" alt="Trainer 3">
        <h3>Lily Elderby</h3>
        <p>Fitness Specialist</p>
        <p>Whether you're aiming to build muscle, increase endurance, or simply stay active, our fitness programs cater to all levels. Join our fitness classes today and start your journey to a healthier you!</p>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact">
    <div class="contact-heading">
      <h2>Contact Us</h2>
      <p>Have questions or need more information? Get in touch with us!</p>
    </div>
    <div class="contact-container">
      <form action="submit_form.php" method="post" class="contact-form">
        <div class="form-group">
          <label for="name">Your Name</label>
          <input type="text" id="name" name="name" required placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label for="email">Your Email</label>
          <input type="email" id="email" name="email" required placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="phone">Your Phone (Optional)</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
        </div>
        <div class="form-group">
          <label for="message">Your Message</label>
          <textarea id="message" name="message" required placeholder="Write your message"></textarea>
        </div>
        <button type="submit" class="submit-btn">Send Message</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2024 WORLD GYM. All rights reserved.</p>
  </footer>

</body>
</html>
