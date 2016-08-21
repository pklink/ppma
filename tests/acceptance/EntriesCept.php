<?php

/* @var \Codeception\Scenario $scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('perform GET request on /entries and see result');

// send
$I->sendGET('/entries');

// asserts
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseJsonMatchesJsonPath('$[*].id');
$I->seeResponseJsonMatchesJsonPath('$[*].name');
$I->seeResponseJsonMatchesJsonPath('$[*].username');
$I->seeResponseJsonMatchesJsonPath('$[*].password');
