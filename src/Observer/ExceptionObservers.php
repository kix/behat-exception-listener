<?php
namespace Kix\ExceptionListenerExtension\Observer;

class ExceptionObservers implements \IteratorAggregate
{
    private $observers;

    public function __construct(array $observers = [])
    {
        foreach($observers as $observer) {
            if ($observer instanceof ExceptionObserver) {
                continue;
            }

            $message = 'Can only be constructed with implementations of Kix\ExceptionListenerExtension\Observer\ErrorObserver';
            throw new \InvalidArgumentException($message);
        }

        $this->observers = $observers;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->observers);
    }
}
