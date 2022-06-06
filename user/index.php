<?php
header('Content-Type: text/html; charset=UTF-8');

if (!defined('CSS_PATH')) {
    define('CSS_PATH', '../css/');
}
if (!defined('JS_PATH')) {
    define('JS_PATH', '../js/');
}
// Read the JSON file 
$json = file_get_contents('../vars.json');

// Decode the JSON file
$json_data = json_decode($json, true);

if ($json_data['installed'] == 0) {
    header('Location: ../install.php');
} else {

    session_start();
    unset($_SESSION['admin_admin']);
    $_SESSION['user_user'] = 1;

    require("../model/functions.php");
    include("../basics/header.php");

?>

    <!--Main layout-->
    <main class="mt-5">
        <div class="container">
            <!--Section: Content-->
            <hr />
            <section id="patlasco">
                <div class="row">
                    <div class="col-md-7 gx-5 mb-4">
                        <div class="shadow-2-strong" data-mdb-ripple-color="light" id="map_container">
                            <div id="map" style="margin-top: 10%;">
                                <button id="refreshButton" onclick="refresh()" class="btn btn-success btn-lg m-5 fa fa-refresh">
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-5 gx-5 mb-4">

                        <!-- Park info Card -->
                        <div id="cards_landscape_wrap-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                                <img src="../images/map.png" class="img-fluid" />
                                                <a href="#!">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" id="mapTitle">Select a point on the map</h5>
                                                <p class="card-text" id="mapContent">

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <!--Section: Content-->



        </div>

    </main>
    <!--Main layout-->





    <script type="text/javascript">
        <?php
        $result = getAllMarkers();
        $dataArray = "";
        $entityName = "parque";
        while ($marker = mysqli_fetch_assoc($result)) {

            $dataArray = $dataArray . '{"loc":[' . $marker["latitude"] . ',' . $marker["longitude"] . '], "title": ' . "'" . $marker['item_name'] . ' </br><button class="btn btn-success btn-xs" onclick="showInfo(' . "\'" . $marker['item_name'] . "\'" . ',' . "\'" . $entityName . "\'" . ') " href="#patlasco" data-mdb-toggle="collapse" data-mdb-target = "#collapseWidthExample" aria-expanded ="false" aria-controls ="collapseWidthExample" > Mostrar información </button>' . "'" . ', "icon": greenIcon,"alt": "' . $marker["item_name"] . '"},';
        }
        $markersData = "[" . $dataArray . "]";

        $basic_data = getBasicData();
        $country_name = $basic_data['country_name'];
        $latitude = $basic_data['latitude'];
        $longitude = $basic_data['longitude'];
        $zoom = $basic_data['zoom'];
        ?>

        //alert(data2);
        Object.defineProperty(navigator, 'userAgent', {
            get: function() {
                return 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36';
            }
        });
        setMap();





        function setMap() {

            var greenIcon = L.icon({
                iconUrl: '../img/leaf-green.png',
                shadowUrl: '../img/leaf-shadow.png',

                iconSize: [85, 80], // size of the icon
                shadowSize: [50, 64], // size of the shadow
                iconAnchor: [45, 80], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62], // the same for the shadow
                popupAnchor: [-5, -63] // point from which the popup should open relative to the iconAnchor
            });

            /*
                        var data = [{
                            "loc": [12.1667, -71.3333],
                            "title": 'Serranía de Macuira </br><button class="btn btn-success btn-xs" onclick="showInfo(\'Serranía de la Macuira\',\'La Serranía de la Macuira está en la Guajira \') " href="#patlasco" data-mdb-toggle="collapse" data-mdb-target = "#collapseWidthExample" aria-expanded = "false" aria-controls = "collapseWidthExample" > Mostrar información </button>',
                            "icon": greenIcon,
                            "alt": 'Serranía de Macuira'
                        }, ];*/


            <?php
            echo "var data =" . $markersData . ";";
            echo "var country_name ='" . $country_name . "';";
            echo "var latitude =" . $latitude . ";";
            echo "var longitude =" . $longitude . ";";
            echo "var zoom =" . $zoom . ";";
            ?>
            //var data = [{"loc":[12.1667,-71.3333], "icon": greenIcon,"alt": "Serranía de la Macuira"},];

            var map = L.map('map').
            setView([latitude, longitude],
                zoom);


            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                maxZoom: 18
            }).addTo(map);

            L.control.scale().addTo(map);

            var info = L.control();

            info.onAdd = function(map) {
                this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
                this.update();
                return this._div;
            };

            // method that we will use to update the control based on feature properties passed
            info.update = function() {
                this._div.innerHTML = '<h4 >LinkedAtlas</h4>';
                this._div.style.backgroundColor = "white";
                this._div.style.borderRadius = "20%";
                this._div.style.width = "150px";
                this._div.style.height = "50px";
                this._div.style.padding = "10px";
            };

            info.addTo(map);


            map.addLayer(new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')); //base layer

            var markersLayer = new L.featureGroup(); //layer contain searched elements



            var controlSearch = new L.Control.Search({
                position: 'topleft',
                layer: markersLayer,
                propertyName: 'alt',
                initial: false,
                zoom: 12,
                marker: false
            });

            map.addControl(controlSearch);


            ////////////populate map with markers from sample data
            for (i in data) {
                var alt = data[i].alt, //value searched                
                    loc = data[i].loc, //position found
                    marker = new L.Marker(new L.latLng(loc), {
                        title: data[i].title,
                        alt: alt,
                        icon: data[i].icon
                    }); //se property searched
                marker.bindPopup(data[i].title);
                marker.on('click', function(e) {
                    map.setView(e.latlng, 11);
                });
                markersLayer.addLayer(marker);
            }



            //map.fitBounds(markersLayer.getBounds());




            return map;
        }

        function showInfo(title, content) {

            <?php
            require_once("dbpedia_query.php");
            echo "var data2 = " . getDBpediaESInfo("El Cocuy", "parque")['la_comment'] . ";";
            ?>

            document.getElementById("mapTitle").innerHTML = title;

            document.getElementById("mapContent").innerHTML = content; //outputResult;
        }

        function refresh(latitude, longitude, zoom) {
            map.remove();
            //console.log("MAPA: " + mapa.outerHTML);
            var div = document.createElement("div");
            div.setAttribute("id", "map");
            div.setAttribute("style", "margin-top: 10%;");
            var boton = document.createElement("button");
            boton.setAttribute("id", "refreshButton");
            boton.setAttribute("onclick", "refresh()");
            boton.setAttribute("data-mdb-toggle", "collapse");
            boton.setAttribute("data-mdb-target", "#collapseWidthExample");
            boton.setAttribute("aria-expanded", "false");
            boton.setAttribute("aria-controls", "collapseWidthExample");
            boton.setAttribute("class", "btn btn-success btn-lg m-5 fa fa-refresh");
            div.appendChild(boton);
            document.getElementById('map_container').appendChild(div);
            document.getElementById("mapTitle").innerHTML = "Select a point on the map";
            document.getElementById("mapContent").innerHTML = "";
            var mapa = setMap();
            mapa.setView([latitude, longitude], zoom);
        }
    </script>
<?php
    function searchData2($data1, $data2)
    {
        require_once("dbpedia_query.php");
        $resultDBpedia = getDBpediaESInfo($data1, $data2);
        //echo "<br>" . $resultDBpedia['la_comment'];
        return $resultDBpedia['la_comment'];
    }
    include("../basics/footer.php");
}
?>