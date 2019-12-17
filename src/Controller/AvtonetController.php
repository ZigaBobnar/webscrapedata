<?php

namespace App\Controller;

use App\Entity\AvtonetAd;
use App\Form\Type\AvtonetAdType;
use App\Repository\AvtonetAdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvtonetController extends AbstractController
{
    private $adRepo;
    
    public function __construct(AvtonetAdRepository $adRepository)
    {
        $this->adRepo = $adRepository;
    }
    
    /**
     * @Route("/avtonet", name="app_avtonet")
     */
    public function index()
    {
        $ads = $this->adRepo->findAll();
        
        return $this->render('avtonet/index.html.twig', [
            'ads' => $ads,
        ]);
    }
    
    /**
     * @Route("/avtonet/new", name="app_avtonet_new")
     */
    /*public function new(Request $request) {
        $ad = new AvtonetAd();
        
        $form = $this->createForm(AvtonetAdType::class, $ad);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            // TODO: Save the data into database
            
            return $this->redirectToRoute('index');
        }
        
        return $this->render('avtonet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/
    
    /**
     * @Route("/avtonet/createAd", name="app_avtonet_create_ad")
     */
    /*public function createAd(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        
        $ad = new AvtonetAd();
        $ad->setTitle('Volkswagen Golf Variant Comfortline 1.6 ...');
        $ad->setAvtonetId(15156131);
        $ad->setFirstSeenOn(\DateTime::createFromFormat('Y-m-d H:i:s', '2019-12-07 10:30:00'));
        $ad->setPrice(5600);
        
        $entityManager->persist($ad);
        
        $entityManager->flush();
        
        return new Response('Created new ad with id ' . $ad->getId());
    }*/
    
    /**
     * @Route("/avtonet/import", name="app_avtonet_import")
     */
    public function import(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $response = [
            'status' => 'success',
            'insertedAds' => 0,
            'updatedAds' => 0,
            'errors' => [],
            'updates' => []
        ];
        
        foreach ($data as $id => $adData) {
            $ad = new AvtonetAd();
            $ad->fromArray($adData);

            $dbAd = $this->adRepo->findOneByAvtonetId($id);
            
            if (!$dbAd) {
                $dbAd = $this->adRepo->insertOne($ad);
                $response['insertedAds']++;
            } else {
                if (!$dbAd->isEqualTo($ad)) {
                    $changes = [];
                    
                    if ($dbAd->getTitle() != $ad->getTitle()) {
                        $changes['title'] = $dbAd->getTitle();
                        $dbAd->setTitle($ad->getTitle());
                    }
                    if ($dbAd->getPrice() != $ad->getPrice()) {
                        $changes['price'] = $dbAd->getPrice();
                        $dbAd->setPrice($ad->getPrice());
                    }
                    if ($dbAd->getFeatures() != $ad->getFeatures()) {
                        $changes['features'] = $dbAd->getFeatures();
                        $dbAd->setFeatures($ad->getFeatures());
                    }
                    if ($dbAd->getCoverImageName() != $ad->getCoverImageName()) {
                        $changes['coverImageName'] = $dbAd->getCoverImageName();
                        $dbAd->setCoverImageName($ad->getCoverImageName());
                    }
                    
                    if ($dbAd->getFeatures() != $ad->getFeatures()) {
                        $changes['features'] = $dbAd->getFeatures();
                        $dbAd->setFeatures($ad->getFeatures());
                    }
    
                    $dbAd->addToChangelog($changes, $dbAd->getUpdatedOn() ?? ($dbAd->getFirstSeenOn() ?? new \DateTime()));
                    $dbAd->setUpdatedOn($ad->getUpdatedOn() ?? new \DateTime());
                    
                    $this->adRepo->update($dbAd);
                    
                    $response['updates'][$id] = $changes;
                    
                    $response['updatedAds']++;
                }
            }
        }
        
        return new JsonResponse($response);
    }
}
