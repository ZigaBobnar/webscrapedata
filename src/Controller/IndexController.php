<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController {
    /**
     * @Route("/")
     */
    public function index() {
        $ads = [
            ['title' => 'Ad 1', 'features' => 'mklfds. vfds.v ds.ff vds.f vd.s fv.sd'],
            ['title' => 'Ad 2', 'features' => 'mklfds. vfds.v ds.ff vds.f vd.s fv.sd'],
            ['title' => 'Ad 3', 'features' => 'mklfds. vfds.v ds.ff vds.f vd.s fv.sd'],
            ['title' => 'Ad 4', 'features' => 'mklfds. vfds.v ds.ff vds.f vd.s fv.sd'],
            ['title' => 'Ad 5', 'features' => 'mklfds. vfds.v ds.ff vds.f vd.s fv.sd']
        ];

        return $this->render('index/index.html.twig', [
            'ads' => $ads
        ]);
    }
}
