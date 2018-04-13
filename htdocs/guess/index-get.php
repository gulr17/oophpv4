<?php
/**
 * Get
 */

require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";

$title = "Guess my number (GET)";

$number = $_GET["number"] ?? -1;
$tries = $_GET["tries"] ?? 6;
$guess = $_GET["guess"] ?? null;
$game = new Guess($number, $tries);


if (isset($_GET["reset"])) {
    $game->random();
}

$res = null;
if (isset($_GET["doGuess"])) {
    $res = $game->makeGuess($guess);
}

?><!doctype html>
<meta charset="utf8">
<title><?=$title?></title>
<h1><?=$title?></h1>
<p>Guess a number between 1 and 100 you have <?=$game->tries?> tries left</p>
<form method="GET">
    <input name="number" value="<?=$game->number?>" type="hidden">
    <input name="tries" value="<?=$game->tries?>" type="hidden">
    <input name="guess" type="text">
    <input name="doGuess" value="Make a guess" type="submit">
    <input name="doCheat" value="Cheat" type="submit">
</form>
<a href="?reset=yes">Reset</a>
<?php
if (!isset($_GET["doCheat"])) {
    echo "<p>$res</p>";
} else {
    echo "<p>Correct is: $game->number</p>";
}
