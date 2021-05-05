<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Categories.php';

    $database = new Database();
    $db = $database->connect();

    $categories= new Categories($db);
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $categories->id = $id;
    }
    $categories_arr = array();
    $categories->read_single_byId();

    $categories_arr['data'] = array('id' => $categories->id,
                                'category' => $categories->category);

    echo json_encode($categories_arr);
    
?>