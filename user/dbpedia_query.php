<?php
# Example retrieved from: https://www.openlinksw.com/blog/~kidehen/?id=1652#:~:text=SPARQL%20queries%20are%20actually%20HTTP,PHP.

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
    echo "ENTRAAAAAAAAAAA";
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
    foreach ($data->results as $key => $value) {
        if ($value[0] != null) {
            if (is_object($value[0])) {
                if (isset($value[0]->la_comment))
                    $dataArray['la_comment'] = $value[0]->la_comment->value;
            }
        }
    }
    //print_r($dataArray);

    return $dataArray;
}
