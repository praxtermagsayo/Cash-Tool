const landingPage = document.getElementById('home');
const signUpPage = document.getElementById('signup-page');
const logInPage = document.getElementById('login-page');

const logInButton = document.getElementById('login');
const logInLink = document.getElementById('login-link');

const signUpButton = document.getElementById('signup');
const signUpLink = document.getElementById('register-link');

function toLogInPage(){
    logInPage.style.display = "";
    landingPage.style.display = "none";
    signUpPage.style.display = "none";
}

function toSignUpPage(){
    signUpPage.style.display = "";
    logInPage.style.display = "none";
    landingPage.style.display = "none";
}

logInButton.addEventListener('click', toLogInPage);
logInLink.addEventListener('click', toLogInPage);

signUpButton.addEventListener('click', toSignUpPage);
signUpLink.addEventListener('click', toSignUpPage);
