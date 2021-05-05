<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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
    $id = htmlspecialchars(strip_tags($data->id)); 

    if (isset($id)) {
        $authors->id = $id;

        try {
            $authors->delete_author();
            echo json_encode(array('message' => 'Author Deleted'));
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo json_encode(array('message' => $error));
        }
    } else {
        echo json_encode(array('message' => 'Must provide an author id'));
    }
?>