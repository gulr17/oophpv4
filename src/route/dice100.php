<?php
/**
 * Dice100 specific routes.
 */
//var_dump(array_keys(get_defined_vars()));
/**
 * Dice 100
 */
$app->router->any(["GET", "POST"], "tarning/dice100", function () use ($app) {
    $data = [
        "title" => "Spela Dice100"
    ];

    //include __DIR__ . "/../../htdocs/dice/index.php";

    //require __DIR__ . "/config.php";
    //require __DIR__ . "/../../vendor/autoload.php";

    session_name("dice100");
    session_start();
    
    $roundScore = $_SESSION["roundScore"] ?? 0;
    $score = $_SESSION['score'] ?? array(0, 0);
    $res = $_SESSION['res'] ?? array();
    
    $game = new \Gula\Dice\Game();
    
    function rollComputer($game, $score)
    {
        $score[1] = $score[1] + $game->rollComputer();
        $_SESSION['score'] = $score;
        $roundScore = 0;
    }
    
    if (isset($_POST["roll"])) {
        $res = $game->roll();
        $_SESSION["res"] = $res;
    
        $roundScore = !in_array(1, $res)
            ? $game->roundScore($roundScore ?? 0, array_sum($res)) : rollComputer($game, $score);
        $_SESSION["roundScore"] = $roundScore;
        $won = $game->checkWinner($_SESSION["score"] ?? array(0, 0));
    }
    
    if (isset($_POST["stay"])) {
        $score[0] += $_SESSION["roundScore"];
        $_SESSION['score'] = $score;
        $_SESSION["roundScore"] = 0;
        rollComputer($game, $score);
        $won = $game->checkWinner($_SESSION["score"] ?? array(0,0));
    }
    
    if (isset($_POST["reset"])) {
        session_destroy();
    }


    $data["res"] = $res;
    $data["score"] = $score;
    $data["roundScore"] = $roundScore;
    $data["game"] = $game;
    $data["won"] = $won;

    $app->view->add("dice/dice100", $data);
    $app->page->render($data);
});
/**
* Dice 100
 */
$app->router->get("lek/hello-world-wrap", function () use ($app) {
    $data = [
        "title" => "Show hello world within page layout | oophp",
        "class" => "hello-world",
        "content" => "Hello World",
    ];
    $app->view->add("content/oophp/default", $data);
    $app->page->render($data);
});
