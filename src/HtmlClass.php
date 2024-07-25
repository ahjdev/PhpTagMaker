<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker;

use Stringable;
use IteratorAggregate;

final class HtmlClass implements Stringable, IteratorAggregate
{
    public function __construct(private array $classList = [])
    {
    }

    public function __toString(): string
    {
        return implode(' ', $this->classList);
    }

    public function has(string $class): bool
    {
        return in_array($class, $this->classList, true);
    }

    public function add(string $class): self
    {
        if (!(empty($class) || $this->has($class))) {
            $this->classList[] = $class;
        }
        return $this;
    }

    public function remove(string $class): self
    {
        if (($pos = array_search($class, $this->classList, true)) !== false) {
            unset($this->classList[$pos]);
        }
        return $this;
    }

    public function merge(string|self ...$classes): self
    {
        foreach ($classes as $class) {
            if ($class instanceof self) {
                $this->classList = array_merge($this->classList, $class->asArray());
                array_shift($classes);
            }
        }
        if ($classes) {
            $this->classList = array_merge($this->classList, $classes);
        }
        $this->classList = array_filter($this->classList);
        return $this;
    }

    public function asArray(): array
    {
        return $this->classList;
    }

    public function getIterator(): \Generator
    {
        return yield from $this->classList;
    }
}
