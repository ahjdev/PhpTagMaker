<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker\Node;

use AhjDev\PhpTagMaker\Node;

final class Text extends Node
{
    public function __construct(private string|\Stringable $text)
    {
    }

    public static function make($text)
    {
        return new static($text);
    }

    public function toDomNode(\DOMDocument $domDocument): \DomNode
    {
        return $domDocument->createTextNode((string) $this->text);
    }
}
