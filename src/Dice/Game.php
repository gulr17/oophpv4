<?php
namespace Gula\Dice;

/**
 * Short description for file
 *
 * PHP version 7
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Test
 * @package   Test
 * @author    Gustav Larsson <gustav.b.larsson@gmail.com>
 * @copyright 2018 Gustav Larsson
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://gula.pw
 */

/**
 * A dicehand, consisting of dices.
 *
 * @category Test
 * @package  Test
 * @author   Gustav Larsson <gustav.b.larsson@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://gula.pw
 */


class Game
{
    /**
     * Dices
     *
     * @var object $dices Object with dicerolls from player.
     * @var object $dicesComp Object with dicerolls from computer.
     */
    private $dices;
    private $dicesComp;

    /**
     * Create a new dicehand and roll them -player
     *
     * @return int[] with the result of the dice roll.
     */
    public function roll()
    {
        $this->dices = new DiceHand();
        $this->dices->roll();
        return $this->dices->values();
    }

    /**
     * Sum current score of the round
     *
     * @param  int $roundScore current roundScore.
     * @param  int $sum sum of last dice roll.
     *
     * @return int with the score of the round.
     */
    public function roundScore(int $roundScore, int $sum)
    {
        return $roundScore + $sum;
    }

    /**
     * Check if we have a winner
     *
     * @param  int[] $score Current score.
     *
     * @return int with the score of the round.
     */
    public function checkWinner(array $score)
    {
        if ($score[0] > 100) {
            return "You won!";
        }
        if ($score[1] > 100) {
            return "The Machine won!";
        }
    }

    /**
     * Simple logic for automated computer roll.
     *
     * @return int[] result of dice roll for computer.
     */
    public function rollComputer()
    {
        $this->dicesComp = new DiceHand(4);
        $this->dicesComp->roll();
        if (!in_array(1, $this->dicesComp->values())) {
            return array_sum($this->dicesComp->values());
        } else {
            return 0;
        }
    }
}
