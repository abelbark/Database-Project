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
