<?php
include("../basics/header.php");
echo "Bienvenido admin";
include("../basics/footer.php");
?>

<!--Main layout-->
<main class="mt-5">
    <div class="container col-4">
        <!--Section: Content-->

        <div class="card">
            <div class="card-header">
                Welcome admin, please enter data to login
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                        </div>
                        <hr>                        
                        <button type="submit" class="btn btn-info">Login</button>
                    </form>
                </blockquote>
            </div>
        </div>

    </div>
</main>