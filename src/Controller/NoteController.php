<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Service\Message;

class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index(Message $message, LoggerInterface $logger)
    {
        $logger->info ('début2');
		return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }
}
