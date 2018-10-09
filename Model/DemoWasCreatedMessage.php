<?php

namespace Disjfa\EnqueueBundle\Model;

use Disjfa\EnqueueBundle\Message\EnqueueMessage;

class DemoWasCreatedMessage implements EnqueueMessage
{
    const NAME = 'demo_was_created';

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
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
        ];
    }
}
