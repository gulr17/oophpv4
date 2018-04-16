<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<style>
/**
 * CSS sprite for a dice with six faces.
 */
.dice-sprite {
    display: inline-block;
    padding: 0;
    margin: 0 4px 0 0;
    width: 32px;
    height: 32px;
    background: url(../img/dice-faces.jpg) no-repeat;
}

.dice-sprite.dice-1 { background-position: -160px 0; }
.dice-sprite.dice-2 { background-position: -128px 0; }
.dice-sprite.dice-3 { background-position: -96px 0; }
.dice-sprite.dice-4 { background-position: -64px 0; }
.dice-sprite.dice-5 { background-position: -32px 0; }
.dice-sprite.dice-6 { background-position: 0 0; }
</style>
<?php if (!isset($won)) : ?>
<p>

<?php foreach ($res as $value) : ?>
    <i class="dice-sprite dice-<?= $value ?>"></i>
<?php endforeach; ?>
</p>

<h3>Summa denna runda: <?= $_SESSION["roundScore"] ?? $roundScore?>.</h3>

<table>
    <tr>
        <td>
            <b>Du</b>
        </td>
        <td>
            <?=$score[0] ?? 0?>
        </td>
    </tr>
    <tr>
        <td>
            <b>Datorn</b>
        </td>
        <td>
            <?=$_SESSION["score"][1] ?? 0?>
        </td>
    </tr>
</table>



<form method="POST">
    <input name="roll" type="submit" value="Rulla">
    <input name="stay" type="submit" value="Stanna">
    <input name="reset" type="submit" value="Reset">
</form>
<?php else : ?>
<h1><?=$won?></h1>
<?php endif; ?>
