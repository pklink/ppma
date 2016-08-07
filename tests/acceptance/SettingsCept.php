<?php

/* @var \Codeception\Scenario $scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('perform get request on /settings and see result');

// send
$I->sendGET('/settings');

// asserts
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseJsonMatchesJsonPath('$[*].name');
$I->seeResponseJsonMatchesJsonPath('$[*].value');
$I->dontSeeResponseJsonMatchesJsonPath('$[*].id');
