<?php
namespace Gula\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    public $number;
    public $tries;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($number == -1) {
            $this->tries = $tries;
            $this->random();
        } else {
            $this->tries = $tries;
            $this->number = $number;
        }
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    
    public function random()
    {
        $this->number = mt_rand(1, 100);
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number()
    {
        return $this->number;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    
    public function makeGuess($guess)
    {
        $this->tries = $this->tries -1;
        if ($guess > 100 || $guess < 1) {
            throw new GuessException("Number is out of bounds", 1);
        } elseif ($guess > $this->number) {
            return "Your guess $guess <b>is to high.</b>";
        } elseif ($guess < $this->number) {
            return "Your guess $guess <b>is to low</b>.";
        } else {
            return "Your guess $guess <b>is correct</b>.";
        }
    }
}
