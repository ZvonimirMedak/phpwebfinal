<?php
include_once('src/php/database.php');
include_once('src/php/initial.php');
 if(isset($_POST["login"]))  
 {  
      if(empty($_POST["email"]) && empty($_POST["password"]))  
      {  
           echo "Jedan od input fieldova je prazan";  
      }  else {
        $email = htmlspecialchars($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Krivi format emaila";
        }else {
            $password = htmlspecialchars($_POST["password"]);
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";  
            $prep_state = $db->prepare($sql);
            $flag = false;
            if($prep_state->execute()) {
                while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    if($row['password'] == $password) {
                        $flag = true;
                    }
                }
                if($flag) {
                    echo "Korisnik pronađen";
                } else {
                    echo "Provjerite jeste li dobro unijeli email i lozinku";
                }
            } else {
                echo "Nešto je pošlo po krivu";
            }
        }
      }
 } 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="src/css/login.css" />

    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/footer.css" />

    <script src="src/script/header.js" type="text/javascript" defer></script>
    <script src="src/script/login.js" type="text/javascript" defer></script>
    <script src="src/script/footer.js" type="text/javascript" defer></script>

    <title>Login</title>
  </head>
  <body>
    <header>
      <header-component />
    </header>
    <div class="loginContainer">
      <form class="loginForm" method="POST">
        <div class="formTitleContainer">
          <h1 class="loginTitle">Prijavi se</h1>
        </div>
        <div class="inputContainer">
          <div class="innerInputContainer">
            <label for="email">Email</label>
            <input
              class="inputField"
              type="text"
              id="email"
              name="email"
              placeholder="Unesite email"
              required
            />
          </div>
        </div>
        <div class="inputContainer">
          <div class="innerInputContainer">
            <label for="password">Lozinka</label>
            <input
              class="inputField"
              type="password"
              id="password"
              name="password"
              placeholder="Unesite sifru"
              required
            />
          </div>
        </div>
        <div class="loginButtonContainer">
          <button class="customButton positionCenter" name="login" type="submit">
            <p class="largeText family buttonTextColor">Prijava</p>
          </button>
        </div>
      </form>
    </div>
    <footer class="footerContainer footerPosition">
      <footer-component />
    </footer>
  </body>
</html>