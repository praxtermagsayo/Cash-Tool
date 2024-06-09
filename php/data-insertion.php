<?php
    session_start();
    include('connection.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        header('Location: ../home.php');
    }

    $expenseCategories = array(
        "Food",
        "Utilities",
        "Transportation",
        "Entertainment",
        "Medical",
        "Education",
        "Rent",
        "Insurance",
        "Shopping",
        "Dining out",
        "Travel",
        "Personal care",
        "Gifts",
        "Subscriptions",
        "Miscellaneous"
    );

    $categoryDescriptions = array(
        "Food" => array(
            "Groceries",
            "Dining out",
            "Takeout",
            "Coffee",
            "Fast food",
            "Restaurants",
            "Snacks",
            "Beverages",
            "Desserts",
            "Food delivery"
        ),
        "Utilities" => array(
            "Electricity",
            "Water",
            "Gas",
            "Internet",
            "Phone",
            "Cable",
            "Trash collection",
            "Home security",
            "Home maintenance",
            "Appliance repair"
        ),
        "Transportation" => array(
            "Gasoline",
            "Public transit",
            "Taxi",
            "Uber/Lyft",
            "Car maintenance",
            "Parking fees",
            "Tolls",
            "Vehicle registration",
            "Vehicle insurance",
            "Public transportation passes"
        ),
        "Entertainment" => array(
            "Movie tickets",
            "Concerts",
            "Streaming services",
            "Video games",
            "Books",
            "Sports events",
            "Amusement parks",
            "Museum visits",
            "Art shows",
            "Theater"
        ),
        "Medical" => array(
            "Doctors visits",
            "Prescription drugs",
            "Medical supplies",
            "Dental care",
            "Vision care",
            "Health insurance",
            "Medical tests",
            "Specialist consultations",
            "Therapy sessions",
            "Medical procedures"
        ),
        "Education" => array(
            "Tuition fees",
            "Textbooks",
            "School supplies",
            "Educational software",
            "Online courses",
            "Workshops",
            "Seminar fees",
            "School events",
            "Extracurricular activities",
            "Tutoring"
        ),
        "Rent" => array(
            "Apartment rent",
            "House rent",
            "Room rent",
            "Lease fees",
            "Renters insurance",
            "Security deposit",
            "Utilities deposit",
            "Parking fees",
            "Property management fees",
            "Condo fees"
        ),
        "Insurance" => array(
            "Health insurance",
            "Life insurance",
            "Auto insurance",
            "Homeowners insurance",
            "Renters insurance",
            "Travel insurance",
            "Pet insurance",
            "Business insurance",
            "Disability insurance",
            "Liability insurance"
        ),
        "Shopping" => array(
            "Clothing",
            "Electronics",
            "Home decor",
            "Furniture",
            "Appliances",
            "Toys",
            "Gifts",
            "Jewelry",
            "Books",
            "Craft supplies"
        ),
        "Dining out" => array(
            "Fast food",
            "Casual dining",
            "Fine dining",
            "Cafes",
            "Takeout",
            "Delivery",
            "Buffet",
            "Food trucks",
            "Pubs",
            "Bars"
        ),
        "Travel" => array(
            "Airfare",
            "Hotel accommodation",
            "Car rental",
            "Cruise",
            "Train tickets",
            "Bus tickets",
            "Travel insurance",
            "Vacation packages",
            "Tourist attractions",
            "Souvenirs"
        ),
        "Personal care" => array(
            "Haircuts",
            "Salon services",
            "Spa treatments",
            "Manicures/pedicures",
            "Skin care products",
            "Cosmetics",
            "Grooming products",
            "Personal hygiene items",
            "Fitness classes",
            "Massage therapy"
        ),
        "Gifts" => array(
            "Birthday gifts",
            "Christmas gifts",
            "Anniversary gifts",
            "Wedding gifts",
            "Baby shower gifts",
            "Graduation gifts",
            "Housewarming gifts",
            "Valentines Day gifts",
            "Mothers Day gifts",
            "Fathers Day gifts"
        ),
        "Subscriptions" => array(
            "Streaming services",
            "Magazine subscriptions",
            "Newspaper subscriptions",
            "Music subscriptions",
            "Software subscriptions",
            "Gaming subscriptions",
            "Online memberships",
            "Fitness subscriptions",
            "Meal kit subscriptions",
            "Book clubs"
        ),
        "Miscellaneous" => array(
            "Charitable donations",
            "Legal fees",
            "Bank fees",
            "Pet expenses",
            "Hobbies",
            "Professional dues",
            "Storage rental",
            "Postage",
            "Home organization",
            "Home renovation"
        )
    );

    $sources = array(
        "Salary",
        "Freelance",
        "Investments",
        "Rental Income",
        "Gifts", "Business",
        "Royalties",
        "Savings Interest",
        "Government Benefits",
        "Other"
    );

    $sourceDescriptions = array(
        "Salary" => array("Monthly salary", "Bonus", "Overtime", "Commission"),
        "Freelance" => array("Project payment", "Consulting fee", "Freelance gig", "Contract work"),
        "Investments" => array("Stock dividends", "Bond interest", "Capital gains", "Mutual fund returns"),
        "Rental Income" => array("Apartment rent", "Commercial property rent", "Vacation rental", "Storage unit rent"),
        "Gifts" => array("Birthday gift", "Wedding gift", "Holiday gift", "Inheritance"),
        "Business" => array("Sales revenue", "Service income", "Partnership earnings", "Franchise income"),
        "Royalties" => array("Book royalties", "Music royalties", "Patent royalties", "Trademark royalties"),
        "Savings Interest" => array("Bank interest", "Certificate of deposit interest", "Savings account interest", "Money market interest"),
        "Government Benefits" => array("Unemployment benefits", "Social security", "Disability benefits", "Child support"),
        "Other" => array("Lottery winnings", "Scholarship", "Grant", "Miscellaneous income")
    );

    
    function generateRandomDate($year, $month) {
        $firstDay = strtotime("first day of $year-$month");
        $lastDay = strtotime("last day of $year-$month");

        $randomTimestamp = mt_rand($firstDay, $lastDay);

        return date('Y-m-d', $randomTimestamp);
    }

    function generateRandomDecimal($min, $max, $decimals) {
        $scale = pow(10, $decimals);
        return mt_rand($min * $scale, $max * $scale) / $scale;
    }

    $monnthof = date('n');

    $n = random_int(10, 30);
    for($i = 1; $i < $n; $i++){
        for($y = 1; $y <= $monnthof; $y++){
            $randomDate = generateRandomDate(2024, $y);
            $randomCategory = $expenseCategories[array_rand($expenseCategories)];
            $description = $categoryDescriptions[$randomCategory];
            $randomDescription = $description[array_rand($description)];
            $randomAmount = generateRandomDecimal(100, 1500, 2);
    
            $sql = "INSERT INTO expenses (user_id, expense_date, category, amount, description) VALUES('$user_id', '$randomDate', '$randomCategory', '$randomAmount', '$randomDescription')";
            if ($conn->query($sql) === TRUE) {
                echo "Expense record inserted successfully<br>";
            } else {
                echo "Error inserting expense record: " . $conn->error . "<br>";
            }
        }
    }

    $n = random_int(10, 30);
    for($i = 1; $i < $n; $i++){
        for($y = 1; $y <=$monnthof; $y++){
            $randomDate = generateRandomDate(2024, $y);
            $randomSource = $sources[array_rand($sources)];
            $description = $sourceDescriptions[$randomSource];
            $randomDescription = $description[array_rand($description)];
            $randomAmount = generateRandomDecimal(500, 50000, 2);
    
            $sql = "INSERT INTO income (user_id, income_received, source, amount, description) VALUES('$user_id', '$randomDate', '$randomSource', '$randomAmount', '$randomDescription')";
            if ($conn->query($sql) === TRUE) {
                echo "Income record inserted successfully<br>";
            } else {
                echo "Error inserting income record: " . $conn->error . "<br>";
            }
        }
    }
    if(isset($_SESSION['user_id'])){
        header('Location: ../home.php');
    }
?>