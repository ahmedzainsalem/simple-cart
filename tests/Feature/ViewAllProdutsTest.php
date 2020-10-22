<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewAllProdutsTest extends TestCase
{
    use RefreshDatabase;
     public function testCanViewAllProducts(){
         //Arrange
            $product1=factory(Product::class)->create();
            $product2=factory(Product::class)->create();
         // Action
            $resp=$this->get('/');
         //assert
            $resp->assertStatus(200);
            $resp->assertSee($product1->title);
            $resp->assertSee($product2->title);
     }

}
