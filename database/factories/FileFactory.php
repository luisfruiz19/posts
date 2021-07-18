<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           // 'path' => $this->faker->imageUrl($width = 640, $height = 480),
            'path'              => $this->faker->image($dir = storage_path('app/file'), $width = 200, $height = 300, 'cats',false,true),
            'mime_type'         => 'image/png',
            'comment_id'        => Comment::factory(),
        ];
    }
}
