<?php

/* @var \Codeception\Scenario $scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('perform GET request on /entries and see own entries only');

// send
$I->amBearerAuthenticated(ADMIN_TOKEN);
$I->sendGET('/entries');

// asserts
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([[
    'id'       => 1,
    'name'     => 'github.com',
    'username' => 'pklink',
    'password' => '123456',
    'owner_id' => 1,
]]);
$I->seeResponseJsonMatchesJsonPath('$[0].created_at');
$I->seeResponseJsonMatchesJsonPath('$[0].updated_at');
$I->dontSeeResponseJsonMatchesJsonPath('$[1]');
