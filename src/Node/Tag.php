<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker\Node;

use Stringable;
use DOMDocument;
use DOMNode;
use AhjDev\PhpTagMaker\Node;

final class Tag extends Node
{
    private array $attributes = [];
    private array $value;

    public function __construct(private string $tag, Stringable|Node|string ...$value)
    {
        $this->value = $value;
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return new Tag($name, ...$arguments);
    }

    public function setAttribute(string $qualifiedName, string $value): self
    {
        $this->attributes[$qualifiedName] = $value;
        return $this;
    }

    public function removeAttribute(string $qualifiedName): self
    {
        unset($this->attributes[$qualifiedName]);
        return $this;
    }

    public function toDomNode(DOMDocument $domDocument): DomNode
    {
        $element = $domDocument->createElement($this->tag);
        // Add values
        foreach ($this->value as $value) {
            if (is_string($value) || $value instanceof Stringable) {
                $value = new Text($value);
            }
            $value = $value->toDomNode($domDocument);
            $element->appendChild($value);
        }
        // Set attributes
        foreach ($this->attributes as $name => $value)
            $element->setAttribute($name, $value);
        // Return DomElement
        return $element;
    }
}
