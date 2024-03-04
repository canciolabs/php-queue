# CancioLabs / DS / PHP-Queue

This tiny package contains an interface and an array-based implementation of the FIFO Queue data structure.

## Interface

The Queue interface extends both Countable and IteratorAggragate interfaces

### Methods

| Method  | Description                                         |
|---------|-----------------------------------------------------|
| enqueue | Add a new element to the back of the queue.         |
| dequeue | Remove and return the front element from the queue. |
| back    | Return the back element of the queue.               |
| front   | Return the front element of the queue.              |
| isEmpty | Test whether the queue is empty.                    |
| clear   | Remove all elements from the queue.                 |
| count   | Return the number of elements of the queue.         |

## How to use it

```
$queue = new Queue();

$queue->enqueue('A');
$queue->enqueue('B');
$queue->enqueue('C');
$queue->enqueue('D');

$queue->isEmpty(); // returns false
$queue->count(); // returns 4
count($queue) // returns 4

$queue->front(); // output 'A'
$queue->back(); // output 'D'
$queue->dequeue(); // output 'A'

foreach ($queue as $element) {
    // $element = 'B', 'C', 'D'
}

$queue->isEmpty(); // returns true 
```

## Tests and Coverage

All tests are passing with no warnings and code coverage is 100%.
