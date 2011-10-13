<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param   array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }


    /**
     * @Given /^I am on "([^"]*)"$/
     */
    public function iAmOn($argument1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I fill in "([^"]*)" with "([^"]*)"$/
     */
    public function iFillInWith($argument1, $argument2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I press "([^"]*)"$/
     */
    public function iPress($argument1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($argument1)
    {
        throw new PendingException();
    }

}
