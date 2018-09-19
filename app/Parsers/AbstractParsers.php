<?php
namespace App\Parsers;

use DOMXPath;
use DOMDocument;

/**
 * Class AbstractParsers
 * @package App\Parsers
 */

abstract class AbstractParsers
{
    protected $content, $domDocument, $domXpath;

    /**
     * AbstractParsers constructor.
     * @param string $body
     */
    public function __construct(string $body)
    {
        $this->content = $body;
    }

    protected function initDomDocument()
    {
        $this->domDocument = new DOMDocument();

        libxml_use_internal_errors(true);
        $this->domDocument->loadHTML(mb_convert_encoding($this->content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();
    }

    protected function destroyDomDocument()
    {
        unset($this->domDocument);
    }

    protected function destroyDomXpath()
    {
        unset($this->domXpath);
    }

    protected function initDomXpath()
    {
        $this->domXpath = new DOMXPath($this->domDocument);
    }

    protected function initDom()
    {
        $this->initDomDocument();
        $this->initDomXpath();

    }

    protected function destroyDom()
    {
        $this->destroyDomDocument();
        $this->destroyDomXpath();
    }

    /**
     * Safe parser, with auto dom object destruction
     * @param callable $callback
     * @return mixed
     */
    protected function parserLife(callable $callback)
    {
        $this->initDom();
        $response = $callback();
        $this->destroyDom();
        return $response;
    }
}