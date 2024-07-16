<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker;

use DOMDocument;

final class TagMaker
{
    private DOMDocument $dom;

    public function __construct()
    {
        \assert(\extension_loaded('dom'), 'Extension Dom not found');
        $this->dom = new DOMDocument();
    }

    /**
     * Nicely formats output with indentation and extra space.
     */
    public function formatOutput(bool $option): self
    {
        $this->dom->formatOutput = $option;
        return $this;
    }

    public function run(Node $node): string
    {
        $node = $node->toDomNode($this->dom);
        $this->dom->appendChild($node);
        return $this->dom->saveHTML();
    }

    public static function build(Node $node): string
    {
        return (new self)->run($node);
    }
}
