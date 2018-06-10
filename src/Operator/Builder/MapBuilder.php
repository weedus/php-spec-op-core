<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 06.06.18
 * Time: 23:54
 */

namespace PhpSpecOps\Operator\Builder;


use PhpSpecOps\Model\Area\Field;
use PhpSpecOps\Model\Area\Location;
use PhpSpecOps\Model\Area\Map;
use PhpSpecOps\ValueObjects\Configuration\ConfigurationInterface;
use PhpSpecOps\ValueObjects\Configuration\FieldConfiguration;
use PhpSpecOps\ValueObjects\Configuration\LevelConfiguration;

abstract class MapBuilder implements BuilderInterfacer
{

    /**
     * @param ConfigurationInterface $configuration
     * @return bool|Map
     * @throws \Assert\AssertionFailedException
     */
    public static function get(ConfigurationInterface $configuration)
    {
        if($configuration instanceof LevelConfiguration){
            return self::getByLevelConfig($configuration);
        }
        return false;
    }

    /**
     * @param LevelConfiguration $configuration
     * @return Map
     * @throws \Assert\AssertionFailedException
     */
    private static function getByLevelConfig(LevelConfiguration $configuration)
    {
        $map = new Map($configuration->getLength(),$configuration->getWidth(),$configuration->getHeight());
        $fields = array_map(function(FieldConfiguration $config){
            return FieldBuilder::get($config);
        },$configuration->getFields());
        /** @var Field $field */
        foreach($fields as $field){
            $map->addField($field);
        }
        self::fillHeightsWithDefault($map,$configuration->getHeightsToFill());

        return $map;
    }

    /**
     * @param Map $map
     * @param array $getHeightsToFill
     * @throws \Assert\AssertionFailedException
     */
    private static function fillHeightsWithDefault(Map $map, array $getHeightsToFill)
    {
        foreach($getHeightsToFill as $z){
            for($x = 0; $x < $map->getLength(); $x){
                for($y = 0; $y < $map->getLength(); $y){
                    if(!$map->hasField(Location::create($x,$y,$z))){
                        $map->addField(self::getDefaultField($x,$y,$z));
                    }
                }
            }
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return bool|Field
     * @throws \Assert\AssertionFailedException
     */
    private static function getDefaultField(int $x, int $y, int $z)
    {
        return FieldBuilder::get(new FieldConfiguration($x,$y,$z));
    }
}