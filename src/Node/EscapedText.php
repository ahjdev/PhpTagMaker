<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker\Node;

use DOMCdataSection;
use AhjDev\PhpTagMaker\Node;

final class EscapedText extends Node
{
    private DOMCdataSection $text;

    public function __construct(string $text)
    {
        $this->text = new DOMCdataSection($text);
    }

    public static function make($text)
    {
        return new static($text);
    }

    public function toDomNode(): DOMCdataSection
    {
        return $this->text;
    }
}
