<?php

namespace Kix\ExceptionListenerExtension\Observer;

use RMiller\PhpSpecExtension\Process\DescRunner;
use Symfony\Component\Console\Output\OutputInterface;

interface ExceptionObserver
{
    public function __construct(OutputInterface $output, DescRunner $specRunner);
    public function notify(\Exception $exception);
}