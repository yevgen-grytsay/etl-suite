<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Lookup;

/**
 * На основании входных значений выполняет поиск объекта,
 * делегируя процесс поиска объекту @see \app\utils\etl\Lookup\FinderInterface.
 *
 * Из найденного объекта извлекаются значения заданных полей..
 *
 * Class Lookup
 * @package YevgenGrytsay\EtlSuite\Lookup
 */
class Lookup implements LookupInterface
{
    /**
     * @var array
     */
    protected $lookupMap = [];

    /**
     * @var array
     */
    protected $extractMap = [];

    /**
     * @var \YevgenGrytsay\EtlSuite\Lookup\FinderInterface
     */
    protected $finder;

    /**
     * @param array $lookupMap Карта [rowKey => lookupKey]
     * @param array $extractMap Карта [rowKey => lookupKey]
     * @param \YevgenGrytsay\EtlSuite\Lookup\FinderInterface $finder
     */
    public function __construct(array $lookupMap, array $extractMap, FinderInterface $finder)
    {
        $this->lookupMap = $lookupMap;
        $this->extractMap = $extractMap;
        $this->finder = $finder;
    }

    /**
     * @param $row
     *
     * @return mixed
     */
    //TODO: refactoring needed
    public function findFor($row)
    {
        $criteria = [];
        foreach ($this->lookupMap as $rowKey => $lookupKey) {
            $criteria[$lookupKey] = array_key_exists($rowKey, $row) ? $row[$rowKey] : null;
        }

        $found = $this->finder->findBy($criteria);
        $result = [];
        if (is_array($found)) {

            if (count($this->extractMap) === 0) {
                $result = $found;
            }
            else {
                //TODO: field mapper transformer
                foreach ($found as $lookupName => $lookupValue) {
                    $rowKey = array_search($lookupName, $this->extractMap, false);
                    if (is_string($rowKey)) {
                        $result[$rowKey] = $lookupValue;
                    }
                    else if (is_numeric($rowKey)) {
                        $result[$lookupName] = $lookupValue;
                    }
                }
            }
        }

        return $result;
    }
}