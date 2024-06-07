<?php
    session_start();

    include("php/connection.php");
    if(!isset($_SESSION['username'])){
        header("Location: index.html");
    }
    else {
        $id = $_SESSION['user_id'];
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");
        if(mysqli_num_rows($sql) == 0){
            header("Location: index.html");
        }else{
            $user = mysqli_fetch_object($sql);
            if($user->verification_status != 0){
                $current_month = date('n');
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_SESSION['month'] = $_POST['month'];
                }
                $selectedMonth = $_SESSION['month'];
                $current_month = $selectedMonth;
                /* This is for the total */
                $total_balance = 0.00;
                $total_income = 0.00;
                $total_expense = 0.00;
                $inpn = 0;
                $expn = 0;
                $topn = 0;
                $current_date = date('Y-m-d');
                $previous_month = $current_month - 1;
                $sql = mysqli_query($conn, "SELECT total_expense FROM expense_percentage WHERE user_id = '$id' AND month = '$current_month'");
                $result = mysqli_fetch_assoc($sql);
                if(mysqli_num_rows($sql)!=0){
                    $total_expense = $result['total_expense'];
                }
                $sql = mysqli_query($conn, "SELECT total_income FROM income_percentage WHERE user_id='$id' AND month = '$current_month'");
                $result = mysqli_fetch_assoc($sql);
                if(mysqli_num_rows($sql)!=0){
                    $total_income = $result['total_income'];
                }

                /* This is for the percentages */
                $income_percentage = 0;
                $expense_percentage = 0;
                $balance_percentage = 0;
                $current_month_income = 0;
                $previous_month_income = 0;
                $current_month_expense = 0;
                $previous_month_expense = 0;
                $total_balance = 0;
                $previous_month_balance = 0;

                /* Income */
                $sql = mysqli_query($conn, "SELECT month, total_income FROM income_percentage WHERE user_id = '$id' AND month = '$current_month'");
                $result = mysqli_fetch_assoc($sql);
                if(mysqli_num_rows($sql)!=0){
                    $current_month_income = $result['total_income'];
                    $sql = mysqli_query($conn, "SELECT month, total_income FROM income_percentage WHERE user_id = '$id' AND month = '$previous_month'");
                    $result = mysqli_fetch_assoc($sql);
                    if(mysqli_num_rows($sql)!=0){
                        $previous_month_income = $result['total_income'];
                        try{
                            if($current_month_income > $previous_month_income){
                                $income_percentage = (($current_month_income - $previous_month_income) / $current_month_income) * 100;
                                if($income_percentage>=0){
                                    $inpn = 1;
                                }else{
                                    $inpn = 0;
                                }
                                $income_percentage = number_format($income_percentage, 2);
                            }else{
                                $income_percentage = (($previous_month_income - $current_month_income) / $previous_month_income) * 100;
                                if($income_percentage>=0){
                                    $inpn = 0;
                                }else{
                                    $inpn = 1;
                                }
                                $income_percentage = number_format($income_percentage, 2);
                            }
                        }catch(Exception $e){
                            
                        }
                        
                    }else{
                        $income_percentage = 100.00;
                        $inpn = 1;
                    }
                }else{
                    $income_percentage = 0.00;
                    $inpn = 0;
                }
                
                /* Expenses */
                $sql = mysqli_query($conn, "SELECT month, total_expense FROM expense_percentage WHERE user_id = '$id' AND month = '$current_month'");
                $result = mysqli_fetch_assoc($sql);
                if(mysqli_num_rows($sql)!=0){
                    $current_month_expense = $result['total_expense'];
                    $sql = mysqli_query($conn, "SELECT month, total_expense FROM expense_percentage WHERE user_id = '$id' AND month = '$previous_month'");
                    $result = mysqli_fetch_assoc($sql);
                    if(mysqli_num_rows($sql)!=0){
                        try{
                            $previous_month_expense = $result['total_expense'];
                            if($current_month_expense > $previous_month_expense){
                                $expense_percentage = (($current_month_expense - $previous_month_expense) / $current_month_expense) * 100;
                                $expense_percentage = number_format($expense_percentage, 2);
                                if($expense_percentage>0){
                                    $expn = 0;
                                }else{
                                    $expn = 1;
                                }
                            }else{
                                $expense_percentage = (($previous_month_expense - $current_month_expense) / $previous_month_expense) * 100;
                                $expense_percentage = number_format($expense_percentage, 2);
                                if($expense_percentage>0){
                                    $expn = 1;
                                }else{
                                    $expn = 0;
                                }
                            }
                        } catch(Exception $e){

                        }
                    }else{
                        $expense_percentage = 100.00;
                        $expn = 0;
                    }
                }else{
                    $expense_percentage = 0;
                    $expn = 1;
                }
                $previous_month_balance = ($previous_month_income - $previous_month_expense);
                $total_balance = ($current_month_income - $current_month_expense);
                try{
                    if($total_balance > $previous_month_balance){
                        $balance_percentage = (($total_balance - $previous_month_balance) / $total_balance) * 100;
                        if($balance_percentage!=0 and $balance_percentage!=100){
                            $balance_percentage = number_format($balance_percentage, 2);
                        }
                        if($balance_percentage>0){
                            $topn = 1;
                        }else{
                            $topn = 0;
                        }
                    }else{
                        $balance_percentage = (($previous_month_balance - $total_balance) / $previous_month_balance) * 100;
                        if($balance_percentage!=0 and $balance_percentage!=100){
                            $balance_percentage = number_format($balance_percentage, 2);
                        }
                        if($balance_percentage>0){
                            $topn = 0;
                        }else{
                            $topn = 1;
                        }
                    }
                }catch(DivisionByZeroError $e){

                }
                $total_balance = number_format($total_balance, 2);
                $total_expense = number_format($total_expense, 2);
                $total_income = number_format($total_income, 2);

                $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");

                while($result = mysqli_fetch_assoc($sql)){
                    $c_username =  $result['username'];
                    $_SESSION['password'] = str_repeat('*', strlen($_SESSION['password']));
                    $c_password = $_SESSION['password'];
                    $c_email = $result['email'];
                }
            }else{
                session_destroy();
                header("Location: index.html");
            }
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jolly+Lodger&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" href="img/CS.png">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <title>Cash Tool - Home</title>
</head>
<body>
    
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <span id="logo">Cash<span id="logo2">Tool</span></span>
                </div>
                <div class="close">
                    <span class="material-symbols-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a id="dashboard" class="active">
                    <span class="material-symbols-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a id="income">
                    <span class="material-symbols-sharp">
                        paid
                    </span>
                    <h3>Income</h3>
                </a>
                <a id="expense">
                    <span class="material-symbols-sharp">
                        payments
                    </span>
                    <h3>Expense</h3>
                </a>
                <a id="user-profile">
                    <span class="material-symbols-sharp">
                        person
                    </span>
                    <h3>User Profile</h3>
                </a>
                <a href="php/logout.php">
                    <span class="material-symbols-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main id="dashboardPage">
            <h1>Dashboard</h1>
            <p>See every changes in your cash flow.</p>
            <div class="money">
                <h2>Hey, <span><?php echo $c_username . "!" ?></span></h2>
                <h2>Month of :
                    <span>
                        <?php
                            $month = DateTime::createFromFormat("m", $current_month);
                            $m = $month->format("F");
                        ?>
                        <select class="month" name="month" id="month">
                            <option value="" disabled selected><?php echo $m ?></option>
                        </select>
                    </span>
                </h2>
            </div>
            <h1>Analytics</h1>
            <p>You can analyze your cash in detail.</p>
            <div class="container-card">
                <div class="info-card">
                    <?php
                        if($inpn == 1){
                            echo <<<END
                                <div class="analytic-data positive">
                                    <b>$income_percentage%</b>
                                    <span class="material-symbols-sharp">
                                        trending_up
                                    </span>
                                </div>
                            END;
                        }else{
                            echo <<<END
                                <div class="analytic-data negative">
                                    <b>$income_percentage%</b>
                                    <span class="material-symbols-sharp">
                                        trending_down
                                    </span>
                                </div>
                            END;
                        }
                    ?>
                    <h2>Total Income</h2>
                    <h1>&#x20B1<span><?php echo $total_income ?></span></h1>
                </div>
                <div class="info-card">
                    <?php
                        if($expn == 1){
                            echo <<<END
                                <div class="analytic-data positive">
                                <b>$expense_percentage%</b>
                                    <span class="material-symbols-sharp">
                                        trending_up
                                    </span>
                                </div>
                            END;
                        }else{
                            echo <<<END
                                <div class="analytic-data negative">
                                    <b>$expense_percentage%</b>
                                    <span class="material-symbols-sharp">
                                        trending_down
                                    </span>
                                </div>
                            END;
                        }
                    ?>
                    <h2>Total Expense</h2>
                    <h1>&#x20B1<span><?php echo $total_expense ?></span></h1>
                </div>
                <div class="info-card">
                    <?php
                        if($topn == 1){
                            echo <<<END
                                <div class="analytic-data positive">
                                    <b>$balance_percentage%</b>
                                    <span class="material-symbols-sharp">
                                        trending_up
                                    </span>
                                </div>
                            END;
                        }else{
                            echo <<<END
                                <div class="analytic-data negative">
                                    <b>$balance_percentage%</b>
                                    <span class="material-symbols-sharp">
                                        trending_down
                                    </span>
                                </div>
                            END;
                        }
                    ?>
                    <h2>Total Balance</h2>
                    <h1>&#x20B1<span><?php echo $total_balance ?></span></h1>
                </div>
            </div>
        </main>

        <main id="incomePage" style="display: none">
            <h1>Income</h1>
            <p>See your income in detail.</p>
            <?php
                $sql = mysqli_query($conn,"SELECT * FROM income WHERE
                                    user_id = '$id'
                                    AND MONTH(income_received) = $current_month
                                    ORDER BY income_received DESC");
                $num_rows = mysqli_num_rows($sql);
                if($num_rows==0){
                    echo <<<END
                        <br>
                        <div class="card center">
                            <h2>Your income page in $m is empty, that's not great :( </h2>
                        </div>
                    END;
                } else{
            ?>
            <div class="money">
                <h2>Total Income: <span><?php echo $total_income ?> </span></h2>
                <h2>Number of Income: <span><?php echo $num_rows ?> </span></h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Date Received</th>
                        <th>Source</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($result = mysqli_fetch_assoc($sql)){
                        $income_received = date("M d, Y", strtotime($result['income_received']));
                        $source = $result['source'];
                        $amount = number_format($result['amount'], 2, '.', ',');
                        $description = $result['description'];
                        $date_created = date("M d, Y", strtotime($result['date_created']));
                        echo <<<END
                            <tr>
                                <td>$income_received</td>
                                <td>$source</td>
                                <td>&#x20B1 $amount</td>
                                <td>$description</td>
                                <td>$date_created</td>
                            </tr>
                         END;
                    }
                }
                ?>
            </table>
        </main>

        <main id="expensePage" style="display: none">
            <h1>Expenses</h1>
            <p>See your expenses in detail.</p>
            <?php
                $sql = mysqli_query($conn,"SELECT * FROM expenses WHERE
                                        user_id = '$id'
                                        AND MONTH(expense_date) = $current_month
                                        ORDER BY expense_date DESC");
                $num_rows = mysqli_num_rows($sql);
                if($num_rows==0){
                    echo <<<END
                        <br>
                        <div class="card center">
                            <h2>Your expenses page in $m  is empty, that's great!</h2>
                        </div>
                    END;
                } else {
            ?>
            <div class="money">
                <h2>Total Expense: <span><?php echo $total_expense ?></span></h2>
                <h2>Number of Expenses: <span><?php echo $num_rows ?></span></h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Expense Date</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($result = mysqli_fetch_assoc($sql)){
                            $expense_date = date("M d, Y", strtotime($result['expense_date']));
                            $category = $result['category'];
                            $amount = number_format($result['amount'], 2, '.', ',');
                            $description = $result['description'];
                            $date_created = date("M d, Y", strtotime($result['date_created']));
                            echo <<<END
                                <tr>
                                    <td>$expense_date</td>
                                    <td>$category</td>
                                    <td>&#x20B1 $amount</td>
                                    <td>$description</td>
                                    <td>$date_created</td>
                                </tr>
                             END;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </main>

        <main id="userPage" style="display: none;">
            <h1>User Profile</h1>
            <p>Configure your personal profile to your liking.</p>
            <div class="user-info card">
                <p>Username: <b><?php echo $c_username ?></b></p>
                <p>Email: <b><?php echo $c_email ?></b></p>
                <p>Password: <b><?php echo $c_password ?></b></p>
                <p>
                    <b>
                        <a href="fpass.php?email=<?php echo $c_email ?>"  style="color: #118C4F">
                            Change Password
                            <span class="material-symbols-sharp">
                                edit
                            </span>
                        </a>
                    </b>
                </p>
            </div>
        </main>

    </div>

    <script>
        const currentMonth = new Date().getMonth();

        // Define months
        const months = [
            { name: "January", value: "1" },
            { name: "February", value: "2" },
            { name: "March", value: "3" },
            { name: "April", value: "4" },
            { name: "May", value: "5" },
            { name: "June", value: "6" },
            { name: "July", value: "7" },
            { name: "August", value: "8" },
            { name: "September", value: "9" },
            { name: "October", value: "10" },
            { name: "November", value: "11" },
            { name: "December", value: "12" }
        ];

        const monthSelect = document.getElementById("month");

        months.forEach((month, index) => {
            const option = document.createElement("option");
            option.value = `${month.value}`;
            option.textContent = month.name;
            monthSelect.appendChild(option);
        });

        monthSelect.addEventListener('change', function() {
            const selectedMonth = monthSelect.value;
            console.log('Selected month:', selectedMonth);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'home.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const dataContainer = document.getElementById('data-container');
                    if (dataContainer) {
                        dataContainer.innerHTML = xhr.responseText;
                    } else {
                        console.error('Data container element not found.');
                    }
                }
            };
            xhr.send('month=' + encodeURIComponent(selectedMonth));
            location.reload();
        });
        monthSelect.dispatchEvent(new Event('input'));
    </script>
    <script src="js/home.js?v=<?php echo time(); ?>"></script>
</body>
</html>