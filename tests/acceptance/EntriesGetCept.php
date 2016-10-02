<?php

/* @var \Codeception\Scenario $scenario */
$I = new AcceptanceTester($scenario);

$I->wantTo('perform unauthenticated GET request on /entries/1 and see status code 401');
$I->sendGET('/entries/1');
$I->seeResponseCodeIs(401);

$I->wantTo('perform unauthenticated GET request on /entries/999 and see status code 401');
$I->sendGET('/entries/999');
$I->seeResponseCodeIs(401);

$I->wantTo('perform GET request on /entries/1 as admin and see entry');
$I->amBearerAuthenticated(ADMIN_TOKEN);
$I->sendGET('/entries/1');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$I->wantTo('perform GET request on /entries/2 as admin and see status code 403');
$I->amBearerAuthenticated(ADMIN_TOKEN);
$I->sendGET('/entries/2');
$I->seeResponseCodeIs(403);

$I->wantTo('perform GET request on /entries/2 as member and see entry');
$I->amBearerAuthenticated(MEMBER_TOKEN);
$I->sendGET('/entries/2');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();

$I->wantTo('perform GET request on /entries/1 as admin and see status code 403');
$I->amBearerAuthenticated(MEMBER_TOKEN);
$I->sendGET('/entries/1');
$I->seeResponseCodeIs(403);

$I->wantTo('perform GET request on /entries/999 as admin and see status code 404');
$I->amBearerAuthenticated(ADMIN_TOKEN);
$I->sendGET('/entries/999');
$I->seeResponseCodeIs(404);
