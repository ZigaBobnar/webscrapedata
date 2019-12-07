<?php

namespace App\Controller;

use App\Entity\AvtonetAd;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvtonetController extends AbstractController
{
    /**
     * @Route("/avtonet", name="avtonet")
     */
    public function index()
    {
        $ads = $this->getDoctrine()
            ->getRepository(AvtonetAd::class)
            ->findAll();

        return $this->render('avtonet/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * @Route("/avtonet/createAd", name="avtonet_create_ad")
     */
    public function createAd(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();

        $ad = new AvtonetAd();
        $ad->setTitle('Volkswagen Golf Variant Comfortline 1.6 ...');
        $ad->setAvtonetId(15156131);
        $ad->setFirstSeenOn(\DateTime::createFromFormat('Y-m-d H:i:s', '2019-12-07 10:30:00'));
        $ad->setPrice(5600);

        $entityManager->persist($ad);

        $entityManager->flush();

        return new Response('Created new ad with id ' . $ad->getId());
    }

    /**
     * @Route("/avtonet/import", name="avtonet_import")
     */
    public function import() {
        $entityManager = $this->getDoctrine()->getManager();

        $importads = [/**/];

        foreach ($importads as $id => $ad) {
            $dbAd = $entityManager->getRepository(AvtonetAd::class)
                ->findOneBy([
                    'avtonet_id' => $id
                ]);

            if (!$dbAd) {
                $dbAd = new AvtonetAd();
            }

            if ($ad != dbAd) {
                // TODO

            }
        }





        return new Response('Imported.');
    }
}
