const dashboard = document.getElementById('dashboard');
const userProfile = document.getElementById('user-profile');
const settings = document.getElementById('settings');

function toDashboard(){
    dashboard.classList.add('active');
    userProfile.classList.remove('active');
    settings.classList.remove('active');
}

function toUserProfile(){
    dashboard.classList.remove('active');
    userProfile.classList.add('active');
    settings.classList.remove('active');
}

function toSettings(){
    dashboard.classList.remove('active');
    userProfile.classList.remove('active');
    settings.classList.add('active');
}

dashboard.addEventListener('click', toDashboard);
userProfile.addEventListener('click', toUserProfile);
settings.addEventListener('click', toSettings);