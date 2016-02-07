<?php

class EntryControllerTest extends TestCase
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
        $crawler = $this->post('/api/entries', [
            'label'    => 'First Entry',
            'password' => 'secret'
        ]);
        $crawler->seeStatusCode(201);
        $crawler->isJson();
        $crawler->seeJson(['id' => 1]);

        $crawler = $this->post('/api/entries', []);
        $crawler->seeStatusCode(422);
        $crawler->isJson();
    }

    public function testGet()
    {
        factory(\App\Model\EntryModel::class)->times(1)->create();

        $crawler = $this->get('/api/entries/1');
        $crawler->seeStatusCode(200);
        $crawler->isJson();
        $crawler->seeJson(['id' => 1]);

        $crawler = $this->get('/api/entries/2');
        $crawler->seeStatusCode(404);
        $crawler->isJson();
        $crawler->seeJson(['message' => 'Not Found']);
    }

    public function testIndex()
    {
        factory(\App\Model\EntryModel::class)->times(3)->create();

        $crawler = $this->get('/api/entries');
        $crawler->seeStatusCode(200);
        $crawler->isJson();
        $crawler->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        factory(\App\Model\EntryModel::class)->times(1)->create();

        $crawler = $this->put('/api/entries/1', [
            'label'    => 'ppma.pw',
            'password' => 'secret'
        ]);
        $crawler->seeStatusCode(204);
        $crawler = $this->get('/api/entries/1');
        $crawler->seeJson(['label' => 'ppma.pw']);

        $crawler = $this->put('/api/entries/1', []);
        $crawler->seeStatusCode(422);

        $crawler = $this->put('/api/entries/2', []);
        $crawler->seeStatusCode(404);
    }

    public function testDelete()
    {
        factory(\App\Model\EntryModel::class)->times(1)->create();

        $crawler = $this->delete('/api/entries/1');
        $crawler->seeStatusCode(204);

        $crawler = $this->delete('/api/entries/1');
        $crawler->seeStatusCode(204);
    }

}
