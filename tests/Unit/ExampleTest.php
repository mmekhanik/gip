<?php

namespace Tests\Unit;
use Gipirion\Posts;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$this->assertTrue(true);

        $first=factory(Post::class)->create();
        $first=factory(Post::class)->create([
        	'created_at'=>\Carbon\Carbon::now()->subMonth();
        ]);
        
        $post = Posts::archives();

        $this->assertCount(2, $posts);
    }
}
