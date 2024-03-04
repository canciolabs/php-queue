<?php

namespace CancioLabs\Ds\Queue\Iterator;

use CancioLabs\Ds\Queue\QueueInterface;
use Iterator;

class QueueIterator implements Iterator
{

    private QueueInterface $queue;
    private int $index = 0;

    public function __construct(QueueInterface $queue)
    {
        $this->queue = $queue;
    }

    public function current(): mixed
    {
        return $this->queue->dequeue();
    }

    public function next(): void
    {
        $this->index++;
    }

    public function key(): mixed
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return !$this->queue->isEmpty();
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

}