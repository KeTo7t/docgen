<?php

namespace KeTo7t\docgen\Writer;

use KeTo7t\docgen\Contract\CollectorInterface;
use KeTo7t\docgen\Contract\WriterInterface;
use KeTo7t\docgen\Library\Converter;

class MarkDownWriter implements WriterInterface
{
    private $converter, $collector;

    public function __construct(Converter $converter)
    {

        $this->converter = $converter;
    }


    function run($filename, CollectorInterface $collector)
    {

        $this->collector = $collector;
        $tables = $this->collector->fetchSettings();

        $result = $this->generateTable($tables);

          file_put_contents($filename . ".md", join("\n",$result));
    }


    private function transformRow($rowArray): string
    {
        return "|" . join("|", $rowArray) . "|\n";
    }


    function generateTable($tables)
    {

        $headers = $this->converter->tableHeader("columns");
        $separators = array_fill(0, count($headers), "---");
        $result = array_map(function ($key,$table) use ($headers,$separators) {

            $result= "# $key \n";
            $result .= $this->transformRow($headers);
            $result .= $this->transformRow($separators);

            $row = $this->converter->arrayProjection($table["column_setting"], $headers, false);

            foreach ($row as $column) {
                $result .= $this->transformRow($column);
            }
            $result.="\n";
            return $result;
        }, array_keys($tables)  ,array_values($tables));

        return $result;
    }
}
