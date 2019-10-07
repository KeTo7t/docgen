<?php


namespace KeTo7t\docgen\Excel;


use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

/**
 * Class Range
 * @package KeTo7t\docgen\Excel
  */
class Range
{

    private $rowIndex, $colIndex, $rowHeight, $colWidth;

    public function __construct($bound = null)
    {

        if (is_array($bound)) {
            $this->setBound($bound);
        } elseif (is_string($bound)) {
            $coordinate = Coordinate::rangeBoundaries($bound);
            $this->setBound($coordinate);
        } else {
            $this->rowIndex = 1;
            $this->colIndex = 1;
            $this->rowHeight = 0;
            $this->colWidth = 0;
        }
    }


    public function __toString()
    {
        return $this->getRange();
    }


    /** カラムのインデックス値からアドレス文字列を判定
     * http://note.onichannn.net/archives/1460
     *
     * @param $target
     * @return mixed|string
     *
     */
    private function getColKey($target)
    {
        $target--;
        for ($i = 0; $i < 26; $i++) {
            $alphabet[] = strtoupper(chr(ord('a') + $i));
        }

        $one = fmod($target, 26);
        $result = $alphabet[$one];
        $carry = ($target - $one) / 26;
        while ($carry != 0) {
            $one = fmod($carry - 1, 26);
            $result = $alphabet[$one] . $result;
            $carry = ($carry - 1 - $one) / 26;
        }
        return $result;
    }

    /**現在の範囲の高さを取得
     * @return int
     */
    function getHeight()
    {
        return $this->rowIndex + $this->rowHeight;
    }

    /**
     * Coordinateから得られる配列をもとにアドレスを設定
     * @param array $bound
     * @return Range
     */

    function setBound(array $bound)
    {
        $startrow = $bound[0][1];
        $startcol = $bound[0][0];
        $endRow = $bound[1][1];
        $endCol = $bound[1][0];

        return $this->setRange($startrow, $startcol, $endRow, $endCol);
    }

    /**
     * 格納されているアドレスを変えずにBaseCellのアドレス、そこからの範囲を変えたアドレス文字列を取得
     * @param int|null $startRow
     * @param int|null $startColumn
     * @param int $height
     * @param int $width
     * @return string
     */
    function getOffset(int $startRow=null , int $startColumn=null ,int $height = 0, int $width = 0){
        $startRow=empty($startRow)?$this->rowIndex:$startRow;
        $startColumn=empty($startColumn)?$this->colIndex:$startColumn;
        $startColumnAddr=empty($startColumn)?$this->getColKey($this->colIndex):$this->getColKey( $startColumn);

        $endRow=empty($height)?$startRow:$startRow+ $height;
        $endCol=empty($width)?"":$this->getColKey($startColumn + $width );

        return  $this->calculateAddress($startColumnAddr ,$startRow  ,$endCol,  $endRow);
    }

    /**　格納アドレス、範囲を変更（範囲は高さ、幅指定）
     * @param int|null $startRow
     * @param int|null $startColumn
     * @param int|null $height
     * @param int|null $Width
     * @return $this
     */
    function setOffset(int $startRow = null, int $startColumn = null, int $height = null, int $Width = null)
    {
        $this->rowIndex = !empty($startRow) ? $this->rowIndex + $startRow : $this->rowIndex;
        $this->colIndex = !empty($startColumn) ? $this->colIndex + $startColumn : $this->colIndex;
        $this->rowHeight = !empty($height) ? $this->rowHeight + $height : $this->rowHeight;
        $this->colWidth = !empty($Width) ? $this->colWidth + $Width : $this->colWidth;

        return $this;
    }

    /**　格納アドレスを設定
     * @param int|null $startRow
     * @param int|null $startColumn
     * @param int $endRow
     * @param int $endColumn
     * @return $this
     */
    function setRange(int $startRow = null, int $startColumn = null, int $endRow = 0, int $endColumn = 0)
    {

        $this->colIndex = is_null($startColumn) ? $this->colIndex : $startColumn;
        $this->rowIndex = is_null($startRow) ? $this->rowIndex : $startRow;

        $this->colWidth = $this->colIndex - $endColumn;
        $this->rowHeight = $this->rowIndex - $endRow;
        return $this;
    }

    /** セル、範囲のアドレスを取得
     * @param $startCol
     * @param $startRow
     * @param $endCol
     * @param $endRow
     * @return string
     */
    private function calculateAddress($startCol ,$startRow ,$endCol  ,$endRow){

        if (empty($endCol) && $startRow == $endRow) {
            return $startCol . $startRow;
        }
        if (!empty($startCol) && !empty($endCol) && !empty($startRow) && !empty($endRow)) {
            return $startCol . $startRow . ":" . $endCol . $endRow;
        } elseif (!empty($startCol) && !empty($endCol)) {
            return $startCol . ":" . $endCol;
        } elseif (!empty($startRow) && !empty($endRowRow)) {
            return $startRow . ":" . $endRow;
        } elseif (!empty($startCol) && !empty($startRow)) {
            return $startCol . $startRow;
        } elseif (!empty($endCol) && !empty($endRow)) {
            return $endCol . $endRow;
        }


    }

    /** 格納されているアドレス、範囲を取得
     * @return string
     */
    function getRange()
    {
        $startCol = !empty($this->colIndex) ? $this->getColKey($this->colIndex) : "";
        $startRow = !empty($this->rowIndex) ? $this->rowIndex : "";
        $endCol = !empty($this->colWidth) ? $this->getColKey($this->colIndex + $this->colWidth) : "";
        $endRow = $this->rowIndex + $this->rowHeight;

        return $this->calculateAddress($startCol,$startRow ,$endCol  ,$endRow);
    }

}