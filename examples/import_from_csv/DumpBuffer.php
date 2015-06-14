<?php
/**
 * @author: yevgen
 */

use YevgenGrytsay\EtlSuite\Buffer\AbstractBuffer;

class DumpBuffer extends AbstractBuffer
{
    public function flush()
    {
        var_dump(array_splice($this->elements, 0));
    }
}