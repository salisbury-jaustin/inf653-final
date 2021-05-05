<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Authors.php';

    $database = new Database();
    $db = $database->connect();

    $authors= new Authors($db);
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $authors->id = $id;
    }
    $authors_arr = array();
    $authors->read_single_byId();

    $authors_arr['data'] = array('id' => $authors->id,
                                'author' => $authors->author);

    echo json_encode($authors_arr);
    
?>