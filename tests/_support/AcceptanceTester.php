<?php

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
*/

class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function login($username,$password,$name){ 
    	
    	$this->amOnPage('/login/index.php');
    	$this->fillField('username', $username);
    	$this->fillField('password', $password);
    	$this->click('loginbtn');
    	$this->seeLink($name);

    }
    
    public function createCategory($categoryname, $categoryparent){

    	$this->amOnPage('/course/editcategory.php?parent=1');
    	$this->selectOption('parent', $categoryparent);
    	$this->fillField('name', $categoryname);
    	$this->click('submitbutton');
    	$this->seeLink($categoryname);
    
    }
    
    public function createCourse($coursename, $shortname, $category){

    	$this->amOnPage('/course/edit.php?category=1');
    	$this->fillField('fullname', $coursename);
    	$this->fillField('shortname', $shortname);
    	$this->selectOption('category', $category);
    	$this->click('submitbutton');
    	
    }
    
    public function createUser($username, $password, $firstname, $lastname, $email){

    	$this->amOnPage('user/editadvanced.php?id=-1');
    	$this->fillField('username', $username);
    	$this->fillField('newpassword', $password);
    	$this->fillField('firstname', $firstname);
    	$this->fillField('lastname', $lastname);
    	$this->fillField('email', $email);
    	$this->click('submitbutton');
    	
    }
    public function createEmarkingActivity($info){
    	
    	$this->amOnPage('/login/index.php');
    	$this->fillField('username', 'admin');
    	$this->fillField('password', 'pepito.P0');
    	$this->click('loginbtn');
    	
    	$this->see($info['curse']);    	
    	$this->click($info['curse']);
    	
    	$courseid = $this->grabFromCurrentUrl('/id=(\d+)/');
    	
    	$this->amOnPage('/course/modedit.php?add=emarking&type=&course='.$courseid.'&section=0&return=0&sr=0');
    	
    	// General
    	$this->fillField('name',$info['name']);
    	// falta description
    	
    	// Marking
    	$this->selectOption('totalpages',$info['totalpages']);
    	$this->selectOption('anonymous',$info['anonymous']);
    	// falta custom marks
    	
    	// Dates and Regrades
    	if ($info['enableduedate'])
    	{
    	$this->checkOption('#id_enableduedate');
    	
    	$this->selectOption('markingduedate[day]',$info['markingduedateday']);
    	$this->selectOption('markingduedate[month]',$info['markingduedatemonth']);
    	$this->selectOption('markingduedate[year]',$info['markingduedateyear']);
    	$this->selectOption('markingduedate[hour]',$info['markingduedatehour']);
    	$this->selectOption('markingduedate[minute]',$info['markingduedateminute']);
    	}
    	
    	if ($info['regraderestrictdates'])
    	{
    	$this->checkOption('#id_regraderestrictdates');
    	
    	$this->selectOption('regradesopendate[day]',$info['regradesopendateday']);
    	$this->selectOption('regradesopendate[month]',$info['regradesopendatemonth']);
    	$this->selectOption('regradesopendate[year]',$info['regradesopendateyear']);
    	$this->selectOption('regradesopendate[hour]',$info['regradesopendatehour']);
    	$this->selectOption('regradesopendate[minute]',$info['regradesopendateminute']);
    	
    	$this->selectOption('regradesclosedate[day]',$info['regradesclosedateday']);
    	$this->selectOption('regradesclosedate[month]',$info['regradesclosedatemonth']);
    	$this->selectOption('regradesclosedate[year]',$info['regradesclosedateyear']);
    	$this->selectOption('regradesclosedate[hour]',$info['regradesclosedatehour']);
    	$this->selectOption('regradesclosedate[minute]',$info['regradesclosedateminute']);
    	}
    	
    	
    	$this->selectOption('peervisibility',$info['peervisibility']);
    	
    	
    	//Grade
    	$this->selectOption('gradecat',$info['gradecat']);
    	$this->selectOption('grademin',$info['grademin']);
    	$this->selectOption('grade',$info['grade']);
    	
    	if($info['adjustslope'])
    	{
    	$this->checkOption('adjustslope');
    	
    	$this->fillField('adjustslopegrade',$info['adjustslopegrade']);
    	$this->fillField('adjustslopescore',$info['adjustslopescore']);
    	}
    	
    	//Common module settings
    	$this->fillField('cmidnumber',$info['cmidnumber']);
    	$this->selectOption('groupmode',$info['groupmode']);
    	
    	$this->click('id_submitbutton2');
    	
    	$this->seeLink($info['name']);
    	
    }
    
}