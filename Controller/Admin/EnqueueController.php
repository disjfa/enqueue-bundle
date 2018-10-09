<?php

namespace Disjfa\EnqueueBundle\Controller\Admin;

use Disjfa\EnqueueBundle\Entity\Enqueue;
use Disjfa\EnqueueBundle\Model\DemoModel;
use Disjfa\EnqueueBundle\Service\ProcessorService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/enqueue")
 */
class EnqueueController extends Controller
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var ProcessorService
     */
    private $processorService;

    /**
     * EnqueueController constructor.
     * @param ProcessorService $processorService
     * @param FlashBagInterface $flashBag
     */
    public function __construct(ProcessorService $processorService, FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
        $this->processorService = $processorService;
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

        $model = new DemoModel('test - ' . uniqid());
        $this->processorService->handle($model);

        $this->flashBag->add('success', 'Added a message to the producer');

        return $this->redirectToRoute('admin_enqueue_index');
    }

}
