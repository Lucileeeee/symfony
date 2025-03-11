<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'app_weather')]
    public function showWeather(WeatherService $weatherService): Response
    {
        $data = $weatherService->getWeather();
       //todo passer la temp en celsius
        $ville = $data["name"];
        $pays = $data["sys"]["country"];
        $temperature = $data["main"]["temp"];
        $ic = $data["weather"][0]["icon"];
     
        return $this->render('weather/weatherVue.html.twig',
        ["ville" => $ville??null,
            "pays" => $pays??null,
            "temperature" => $temperature??null,
            "ic" => $ic??null
        ]);
    }
}
