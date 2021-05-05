<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
        Content-Type,
        Access-Control-Allow-Methods,
        Authorization,
        X-Requested-With');

    require '../../config/Database.php';
    require '../../model/Authors.php';

    $database = new Database();
    $db = $database->connect();

    $authors = new Authors($db);
    $data = json_decode(file_get_contents("php://input"));

    foreach ($data as &$value) {
        $value = htmlspecialchars(strip_tags($value));
    }
    unset($value);

    if ($data->id != null 
        && $data->author != null) {

        $authors->id = $data->id;
        $authors->author = $data->author;
        
        try {
            $authors->update_author();
            echo json_encode(array('message' => 'Author Updated'));
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo json_encode(array('message' => $error));
        }
    } else {
        echo json_encode(array('message' => 'Must provide an author AND an id'));
    }
?>