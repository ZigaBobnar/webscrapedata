<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController {
    /**
     * @Route("/")
     */
    public function index() {
        return new Response(
            '<html><body></body></html>'
        );
    }
}
