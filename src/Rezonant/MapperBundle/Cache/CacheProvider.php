<?php

namespace Rezonant\MapperBundle\Cache;
use Rezonant\MapperBundle\Providers\MapProvider;

/**
 * 
 */
class CacheProvider extends MapProvider { 
	
	public function __construct(MapProviderInterface $provider, CacheStrategyInterface $strategy) {
		$this->provider = $provider;
		$this->strategy = $strategy;
	}
	
	private $provider;
	private $strategy;
	
	private static function describeType($object)
	{
		if (is_string($object))
			return $object;
		
		if (is_array($object))
			return '<array>';
		if (is_object($object))
			return get_class($object);
		
		return '<unknown>';
	}
	
	/**
	 * Produce a string description of the mapping so that cached maps
	 * for this mapping may be consistently identified within the cache.
	 * 
	 * @param mixed $source
	 * @param mixed $destination
	 * @return string
	 */
	public static function getCacheKey($source, $destination)
	{
		return self::describeType($source).' => '.self::describeType($destination);
	}
	
	public function getMap($source, $destination) {
		$key = self::getCacheKey($source, $destination);
		$map = $this->strategy->get($key);
		$miss = !$map;
		
		if ($miss) {
			$map = $this->provider->getMap($source, $destination);
			$this->strategy->set($key, $map);
		}
		
		return $map;
	}
}