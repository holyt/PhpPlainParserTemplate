<?php
namespace App\Parsers;

interface ParseInterface
{
    /**
     * Main parsing method
     * @return mixed
     */
    public function parse();
}