<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker\Node;

use IteratorAggregate;
use AhjDev\PhpTagMaker\Node;

/**
 * @implements IteratorAggregate<HtmlTag>
 */
final class HtmlTagMulti extends Node implements IteratorAggregate
{
    public function __construct(private string $text, private array $tags)
    {
    }

    public static function make(string $text, array $tags)
    {
        return new static($text, $tags);
    }

    public function getIterator(): \Traversable
    {
        return yield from $this->tags;
    }

    public function toDomNode(): \DomNode
    {
        $before = $this->text;
        foreach (array_reverse($this->tags) as $tag) {
            $tag    = new HtmlTag($tag, $before);
            $before = $tag;
            // foreach ($attributes as $name => $value)
            //     $tag->setAttribute($name, $value);
        }
        // Return DomElement
        return $tag->toDomNode();
    }
}
