<?php

namespace App\Controller;

use App\Entity\Parser;
use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;
use App\Form\FormType;
use Symfony\Component\Routing\Annotation\Route;

class ParserController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/', name: 'app_index')]
    public function index(Request $request): Response
    {
        $parser = new Parser();
		$form = $this->createForm(FormType::class, $parser);
        $form->handleRequest($request);
		
        if ($form->isSubmitted() && $form->isValid()) {
			$url = $form->get('url')->getData();
			
			$response = $this->client->request( 'GET',$url );
			$statusCode = $response->getStatusCode();
			$sum = 0; // количество изображений
			$src = [];
			$images = [];
			$newurl = $parser->clearingURL();
						
			if ($statusCode == 200) {
				$content = $response->getContent();
				$crawler = new Crawler($content);
				$src = $crawler->filter('img')->extract(['src']);

				foreach($src as $key => $value) {
					$img = new Image();
					$img->setSRC($value);
					$img->pictureURL($newurl);
					$images[$key] = $img->getSRC();
				}
				
			$sum = count($images);
			}
			
			return $this->render('table.html.twig', [
				'images' => $images,
				'sum' => $sum,
			]);
        }

		return $this->render('base.html.twig', [
			'form' => $form->createView(),
        ]);
    }
}
