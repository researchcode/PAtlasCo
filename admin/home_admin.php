<?php
session_start();
unset($_SESSION['user_user']);
$_SESSION['admin_admin'] = 1;

require("../model/functions.php");
include("../basics/header.php");
?>
<!--Main layout-->
<main class="mt-5">
    <div class="col-12">
        <section id="">
            <div class="row d-flex justify-content-center">
                <div class="card p-s " style="width: 25rem;">
                    <div class="card-body">
                        <form action="">
                            <h5 class="card-title">Entity</h5>
                            <h6 class="card-subtitle mb-2 text-muted">A word that represents a location-based entity (i.e. parks)</h6>
                            <div class="form-group">
                                <label for="">Entity</label>
                                <input type="text" name="entity" value="<?php echo getBasicData()['entity']; ?>" class="form-control">
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
                <div class="card p-2 offset-md-1" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title">Country</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Give the coordinates of the country to focus the map on that country </h6>
                        <form action="">
                            <div class="form-group">
                                <label for="">Country name</label>
                                <input type="text" class="form-control" name="country_name" value="<?php echo getBasicData()['country_name']; ?>">                                
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" class="form-control" name="latitude" value="<?php echo getBasicData()['latitude']; ?>">
                                <small id="emailHelp" class="form-text text-muted">i.e. 4.40</small>
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" class="form-control" name="longitude" value="<?php echo getBasicData()['longitude']; ?>">
                                <small id="emailHelp" class="form-text text-muted">i.e. -72.9301367</small>
                            </div>
                            <div class="form-group">
                                <label for="">Zoom</label>
                                <input type="text" class="form-control" name="zoom" value="<?php echo getBasicData()['zoom']; ?>">
                                <small id="emailHelp" class="form-text text-muted">A number from 0.0 to 18.0</small>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section id="">
            <div class="row d-flex justify-content-center">
                <div class="card" style="width: 80rem;">
                    <div class="card-body">
                        <h5 class="card-title">List of markers</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Each marker is set as a point on the map</h6>
                        <button class="btn btn-info">New</button>
                        <hr>
                        <table class="table table-striped table-info">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Latitude</th>
                                    <th scope="col">Longitude</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
</main>
<?php
include("../basics/footer.php");
?>