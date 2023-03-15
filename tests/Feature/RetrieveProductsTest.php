<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrieveProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserCanRetrieveProducts()
    {
        $this->actingAs($user = User::factory()->create(), 'api');
        $products =  Product::factory(2)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->last()->id,
                            'attributes' => [
                                'body' => $posts->last()->body,
                                'image' => $posts->last()->image,
                                'posted_at' => $posts->last()->created_at->diffForHumans()
                            ]
                        ]
                    ],
                    [
                        'data' => [
                            'type' => 'posts',
                            'post_id' => $posts->first()->id,
                            'attributes' => [
                                'body' => $posts->first()->body,
                                'image' => $posts->first()->image,
                                'posted_at' => $posts->first()->created_at->diffForHumans()
                            ]
                        ]
                    ]
                ],
                'links' => [
                    'self' => url('/posts'),
                ]
            ]);
    }
}
