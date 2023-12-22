<?php

declare(strict_types=1);

namespace Modules\Media\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ThemoviedbService {
    public static string $token = '';

    public static function getToken(): string {
        if ('' === self::$token) {
            $token = config('services.tmdb.token');
            if (! \is_string($token)) {
                throw new Exception('['.__LINE__.']['.__FILE__.']');
            }
            self::$token = $token;
        }

        return self::$token;
    }

    /**
     * @return array
     */
    public static function getGenresMovie() {
        // https://developers.themoviedb.org/3/genres/get-movie-list

        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key='.self::getToken().'&language=en-US';

        /**
         * @var array
         */
        $res = Http::withToken(self::getToken())
        ->get($url)
        ->json();

        $genres = $res['genres'];

        $opts = [];

        foreach ($genres as $row) {
            $id = $row['id'];
            $label = $row['name'];

            $opts[$id] = $label;
        }

        return $opts;
    }
}
