<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 03.06.18
 * Time: 12:49
 */

namespace Weedus\PhpSpecOps\Model\ValueObjects\Items;

use Assert\Assertion;
use Weedus\PhpSpecOps\Model\ValueObjects\AbstractValueObject;
use Weedus\PhpSpecOps\Model\ValueObjects\Equalizeable;

/**
 * Class ItemType
 * @package PhpSpecOps\ValueObjects\Items
 * @method static ItemType WEAPON()
 * @method static ItemType ARMOR()
 * @method static ItemType SUPPORT()
 */
class ItemType extends AbstractValueObject
{
    const WEAPON = 'weapon';
    const ARMOR = 'armor';
    const SUPPORT = 'support';

    private $value;

    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $name
     * @param $arguments
     * @return ItemType
     */
    public static function __callStatic($name, $arguments): self
    {
        return self::create($name);
    }

    /**
     * @param $name
     * @return ItemType
     */
    public static function create($name): self
    {
        return new self(constant('self::' . $name));
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Equalizeable $item
     * @return bool
     */
    public function equals(Equalizeable $item): bool
    {
        if(!($item instanceof ItemType)){
            return false;
        }
        return $this->value === $item->value;
    }
}