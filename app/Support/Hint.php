<?php


namespace App\Support;

class Hint
{
    /**
     * @ 委婉提示
     * @var array
     */
    protected static $tactful = [
        1   =>  "I know it's just a little joke.",
        2   =>  "Are you trying to move me ?",
        3   =>  "There is a kind of love called letting go.",
        4   =>  "If you want to spend it, you have to have it.",
        5   =>  "Good programmers don't need a girlfriend.",
        6   =>  "There are so many people who have no goals",
        7   =>  "Want to get rich first.",



        999 =>  "Only access to root.",
    ];

    /**
     * @ 警告提示
     * @var array
     */
    protected static $warnimg = [

    ];

    public static function tactful($index=1)
    {
        return static::$tactful[$index];
    }

    public static function warning($index=1)
    {
        return static::$warnimg[$index];
    }
}