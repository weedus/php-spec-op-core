<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 03.06.18
 * Time: 17:40
 */

namespace PhpSpecOps\Operator\Effects\Health;


use Assert\Assertion;
use PhpSpecOps\Model\Entities\Units\CharacterEffectInterface;
use PhpSpecOps\Operator\Effects\AbstractEffect;
use PhpSpecOps\ValueObjects\Range;

class Heal extends AbstractEffect
{
    /** @var int */
    protected $value;

    /**
     * Heal constructor.
     * @param int $amount
     */
    public function __construct(int $value)
    {
        Assertion::greaterOrEqualThan($value, 0);
        $this->value = $value;
    }

    /**
     * @return Range
     */
    public function getRange(): Range
    {
        return Range::ZERO();
    }

    /**
     * @param CharacterEffectInterface $caster
     */
    public function perform(CharacterEffectInterface $caster): void
    {
        $caster->addHealth($this->value);
    }

    /**
     * @param null $value
     * @return mixed|Heal
     * @throws \Assert\AssertionFailedException
     */
    public static function create($value = null)
    {
        Assertion::integer($value);
        return new static($value);
    }


}