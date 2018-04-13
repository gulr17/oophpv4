<?php
/**
 * Post
 */

require "config.php";
require "autoload.php";

$title = "Guess my number (POST)";

$number = $_POST["number"] ?? -1;
$tries = $_POST["tries"] ?? 6;
$guess = $_POST["guess"] ?? null;
$game = new Guess($number, $tries);
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

?><!doctype html>
<meta charset="utf8">
<title><?=$title?></title>
<h1><?=$title?></h1>
<p>Guess a number between 1 and 100 you have <?=$game->tries?> tries left</p>
<form method="POST">
    <input name="number" value="<?=$game->number?>" type="hidden">
    <input name="tries" value="<?=$game->tries?>" type="hidden">
    <input name="guess" type="text">
    <input name="doGuess" value="Make a guess" type="submit">
    <input name="doCheat" value="Cheat" type="submit">
</form>
<a href="?reset=yes">Reset</a>
<?php
if (!isset($_POST["doCheat"])) {
    echo "<p>$res</p>";
} else {
    echo "<p>Correct is: $game->number</p>";
}