<?php

namespace Disjfa\EnqueueBundle\Traits;

use Disjfa\EnqueueBundle\Message\EnqueueMessage;

interface EnqueueTraitInterface
{
    /**
     * @param EnqueueMessage $enqueueMessage
     */
    public function recordMessage(EnqueueMessage $enqueueMessage);

    /**
     * @return EnqueueMessage[]
     */
    public function getRecordedMessages();
}
