<?php /** @noinspection PhpUndefinedNamespaceInspection */

namespace Facebook\WebDriver\Remote;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver;


class Test extends TestCase
{

    /**
     * @var RemoteWebDriver
     */
    private $webDriver;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * init webdriver
     */
    public function setUp()
    {
        $desiredCapabilities = Facebook\WebDriver\Remote\DesiredCapabilities::chrome();
        $desiredCapabilities->setCapability('trustAllSSLCertificates', true);
        $this->webDriver = RemoteWebDriver::create(
            $_SERVER['SELENIUM_HUB'],
            $desiredCapabilities
        );
        $this->baseUrl = $_SERVER['SELENIUM_BASE_URL'];
    }

    /**
     * Method testSuccessfulSignUp
     * @test
     */
    //Test that the Sign Up Function works correctly
    public function testSuccessfulSignUp()
    {
        // open | http://matchisuru2.herokuapp.com/ | 
        $this->webDriver->get("http://matchisuru2.herokuapp.com/");
        // click | link=Sign Up | 
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // click | name=FName | 
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->click();
        // type | name=FName | Jane
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->sendKeys("Jane");
        // type | name=LName | Doe
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->sendKeys("Doe");
        // type | name=Email | jane@gmail.com
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->sendKeys("jane@gmail.com");
        // type | name=UserName | jane
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("jane");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=signup | 
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?success', $url);
    }

    //Test when the Last Name contains non-letters when signing up
    public function testInvalidLastNameInSignUpForm()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Sign Up |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // click | name=FName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->click();
        // type | name=FName | John
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->sendKeys("John");
        // type | name=LName | Doe2334
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->sendKeys("Doe2334");
        // click | name=Email |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->click();
        // type | name=Email | john@gmail.com
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->sendKeys("john@gmail.com");
        // type | name=UserName | john
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("john");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=signup |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?Invalid', $url);
    }

    //Test when the email given is already in the database when signing up
    public function testTakenEmailOnSignUpForm()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Sign Up |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // click | name=FName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->click();
        // type | name=FName | john
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->sendKeys("john");
        // type | name=LName | doe
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->sendKeys("doe");
        // type | name=Email | jane@gmail.com
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->sendKeys("jane@gmail.com");
        // type | name=UserName | john
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("john");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=signup |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?Email', $url);
    }

    //Test when the email is not in the right format, such as name.gmail.com when signing up
    public function testInvalidEmailOnSignUpForm()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Sign Up |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // type | name=FName | Pui
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->sendKeys("Pui");
        // click | name=LName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->click();
        // type | name=LName | Tam
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->sendKeys("Tam");
        // click | name=Email |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->click();
        // type | name=Email | pui.gmail.com
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->sendKeys("pui.gmail.com");
        // click | name=UserName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->click();
        // type | name=UserName | pui
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("pui");
        // click | name=password |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->click();
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=signup |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?VEmail', $url);
    }

    //Test when the given username is already in the database when signing up
    public function testTakenUsernameInSignUpForm()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Sign Up |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // click | name=FName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->click();
        // type | name=FName | jane
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->sendKeys("jane");
        // type | name=LName | doe
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->sendKeys("doe");
        // type | name=Email | jane@gmail.com
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->sendKeys("jane@gmail.com");
        // click | name=UserName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->click();
        // type | name=UserName | jane
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("jane");
        // click | name=password |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->click();
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=signup |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?User', $url);
    }

    //Test when there are invalid characters in the first name field, such as Bob2341, in the sign up form
    public function testInvalidCharactersInFirstNameInSignUpForm()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Sign Up |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // click | name=FName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->click();
        // type | name=FName | John2344
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("FName"))->sendKeys("John2344");
        // click | name=LName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->click();
        // type | name=LName | Doe
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("LName"))->sendKeys("Doe");
        // click | name=Email |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->click();
        // type | name=Email | john@gmail.com
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("Email"))->sendKeys("john@gmail.com");
        // type | name=UserName | john
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("john");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=signup |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?Invalid', $url);
    }

    //Test when one or more of the sign up fields are empty
    public function testEmptySignUpFormFields()
    {
        // open | http://matchisuru2.herokuapp.com/ |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/");
        // click | link=Sign Up |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Sign Up"))->click();
        // click | name=signup |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("signup"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/signupdesign.php?empty', $url);
    }

    //Test when the user tries to log in when an invalid username
    public function testInvalidLoginUsername()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Login |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Login"))->click();
        // click | name=UserName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->click();
        // type | name=UserName | john
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("john");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // sendKeys | name=password | ${KEY_ENTER}
        $this->keys("${KEY_ENTER}");
        // click | name=login |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("login"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/logindesign.php?U_Invalid', $url);
    }

    //Test successful login
    public function testSuccessfulLogin()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Login |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Login"))->click();
        // click | name=UserName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->click();
        // type | name=UserName | jane
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("jane");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=login |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("login"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/account.php?Well', $url);
    }

    //Test successful lout out after logging in
    public function testSucessfulLogOut()
    {
        // open | http://matchisuru2.herokuapp.com/index.php |
        $this->webDriver->get("http://matchisuru2.herokuapp.com/index.php");
        // click | link=Login |
        $this->webDriver->findElement(WebDriver\WebDriverBy::linkText("Login"))->click();
        // click | name=UserName |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->click();
        // type | name=UserName | jane
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("UserName"))->sendKeys("jane");
        // type | name=password | password
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("password"))->sendKeys("password");
        // click | name=login |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("login"))->click();
        // click | name=logout |
        $this->webDriver->findElement(WebDriver\WebDriverBy::name("logout"))->click();
        $url = $this->getLocation();
        $this->assertEquals('http://matchisuru2.herokuapp.com/index.php', $url);
    }

    /**
     * Close the current window.
     */
    public function tearDown()
    {
        $this->webDriver->close();
    }

    /**
     * @param WebDriver\Remote\RemoteWebElement $element
     *
     * @return WebDriver\WebDriverSelect
     * @throws WebDriver\Exception\UnexpectedTagNameException
     */
    private function getSelect(WebDriver\Remote\RemoteWebElement $element): WebDriver\WebDriverSelect
    {
        return new WebDriver\WebDriverSelect($element);
    }
}
