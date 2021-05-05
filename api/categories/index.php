<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Categories.php';

    $database = new Database();
    $db = $database->connect();

    $categories = new Categories($db);

    $result = $categories->read();

        $count = $result->rowCount();

        if ($count > 0) {
            $categories_arr = array();
            $categories_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $category = array(
                    'id' => $id,
                    'category' => $category
                );
                
                array_push($categories_arr['data'], $category);
            }

            echo json_encode($categories_arr);
        } else {
            echo json_encode(array('message' => 'No Categories Found'));
        }
?>