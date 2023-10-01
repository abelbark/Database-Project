<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/gondrin" rel="stylesheet"> 
    <link rel="stylesheet" href="index.css">       
    <title>440 Project</title>
</head>
<body>

    <div class="Container">
        
        <!--div class="floating-head">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/000/602/490/f38.gif" id="bill-nye" alt="bill nye head">
        </div-->

        <div class="header-container">
            <h3 id="login-header">Login</h3>
            <h3 id="register-header">Register</h3>
        </div>
        

        <div class="form">

            <!-- login Form -->
            <div id="login-box">
                <input type="text" 
                       id="email" 
                       placeholder="Email" 
                       name="email"><br>
                <input type="text"
                       id="password"
                       placeholder="Password"
                       name="password"><br>

                <input type="submit" id="sign-in" value="Sign In">
            </div>

            <!-- SignUp form-->
            <div id="register-box">

                <input type="text" 
                        id="user-email" 
                        placeholder="Email" 
                        name="user-email"><br>
                <input type="text" 
                        id="first-name" 
                        placeholder="First Name" 
                        name="first-name"><br>
                <input type="text" 
                        id="last-name" 
                        placeholder="Last Name" 
                        name="last-name"><br>
                <input type="text" 
                        id="user-name" 
                        placeholder="Username" 
                        name="user-name"><br>
                <input type="text"
                        id="user-password"
                        placeholder="Password"
                        name="user-password"><br>
                <input type="text"
                        id="confirm-password"
                        placeholder="Confirm Password"
                        name="confirm-password"><br>

                <input type="submit" id="sign-up" value="Create">
            </div>

        </div>


    </div>

</body>
<script>
    var theLogin;
var theRegister;

function init() {
  //div stuff
  theLogin = document.getElementById("login-box");
  theRegister = document.getElementById("register-box");

  //header stuff
  loginHeader = document.getElementById("login-header");
  registerHeader = document.getElementById("register-header");
  loginHeader.addEventListener("click", Login);
  registerHeader.addEventListener("click", SignUp);

  //theLogin.addEventListener("click", Login);
  //theRegister.addEventListener("click", SignUp);

  makeLoginVisible();
  makeRegisterInvisible();
}

function makeRegisterInvisible() {
  theRegister.style.display = "none";
}

function makeRegisterVisible() {
  theRegister.style.display = "flex";
}

function makeLoginInvisible() {
  theLogin.style.display = "none";
}

function makeLoginVisible() {
  theLogin.style.display = "flex";
}

function SignUp() {
  makeLoginInvisible();
  makeRegisterVisible();
}

function Login() {
  makeRegisterInvisible();
  makeLoginVisible();
}

window.addEventListener("load", init);
</script>
</html>

