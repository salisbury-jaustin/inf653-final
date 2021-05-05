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
    require '../../model/Categories.php';

    $database = new Database();
    $db = $database->connect();

    $categories = new Categories($db);
    $data = json_decode(file_get_contents("php://input"));

    foreach ($data as &$value) {
        $value = htmlspecialchars(strip_tags($value));
    }
    unset($value);

    if ($data->id != null 
        && $data->category != null) {

        $categories->id = $data->id;
        $categories->category = $data->category;

        try {
            $categories->update_category();
            echo json_encode(array('message' => 'Category Updated'));
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo json_encode(array('message' => $error));
        }
    } else {
        echo json_encode(array('message' => 'Must provide a category AND an id'));
    }
?>