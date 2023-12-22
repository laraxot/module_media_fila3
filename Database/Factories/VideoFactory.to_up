<?php

declare(strict_types=1);

namespace Modules\Media\Database\Factories;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
// ---- models ----
use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\Video as Model;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/**
 * Class VideoFactory.
 */
class VideoFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $faker = $this->faker;

        /* $path = $faker->file($sourceDir='/home/gujarat/fakerFile/video', $targetDir='./public/videoLibrary', false);
         $uploadedFile = new UploadedFile($path, 'randomName');
         $uploadedFile->getClientSize();*/

        $id = '2499611';

        $client = new Client(['base_uri' => 'https://api.pexels.com']);

        $response = $client->request('GET', 'videos/videos/'.$id, ['headers' => ['Authorization' => '563492ad6f917000010000016ecf84bd5d7d47d88c44d0c29deb3916']]);

        $data = json_decode((string) $response->getBody());

        $video_link = $data->video_files[0]->link;

        $file_name = date('Ymdhis').'.mp4';

        $temp_image = tempnam(sys_get_temp_dir(), $file_name);
        if (! \is_string($temp_image)) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        copy($video_link, $temp_image);

        $content = file_get_contents($temp_image);
        if (false === $content) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        Storage::disk('videos')->put($file_name, $content);

        return [
            'title' => $faker->name,
            'original_name' => $faker->name,
            'disk' => 'videos',
            'path' => $file_name,
            'converted_for_downloading_at' => $faker->dateTime(),
            'converted_for_streaming_at' => $faker->dateTime(),
            'adult' => $faker->boolean(),
            'backdrop_path' => '',
            'original_language' => 'italian',
            'original_title' => $faker->name,
            'overview' => $faker->text,
            'popularity' => $faker->randomFloat(3, 0, 5),
            'poster_path' => '',
            'release_date' => $faker->dateTime(),
            'vote_average' => $faker->randomFloat(3, 0, 5),
            'vote_count' => $faker->randomDigit(),
        ];
    }
}
