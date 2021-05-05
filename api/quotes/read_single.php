<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Quotes.php';

    $database = new Database();
    $db = $database->connect();

    $quotes = new Quotes($db);
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $quotes->id = $id;
    }
    $quotes_arr = array();
    $quotes->read_single_byId();

    $quotes_arr['data'] = array('id' => $quotes->id,
                                'quote' => $quotes->quote,
                                'author' => $quotes->author,
                                'category' => $quotes->category);

    echo json_encode($quotes_arr);
    
?>