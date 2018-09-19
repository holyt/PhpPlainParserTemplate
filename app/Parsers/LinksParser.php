<?php
namespace App\Parsers;

use DOMXPath;

class LinksParser extends AbstractParsers implements ParseInterface
{
    /**
     * Parse page
     *
     * @return array
     */
    public function parse(): array
    {
        $debitors = $this->parserLife(function () {
            return $this->parseDebitors($this->domXpath);
        });

        return $debitors;
    }

    /**
     * Parsing links from dom
     * @param DOMXPath $domXpath
     * @return array
     */
    protected function parseDebitors(DOMXPath $domXpath): array
    {
        $debitorsNodes = $domXpath->query("//a");

        $debitors = [];
        foreach ($debitorsNodes as $debitorNode) {
            $debitors[] = trim($debitorNode->nodeValue);
        }

        return $debitors;
    }

}