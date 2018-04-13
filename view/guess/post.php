<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
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
