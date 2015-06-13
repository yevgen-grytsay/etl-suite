<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Lookup;

/**
 * Объект, выполняющий поиск по заданному критерию.
 *
 * Interface FinderInterface
 * @package YevgenGrytsay\EtlSuite\Lookup
 */
interface FinderInterface
{
    /**
     * @param $criteria
     *
     * @return mixed
     */
    public function findBy($criteria);
}