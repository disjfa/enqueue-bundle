<?php

namespace Disjfa\EnqueueBundle\Controller\Admin;

use Disjfa\EnqueueBundle\Entity\Enqueue;
use Enqueue\Client\TraceableProducer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * @Route("/admin/enqueue")
 */
class EnqueueController extends Controller
{
    /**
     * @var TraceableProducer
     */
    private $producer;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(TraceableProducer $producer, FlashBagInterface $flashBag)
    {
        $this->producer = $producer;
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("", name="admin_enqueue_index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('@DisjfaEnqueue/admin/enqueue/index.html.twig', [
            'list' => $this->getDoctrine()->getRepository(Enqueue::class)->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="admin_enqueue_add")
     */
    public function add()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $this->producer->send('demo_add', 'Message was added: demo_add');

        $this->flashBag->add('success', 'Added a message to the producer');

        return $this->redirectToRoute('admin_enqueue_index');
    }

}