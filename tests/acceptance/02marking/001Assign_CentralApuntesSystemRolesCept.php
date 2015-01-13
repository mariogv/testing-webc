<?php

// Log In Admin
$I = new AcceptanceTester($scenario);
$I->wantTo('Assign Central de apuntes System rol to "CENTRAL DE APUNTES" user');
$I->amOnPage('/?lang=en');
$I->click('Log in', 'div.logininfo');
$I->fillField('username', 'admin');
$I->fillField('password', 'pepito.P0');
$I->click('loginbtn');
$I->see('You are logged in as', 'div.logininfo');
$I->seeLink('Admin Usuario');

$I->amOnPage('admin/roles/assign.php?contextid=1&lang=en');
$I->see('Assign roles in System');

// User "CENTRAL DE APUNTES" is added to the global role

$I->seeLink('Central de Apuntes');
$I->click('Central de Apuntes');

$I->fillField('addselect_searchtext', 'CENTRAL DE APUNTES');
$I->selectOption('addselect[]','CENTRAL DE APUNTES (central_apuntes@unmail.com)');
$I->click('add');

$I->amOnPage('admin/roles/assign.php?contextid=1&lang=en');
$I->seeLink('CENTRAL DE APUNTES');


?>