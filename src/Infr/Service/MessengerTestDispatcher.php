<?php

namespace App\Infr\Service;

use App\Core\Service\TestDispatcher;
use App\Core\Testing\TestCase;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerTestDispatcher implements TestDispatcher
{

    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function dispatch(TestCase $test): void
    {
        $this->messageBus->dispatch($test);
    }
}
