<?php

namespace Disjfa\EnqueueBundle\Traits;

use Disjfa\EnqueueBundle\Message\EnqueueMessage;

interface EnqueueTraitInterface
{
    /**
     * @param EnqueueMessage $enqueueMessage
     * @return void
     */
    public function recordMessage(EnqueueMessage $enqueueMessage);

    /**
     * @return EnqueueMessage[]
     */
    public function getRecordedMessages();
}
