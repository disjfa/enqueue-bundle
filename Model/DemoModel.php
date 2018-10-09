<?php

namespace Disjfa\EnqueueBundle\Model;

use Disjfa\EnqueueBundle\Traits\EnqueueTrait;
use Disjfa\EnqueueBundle\Traits\EnqueueTraitInterface;

class DemoModel implements EnqueueTraitInterface
{
    use EnqueueTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

        $this->recordMessage(new DemoWasCreatedMessage($name));
    }
}
