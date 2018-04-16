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
 * Class that handles dice roll.
 *
 * @category Test
 * @package  Test
 * @author   Gustav Larsson <gustav.b.larsson@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://gula.pw
 */
class Dice
{
    /**
     * Variables to use
     *
     * @var int $lastRoll  Value of the last roll.
     * @var int $die   Die variable.
     */
    private $sides;
    protected $lastRoll;

    /**
     * Constructor to create a dice.
     *
     * @param int $die Value of the die.
     *
     * @return void
     */
    public function __construct(int $die = -1)
    {
        $this->die = $die;
        if ($die === -1) {
            $this->roll();
        }
    }

    /**
     * Roll a die. Create random number between 1 and 6.
     *
     * @return int
     */
    public function roll()
    {
        $this->lastRoll = rand(1, 6);
        return $this->lastRoll;
    }
}
