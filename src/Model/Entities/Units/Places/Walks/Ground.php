<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 05.06.18
 * Time: 23:44
 */

namespace Weedus\PhpSpecOps\Core\Model\Entities\Units\Places\Walks;

use PascalDeVink\ShortUuid\ShortUuid;
use Weedus\PhpSpecOps\Core\Model\Entities\Units\Places\AbstractPlace;
use Weedus\PhpSpecOps\Core\Operator\Effects\EffectInterface;

class Ground extends AbstractPlace implements WalksInterface
{
    public function __construct(?string $name, ?ShortUuid $id)
    {
        parent::__construct($name ?? 'ground', $id);
    }

    public function isWalkable(): bool
    {
        return true;
    }

    public function getWalkOverEffect(): ?EffectInterface
    {
        return null;
    }

    /**
     * @return null|EffectInterface
     */
    public function getRestEffect(): ?EffectInterface
    {
        return null;
    }

    public function hasArriveEffect(): bool
    {
        return !empty($this->getArriveEffect());
    }

    /**
     * @return null|EffectInterface
     */
    public function getArriveEffect(): ?EffectInterface
    {
        return null;
    }

    public function hasStandOnEffect(): bool
    {
        return !empty($this->getStandOnEffect());
    }

    /**
     * @return null|EffectInterface
     */
    public function getStandOnEffect(): ?EffectInterface
    {
        return null;
    }

    public function hasLeaveEffect(): bool
    {
        return !empty($this->getLeaveEffect());
    }

    /**
     * @return null|EffectInterface
     */
    public function getLeaveEffect(): ?EffectInterface
    {
        return null;
    }
}