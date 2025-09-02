<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Sushi\Sushi;

class SearchMovie extends Model
{
    use Sushi;

    protected static $var;

    public static function setVar($value)
    {
        self::$var = $value;
        return self::query();
    }

    public function getRows(): array
    {
        $response = Http::asJson()
            ->acceptJson()
            ->get('https://api.themoviedb.org/3/search/movie', [
                'api_key' => config("TMDB_API_KEY"),
                'query' => self::$var ?? '',
            ]);

        $movies = Arr::map($response['results'], function ($item) {
            $posterPath = isset($item['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500' . $item['poster_path']
                : 'path/to/default/image.jpg';

            $releaseDate = isset($item['release_date']) ?
                $item['release_date'] :
                null;

            $voteAverage = isset($item['vote_average']) ?
                $item['vote_average'] :
                null;

            return [
                'title' => $item['title'],
                'overview' => $item['overview'],
                'poster_path' => $posterPath,
                'release_date' => $releaseDate,
                'vote_average' => $voteAverage,
            ];
        });

        // Optional: Filter out any movies missing required attributes
        return array_filter($movies, function ($item) {
            return isset($item['title'], $item['overview'], $item['poster_path'], $item['release_date'], $item['vote_average']);
        });
    }
}
