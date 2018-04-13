<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
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