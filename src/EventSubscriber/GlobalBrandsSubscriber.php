<?php

namespace App\EventSubscriber;

use App\Repository\BrandRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class GlobalBrandsSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $brandRepository;

    public function __construct(Environment $twig, BrandRepository $brandRepository)
    {
        $this->twig = $twig;
        $this->brandRepository = $brandRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $brands = $this->brandRepository->findAll();
        $this->twig->addGlobal('brands', $brands);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
