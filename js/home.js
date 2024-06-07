const dashboard = document.getElementById('dashboard');
const income = document.getElementById('income');
const expense = document.getElementById('expense');
const userProfile = document.getElementById('user-profile');

const dashboardPage = document.getElementById('dashboardPage');
const incomePage = document.getElementById('incomePage');``
const expensePage = document.getElementById('expensePage');
const userPage = document.getElementById('userPage');


function toDashboard(){
    dashboard.classList.add('active');
    income.classList.remove('active');
    expense.classList.remove('active');
    userProfile.classList.remove('active');

    dashboardPage.style.display = "";
    incomePage.style.display = "none";
    expensePage.style.display = "none";
    userPage.style.display = "none";
}

function toIncome(){
    dashboard.classList.remove('active');
    income.classList.add('active');
    expense.classList.remove('active');
    userProfile.classList.remove('active');

    dashboardPage.style.display = "none";
    incomePage.style.display = "";
    expensePage.style.display = "none";
    userPage.style.display = "none";
}

function toExpense(){
    dashboard.classList.remove('active');
    income.classList.remove('active');
    expense.classList.add('active');
    userProfile.classList.remove('active');

    dashboardPage.style.display = "none";
    incomePage.style.display = "none";
    expensePage.style.display = "";
    userPage.style.display = "none";
}

function toUserProfile(){
    dashboard.classList.remove('active');
    income.classList.remove('active');
    expense.classList.remove('active');
    userProfile.classList.add('active');

    dashboardPage.style.display = "none";
    incomePage.style.display = "none";
    expensePage.style.display = "none";
    userPage.style.display = "";
}

dashboard.addEventListener('click', toDashboard);
income.addEventListener('click', toIncome);
expense.addEventListener('click', toExpense);
userProfile.addEventListener('click', toUserProfile);