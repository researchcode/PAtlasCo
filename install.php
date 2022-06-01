<?php

// Read the JSON file 
$json = file_get_contents('vars.json');

// Decode the JSON file
$json_data = json_decode($json, true);

$json_data['installed'] = 0;

if (isset($_POST["admindata"])) {
   // echo $_POST["username"] . " - " . $_POST["password"];
    // encode array to json
    $json_to_save = json_encode(array('installed' => 1));

    //write json to file
    file_put_contents("vars.json", $json_to_save);
}
?>
<form action="#" method="POST">
    <p>Please do not forget these data. In such a case please contact the database admin to get the admin username and password of the LinkedAtlas platform.</p>
    <p>After configuring your username and password yo can go to the admin home http://yourdomain/linkedatlas/admin to configure other info and gui options for the platform.</p>
    <hr>
    <label for="username">Admin username</label>
    <input type="text" name="username" id="username">
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="hidden" name="admindata">
    <button type="submit">Save</button>
</form>
<?php


?>