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
            'api_key' => '045a227c65ecd494e11b32ee34ec4b05',
            'query' => self::$var ?? '',
        ]);

        // dd($response['results']);

        $movies = Arr::map($response['results'], function ($item) {
            $posterPath = isset($item['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500' . $item['poster_path']
                : 'path/to/default/image.jpg'; // Replace with your default image URL

            return [
                'title' => $item['title'], // Directly assign the title
                'overview' => $item['overview'], // Directly assign the overview
                'poster_path' => $posterPath, // Use the processed poster_path
                'release_date' => $item['release_date'], // Directly assign release_date
                'vote_average' => $item['vote_average'], // Directly assign vote_average
            ];
        });

        // Optional: Filter out any movies missing required attributes
        return array_filter($movies, function ($item) {
            return isset($item['title'], $item['overview'], $item['poster_path'], $item['release_date'], $item['vote_average']);
        });

    }
}
