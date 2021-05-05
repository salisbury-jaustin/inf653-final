<?php 
    // require custom class Curl
    require './config/Curl.php';

    // store necessary api endpoints
    $author_url = 'https://quotemachine-demo.herokuapp.com/quotes/api/authors/';
    $category_url= 'https://quotemachine-demo.herokuapp.com/quotes/api/categories/';

    // create Curl object for each api request
    $author_request = new Curl();
    $category_request = new Curl();

    // pass api endpoints to Curl objects
    $author_request->service_url = $author_url;
    $category_request->service_url = $category_url;

    // call Curl method to send request for data to api && store returned data
    $author_response = $author_request->send_request();
    $category_response = $category_request->send_request();

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'read';
    }

    if ($action == 'read') {
        // store api endpoint url for getting all quotes
        $quote_url = 'https://quotemachine-demo.herokuapp.com/quotes/api/quotes/';

        // create Curl object for each api request
        $quote_request = new Curl();

        // pass api endpoints to Curl objects
        $quote_request->service_url = $quote_url;      

        // call Curl method to send request for data to api && store returned data
        $quote_response = $quote_request->send_request();

        include('./view/quotes.php');
    }

    elseif ($action == 'sort') {
        // determine the api endpoint from the get request
        if (!empty($_GET['authorId']) && !empty($_GET['categoryId'])) {
            $quote_url = 'https://quotemachine-demo.herokuapp.com/quotes/api/quotes/' . '?authorId=' . $_GET['authorId'] . '&categoryId=' . $_GET['categoryId'];
        } elseif (!empty($_GET['authorId']) && empty($_GET['categoryId'])) {
            $quote_url = 'https://quotemachine-demo.herokuapp.com/quotes/api/quotes/' . '?authorId=' . $_GET['authorId'];
        } else if (empty($_GET['authorId']) && !empty($_GET['categoryId'])) {
            $quote_url = 'https://quotemachine-demo.herokuapp.com/quotes/api/quotes/' . '?categoryId=' . $_GET['categoryId'];
        } else {
            $quote_url = 'https://quotemachine-demo.herokuapp.com/quotes/api/quotes/';
        }

        // create Curl object for each api request
        $quote_request = new Curl();

        // pass api endpoints to Curl objects
        $quote_request->service_url = $quote_url;      

        // call Curl method to send request for data to api && store returned data
        $quote_response = $quote_request->send_request();

        include('./view/quotes.php');
    }
?>