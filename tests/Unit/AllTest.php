<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class AllTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tc_message_001(){
        $this->post('/login',[
            'email' => '2041720079@student.polinema.ac.id',
            'password' => '12345678'
        ]);
        $response = $this->post('/messages',[
            'to_user_id' => '1',
            'from_user_id' => auth()->user()->user_id,
            'message' =>'php unit',
        ]);
        $response->assertStatus(302);
    }

    public function test_tc_product_001(){
        Storage::fake('photos');

        $file = UploadedFile::fake()->
        image('avatar'.rand(0, 30).'.jpg', 300, 300)->size(500);
        
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
        Storage::disk('image')->assertExists($file->hashName());
        $response->assertStatus(302);
    }
}
