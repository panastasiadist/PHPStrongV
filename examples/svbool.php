<!DOCTYPE HTML>
<html>
<head>
    <meta name="robots" content="index, follow">
    <meta charset="utf-8" />
</head>
<body>

<?php

include_once ('../lib/PHPStrongV.php');
include_once ('tools.php');

use \PHPStrongV\Types as t;


echo '<h4>Testing Int32 Operations</h4>';
Tools::assertCondition(svbool(true)->val() === true);
Tools::assertCondition(svbool(false)->val() === false);
Tools::assertCondition(t\svbool::parse(1)->val() === true);
Tools::assertCondition(t\svbool::parse(0)->val() === false);
Tools::assertCondition(t\svbool::parse(true)->val() === true);
Tools::assertCondition(t\svbool::parse(false)->val() === false);
Tools::assertCondition(t\svbool::isCompatible(true) === true);
Tools::assertCondition(t\svbool::isCompatible(false) === true);
Tools::assertCondition(t\svbool::isCompatible(1) === true);
Tools::assertCondition(t\svbool::isCompatible(0) === true);
Tools::assertCondition(t\svbool::isValid(true) === true);
Tools::assertCondition(t\svbool::isValid(false) === true);
Tools::assertCondition(t\svbool::isValid(0) === false);
Tools::assertCondition(t\svbool::isValid(1) === false);


?>

</body>
</html>