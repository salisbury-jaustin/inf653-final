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
    require '../../model/Quotes.php';

    $database = new Database();
    $db = $database->connect();

    $quotes = new Quotes($db);
    $data = json_decode(file_get_contents("php://input"));
    foreach ($data as &$value) {
        $value = htmlspecialchars(strip_tags($value));
    }
    unset($value);

    if ($data->quote != null 
        && $data->authorId != null 
        && $data->categoryId != null) {

        $quotes->authorId = $data->authorId;
        $quotes->categoryId = $data->categoryId;
        $quotes->quote = $data->quote;

        try {
            $quotes->create_quote();
            echo json_encode(array('message' => 'Quote Created'));
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo json_encode(array('message' => $error));
        }
    } else {
        echo json_encode(array('message' => 'Must provide an authorId, categoryId, and quote'));
    }
?>