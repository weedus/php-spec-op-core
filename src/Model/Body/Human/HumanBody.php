<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 04.06.18
 * Time: 21:35
 */

namespace Weedus\PhpSpecOps\Model\Body\Human;


use Weedus\PhpSpecOps\Model\Body\Body;
use Weedus\PhpSpecOps\Model\Equalizeable;
use Weedus\PhpSpecOps\Model\ValueObjects\Items\Armor\Head\ArmorHeadInterface;
use Weedus\PhpSpecOps\Model\ValueObjects\Items\Armor\Head\ArmorLegsInterface;
use Weedus\PhpSpecOps\Model\ValueObjects\Items\Weapon\WeaponInterface;

class HumanBody extends Body implements HumanBodyInterface
{

    /** @var WeaponInterface */
    protected $leftHand;
    /** @var WeaponInterface */
    protected $rightHand;

    /** @var ArmorHeadInterface */
    protected $head;
    /** @var ArmorLegsInterface */
    protected $legs;

    /**
     * @return WeaponInterface
     */
    public function getLeftHand(): WeaponInterface
    {
        return $this->leftHand;
    }

    /**
     * @param WeaponInterface $leftHand
     */
    public function setLeftHand(WeaponInterface $leftHand): void
    {
        $this->leftHand = $leftHand;
    }

    /**
     * @return WeaponInterface
     */
    public function getRightHand(): WeaponInterface
    {
        return $this->rightHand;
    }

    /**
     * @param WeaponInterface $rightHand
     */
    public function setRightHand(WeaponInterface $rightHand): void
    {
        $this->rightHand = $rightHand;
    }

    /**
     * @return ArmorHeadInterface
     */
    public function getHead(): ArmorHeadInterface
    {
        return $this->head;
    }

    /**
     * @param ArmorHeadInterface $head
     */
    public function setHead(ArmorHeadInterface $head): void
    {
        $this->head = $head;
    }

    /**
     * @return ArmorLegsInterface
     */
    public function getLegs(): ArmorLegsInterface
    {
        return $this->legs;
    }

    /**
     * @param ArmorLegsInterface $legs
     */
    public function setLegs(ArmorLegsInterface $legs): void
    {
        $this->legs = $legs;
    }

    public function equals(Equalizeable $item): bool
    {
        if (!($item instanceof HumanBodyInterface)) {
            return false;
        }
        return $this->leftHand->equals($item->getLeftHand())
            && $this->rightHand->equals($item->getRightHand())
            && $this->head->equals($item->getHead())
            && $this->legs->equals($item->getLegs())
            && parent::equals($item);
    }


}