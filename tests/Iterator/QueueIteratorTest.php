<?php

namespace Test\CancioLabs\Ds\Queue\Iterator;

use CancioLabs\Ds\Queue\Iterator\QueueIterator;
use CancioLabs\Ds\Queue\Queue;
use PHPUnit\Framework\TestCase;

class QueueIteratorTest extends TestCase
{

    public function testIterator(): void
    {
        $queue = new Queue();
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');

        $actualKeys = [];
        $actualElements = [];

        foreach (new QueueIterator($queue) as $key => $element) {
            $actualKeys[] = $key;
            $actualElements[] = $element;
        }

        $expectedElements = ['A', 'B', 'C'];
        $expectedKeys = [0, 1, 2];

        $this->assertSame($expectedKeys, $actualKeys);
        $this->assertSame($expectedElements, $actualElements);
    }

    public function testIteratorWithPushInsideLoop(): void
    {
        $queue = new Queue();
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');

        $actualKeys = [];
        $actualElements = [];

        foreach (new QueueIterator($queue) as $key => $element) {
            if ($element === 'B') {
                $queue->enqueue('D');
            }

            $actualKeys[] = $key;
            $actualElements[] = $element;
        }

        $expectedElements = ['A', 'B', 'C', 'D'];
        $expectedKeys = [0, 1, 2, 3];

        $this->assertSame($expectedKeys, $actualKeys);
        $this->assertSame($expectedElements, $actualElements);
    }

    public function testIteratorWithPopInsideLoop(): void
    {
        $queue = new Queue();
        $queue->enqueue('A');
        $queue->enqueue('B');
        $queue->enqueue('C');
        $queue->enqueue('D');

        $actualKeys = [];
        $actualElements = [];

        foreach (new QueueIterator($queue) as $key => $element) {
            if ($element === 'C') {
                $queue->dequeue();
            }

            $actualKeys[] = $key;
            $actualElements[] = $element;
        }

        $expectedElements = ['A', 'B', 'C'];
        $expectedKeys = [0, 1, 2];

        $this->assertSame($expectedKeys, $actualKeys);
        $this->assertSame($expectedElements, $actualElements);
    }

}