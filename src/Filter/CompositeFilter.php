<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Filter;

use YevgenGrytsay\EtlSuite\FilterInterface;

/**
 * Class CompositeFilter
 * @package YevgenGrytsay\EtlSuite\Filter
 */
class CompositeFilter implements FilterInterface
{
    /**
     * @var \YevgenGrytsay\EtlSuite\FilterInterface[]
     */
    protected $filterChain = array();

    /**
     * @var \YevgenGrytsay\EtlSuite\FilterInterface
     */
    protected $notPassFilter;

    /**
     * @param $name
     * @param \YevgenGrytsay\EtlSuite\FilterInterface $filter
     *
     * @throws \Exception
     */
    public function addFilter($name, FilterInterface $filter)
    {
        if (array_key_exists($name, $this->filterChain)) {
            throw new \Exception("Фильтр с именем '{$name}' уже существует.");
        }
        $this->filterChain[$name] = $filter;
    }

    /**
     * @param $name
     */
    public function removeFilter($name)
    {
        if (array_key_exists($name, $this->filterChain)) {
            unset($this->filterChain[$name]);
        }
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function filter($data)
    {
        $this->clearNotPassFilter();
        $result = false;
        foreach ($this->filterChain as $filter) {
            if ($filter->filter($data)) {
                $this->notPassFilter = $filter;
                $result = true;
                break;
            }
        }

        return $result;
    }

    public function clearNotPassFilter()
    {
        $this->notPassFilter = null;
    }

    /**
     * @return FilterInterface
     */
    public function getNotPassFilter()
    {
        return $this->notPassFilter;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->notPassFilter->getReason();
    }
}