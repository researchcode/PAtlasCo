<?php

header('Content-Type: text/html; charset=ISO-8859-1');


if (!defined('CSS_PATH')) {
    define('CSS_PATH', '../css/');
}
if (!defined('JS_PATH')) {
    define('JS_PATH', '../js/');
}
session_start();
if (isset($_SESSION['user_user'])) {
    unset($_SESSION['user_user']);
    header('Location: ../admin/login.php');
}

unset($_SESSION['user_user']);
$_SESSION['admin_admin'] = 1;


include("../basics/header.php");
?>
<!--Main layout-->
<main class="mt-5">
    <div class="col-12">
        <section id="">
            <div class="row d-flex justify-content-center">
                <div class="card p-s " style="width: 25rem;">
                    <div class="card-body">
                        <form action="../model/functions.php" method="POST">
                            <h5 class="card-title">User home</h5>                            
                            <div class="form-group">
                                <label for="main_title">Title</label>
                                <input type="text" name="main_title" id="main_title" style="color:blue" value="<?php echo getWebsiteData()['main_title']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" style="color:blue" value="<?php echo getWebsiteData()['subtitle']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" style="color:blue" value="<?php echo getWebsiteData()['name']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="use_policy">Policy of use</label>
                                <input type="text" name="use_policy" id="use_policy" style="color:blue" value="<?php echo getWebsiteData()['use_policy']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="copyright">Copyright</label>
                                <input type="text" name="copyright" id="copyright" style="color:blue" value="<?php echo getWebsiteData()['copyright']; ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="twitter_link">Twitter link</label>
                                <input type="text" name="twitter_link" id="twitter_link" style="color:blue" value="<?php echo getWebsiteData()['twitter_link']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="youtube_link">Youtube link</label>
                                <input type="text" name="youtube_link" id="youtube_link" style="color:blue" value="<?php echo getWebsiteData()['youtube_link']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="facebook_link">Facebook link</label>
                                <input type="text" name="facebook_link" id="facebook_link" style="color:blue" value="<?php echo getWebsiteData()['facebook_link']; ?>" class="form-control">
                            </div>                            
                            <hr>
                            <input type="hidden" name="saveWebsiteData">
                            <button type="submit" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
                <div class="card p-s offset-md-1" style="width: 25rem;">
                    <div class="card-body">
                        <form action="../model/functions.php" method="POST">
                            <h5 class="card-title">Entity</h5>
                            <h6 class="card-subtitle mb-2 text-muted">A word that represents a location-based entity (i.e. parks)</h6>
                            <div class="form-group">
                                <label for="">Entity</label>
                                <input type="text" name="entity" style="color:blue" value="<?php echo getBasicData()['entity']; ?>" class="form-control">
                            </div>
                            <hr>
                            <input type="hidden" name="saveEntity">
                            <button type="submit" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
                <div class="card p-2 offset-md-1" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title">Country</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Give the coordinates of the country to center the map on that country </h6>
                        <form action="../model/functions.php" method="POST">
                            <div class="form-group">
                                <label for="">Country name</label>
                                <input type="text" class="form-control" style="color:blue" name="country_name" value="<?php echo getBasicData()['country_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" class="form-control" style="color:blue" name="latitude" value="<?php echo getBasicData()['latitude']; ?>">
                                <small id="emailHelp" class="form-text text-muted">i.e. 4.40</small>
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" class="form-control" style="color:blue" name="longitude" value="<?php echo getBasicData()['longitude']; ?>">
                                <small id="emailHelp" class="form-text text-muted">i.e. -72.9301367</small>
                            </div>
                            <div class="form-group">
                                <label for="">Zoom</label>
                                <input type="text" class="form-control" style="color:blue" name="zoom" value="<?php echo getBasicData()['zoom']; ?>">
                                <small id="emailHelp" class="form-text text-muted">A number from 0.0 to 18.0</small>
                            </div>
                            <hr>
                            <input type="hidden" name="saveCountryCenterPoint">
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

                        <!-- Button trigger newMarkerModal -->
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#newMarkerModal">
                            New
                        </button>
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
                                <?php
                                $result = getAllMarkers();
                                while ($marker = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $marker['id']; ?></th>
                                        <td><?php echo $marker['item_name']; ?></td>
                                        <td><?php echo $marker['latitude']; ?></td>
                                        <td><?php echo $marker['longitude']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
</main>


<!-- Modal New Marker-->
<div class="modal fade" id="newMarkerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Marker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../model/functions.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" style="color:blue" name="item_name">
                        <small id="emailHelp" class="form-text text-muted">Name of the place or location-based item as it appears on DBpedia</small>
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" style="color:blue" name="latitude">
                        <small id="emailHelp" class="form-text text-muted">i.e. 4.40</small>
                    </div>
                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control" style="color:blue" name="longitude">
                        <small id="emailHelp" class="form-text text-muted">i.e. -72.9301367</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="newMarker">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include("../basics/footer.php");
?>