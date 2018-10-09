<?php

namespace Disjfa\EnqueueBundle\Service;

use Disjfa\EnqueueBundle\Traits\EnqueueTraitInterface;
use Enqueue\Client\ProducerInterface;

class ProcessorService
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param EnqueueTraitInterface $enqueueTrait
     */
    public function handle(EnqueueTraitInterface $enqueueTrait)
    {
        foreach ($enqueueTrait->getRecordedMessages() as $message) {
            $this->producer->sendEvent($message->getName(), $message);
        }
    }
}
