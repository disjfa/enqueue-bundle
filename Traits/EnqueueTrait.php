<?php

namespace Disjfa\EnqueueBundle\Traits;

use Disjfa\EnqueueBundle\Message\EnqueueMessage;

trait EnqueueTrait
{
    /**
     * @var array
     */
    private $enqueueMessages = [];

    /**
     * @param EnqueueMessage $enqueueMessage
     */
    public function recordMessage(EnqueueMessage $enqueueMessage)
    {
        $this->enqueueMessages[] = $enqueueMessage;
    }

    /**
     * @return EnqueueMessage[]
     */
    public function getRecordedMessages()
    {
        $enqueueMessages = $this->enqueueMessages;
        $this->enqueueMessages = [];
        return $enqueueMessages;
    }
}
