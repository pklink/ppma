<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendGET('/settings');
$I->seeResponseCodeIs(200);
