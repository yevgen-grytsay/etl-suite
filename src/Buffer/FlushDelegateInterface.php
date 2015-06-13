<?php
/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.05.15
 * Time: 16:58
 */

namespace YevgenGrytsay\EtlSuite\Buffer;


/**
 * Interface FlushDelegateInterface
 * @package YevgenGrytsay\EtlSuite\Buffer
 */
interface FlushDelegateInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function push(array $data);
}