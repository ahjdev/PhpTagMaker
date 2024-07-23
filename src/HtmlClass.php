<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker;

use Stringable;
use IteratorAggregate;

final class HtmlClass implements Stringable, IteratorAggregate
{
    public function __construct(private array $class)
    {
    }

    public function __tostring()
    {
        return implode(' ', $this->class);
    }

    public function hasClass(string $class)
    {
        return in_array($class, $this->class);
    }

    public function addClass(string $class)
    {
        if (!$this->hasClass($class))
            $this->class[] = $class;
        return $this;
    }

    public function removeClass(string $class)
    {
        if (($s = array_search($class, $this->class)) !== false)
            unset($this->class[$s]);
        return $this;
    }

    public function getIterator(): \Generator
    {
        return yield from $this->class;
    }
}
