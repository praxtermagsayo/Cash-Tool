const logInPage = document.getElementById('login-page');
const landingPage = document.getElementById('home');

const logInButton = document.getElementById('login');

function toLogInPage(){
    logInPage.style.display = "";
    landingPage.style.display = "none";
}

logInButton.addEventListener('click', toLogInPage);