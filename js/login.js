const logInPage = document.getElementById('login-page');
const forgotPassPage =document.getElementById('fpass');

const logInLink = document.getElementById('login-link');

const forgotPassLink = document.getElementById('fpass-link');

function toLogInPage(){
    logInPage.style.display = "";
    forgotPassPage.style.display = "none";
}

function toForgotPassPage(){
    forgotPassPage.style.display = "";
    logInPage.style.display = "none";
}

logInLink.addEventListener('click', toLogInPage);
forgotPassLink.addEventListener('click', toForgotPassPage);