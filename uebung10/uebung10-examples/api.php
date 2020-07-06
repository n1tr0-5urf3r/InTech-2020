<?php

/**
 * Erstellt ein assoziatives Array mit zufälligen Wetterdaten
 *
 * @return array
 */
function createRandomWeather()
{

    $possibleWeatherConditions = ["cloudy", "rainy", "snowy", "sunny", "stormy", "windy"];


    $randomWeatherCondition = $possibleWeatherConditions[array_rand($possibleWeatherConditions)];

    if ($randomWeatherCondition === "snowy") {
        $randomTemperature = rand(-30, 3);
    } else {
        $randomTemperature = rand(0, 45);
    }

    $certainty = rand(0, 49);


    return [
        "weather" => $randomWeatherCondition,
        "temperature" => $randomTemperature,
        "img" => $randomWeatherCondition . ".png",
        "certainty" => $certainty
    ];

}

/**
 * Liefert ein Array mit assoziativen Arrays, die das Wetter zufällig "voraussagen"
 *
 * @param $n int Anzahl Tage, für die das Wetter vorausgesagt werden soll
 * @return array
 */
function createRandomWeatherForNDays($n)
{
    $weatherForNDays = [];


    for ($i = 0; $i < $n; $i++) {
        $date = $tomorrow = date("d.m.Y", strtotime("+$i day"));
        $weather = createRandomWeather();
        $weather['date'] = $date;

        $weatherForNDays[] = $weather;
    }

    return $weatherForNDays;
}

// Das Script liefert eine JSON-Ausgabe, setze daher den Content-Type auf application/json
header('Content-Type: application/json');

// Codiere das Array mit der Wettervorhersage in JSON und gib es aus
echo json_encode(createRandomWeatherForNDays(5));