<?php

/* @var \Codeception\Scenario $scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('perform GET request on /entries and see result');

// send
$I->amBearerAuthenticated('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjp7InVzZXJuYW1lIjoicGllcnJlIiwiaWQiOiIxIiwicGVybWlzc2lvbnMiOlsiZW50cmllcy5jcmVhdGUiLCJlbnRyaWVzLnJlYWQiLCJlbnRyaWVzLnVwZGF0ZSIsImVudHJpZXMuZGVsZXRlIiwicm9sZXMuY3JlYXRlIiwicm9sZXMucmVhZCIsInJvbGVzLnVwZGF0ZSIsInJvbGVzLmRlbGV0ZSIsInVzZXJzLmNyZWF0ZSIsInVzZXJzLnJlYWQiLCJ1c2Vycy51cGRhdGUiLCJ1c2Vycy5kZWxldGUiXSwicm9sZSI6IkFkbWluIn19.ipZsmPbB1HVmo8umX-hS5o3kXf9Y2XLKhDaWdrethkM');
$I->sendGET('/entries');

// asserts
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([[
    'id'       => 1,
    'name'     => 'github.com',
    'username' => 'pklink',
    'password' => '123456',
]]);
$I->seeResponseJsonMatchesJsonPath('$[*].created_at');
$I->seeResponseJsonMatchesJsonPath('$[*].updated_at');
