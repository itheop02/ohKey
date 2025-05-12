<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $numOfDivs = $_POST['numOfDivs'];
    $policyID = $_POST['policyID'];
    $age = $_POST['age'] ;
    $gender = $_POST['gender'] ;
    $law = $_POST['law'];

    $divIDs = []; // Initialize an empty array to hold divID values

    for ($i = 1; $i <= $numOfDivs; $i++) {
        // Collect each divID from the POST data and store it in the array
        if (isset($_POST['divID_'.$i])) {
            $divIDs[$i] = $_POST['divID_'.$i];
        } else {
            $divIDs[$i] = null; // or handle the absence of divID_$i as needed
        }
    }

    $annotations = []; // Initialize an empty array to hold divID values

    for ($i = 1; $i <= $numOfDivs; $i++) {
        // Collect each divID from the POST data and store it in the array
        if (isset($_POST['annotation_'.$i])) {
            $annotations[$i] = $_POST['annotation_'.$i];
        } else {
            $annotations[$i] = null; // or handle the absence of divID_$i as needed
        }
    }

    $comments = [];

    for ($i = 1; $i <= $numOfDivs; $i++) {
        // Collect each divID from the POST data and store it in the array
        if (isset($_POST['comment_'.$i])) {
            $comments[$i] = $_POST['comment_'.$i];
        } else {
            $comments[$i] = null; // or handle the absence of divID_$i as needed
        }
    }


    // Now, you have all the data collected and can process it as needed
    // For demonstration, let's just output the collected data
//    echo "Policy ID: " . htmlspecialchars($policyID) . "<br>";
//    echo "Age: " . htmlspecialchars($age) . "<br>";
//    echo "Gender: " . htmlspecialchars($gender) . "<br>";
//    echo "Law: " . htmlspecialchars($law) . "<br>";

    foreach ($divIDs as $i => $divID) {
        // Check if the divID value is not null
        //echo "div: ".$divID."<br>";
    }
    foreach ($annotations as $i => $annotation) {
        // Check if the divID value is not null
       // echo "annotation:".$annotation."<br>";
    }
    foreach ($comments as $i => $comment) {
        // Check if the divID value is not null
        //echo "comments:".$comment."<br>";
    }

    for ($i = 1; $i <= $numOfDivs; $i++) {
        if($annotations[$i] !=null  && $comments[$i] != null){
            $sql= " INSERT INTO `p_answers`(`age`, `gender`, `law_background`, `policy_id`, `div_id`, `annotations`, `comments`) 
            VALUES ('$age','$gender','$law','$policyID','$divIDs[$i]','$annotations[$i]','$comments[$i]')";


            $result = $conn->query($sql);
           // echo $result;
        }
    }


} else {
    echo "This script only handles POST requests.";
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Privacy Policy Annotation</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<header>
    <h1 class="site-heading text-center text-faded d-none d-lg-block">
        <span class="site-heading-custom">OhKéy</span>
        <br>
        <br>
        <span class="site-heading-upper text-primary mb-3">
           An annotation tool for </span>
        <span class="site-heading-lower">Privacy policies</span>

    </h1>
</header>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html"> Policy Annotation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.html" style="color: #e6a756">Home</a></li>
                <!--                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="annotation.html">Annotation</a></li>-->
                <li class="nav-item">
                    <!--                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="survey.html">Survey</a></li>-->
            </ul>
        </div>
    </div>
</nav>
<section class="page-section clearfix">
    <div class="container">
        <div class="intro">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="assets/img/ucyyy.png" alt="..." />
            <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                <h2 class="section-heading mb-4">
                    <span class="section-heading-upper">Finished!</span>
                    <span class="section-heading-lower">Thank you for participating in our survey!</span>
                </h2>
                <p class="mb-3">Your answers have been recorded.</p>
            </div>
        </div>
    </div>
</section>
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner bg-faded text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">We value your feedback!</span>
                        <span class="section-heading-lower">Contact us:</span>
                    </h2>


                    If you have any comments or questions, please contact the persons responsible:
                    <br>
                    - Ioanna Theophilou, University of Cyprus, Cyprus (itheop02@ucy.ac.cy)
                    <br>
                    - Evangelia Vanezi, University of Cyprus, Cyprus (vanezievangelia@gmail.com)
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer text-faded text-center py-5">
    <div class="container"><p class="m-0 small">Copyright &copy; Ioanna Theophilou (itheop02@ucy.ac.cy) Evangelia Vanezi (vanezi.evangelia@ucy.ac.cy)</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>

