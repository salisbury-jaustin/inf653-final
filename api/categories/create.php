<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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
    $category = htmlspecialchars(strip_tags($data->category)); 

    if (isset($category)) {
        $categories->category = $category;

        try {
            $categories->create_category();
            echo json_encode(array('message' => 'Category Created'));
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo json_encode(array('message' => $error));
        }
    } else {
        echo json_encode(array('message' => 'Must provide an category name'));
    }
?>