<?php

namespace Disjfa\EnqueueBundle\Processor;

use Interop\Queue\PsrMessage;
use Interop\Queue\PsrContext;
use Interop\Queue\PsrProcessor;
use Enqueue\Client\TopicSubscriberInterface;
use Psr\Log\LoggerInterface;

class DemoAppProcessor implements PsrProcessor, TopicSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param PsrMessage $message
     * @param PsrContext $session
     * @return object|string
     */
    public function process(PsrMessage $message, PsrContext $session)
    {
        $this->logger->notice($message->getBody());

        return self::ACK;
        // return self::REJECT; // when the message is broken
        // return self::REQUEUE; // the message is fine but you want to postpone processing
    }

    /**
     * @return array
     */
    public static function getSubscribedTopics()
    {
        return ['demo_add'];
    }
}
