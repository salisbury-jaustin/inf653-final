<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Quotes.php';

    $database = new Database();
    $db = $database->connect();

    $quotes = new Quotes($db);

    if (isset($_GET['authorId']) && !isset($_GET['categoryId'])) {
        $authorId = filter_input(INPUT_GET, 'authorId', FILTER_SANITIZE_NUMBER_INT);
        $quotes->authorId = $authorId;
        $result = $quotes->read_byAuthorId(); 

        $count = $result->rowCount();

        if ($count > 0) {
            $quotes_arr = array();
            $quotes_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $quote = array(
                    'id' => $id,
                    'author' => $author,
                    'category' => $category,
                    'quote' => $quote
                );
                
                array_push($quotes_arr['data'], $quote);
            }

            echo json_encode($quotes_arr);
        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    } elseif (isset($_GET['categoryId']) && !isset($_GET['authorId'])) {
        $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $quotes->categoryId = $categoryId;
        $result = $quotes->read_byCategoryId(); 

        $count = $result->rowCount();

        if ($count > 0) {
            $quotes_arr = array();
            $quotes_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $quote = array(
                    'id' => $id,
                    'author' => $author,
                    'category' => $category,
                    'quote' => $quote
                );
                
                array_push($quotes_arr['data'], $quote);
            }

            echo json_encode($quotes_arr);
        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    } elseif (isset($_GET['authorId']) && isset($_GET['categoryId'])) {
        $authorId = filter_input(INPUT_GET, 'authorId', FILTER_SANITIZE_NUMBER_INT); 
        $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $quotes->authorId = $authorId;
        $quotes->categoryId = $categoryId;
        $result = $quotes->read_byAuthor_byCategory(); 

        $count = $result->rowCount();

        if ($count > 0) {
            $quotes_arr = array();
            $quotes_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $quote = array(
                    'id' => $id,
                    'author' => $author,
                    'category' => $category,
                    'quote' => $quote
                );
                
                array_push($quotes_arr['data'], $quote);
            }

            echo json_encode($quotes_arr);
        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    
    } elseif (isset($_GET['limit'])) {
        $limit = filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT);
        $quotes->limit = $limit;

        $result = $quotes->read_limit();

        $count = $result->rowCount();

        if ($count > 0) {
            $quotes_arr = array();
            $quotes_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $quote = array(
                    'id' => $id,
                    'author' => $author,
                    'category' => $category,
                    'quote' => $quote
                );
                
                array_push($quotes_arr['data'], $quote);
            }

            echo json_encode($quotes_arr);
        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    } else {
        $result = $quotes->read();

        $count = $result->rowCount();

        if ($count > 0) {
            $quotes_arr = array();
            $quotes_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $quote = array(
                    'id' => $id,
                    'author' => $author,
                    'category' => $category,
                    'quote' => $quote
                );
                
                array_push($quotes_arr['data'], $quote);
            }

            echo json_encode($quotes_arr);
        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    }
?>