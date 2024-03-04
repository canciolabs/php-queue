<?php

namespace CancioLabs\Ds\Queue;

use CancioLabs\Ds\Queue\Exception\EmptyQueueException;
use CancioLabs\Ds\Queue\Iterator\QueueIterator;
use Traversable;

class Queue implements QueueInterface
{

    private array $queue = [];

    public function enqueue(mixed $element): static
    {
        $this->queue[] = $element;

        return $this;
    }

    public function dequeue(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException('Unable to dequeue an element as the queue is empty.');
        }

        return array_shift($this->queue);
    }

    public function back(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException('Unable to get the back element as the queue is empty.');
        }

        return $this->queue[$this->count() - 1];
    }

    public function front(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException('Unable to get the front element as the queue is empty.');
        }

        return $this->queue[0];
    }

    public function isEmpty(): bool
    {
        return empty($this->queue);
    }

    public function clear(): static
    {
        $this->queue = [];

        return $this;
    }

    public function count(): int
    {
        return count($this->queue);
    }

    public function getIterator(): Traversable
    {
        return new QueueIterator($this);
    }

}