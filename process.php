<?php
// Simple PHP form processor that sanitizes input and displays a formatted response.
// Save this file as process.php and host on a PHP-capable server (e.g., 000webhost, InfinityFree, Heroku with PHP buildpack).

function clean($s){
    return htmlspecialchars(trim($s), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: register.html');
    exit;
}

$fullname = clean($_POST['fullname'] ?? '');
$email = clean($_POST['email'] ?? '');
$phone = clean($_POST['phone'] ?? '');
$course = clean($_POST['course'] ?? '');
$message = clean($_POST['message'] ?? '');

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Submission Received</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../resume_site/styles.css">
</head>
<body>
  <header class="site-header">
    <h1>Submission Received</h1>
    <nav>
      <a href="../resume_site/index.html">Home</a>
      <a href="register.html">Register Again</a>
    </nav>
  </header>

  <main class="container">
    <section class="resume">
      <h2>Thank you, <?php echo $fullname ? $fullname : 'Guest'; ?>!</h2>
      <p>Your registration details are below (formatted):</p>

      <div style="background:#fff;padding:1rem;border-radius:8px;">
        <p><strong>Full Name:</strong> <?php echo $fullname; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        <p><strong>Course:</strong> <?php echo $course; ?></p>
        <p><strong>Message:</strong><br><?php echo nl2br($message); ?></p>
      </div>

      <h3>Notes</h3>
      <ul>
        <li>All fields are sanitized for XSS protection using htmlspecialchars.</li>
        <li>For production, validate inputs server-side and use HTTPS.</li>
      </ul>
    </section>
  </main>

  <footer class="site-footer"><p>© 2025</p></footer>
</body>
</html>
