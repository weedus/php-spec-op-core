<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 19.06.18
 * Time: 00:14
 */

namespace Weedus\PhpSpecOps\Core\Tests\functional;


use Weedus\Exceptions\NotYetImplementedException;

class LevelCest
{
    public function _before(\FunctionalTester $I)
    {
    }

    public function _after(\FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(\FunctionalTester $I)
    {
        throw new NotYetImplementedException(__METHOD__);
    }
}