<!DOCTYPE html>
<html>
<head>
  <title> Dashboard</title>
  <link rel="stylesheet" href="dash.css"/>
  <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/popup_style.css">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link rel="icon" type="image/jpg" href="../images/1.jpg">
  <style>

img {
  border-radius: 5px 5px 0 0;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.containers {
  padding: 2px 16px;
} 
  </style>
</head>
<body>


<div class="sidebar">
    <div class="logo-details">
     <i class="bi bi-person-fill"></i>
      <span class="logo_name"><?php echo $_SESSION['designation']; ?></span>
    </div>

     <ul class="nav-links">
      <li>
        <a href="#" class="active">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>

      <li>
        <a href="home.php">
          <i class="bi bi-house"></i>
          <span class="links_name">Home</span>
        </a>
      </li>

      <li>
        <a href="Area3.php">
          <i class="bi bi-calendar-check"></i>
          <span class="links_name">Scheduler</span>
        </a>
      </li>

      <li>
        <a href="calculator.php">
          <i class="bi bi-calculator"></i>
          <span class="links_name">Calculator</span>
        </a>
      </li>

      <li>
        <a href="profile.php">
          <i class="bx bx-user"></i>
          <span class="links_name">Profile</span>
        </a>
      </li>

      <li>
        <a href="changepass.php">
          <i class="bi bi-key"></i>
          <span class="links_name">Change Password</span>
        </a>
      </li>

      <li class="log_out">
        <a href="../logout.php">
          <i class="bx bx-log-out"></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        
        <span class="dashboard">Dashboard</span>
      </div>

      <div class="profile-details">
        <span class="admin_name">Welcome: <?php echo $_SESSION['fname']; ?></span>
      </div>
    </nav>
  </section>