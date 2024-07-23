<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker\Node;

use DOMElement;
use AhjDev\PhpTagMaker\Node;

final class HtmlTag extends Node
{
    use Internal\Attributes;
    use Internal\DefaultTags;

    private DOMElement $domElement;
    private array $values     = [];

    public function __construct(private string $tag, Node|string ...$value)
    {
        $this->domElement = new DOMElement($tag);
        $this->values = array_map(static fn ($v) => is_string($v) ? new HtmlText($v) : $v, $value);
        // $this->domElement->getElementsByTagName();
        // $this->domElement->insertAdjacentElement();
        // $this->domElement->insertAdjacentText();
        // $this->domElement->insertBefore();
        // $this->domElement->removeChild();
    }

    public static function make(string $tag, Node|string ...$value): self
    {
        return new static($tag, ...$value);
    }

    public function getName()
    {
        return $this->domElement->nodeName;
    }

    public function setName(string $tag): self
    {
        $element = new DOMElement($tag);
        // Copy attributes and child nodes from old element to new element
        foreach ($this->domElement->attributes as $attribute) {
            $element->setAttribute(
                $attribute->nodeName,
                $attribute->nodeValue
            );
        }
        // while ($element->hasChildNodes()) {
        //     $newElement->appendChild($element->childNodes->item(0));
        // }
        $this->domElement = $element;
        return $this;
    }

    public function toDomNode(): DOMElement
    {
        $element = $this->domElement->cloneNode(true);
        array_map(
            fn (Node $v) => $element->append(
                $v->toDomNode()
            ),
            $this->values
        );
        return $element;
    }
}
