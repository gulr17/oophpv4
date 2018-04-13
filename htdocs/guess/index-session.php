<?php
/**
 * Session
 */

require "config.php";
require "autoload.php";

$title = "Guess my number (SESSION)";


session_name("guessNumber");
session_start();

$guess = $_POST["guess"] ?? null;
$number = $_SESSION["number"] ?? -1;
$tries = $_SESSION["tries"] ?? 6;

$game = new Guess($number, $tries);

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

?><!doctype html>
<meta charset="utf8">
<title><?=$title?></title>
<h1><?=$title?></h1>
<p>Guess a number between 1 and 100 you have <?=$tries?> tries left</p>
<form method="POST">
    <input name="guess" type="text">
    <input name="doGuess" value="Make a guess" type="submit">
    <input name="doCheat" value="Cheat" type="submit">
    <input name="doReset" value="Restart" type="submit">
</form>
<?php
if (!isset($_POST["doCheat"])) {
    echo "<p>$res</p>";
} else {
    echo "<p>Correct is: $number</p>";
}