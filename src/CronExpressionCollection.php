<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Webmozart\Assert\Assert;

final class CronExpressionCollection implements \IteratorAggregate
{
    /**
     * @param CronExpression[] $elements
     */
    public function __construct(
        public array $elements
    ) {
        foreach ($this->elements as $element) {
            Assert::isInstanceOf($element, CronExpression::class);
        }
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->elements);
    }
}
