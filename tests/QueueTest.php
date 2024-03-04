<?php

namespace Test\CancioLabs\Ds\Queue;

use CancioLabs\Ds\Queue\Exception\EmptyQueueException;
use CancioLabs\Ds\Queue\Iterator\QueueIterator;
use CancioLabs\Ds\Queue\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{

    public function testInitialState(): void
    {
        $queue = new Queue();

        $this->assertCount(0, $queue);
        $this->assertTrue($queue->isEmpty());
    }

    /**
     * @after testInitialState
     */
    public function testQueueWithOneElement(): void
    {
        $queue = new Queue();

        $queue->enqueue('A');

        $this->assertFalse($queue->isEmpty());
        $this->assertCount(1, $queue);

        $this->assertSame('A', $queue->front());

        // Ensure the front method does not remove the front element.
        $this->assertSame('A', $queue->front());

        $this->assertSame('A', $queue->back());

        $poppedElement = $queue->dequeue();
        $this->assertSame('A', $poppedElement);

        $this->assertTrue($queue->isEmpty());
        $this->assertCount(0, $queue);
    }

    /**
     * @after testQueueWithOneElement
     */
    public function testQueueWithThreeElements(): void
    {
        $queue = new Queue();

        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');

        $this->assertFalse($queue->isEmpty());

        $this->assertCount(3, $queue);

        // Make sure the front element is always the first one.
        $this->assertSame('A', $queue->front());

        // Make sure the back element is always the last one.
        $this->assertSame('C', $queue->back());

        // Make sure the popped element is always the front element.
        $poppedElement = $queue->dequeue();
        $this->assertSame('A', $poppedElement);

        $this->assertFalse($queue->isEmpty());
        $this->assertCount(2, $queue);

        $this->assertSame('B', $queue->front());
        $this->assertSame('C', $queue->back());
    }

    /**
     * @after testQueueWithThreeElements
     */
    public function testClear(): void
    {
        $queue = new Queue();

        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');

        $this->assertFalse($queue->isEmpty());
        $this->assertCount(3, $queue);

        $emptyQueue2 = $queue->clear();

        $this->assertSame($emptyQueue2, $queue);

        $this->assertTrue($queue->isEmpty());
        $this->assertCount(0, $queue);
    }

    public function testGetIterator(): void
    {
        $queue = new Queue();

        $it = $queue->getIterator();

        $this->assertInstanceOf(QueueIterator::class, $it);
    }

    public function testDequeueWhenQueueIsEmpty(): void
    {
        $queue = new Queue();

        $this->expectException(EmptyQueueException::class);
        $this->expectExceptionMessage('Unable to dequeue an element as the queue is empty.');

        $queue->dequeue();
    }

    public function testFrontWhenQueueIsEmpty(): void
    {
        $queue = new Queue();

        $this->expectException(EmptyQueueException::class);
        $this->expectExceptionMessage('Unable to get the front element as the queue is empty.');

        $queue->front();
    }

    public function testBackWhenQueueIsEmpty(): void
    {
        $queue = new Queue();

        $this->expectException(EmptyQueueException::class);
        $this->expectExceptionMessage('Unable to get the back element as the queue is empty.');

        $queue->back();
    }

}