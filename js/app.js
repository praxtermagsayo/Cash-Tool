const landingPage = document.getElementById('home');
const signUpPage = document.getElementById('signup-page');
const logInPage = document.getElementById('login-page');
const forgotPassPage =document.getElementById('fpass');

const logInButton = document.getElementById('login');
const logInLink = document.getElementById('login-link');
const logInLink2 = document.getElementById('login-link2');

const signUpButton = document.getElementById('signup');
const signUpLink = document.getElementById('register-link');

const forgotPassLink = document.getElementById('fpass-link');

function toLogInPage(){
    logInPage.style.display = "";
    landingPage.style.display = "none";
    signUpPage.style.display = "none";
    forgotPassPage.style.display = "none";
}

function toSignUpPage(){
    signUpPage.style.display = "";
    logInPage.style.display = "none";
    landingPage.style.display = "none";
    forgotPassPage.style.display = "none";
}

function toForgotPassPage(){
    forgotPassPage.style.display = "";
    signUpPage.style.display = "none";
    logInPage.style.display = "none";
    landingPage.style.display = "none";
}

logInButton.addEventListener('click', toLogInPage);
logInLink.addEventListener('click', toLogInPage);
logInLink2.addEventListener('click', toLogInPage);

signUpButton.addEventListener('click', toSignUpPage);
signUpLink.addEventListener('click', toSignUpPage);

forgotPassLink.addEventListener('click', toForgotPassPage);