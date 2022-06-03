<?php
if (!defined('CSS_PATH')) {
    define('CSS_PATH', 'css/');
}
if (!defined('JS_PATH')) {
    define('JS_PATH', 'js/');
}
include("basics/header.php");

// Read the JSON file 
$json = file_get_contents('vars.json');

// Decode the JSON file
$json_data = json_decode($json, true);

if ($json_data['installed'] == 1) {
    header('Location: user');
}

if (isset($_POST["admindata"])) {
    // echo $_POST["username"] . " - " . $_POST["password"];
    // encode array to json
    $json_to_save = json_encode(array('installed' => 1));

    //write json to file
    file_put_contents("vars.json", $json_to_save);
}
?>

<!--Main layout-->
<main class="mt-5">
    <div class="container col-4">
        <!--Section: Content-->

        <div class="card">
            <div class="card-header">
                <h2>Installation</h2>
                <p>Please do not forget these data. In such a case please contact the database admin to get the admin username and password of the LinkedAtlas platform.</p>
                <p>After configuring your username and password yo can go to the admin home http://yourdomain/linkedatlas/admin to configure other info and gui options for the platform.</p>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="username">Admin username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        </div>
                        <input type="hidden" name="admindata">
                        <hr>
                        <button type="submit" class="btn btn-info">Save</button>
                    </form>
                </blockquote>
            </div>
        </div>

    </div>
</main>
<?php

include("basics/footer.php");
?>