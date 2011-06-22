<?php

class LoginSeleniumTest extends BaseSelenium
{

    public function testSuccessful()
    {
        $this->open('/auth/login');
        $this->waitForPageToLoad(30000);
        $this->assertElementPresent("id=email");
        $this->assertElementPresent("id=password");
        $this->assertElementPresent("id=login");

        $this->type("email", "test@test.com");
        $this->type("password", "test");
        $this->click("login");

        $this->waitForPageToLoad(30000);
        $this->assertTextPresent("Logged in successfully");
    }

    public function testIncorrect()
    {
        $this->open('/auth/login');
        $this->waitForPageToLoad(30000);

        $this->type("email", "error@test.com");
        $this->type("password", "test");
        $this->click("login");

        $this->waitForPageToLoad(30000);
        $this->assertTextPresent("Logged in failed");
    }

    public function testUnAuthorised()
    {
        $this->open('/auth/account');
        $this->waitForPageToLoad(30000);
        $this->assertTextPresent("Error: Access denied, you must be logged in to do that");
    }
}
?>
