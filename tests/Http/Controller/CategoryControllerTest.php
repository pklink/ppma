<?php

class CategoryControllerTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate:refresh');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:refresh');
        });
    }

    public function testCreate()
    {
        $crawler = $this->post('/api/categories', [
            'name' => 'Cat-haha-gory'
        ]);
        $crawler->seeStatusCode(201);
        $crawler->isJson();
        $crawler->seeJson(['id' => 1]);

        $crawler = $this->post('/api/categories', []);
        $crawler->seeStatusCode(422);
        $crawler->isJson();
    }

    public function testGet()
    {
        factory(\App\Model\CategoryModel::class)->times(1)->create();

        $crawler = $this->get('/api/categories/1');
        $crawler->seeStatusCode(200);
        $crawler->isJson();
        $crawler->seeJson(['id' => 1]);

        $crawler = $this->get('/api/categories/2');
        $crawler->seeStatusCode(404);
        $crawler->isJson();
        $crawler->seeJson(['message' => 'Not Found']);
    }

    public function testIndex()
    {
        factory(\App\Model\CategoryModel::class)->times(3)->create();

        $crawler = $this->get('/api/categories');
        $crawler->seeStatusCode(200);
        $crawler->isJson();
        $crawler->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        factory(\App\Model\CategoryModel::class)->times(1)->create();

        $crawler = $this->put('/api/categories/1', [
            'name' => 'roflcopter'
        ]);
        $crawler->seeStatusCode(204);
        $crawler = $this->get('/api/categories/1');
        $crawler->seeJson(['name' => 'roflcopter']);

        $crawler = $this->put('/api/categories/1', []);
        $crawler->seeStatusCode(422);

        $crawler = $this->put('/api/categories/2', []);
        $crawler->seeStatusCode(404);
    }

}
