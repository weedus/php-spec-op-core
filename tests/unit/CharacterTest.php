<?php

namespace Weedus\PhpSpecOps\Core\Tests\unit;

use Ramsey\Uuid\Uuid;
use Weedus\PhpSpecOps\Core\Exceptions\ConstructionFailureException;
use Weedus\PhpSpecOps\Core\Model\Body\Human\HumanBodyInterface;
use Weedus\PhpSpecOps\Core\Model\Entities\Units\Characters\BrainAwareInterface;
use Weedus\PhpSpecOps\Core\Model\Entities\Units\Characters\CharacterEffectInterface;
use Weedus\PhpSpecOps\Core\Model\Entities\Units\Characters\Humans\Human;
use Weedus\PhpSpecOps\Core\Model\Entities\Units\Characters\Humans\HumanInterface;
use Weedus\PhpSpecOps\Core\Tests\Helper\TestBrain;

class CharacterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var HumanInterface
     */
    protected $character;
    /**
     * @var HumanInterface
     */
    protected $character2;

    /**
     * @throws ConstructionFailureException
     */
    protected function _before()
    {
        $this->character = new Human(new TestBrain(),'Test');
        $this->character2 = new Human(new TestBrain(),'Test');
    }

    protected function _after()
    {
    }

    // tests
    public function testInterfaces()
    {
        $this->assertInstanceOf(CharacterEffectInterface::class,$this->character);
        $this->assertInstanceOf(HumanInterface::class,$this->character);
        $this->assertInstanceOf(BrainAwareInterface::class,$this->character);
        $this->assertInstanceOf(HumanBodyInterface::class, $this->character->getBody());
        $this->assertInstanceOf(Uuid::class, $this->character->getId());

    }

    public function testEquality()
    {
        $this->assertTrue($this->character->equals($this->character));
        $this->assertTrue($this->character2->equals($this->character2));
        $this->assertFalse($this->character->equals($this->character2));
    }
}