<?php

class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
      $I->sendPOST('/singup', [
        'username' => 'my username',
        'name' => 'my name',
        'password' => 'my password',
        'country' => 'my country',
        'addresse'=> 'my addresse'
      ]);
      $I->seeResponseContainsJson(['message' => 'you have been successfuly registered']);
      $I->seeHttpHeaderOnce('Content-Type');
    }
}
