<?php
    $json = '[]';

    if(isset($_GET['category']) == true && $_GET['category'] != '') {
        $parameter = $_GET['category'];

        if($parameter == "math_1") {
            $json = "[{\"name\":\"1級\"},
                      {\"name\":\"準1級\"},
                      {\"name\":\"2級\"},
                      {\"name\":\"準2級\"},
                      {\"name\":\"3級\"},
                      {\"name\":\"4級\"},
                      {\"name\":\"5級\"}]";
        }
        else if($parameter == "math_2") {
            $json = "[{\"name\":\"6級\"},
                      {\"name\":\"7級\"},
                      {\"name\":\"8級\"},
                      {\"name\":\"9級\"},
                      {\"name\":\"10級\"},
                      {\"name\":\"11級\"},
                      {\"name\":\"かず・かたち検定\"}]";
        }
    }

    header('content-type:application/json; charset=UTF-8');
    print($json);