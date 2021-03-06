<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 18.06.18
 * Time: 00:26
 */

namespace Weedus\PhpSpecOps\Core\Specifications\Map;


use Weedus\PhpSpecOps\Core\Model\Area\Field;
use Weedus\Specification\SpecificationInterface;

class HasCharacter implements SpecificationInterface
{
    public function isSatisfiedBy($item): bool
    {
        if (!($item instanceof Field)) {
            return false;
        }
        return $item->hasCharacter();
    }
}