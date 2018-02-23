<?php

namespace Disjfa\EnqueueBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="enqueue", indexes={
 *     @ORM\Index(name="published_at", columns={"published_at"}),
 *     @ORM\Index(name="queue", columns={"queue"}),
 *     @ORM\Index(name="priority", columns={"priority"}),
 *     @ORM\Index(name="delayed_until", columns={"delayed_until"})
 * })
 */
class Enqueue
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="published_at", type="bigint")
     */
    private $published_at;

    /**
     * @var string
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     * @ORM\Column(name="headers", type="text", nullable=true)
     */
    private $headers;

    /**
     * @var string
     * @ORM\Column(name="properties", type="text", nullable=true)
     */
    private $properties;

    /**
     * @var bool
     * @ORM\Column(name="redelivered", type="boolean", nullable=true)
     */
    private $redelivered;

    /**
     * @var string
     * @ORM\Column(name="queue", type="string")
     */
    private $queue;

    /**
     * @var int
     * @ORM\Column(name="priority", type="smallint")
     */
    private $priority;

    /**
     * @var int
     * @ORM\Column(name="delayed_until", type="integer", nullable=true)
     */
    private $delayed_until;

    /**
     * @var int
     * @ORM\Column(name="time_to_live", type="integer", nullable=true)
     */
    private $time_to_live;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPublishedAt(): int
    {
        return $this->published_at;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getHeaders(): string
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getProperties(): string
    {
        return $this->properties;
    }

    /**
     * @return bool
     */
    public function isRedelivered(): bool
    {
        return $this->redelivered;
    }

    /**
     * @return string
     */
    public function getQueue(): string
    {
        return $this->queue;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return int
     */
    public function getDelayedUntil(): int
    {
        return $this->delayed_until;
    }

    /**
     * @return int
     */
    public function getTimeToLive(): int
    {
        return $this->time_to_live;
    }
}