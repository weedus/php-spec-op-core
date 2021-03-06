<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 05.06.18
 * Time: 23:36
 */

namespace Weedus\PhpSpecOps\Core\Operator\Effects\Actions\FinalAction\Moves;


use Weedus\PhpSpecOps\Core\Model\Area\Location;

class MoveNorth extends AbstractMove
{
    protected function newLocation(Location $location): Location
    {
        return Location::create($location->getX() + 1, $location->getY(), $location->getZ());
    }
}