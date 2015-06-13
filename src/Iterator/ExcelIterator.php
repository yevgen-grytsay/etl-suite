<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Iterator;

/**
 * Class ExcelIterator
 * @package YevgenGrytsay\EtlSuite\Iterator
 */
class ExcelIterator implements \Iterator
{
    protected $maxColName;
    protected $sheet;
    protected $currentRowNumber;
    protected $firstRowNumber = 1;
    protected $lastRowNumber;

    /**
     * @param \PHPExcel_Worksheet $sheet
     */
    public function __construct(\PHPExcel_Worksheet $sheet)
    {
        $this->sheet = $sheet;
        $this->initHighestBounds();
    }

    protected function initHighestBounds()
    {
        $colName = $this->sheet->getHighestColumn();
        $rowNumber = $this->sheet->getHighestRow();

        $this->currentRowNumber = 1;
        $this->lastRowNumber = $rowNumber;
        $this->maxColName = $colName;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $range =
            "A{$this->currentRowNumber}:{$this->maxColName}{$this->currentRowNumber}";
        $data = $this->sheet->rangeToArray($range);

        return current($data);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->currentRowNumber;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->currentRowNumber;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return ($this->currentRowNumber <= $this->lastRowNumber);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->currentRowNumber = 1;
    }
}