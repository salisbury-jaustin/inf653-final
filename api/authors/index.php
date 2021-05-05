<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Authors.php';

    $database = new Database();
    $db = $database->connect();

    $authors = new Authors($db);

    $result = $authors->read();

        $count = $result->rowCount();

        if ($count > 0) {
            $authors_arr = array();
            $authors_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $author = array(
                    'id' => $id,
                    'author' => $author
                );
                
                array_push($authors_arr['data'], $author);
            }

            echo json_encode($authors_arr);
        } else {
            echo json_encode(array('message' => 'No Authors Found'));
        }
?>