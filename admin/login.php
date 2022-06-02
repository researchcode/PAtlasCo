<?php
include("../basics/header.php");
echo "Bienvenido admin";
include("../basics/footer.php");
//require_once("../model/functions.php");
?>

<!--Main layout-->
<main class="mt-5">
    <div class="container col-4">
        <!--Section: Content-->

        <div class="card">
            <div class="card-header">
                <h2>Welcome admin!</h2>
                <p>Please enter data to login</p>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form action="validateLogin()" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        </div>
                        <hr>                        
                        <button type="submit" class="btn btn-info">Login</button>
                    </form>
                </blockquote>
            </div>
        </div>

    </div>
</main>