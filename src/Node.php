<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker;

abstract class Node
{
    abstract public function toDomNode(\DOMDocument $domDocument): \DomNode;
}
