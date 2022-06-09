<?php
//echo "Método HTTP: " . $_SERVER['REQUEST_METHOD'];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $item_name = $input['item_name'];
        $entity = $input['entity'];
        $arrayResult = getDBpediaESInfo($item_name, $entity);
        echo  $arrayResult;
        break;
    case 'GET':
        echo '{"Xonsultar":1}';
        break;
    case 'PUT':
        echo 'Actualizar';
        break;
    case 'DELETE':
        echo 'Eliminar';
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

function getDBpediaESInfo($item_name, $entity)
{
    //$item_name = "Macuira";
    //$entity = "parque";
    $query = "SELECT ?la_comment, ?la_name
WHERE {
    {
        ?item rdfs:comment ?la_comment .
        FILTER regex(?la_comment, '" . $item_name . "', 'i') 
        FILTER regex(?la_comment, '" . $entity . "', 'i') 
    }    
    {
        ?item rdfs:label ?la_name .
        FILTER regex(?la_name, '" . $item_name . "', 'i')
        FILTER regex(?la_name, '" . $item_name . "', 'i') .
    }        
}  LIMIT 1 ";

    $data = sparqlQuery($query, "http://es.dbpedia.org/sparql");


    $dataArray = [];
    if (sizeof($data->results->bindings) == 0) {
        $dataArray['la_comment'] = 'no comment';
    } else {
        foreach ($data->results as $key => $value) {
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

    return json_encode($dataArray);
}
