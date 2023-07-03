<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/auth');

        $response->assertStatus(200);
    }

    public function test_avatars_can_be_uploaded()
    {
        Storage::fake('photos');

        $file = UploadedFile::fake()->image('avatar'.rand(0, 30).'.jpg', 300, 300)->size(500);
        
        $this->post('/login',[
            'email' => '2041720079@student.polinema.ac.id',
            'password' => '12345678'
        ]);

        $response = $this->post('/addProduct',[
            'name' => '1',
            'price' => '9999',
            'desc' =>'php unit',
            'category'=>'Makanan',
            'image'=> $file,
            'user_id'=>auth()->user()->user_id
        ]);
 
        Storage::disk('avatars')->assertExists($file->hashName());
    }
}
