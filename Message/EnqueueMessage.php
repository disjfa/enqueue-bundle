<?php

namespace Disjfa\EnqueueBundle\Message;

use JsonSerializable;

interface EnqueueMessage extends JsonSerializable
{
    /**
     * @return string
     */
    public function getName(): string;
}
