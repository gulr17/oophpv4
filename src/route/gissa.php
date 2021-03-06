<?php
/**
 * Guess game specific routes.
 */

/**
 * Guess
 */
$app->router->get("gissa/get", function () use ($app) {
    //include __DIR__ . "/../../htdocs/guess/index_get-inside.php";

    $data = [
        "title" => "Gissa mitt nummer (GET)"
    ];

    $number = $_GET["number"] ?? -1;
    $tries = $_GET["tries"] ?? 6;
    $guess = $_GET["guess"] ?? null;
    $game = new Gula\Guess\Guess($number, $tries);


    if (isset($_GET["reset"])) {
        $game->random();
    }

    $res = null;
    if (isset($_GET["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    $data["game"] =  $game;
    $data["res"] =  $res;
    $data["guess"] =  $guess;

    $app->view->add("guess/get", $data);
    $app->page->render($data);
});

$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer (POST)"
    ];

    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;
    $game = new Gula\Guess\Guess($number, $tries);
    /*
    echo "<pre>";
    echo "<p>POST </p>";
    var_dump($_POST);
    echo "<p>Object: </p>";
    var_dump($game);
    echo "</pre>";
    */
    if (isset($_POST["reset"])) {
        $game->random();
    }
    
    $res = null;
    if (isset($_POST["doGuess"])) {
        $res = $game->makeGuess($guess);
    }

    $data["number"] = $number;
    $data["game"] =  $game;
    $data["res"] =  $res;
    $data["guess"] =  $guess;

    $app->view->add("guess/post", $data);
    $app->page->render($data);
});

$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer (SESSION)"
    ];
    
    session_name("guessNumber");
    session_start();
    
    $guess = $_POST["guess"] ?? null;
    $number = $_SESSION["number"] ?? -1;
    $tries = $_SESSION["tries"] ?? 6;
    
    $game = new Gula\Guess\Guess($number, $tries);
    
    if ($number == -1) {
        $_SESSION["number"] = $game->number;
    }
    
    if (isset($_POST["doReset"])) {
        $game->random();
        session_destroy();
    }
    
    $res = null;
    if (isset($_POST["doGuess"])) {
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries;
    }
    $data["tries"] = $tries;
    $data["number"] = $number;
    $data["game"] =  $game;
    $data["res"] =  $res;
    $data["guess"] =  $guess;

    $app->view->add("guess/session", $data);
    $app->page->render($data);
});
