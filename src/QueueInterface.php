<?php

namespace CancioLabs\Ds\Queue;

use Countable;
use IteratorAggregate;

interface QueueInterface extends Countable, IteratorAggregate
{

    /**
     * Add a new element to the back of the queue.
     */
    public function enqueue(mixed $element): static;

    /**
     * Remove and return the front element from the queue.
     */
    public function dequeue(): mixed;

    /**
     * Return the back element of the queue.
     */
    public function back(): mixed;

    /**
     * Return the front element of the queue.
     */
    public function front(): mixed;

    /**
     * Test whether the queue is empty.
     */
    public function isEmpty(): bool;

    /**
     * Remove all elements from the queue.
     */
    public function clear(): static;

}