<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/popup_style.css">
    <link rel="stylesheet" href="style.css">
    
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
   <style>
     .word{
      color: hotpink;
      font-size: 24px;
     }
     .word span a{
      color: violet;
     }
   </style>
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header> Login</header>
        <form action="index.php" method="post">
          <div class="field">
            <span class="bi bi-envelope-at"></span>
            <input type="text" name="email" required placeholder="Enter Email">
          </div>
          <div class="field space">
            <span class="bx bx-lock"></span>
            <input type="password"  name="password" class="pass-key" required placeholder="Password">
            <span class="show">SHOW</span>
          </div>
          <div class="field space">
            <input type="submit" name="LOGIN" value="LOGIN">
          </div><br>
          <div class="word">
    <span>Dont have an account?</span>
    <span><a href="register.php">Register Here</a></span>
  </div>
          
        </form>
        <?php
      if (isset($_POST["LOGIN"]))
      {
        $username = $_POST["email"];
        $password =md5($_POST["password"]);
        
        $con = mysqli_connect("localhost", "root", "", "irri");
        
        $se = "SELECT * FROM users where Email= '$username' and Password = '$password' limit 1";
        
        $run = mysqli_query($con, $se);
        
        if (mysqli_num_rows($run) == 0)
        {
          echo "Wrong username or password";
        }
        else
        {
          $result = mysqli_fetch_array($run,);
          //$id = $result["id"];
          $fname = $result["Full Name"];
          $uname = $result["Email"];
          $pass = $result["Password"];
          $role = $result["Designation"];
          
          session_start();
          //$_SESSION["id"] = $id;
           $_SESSION["fname"] = $fname;
          $_SESSION["username"] =  $uname;
          $_SESSION["password"] = $pass;
          $_SESSION["designation"] = $role;
          
          if ($role == "Field-Manager") {
            header("location:field/home.php");
          }
          else if($role=="Irrigation-Engineer")
          {
            header("location:engineer/home.php");
          }
           else if($role=="Agronomist")
          {
            header("location:agronomist/home.php");
          }
           else if($role=="Section-Manager")
          {
            header("location:section/section.php");
          }

          else if($role=="Area-Manager")
          {
            header("location:area/home.php");
          }
  
  
          
        }
          
      }
    ?> 
      </div>
    </div>

    <script>
      const pass_field = document.querySelector('.pass-key');
      const showBtn = document.querySelector('.show');
      showBtn.addEventListener('click', function(){
       if(pass_field.type === "password"){
         pass_field.type = "text";
         showBtn.textContent = "HIDE";
         showBtn.style.color = "#3498db";
       }else{
         pass_field.type = "password";
         showBtn.textContent = "SHOW";
         showBtn.style.color = "#222";
       }
      });
    </script>


  </body>
</html>
