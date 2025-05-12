<?php

function getTagsFromDatabase()
{
    // Replace with your database credentials
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    // Create a PDO connection
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch 'id' and 'text' columns from the 'p_tags' table
        $query = "SELECT id, text FROM `p_tags`";
        $statement = $pdo->prepare($query);
        $statement->execute();

        // Fetch all rows as an associative array
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Close the database connection
        $pdo = null;

        return $result;
    } catch (PDOException $e) {
        // Handle database connection error
        die("Connection failed: " . $e->getMessage());
    }
}
function getPlatformName() {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the number from the submitted form
        $policyID = $_POST["policyID"];

        // Perform any processing with the received number
        // For example, you can echo it back
        //echo "Received Number: " . $number;
    } else {
        // Handle the case where the form is not submitted properly
        echo "Invalid request!";
    }
    switch ($policyID) {
        case 1:
        case 2:
        case 3:
            return 'Social Media Platform';
        case 4:
        case 5:
        case 6:
            return 'E-commerce';
        case 7:
        case 8:
        case 9:
            return 'Online APP Stores';
        case 10:
        case 11:
        case 12:
            return 'Online Advertising';
        default:
            return 'Unknown Platform';
    }
}
function printTags(){
    // Get tags from the database
    $tags = getTagsFromDatabase();

// Generate HTML div elements
    foreach ($tags as $tag) {
        $tagId = $tag['id'];
        $tagText = $tag['text'];

        // Output a hidden div with the specified format
        echo "<div id='tag_$tagId' style='display: none;'>$tagText</div>";
    }
}

function concatenatePolicyAndDiv($policyID, $divNum) {
    // Concatenate policyID and divNum
    $result = "policy:".$policyID . "_div:". $divNum;

    return $result;
}
function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
function show(){

// Replace these with your database credentials
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";



// Your policyID variable
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isAjaxRequest()) {
        // Return a JSON response
        header('Content-Type: application/json');
        $response = array('success' => true, 'message' => 'Data received successfully');
        echo json_encode($response);
    }

        // Retrieve the number from the submitted form
    $policyID = $_POST["policyID"];
    // for age

    $age = isset($_POST['displayAge1']) ? $_POST['displayAge1'] : (isset($_POST['displayAge2']) ? $_POST['displayAge2'] : (isset($_POST['displayAge3']) ? $_POST['displayAge3'] :  'None of the ages are set'));
// For gender
    $gender = isset($_POST['displayGender1']) ? $_POST['displayGender1'] : (isset($_POST['displayGender2']) ? $_POST['displayGender2'] : (isset($_POST['displayGender3']) ? $_POST['displayGender3'] : 'None of the genders are set'));

// For law
    $law = isset($_POST['displayLaw1']) ? $_POST['displayLaw1'] : (isset($_POST['displayLaw2']) ? $_POST['displayLaw2'] : (isset($_POST['displayLaw3']) ? $_POST['displayLaw3'] :  'None of the laws are set'));



// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Step 1: Fetch 'numOfDivs' from p_policies table
    $sql = "SELECT numOfDivs FROM `p_policies` WHERE policy_id = $policyID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numOfDivs = $row['numOfDivs'];

        echo '<form action="https://child-project.eu/policy/submitSurvey.php" method="post" >';

        echo "<input type='hidden' id='numOfDivs' name='numOfDivs' value='" . htmlspecialchars($numOfDivs, ENT_QUOTES) . "'>";

        echo "<input type='hidden' id='policyID' name='policyID' value='" . htmlspecialchars($policyID, ENT_QUOTES) . "'>";
        echo "<input type='hidden' id='age' name='age' value='" . htmlspecialchars($age, ENT_QUOTES) . "'>";
        echo "<input type='hidden' id='gender' name='gender' value='" . htmlspecialchars($gender, ENT_QUOTES) . "'>";
        echo "<input type='hidden' id='law' name='law' value='" . htmlspecialchars($law, ENT_QUOTES) . "'>";


        // Step 2: Dynamically create HTML <div> elements
        for ($i = 1; $i <= $numOfDivs; $i++) {
            // Step 3: Fetch content from p_content table
            $contentSql = "SELECT text, isHeader ,divNum  FROM `p_content` WHERE policy_id = $policyID AND divNum = $i";
            $contentResult = $conn->query($contentSql);

            if ($contentResult->num_rows > 0) {
                $contentRow = $contentResult->fetch_assoc();
                $text = $contentRow['text'];
                $isHeader = $contentRow['isHeader'];
                $divNum = $contentRow['divNum'];

                $concatenatedString = concatenatePolicyAndDiv($policyID, $divNum);
                $annotation = "tag_".$concatenatedString;
                $comment="comment_".$concatenatedString;
                $annotationInput="tag_Inp_".$concatenatedString;
                $commentInput="comment_Inp_".$concatenatedString;

                // Display content in HTML <div>
                echo "<div id='$annotation'class='annotation' > </div>";
                echo"<input style='display: none;' type='text' id='$annotationInput' name='annotation_$i' value=''>";
                echo "<div id='$comment' class='commentInput' style='display=none; margin-left:1%;'> </div>";
                echo"<input style='display: none;' type='text' id='$commentInput' name='comment_$i'>";



                echo "<div onclick='openSwalWithDropdown("; echo json_encode($concatenatedString); echo");' class = 'annotated' style='border: solid;border-radius: 1em;border-color: grey;padding: 10px;margin: 10px;' id='$concatenatedString'>";
                echo"<input style='display: none;' type='text' id='divID' name='divID_$i' value='$concatenatedString'>";

                // If it's a header, make the text bold
                    if ($isHeader) {
                        echo "<h4 class='header'> <strong>$text</strong> </h4>";
                    } else {
                        echo $text;
                    }

                echo "</div>";
                echo "<br>";
            }
        }
        echo "<br><button style='background-color:saddlebrown; color:white; width: 30%;' class='btn ' type='submit'> OhKéy 👍🏼 ! </button>";
        echo '</form>';
    } else {
        echo "No policy found for policyID: $policyID";
    }

// Close connection
    $conn->close();


}



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
    <link href="css/styles1.css" rel="stylesheet" />
    <link href="css/annotations.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php echo printTags();?>
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
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Policy Annotation Tool</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.html">Home</a></li>
<!--                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="annotation.php" style="color: #e6a756">Annotation</a></li>-->
<!--                <li class="nav-item-->
<!--                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="survey.html">Survey</a></li>-->
            </ul>
        </div>
    </div>
</nav>
    <section class="page-section about-heading">
    <div class="container">
        <div class="about-heading-content">
            <br>
            <div class="intro-text left-0  bg-faded p-5 rounded">
                <h3 class="section-heading mb-4">

                    <?php echo getPlatformName();?>

                </h3>
                <br>
                <?php echo show();?>
            </div>
        </div>

    </div>
</section>
    <footer class="footer text-faded text-center py-5">
    <div class="container"><p class="m-0 small">Copyright &copy; Ioanna Theophilou (itheop02@ucy.ac.cy) Evangelia Vanezi (vanezi.evangelia@ucy.ac.cy)</p></div>
</footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swal Element -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="js/scripts1.js"></script>
    <script src="js/annotation.js"></script>

</body>
</html>


