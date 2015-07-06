<?php

use Codeception\Module\MoodleController;
use Codeception\Module\ReservaController;

$I = new AcceptanceTester($scenario);
$U = new MoodleController($I);
$R = new ReservaController($I);

$I->wantTo('Create UAI Rooms');
$U->login('admin', 'pepito.P0', 'Admin User');

$I->amOnPage('local/reservasalas/salas.php');

$I->see('Create new rooms');

$I->click('Create new rooms');

?>