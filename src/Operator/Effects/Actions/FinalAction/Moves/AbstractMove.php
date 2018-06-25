<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 05.06.18
 * Time: 23:57
 */

namespace Weedus\PhpSpecOps\Operator\Effects\Actions\FinalAction\Moves;


use Assert\Assertion;
use Weedus\PhpSpecOps\Model\Area\Field;
use Weedus\PhpSpecOps\Model\Area\Location;
use Weedus\PhpSpecOps\Model\Units\Characters\CharacterEffectInterface;
use Weedus\PhpSpecOps\Model\Units\Characters\CharacterInterface;
use Weedus\PhpSpecOps\Model\Units\Placeables\Walkables\WalkableInterface;
use Weedus\PhpSpecOps\Model\ValueObjects\Range;
use Weedus\PhpSpecOps\Operator\Effects\AbstractEffect;

abstract class AbstractMove extends AbstractEffect
{
    /**
     * @return Range
     */
    public function getRange(): Range
    {
        return Range::ZERO();
    }

    /**
     * @param null $value
     * @return mixed
     * @throws \Assert\AssertionFailedException
     */
    public static function create($value = null)
    {
        Assertion::null($value);
        return parent::create($value); // TODO: Change the autogenerated stub
    }
    /**
     * @param CharacterEffectInterface $target
     * @param Field $field
     * @throws \Assert\AssertionFailedException
     */
    private function move(CharacterEffectInterface $target, Field $field)
    {
        Assertion::notEmpty($field);
        Assertion::false($field->hasCharacter());

        $this->performLeaveEffect($target);
        $target->getField()->unsetCharacter();

        Assertion::isInstanceOf($target, CharacterInterface::class);
        /** @var CharacterInterface $target */
        $field->setCharacter($target);
        $this->performArriveEffect($target);

    }


    protected function newLocation(Location $location): Location
    {
        return Location::create($location->getX(),$location->getY(),$location->getZ());

    }

    /**
     * @param Field $caster
     * @param null|Field $target
     * @throws \Assert\AssertionFailedException
     */
    public function perform(Field $caster, ?Field $target = null): void
    {
        $location = $this->newLocation($caster->getLocation());
        $field = $caster->getMap()->getField($location);
        $this->checkFieldForStairs($field);
        $this->move($caster, $field);
    }

    /**
     * @param null|Field $field
     * @throws \Assert\AssertionFailedException
     */
    private function checkFieldToWalk(?Field $field = null): void
    {
        Assertion::notEmpty($field);
        Assertion::false($field->hasCharacter());
        $placeable = $field->getPlace();
        Assertion::true($placeable->isWalkable());
    }

    /**
     * @param null|Field $field
     * @throws \Assert\AssertionFailedException
     */
    private function checkFieldForStairs(?Field $field = null): void
    {
        $this->checkFieldToWalk($field);
        $placeable = $field->getPlace();
        Assertion::true($placeable->isStairs());
        Assertion::true($placeable->goesUp());
    }

    private function performLeaveEffect(CharacterEffectInterface $target)
    {
        /** @var WalkableInterface $placeable */
        $placeable = $target->getField()->getPlace();
        if(!$placeable->hasLeaveEffect()){
            return null;
        }
        $placeable->getLeaveEffect()->perform($target);
    }

    private function performArriveEffect(CharacterEffectInterface $target)
    {
        /** @var WalkableInterface $placeable */
        $placeable = $target->getField()->getPlace();
        if(!$placeable->hasArriveEffect()){
            return null;
        }
        $placeable->getArriveEffect()->perform($target);
    }

}