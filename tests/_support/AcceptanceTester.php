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
    	
    	
    	$this->see($info['course']);    	
    	$this->click($info['course']);
    	
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
    	if (!$info['enableduedate']){
    		
    		$info['markingduedateday'] = null;
    		$info['markingduedatemonth'] = null;
    		$info['markingduedateyear'] = null;
    		$info['markingduedatehour'] = null;
    		$info['markingduedateminute'] = null;
    	
    	}
    	
    	else{
    		
    		$this->checkOption('#id_enableduedate');
    		 
    		$this->selectOption('markingduedate[day]',$info['markingduedateday']);
    		$this->selectOption('markingduedate[month]',$info['markingduedatemonth']);
    		$this->selectOption('markingduedate[year]',$info['markingduedateyear']);
    		$this->selectOption('markingduedate[hour]',$info['markingduedatehour']);
    		$this->selectOption('markingduedate[minute]',$info['markingduedateminute']);
    	
    	}
    	
    	if (!$info['regraderestrictdates']){
    		
    		$info['regradesopendateday'] = null;
    		$info['regradesopendatemonth'] = null;
    		$info['regradesopendateyear'] = null;
    		$info['regradesopendatehour'] = null;
    		$info['regradesopendateminute'] = null;
    		 
    		$info['regradesclosedateday'] = null;
    		$info['regradesclosedatemonth'] = null;
    		$info['regradesclosedateyear'] = null;
    		$info['regradesclosedatehour'] = null;
    		$info['regradesclosedateminute'] = null;
    		  	
    	}
    	
    	else {
    		
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
    	
    	// Grade
    	$this->selectOption('grademin',$info['grademin']);
    	$this->selectOption('grade',$info['grademax']);
    	
    	if(!$info['adjustslope']){
    	
    		$info['adjustslopegrade'] = null;
    		$info['adjustslopescore'] = null;
    	
    	}
    	
    	else{
    		
    		$this->checkOption('adjustslope');
    		 
    		$this->fillField('adjustslopegrade',$info['adjustslopegrade']);
    		$this->fillField('adjustslopescore',$info['adjustslopescore']);
    		
    	}
    	
    	// Common module settings
    	$this->fillField('cmidnumber',$info['cmidnumber']);
    	$this->selectOption('groupmode',$info['groupmode']);
    	
    	$this->click('id_submitbutton2');
    	
    	$this->seeLink($info['name']);
    	
    }

    public function IdEmarkingActivity($course, $activity){
    
    	$this->see($course);    	
    	$this->click($course);
    	
    	$this->see($activity);
    	$this->click($activity);
    	
    	$activityId = $this->grabFromCurrentUrl('/id=(\d+)/');
    	return $activityId;
    	
    }
    
    public function IdEmarkingRubric($activityId){
    	
    	$this->amOnPage('/mod/emarking/view.php?id='.$activityId);
    	
    	$contextid = $this->grabValueFrom(['css' => 'input[type=hidden][name=contextid]']);
    	$component = $this->grabValueFrom(['css' => 'input[type=hidden][name=component]']);
    	$area = $this->grabValueFrom(['css' => 'input[type=hidden][name=area]']);
    	$sesskey = $this->grabValueFrom(['css' => 'input[type=hidden][name=sesskey]']);
    	
    	$this->amOnPage('/grade/grading/manage.php?id='.$activityId.'&contextid='.$contextid.'&component='.$component.'&area='.$area.'&sesskey='.$sesskey);

    	/**
    	 * Because we couldn't click the SRC about the picture associated,
    	 * we decided to use the xpath ubication
    	 */
    	
    	$this->click('//section[@id="region-main"]/div/div[2]/a');
    	$rubricId = $this->grabFromCurrentUrl('/areaid=(\d+)/');
    	return $rubricId;
    	
    }
    
    public function autofillRubric(array $info){
    	
    	$this->fillField('name', $info['name']);
		
    	$criterianNumber = 0;
    	$quantityLevelsBefore = 0;
		$criterianLevelNumber = 0;
		
		// Count of numbers of levels on criterion X
    	$countCriterionLevels = 0;
    	
    	
    	$this->fillField('rubric[criteria][NEWID1][description]', $info['crit1']);
    	
    	for($criterianLevelNumber = 1; $criterianLevelNumber <= $info['quantLvls1']; $criterianLevelNumber++){
    		if($countCriterionLevels > 2){
    			
    			$this->click('rubric[criteria][NEWID1][levels][addlevel]');
    			
    		}
    		     		
    			$this->fillField('rubric[criteria][NEWID1][levels][NEWID'.$countCriterionLevels.'][definition]', $info['critinfo1.'.$criterianLevelNumber]);
    			$this->fillField('rubric[criteria][NEWID1][levels][NEWID'.$countCriterionLevels.'][score]', $info['critval1.'.$criterianLevelNumber]);
    		
    		    $countCriterionLevels++;
    	}
    	
    	// $info['cantPreguntas'] start on 2 because we had done the first criterian before
    	if($info['cantPreguntas'] >= 2){ 
    		
    		for ($criterianNumber = 2; $criterianNumber <= $info['cantPreguntas']; $criterianNumber++){
    		
    		$countCriterionLevels = 0;
    		
    		$this->click('rubric[criteria][addcriterion]');
    		$this->fillField('rubric[criteria][NEWID'.$criterianNumber.'][description]', $info['crit'.$criterianNumber]);
    		
    		
    		for($criterianLevelNumber = 1; $criterianLevelNumber <= $info['quantLvls'.$criterianNumber]; $criterianLevelNumber++){
    			
    			$quantityLevelsBefore = $criterianNumber - 1;
    			
    			/**
    			 * We had plused 1 at $countCriterionLevels because the difference between
    			 * the start numbers of $countCriterionLevels (0) and $info['quantLvls'.$quantityLevelsBefore] (1)
    			 */
    			
    			if($countCriterionLevels + 1 > $info['quantLvls'.$quantityLevelsBefore]){
    				
    				$this->click('rubric[criteria][NEWID'.$criterianNumber.'][levels][addlevel]');
    			
    				}
    			
    			    $this->fillField('rubric[criteria][NEWID'.$criterianNumber.'][levels][NEWID'.$countCriterionLevels.'][definition]', $info['critinfo'.$criterianNumber.'.'.$criterianLevelNumber]);
    				$this->fillField('rubric[criteria][NEWID'.$criterianNumber.'][levels][NEWID'.$countCriterionLevels.'][score]', $info['critval'.$criterianNumber.'.'.$criterianLevelNumber]);
    			
    			$countCriterionLevels++;
    			}
    		}
    	}
    	
    	if ($info['draft']){
    	
    		$this->click('saverubricdraft');
    	
    	}
    	
    	else{
    	
    		$this->click('saverubric');	
    	
    	}
    	
    	$this->see($info['name']);
    	
    	
    	$row=1;
    	$column=1;
    	
    	$this->see($info['crit'.$row], '//td');
    	 
    	$this->see( $info['critinfo'.$row.'.'.$column],'//td/div/div');
    	$this->see($info['critval'.$row.'.'.$column], '//td/div/div[2]');
    		
    	for($column = 2; $column <= $info['quantLvls'.$row]; $column++){
    		 
    		$this->see($info['critinfo'.$row.'.'.$column],'//tr/td['.$column.']/div/div');
    		$this->see($info['critval'.$row.'.'.$column], '//tr/td['.$column.']/div/div[2]');
    	
    	}
    	
    	for($row = 2; $row <= $info['cantPreguntas']; $row++){
    		
    			$column=1;
    		
    		   	$this->see($info['crit'.$row]);
    			$this->see($info['critinfo'.$row.'.'.$column]);
    		   	$this->see($info['critval'.$row.'.'.$column]);
    		
    			for($column = 2; $column <= $info['quantLvls'.$row]; $column++){
    		
    				$this->see($info['critinfo'.$row.'.'.$column]);
    				$this->see($info['critval'.$row.'.'.$column]);
    			
    			}
    	}
    	
    	/** 
      	 *for($row = 2; $row <= $info['cantPreguntas']; $row++){  		
    	 *	
    	 *	$column=1;
    	 *	
    	 *   	$this->see($info['crit'.$row], '//tr['.$row.']/td');
    	 *   		
    	 *   	$this->see($info['critinfo'.$row.'.'.$column], '//tr['.$row.']/td[2]/table/tbody/tr/td/div/div');
    	 *   	$this->see($info['critval'.$row.'.'.$column], '//tr['.$row.']/td[2]/table/tbody/tr/td/div/div[2]');
    	 *	
    	 *	for($column = 2; $column <= $info['quantLvls'.$row]; $column++){
    	 *		    			
    	 *		$this->see($info['critinfo'.$row.'.'.$column], '//tr['.$row.']/td[2]/table/tbody/tr/td['.$column.']/div/div');
    	 *		$this->see($info['critval'.$row.'.'.$column], '//tr['.$row.']/td[2]/table/tbody/tr/td['.$column.']/div/div[2]');
    	 *			    			
    	 *	}
    	 *}
    	 */
    }
        
    public function publishRubric($rubricId, $name){
    	 
    	$this->amOnPage('/grade/grading/manage.php?areaid='.$rubricId);
    	 
    	/**
    	 * Because we couldn't click the SRC about the picture associated,
    	 * we decided to use the xpath ubication
    	 */
      	
    	$this->click('//section[@id="region-main"]/div/div[2]/a[3]'); 
    	 
    	$this->see($name);
    	 
    	$this->see('Continue');
    	$this->click('Continue');
    	 
    }
    
    public function useExistingRubric($name, $rubricId){
    	   	
    	$this->amOnPage('grade/grading/pick.php?targetid='.$rubricId);
    	
    	$this->see($name);
    	
    	/**
    	 * We used the pick=4 because we couldn't grab the corresponding pick from 
    	 * some X rubric, so we call a standar published rubric that have the value 4 on pick
    	 */

    	$this->amOnPage('/grade/grading/pick.php?targetid='.$rubricId.'&pick=4');
    	
    	$this->see($name);
    	$this->click('Continue');
    	
    	$this->see($name);
    	
    }
    
    public function grabStudentId(){
    	
    	$this->amOnPage('/');
    	
    	$this->click('Mi perfil');

    	$this->click('Ver perfil');

    	$studentId = $this->grabFromCurrentUrl('/id=(\d+)/');
    	
    	return $studentId;
    }
    
}

