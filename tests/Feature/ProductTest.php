<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

       $this->user= $this->createUser();
    }

    public function test_product_table_return_as_empty()
    {

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);

        $response->assertSee('No products found');
    }

    public function test_product_table_not_empty()
    {


        $product = Product::create(['name' => 'product one', 'price' => 111]);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);

        $response->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product);
        });
    }

    public function test_pagination_11th_item_not_showing_in_first_page()
    {

        $products = Product::factory(11)->create();

        $lastProduct = $products->last();
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertStatus(200);

        $response->assertViewHas('products', function ($collection) use ($lastProduct) {
            return !$collection->contains($lastProduct);
        });
    }


    private function createUser(): User
    {
        return User::factory()->create();
    }
}
