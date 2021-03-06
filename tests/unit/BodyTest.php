<?php

namespace Weedus\PhpSpecOps\Core\Tests\unit;

use Weedus\PhpSpecOps\Core\Model\Area\Range;
use Weedus\PhpSpecOps\Core\Model\Body\Body;
use Weedus\PhpSpecOps\Core\Model\Body\BodyInterface;
use Weedus\PhpSpecOps\Core\Model\Body\Human\HumanBody;
use Weedus\PhpSpecOps\Core\Model\Body\Human\HumanBodyInterface;
use Weedus\PhpSpecOps\Core\Model\ValueObjects\Items\Armor\Chest\ArmorChestInterface;
use Weedus\PhpSpecOps\Core\Model\ValueObjects\Items\Armor\Head\ArmorHeadInterface;
use Weedus\PhpSpecOps\Core\Model\ValueObjects\Items\Armor\Legs\ArmorLegsInterface;
use Weedus\PhpSpecOps\Core\Model\ValueObjects\Items\Weapon\WeaponInterface;
use Weedus\PhpSpecOps\Core\Model\ValueObjects\Items\Weapon\WeaponType;
use Weedus\PhpSpecOps\Core\Tests\Helper\TestArmorChest;
use Weedus\PhpSpecOps\Core\Tests\Helper\TestArmorHead;
use Weedus\PhpSpecOps\Core\Tests\Helper\TestArmorLegs;
use Weedus\PhpSpecOps\Core\Tests\Helper\TestWeapon;

class BodyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCreation()
    {
        $body1 = new Body();
        $body2 = new HumanBody();

        $this->assertInstanceOf(BodyInterface::class, $body1);
        $this->assertInstanceOf(BodyInterface::class, $body2);
        $this->assertNotInstanceOf(HumanBodyInterface::class, $body1);
        $this->assertInstanceOf(HumanBodyInterface::class, $body2);
    }

    public function testSetterAndGetter()
    {
        $body = new HumanBody();

        $chest = new TestArmorChest('chest', 1);
        $head = new TestArmorHead('head', 1);
        $legs = new TestArmorLegs('legs', 1);
        $weapon = new TestWeapon('weapon', 1, 1, Range::ZERO(), Range::MEDIUM(), WeaponType::DAGGER());
        $shield = new TestWeapon('weapon', 1, 1, Range::ZERO(), Range::MEDIUM(), WeaponType::SHIELD());

        $this->assertNull($body->getChest());
        $this->assertNull($body->getHead());
        $this->assertNull($body->getLegs());
        $this->assertNull($body->getLeftHand());
        $this->assertNull($body->getRightHand());

        $body->setHead($head);
        $body->setLegs($legs);
        $body->setChest($chest);
        $body->setLeftHand($weapon);
        $body->setRightHand($shield);

        $this->assertInstanceOf(ArmorChestInterface::class, $body->getChest());
        $this->assertInstanceOf(ArmorHeadInterface::class, $body->getHead());
        $this->assertInstanceOf(ArmorLegsInterface::class, $body->getLegs());
        $this->assertInstanceOf(WeaponInterface::class, $body->getLeftHand());
        $this->assertInstanceOf(WeaponInterface::class, $body->getRightHand());
    }

    // tests

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}
