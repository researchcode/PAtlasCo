<?php
//echo "Método HTTP: " . $_SERVER['REQUEST_METHOD'];
require("../model/functions.php");

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $item_name = $input['item_name'];
        $entity = $input['entity'];
        $country = $input['country'];
        $lang = $input['lang'];
        $arrayResult = getDBpediaInfo($item_name, $entity, $country, $lang);
        echo  $arrayResult;
        break;
    case 'GET':
        echo '{"jsonkey":"jsonvalue"}';
        break;
    case 'PUT':
        echo '{"jsonkey":"jsonvalue"}';
        break;
    case 'DELETE':
        echo '{"jsonkey":"jsonvalue"}';
        break;
}


function sparqlQuery($query, $baseURL, $format = "application/json")

{
    $params = array(
        "default-graph" =>  "",
        "should-sponge" =>  "soft",
        "query" =>  $query,
        "debug" =>  "on",
        "timeout" =>  "",
        "format" =>  $format,
        "save" =>  "display",
        "fname" =>  ""
    );

    $querypart = "?";
    foreach ($params as $name => $value) {
        $querypart = $querypart . $name . '=' . urlencode($value) . "&";
    }

    $sparqlURL = $baseURL . $querypart;

    return json_decode(file_get_contents($sparqlURL));
};

function getDBpediaInfo($item_name, $entity, $country, $lang)
{
    /*Comment*/
    $query1 = "SELECT ?la_comment
WHERE {
    {
        ?item rdfs:comment ?la_comment .
        FILTER regex(?la_comment, '" . $item_name . "', 'i') 
        FILTER regex(?la_comment, '" . $entity . "', 'i') 
    }       
}  LIMIT 1 ";
error_log($query1);
    $data1 = sparqlQuery($query1, getBasicData()['sparql_endpoint']);


    $dataArray = [];
    if (sizeof($data1->results->bindings) == 0) {
        $dataArray['la_comment'] = 'no comment';
    } else {
        foreach ($data1->results as $key => $value) {
            if (isset($value)) {
                if ($value[0] != null) {
                    if (is_object($value[0])) {
                        if (isset($value[0]->la_comment)) {
                            $dataArray['la_comment'] = $value[0]->la_comment->value;
                        }
                    }
                }
            }
        }
    }

    /*Thumbnail*/
    $query2 = "SELECT ?la_image
WHERE {       
{    
    ?item rdfs:label ?name2 .
    FILTER regex(?name2, '" . $item_name . "', 'i') .    
    ?item dbo:thumbnail  ?la_image .
    ?item dbo:country | dbo:location dbr:" . $country . ".
} 
}  LIMIT 1 ";
    error_log($query2);

    $data2 = sparqlQuery($query2, "http://dbpedia.org/sparql");

    if (sizeof($data2->results->bindings) == 0) {
        $dataArray['image'] = 'no image';
    } else {
        foreach ($data2->results as $key => $value) {
            if (isset($value)) {
                if ($value[0] != null) {
                    if (is_object($value[0])) {
                        if (isset($value[0]->la_image)) {
                            $dataArray['image'] = $value[0]->la_image->value;
                        }
                    }
                }
            }
        }
    }

    return json_encode($dataArray);
}
