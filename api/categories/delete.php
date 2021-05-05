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
    require '../../model/Categories.php';

    $database = new Database();
    $db = $database->connect();

    $categories = new Categories($db);
    $data = json_decode(file_get_contents("php://input"));
    $id = htmlspecialchars(strip_tags($data->id)); 

    if (isset($id)) {
        $categories->id = $id;

        try {
            $categories->delete_category();
            echo json_encode(array('message' => 'Category Deleted'));
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo json_encode(array('message' => $error));
        }
    } else {
        echo json_encode(array('message' => 'Must provide a category ID'));
    }
?>