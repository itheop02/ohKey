<?php
// annotations.php

// Function to check if the request is an AJAX request
function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
//$data = json_decode(file_get_contents('php://input'), true);


// for age

$age = isset($_POST['displayAge1']) ? $_POST['displayAge1'] : (isset($_POST['displayAge2']) ? $_POST['displayAge2'] : (isset($_POST['displayAge3']) ? $_POST['displayAge3'] : (isset($_POST['displayAge4']) ? $_POST['displayAge4'] :  'None of the ages are set')));
// For gender
$gender = isset($_POST['displayGender1']) ? $_POST['displayGender1'] : (isset($_POST['displayGender2']) ? $_POST['displayGender2'] : (isset($_POST['displayGender3']) ? $_POST['displayGender3'] : (isset($_POST['displayGender4']) ? $_POST['displayGender4'] : 'None of the genders are set')));

// For law
$law = isset($_POST['displayLaw1']) ? $_POST['displayLaw1'] : (isset($_POST['displayLaw2']) ? $_POST['displayLaw2'] : (isset($_POST['displayLaw3']) ? $_POST['displayLaw3'] : (isset($_POST['displayLaw4']) ? $_POST['displayLaw4'] : 'None of the laws are set')));


//var_dump($law);
// Process the data as needed

// Check if it's an AJAX request
if (isAjaxRequest()) {
    // Return a JSON response
    header('Content-Type: application/json');
    $response = array('success' => true, 'message' => 'Data received successfully');
    echo json_encode($response);
}
// Handle as regular request: return HTML
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Policy Annotation Tool </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.html">Home</a></li>
                    <!--                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="annotation.html" style="color: #e6a756">Annotation</a></li>-->
                    <li class="nav-item"></li>
                    <!--                            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="survey.html">Survey</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
    <section class="page-section about-heading">
        <div class="container">
            <div class="about-heading-content">
                <!-- PARAMETERS FROM THE SURVEY PAGE -->

                <br>
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="section-heading mb-4">
                        <h3> Online app Stores:</h3>
                        <br>
                        <h4>Select one app</h4>
                        <br>
                    </h2>
                    <div class="container px-4 px-lg-5 text-center">
                        <div class="row gx-4 gx-lg-5" style="justify-content: center;">
                            <!-- google play ---------------------------------------------------- -->

                            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                <form action="https://child-project.eu/policy/loadPolicy.php" method="post" >

                                    <label style="display: none;"  for="displayAge1"> </label>
                                    <input style="display: none;" type="text" id="displayAge1" name="displayAge1">

                                    <label style="display: none;"  for="displayGender1"> </label>
                                    <input style="display: none;" type="text" id="displayGender1" name="displayGender1">

                                    <label style="display: none;"  for="displayLaw1"> </label>
                                    <input style="display: none;" type="text" id="displayLaw1" name="displayLaw1">

                                    <label style="display: none;"  for="policyID"> </label>
                                    <input style="display: none;" type="text" id="policyID" name="policyID" value="7">
                                    <button type="submit" style="background: none; border:none;">

                                        <span class="service-icon-app-store rounded-circle mx-auto mb-3"><i class="fa fa-mobile-phone"></i></span>
                                        <h4><strong>Platform 1</strong></h4>
                                    </button>
                                </form>
                            </div>

                            <!-- app store ---------------------------------------------------- -->

                            <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                <form action="https://child-project.eu/policy/loadPolicy.php" method="post" >

                                    <label style="display: none;"  for="displayAge2"> </label>
                                    <input style="display: none;" type="text" id="displayAge2" name="displayAge2">

                                    <label style="display: none;"  for="displayGender2"> </label>
                                    <input style="display: none;" type="text" id="displayGender2" name="displayGender2">

                                    <label style="display: none;"  for="displayLaw2"> </label>
                                    <input style="display: none;" type="text" id="displayLaw2" name="displayLaw2">

                                    <label style="display: none;"  for="policyID"> </label>
                                    <input style="display: none;" type="text" id="policyID" name="policyID" value="8">

                                    <button type="submit" style="background: none; border:none;">
                                        <span class="service-icon-app-store rounded-circle mx-auto mb-3"><i class="fa fa-mobile-phone"></i></span>
                                        <h4><strong>Platform 2 </strong></h4>
                                    </button>

                                </form>

                            </div>

                            <!-- kanena ---------------------------------------------------- -->
                            <div class="col-lg-3 col-md-6" style="display: none;">
                                <form action="https://child-project.eu/policy/loadPolicy.php" method="post" >

                                    <label style="display: none;"  for="displayAge3"> </label>
                                    <input style="display: none;" type="text" id="displayAge3" name="displayAge3">

                                    <label style="display: none;"  for="displayGender3"> </label>
                                    <input style="display: none;" type="text" id="displayGender3" name="displayGender3">

                                    <label style="display: none;"  for="displayLaw3"> </label>
                                    <input style="display: none;" type="text" id="displayLaw3" name="displayLaw3">

                                    <label style="display: none;"  for="policyID"> </label>
                                    <input style="display: none;" type="text" id="policyID" name="policyID" value="9">

                                    <button type="submit" style="background: none; border:none;">

                                        <span class="service-icon-app-store rounded-circle mx-auto mb-3"><i class="fa fa-mobile-phone"></i></span>
                                        <h4><strong>Platform 3</strong></h4>

                                    </button>
                                </form>
                            </div>

                        </div>
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
    <script src="js/scripts1.js"></script>
    <script src="js/annotation.js"></script>
    <script>
        window.onload = function () {
            let age = "<?php echo $age; ?>";
            let gender = "<?php echo $gender; ?>";
            let law =" <?php echo $law; ?>";
            //alert("hello");
            // Get the parameters from the URL

            console.log("Age: ", age);
            console.log("Gender: ", gender);
            console.log("law", law);


            document.getElementById("displayAge1").value = age;
            document.getElementById("displayGender1").value = gender;
            document.getElementById("displayLaw1").value = law;

            document.getElementById("displayAge2").value = age;
            document.getElementById("displayGender2").value = gender;
            document.getElementById("displayLaw2").value = law;

            document.getElementById("displayAge3").value = age;
            document.getElementById("displayGender3").value = gender;
            document.getElementById("displayLaw3").value = law;

            // Display the values on the page (you can modify this as needed)

        };
    </script>

    </body>
    </html>
<?php

?>