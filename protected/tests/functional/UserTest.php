<?php

class UserTest extends WebTestCase
{
    
    /**
     * 
     * @var array
     */
    public $fixtures = array(
        'users'    => 'User',
        'settings' => 'Setting',
    );

    
    /**
     * 
     * @return void
     */
	protected function _testLogin()
	{
        // needed form elements
        $this->assertElementPresent('name=LoginForm[username]');
        $this->assertElementPresent('name=LoginForm[password]');
        $this->assertElementPresent('name=login');
        
        // empty form
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Username cannot be blank.');
        $this->assertTextPresent('Password cannot be blank.');
        
        // empty username
        $this->type('name=LoginForm[password]', 'pass');
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Username cannot be blank.');
        
        // empty password
        $this->type('name=LoginForm[username]', 'root');
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Password cannot be blank.');
        
        // wrong login (correct user; wrong password)
        $this->type('name=LoginForm[username]', 'root');
        $this->type('name=LoginForm[password]', 'passw');
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Login is incorrect.');
        
        // wrong login (wrong user; correct password)
        $this->type('name=LoginForm[username]', 'rootw');
        $this->type('name=LoginForm[password]', 'pass');
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Login is incorrect.');
        
        // wrong login (wrong user; wrong password)
        $this->type('name=LoginForm[username]', 'rootw');
        $this->type('name=LoginForm[password]', 'passw');
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Login is incorrect.');
        
        // correct login
        $this->type('name=LoginForm[username]', 'root');
        $this->type('name=LoginForm[password]', 'pass');
        $this->clickAndWait('name=login');
        $this->assertTextPresent('Logout (root)');
    }
    
    
    /**
     * 
     * @return void
     */
    protected function _testLogout()
    {
        $this->assertTextNotPresent('Login');
        $this->clickAndWait('link=Logout (root)');
        $this->assertTextPresent('Login');
    }
    
    
    /**
     * 
     * @return void
     */
    public function testLoginLogout()
    {
        $this->open('?user/login');
        
        $this->_testLogin();
        $this->_testLogout();
    }
    
    
    /**
     * 
     * @return void
     */
    public function testRegistration()
    {
        $this->open('?r=user/register');
        
        // needed form elements
        $this->assertElementPresent('name=User[username]');
        $this->assertElementPresent('name=User[password]');
        $this->assertElementPresent('name=register');
        
        // empty form
        $this->clickAndWait('name=register');
        $this->assertTextPresent('Username cannot be blank.');
        $this->assertTextPresent('Password cannot be blank.');

        // empty username
        $this->type('name=User[password]', 'pass');
        $this->clickAndWait('name=register');
        $this->assertTextPresent('Username cannot be blank.');
        $this->assertElementValueEquals('name=User[password]', '');
        
        // empty password
        $this->type('name=User[username]', 'peter');
        $this->clickAndWait('name=register');
        $this->assertTextPresent('Password cannot be blank.');
        $this->assertElementValueEquals('name=User[username]', 'peter');
        
        // duplicate username
        $this->type('name=User[username]', 'root');
        $this->clickAndWait('name=register');
        $this->assertTextPresent('Username "root" has already been taken.');
        
        // correct filled form
        $this->type('name=User[username]', 'peter');
        $this->type('name=User[password]', 'pass');
        $this->clickAndWait('name=register');
        $this->assertElementPresent('class=flash-success');
    }
    
}
