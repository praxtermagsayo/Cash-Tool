const dashboard = document.getElementById('dashboard');
const userProfile = document.getElementById('user-profile');
const settings = document.getElementById('settings');

const dashboardPage = document.getElementById('dashboardPage');
const userPage = document.getElementById('userPage');
const settingsPage = document.getElementById('settingsPage');

function toDashboard(){
    dashboard.classList.add('active');
    userProfile.classList.remove('active');
    settings.classList.remove('active');

    dashboardPage.style.display = "";
    userPage.style.display = "none";
    settingsPage.style.display = "none";
}

function toUserProfile(){
    dashboard.classList.remove('active');
    userProfile.classList.add('active');
    settings.classList.remove('active');

    dashboardPage.style.display = "none";
    userPage.style.display = "";
    settingsPage.style.display = "none";
}

function toSettings(){
    dashboard.classList.remove('active');
    userProfile.classList.remove('active');
    settings.classList.add('active');

    dashboardPage.style.display = "none";
    userPage.style.display = "none";
    settingsPage.style.display = "";
}

dashboard.addEventListener('click', toDashboard);
userProfile.addEventListener('click', toUserProfile);
settings.addEventListener('click', toSettings);