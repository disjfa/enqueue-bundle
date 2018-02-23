<?php

namespace Disjfa\EnqueueBundle\Entity;

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
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="published_at", type="bigint")
     */
    private $published_at;

    /**
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(name="headers", type="text", nullable=true)
     */
    private $headers;

    /**
     * @ORM\Column(name="properties", type="text", nullable=true)
     */
    private $properties;

    /**
     * @ORM\Column(name="redelivered", type="boolean", nullable=true)
     */
    private $redelivered;

    /**
     * @ORM\Column(name="queue", type="string")
     */
    private $queue;

    /**
     * @ORM\Column(name="priority", type="smallint")
     */
    private $priority;

    /**
     * @ORM\Column(name="delayed_until", type="integer", nullable=true)
     */
    private $delayed_until;

    /**
     * @ORM\Column(name="time_to_live", type="integer", nullable=true)
     */
    private $time_to_live;
}