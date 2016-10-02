<?php

/* @var \Codeception\Scenario $scenario */
$I = new AcceptanceTester($scenario);

$I->wantTo('perform unauthenticated GET request on /entries and see status code 401');
$I->sendGET('/entries');

// asserts
$I->seeResponseCodeIs(401);


$I->wantTo('perform GET request on /entries as admin and see own entries only');
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


$I->wantTo('perform GET request on /entries as member and see own entries only');
$I->amBearerAuthenticated(MEMBER_TOKEN);
$I->sendGET('/entries');

// asserts
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([[
    'id' => 2,
]]);
$I->dontSeeResponseJsonMatchesJsonPath('$[1]');
