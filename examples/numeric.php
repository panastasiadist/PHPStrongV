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
Tools::assertCondition(svint32(svint32(50))->val() === 50);
Tools::assertCondition(svint32(2)->val() === 2);
Tools::assertCondition(t\svint32::isNumeric('2') === true);
Tools::assertCondition(t\svint32::isNumeric('f') === false);
Tools::assertCondition(t\svint32::isValid('2') == false);
Tools::assertCondition(t\svint32::isValid(2) == true);
Tools::assertCondition(t\svint32::isValid(21474836478) == false);
Tools::assertCondition(t\svint32::isValid(-21474836478) == false);
Tools::assertCondition(t\svint32::isValid(2147483647) == true);
Tools::assertCondition(t\svint32::isValid(-2147483648) == true);
Tools::assertCondition(t\svuint32::isValid(2147483647) == true);
Tools::assertCondition(t\svuint32::isValid(-2147483648) == false);
Tools::assertCondition(t\svint32::parse('2')->val() == 2);
Tools::assertCondition(t\svint32::parse('2')->equals(2) == true);
$num = &svint32(2);
$num->set(5); // now 5

echo '<h4>Testing Int16 Operations</h4>';
Tools::assertCondition(svint16(svint32(50))->val() === 50);
Tools::assertCondition(svint16(2)->val() === 2);
Tools::assertCondition(t\svint16::isNumeric('2') === true);
Tools::assertCondition(t\svint16::isNumeric('f') === false);
Tools::assertCondition(t\svint16::isValid('2') == false);
Tools::assertCondition(t\svint16::isValid(2) == true);
Tools::assertCondition(t\svint16::isValid(32768) == false);
Tools::assertCondition(t\svint16::isValid(-32769) == false);
Tools::assertCondition(t\svint16::isValid(32767) == true);
Tools::assertCondition(t\svint16::isValid(-32768) == true);
Tools::assertCondition(t\svuint16::isValid(32767) == true);
Tools::assertCondition(t\svuint16::isValid(-32768) == false);
Tools::assertCondition(t\svint16::parse('2')->val() == 2);
Tools::assertCondition(t\svint16::parse('2')->equals(2) == true);

echo '<h4>Testing Byte Operations</h4>';
Tools::assertCondition(svbyte(svint32(50))->val() === 50);
Tools::assertCondition(svbyte(2)->val() === 2);
Tools::assertCondition(t\svbyte::isNumeric('2') === true);
Tools::assertCondition(t\svbyte::isNumeric('f') === false);
Tools::assertCondition(t\svbyte::isValid('2') == false);
Tools::assertCondition(t\svbyte::isValid(2) == true);
Tools::assertCondition(t\svbyte::isValid(127) == true);
Tools::assertCondition(t\svbyte::isValid(-128) == true);
Tools::assertCondition(t\svubyte::isValid(127) == true);
Tools::assertCondition(t\svubyte::isValid(-128) == false);
Tools::assertCondition(t\svbyte::parse('2')->val() == 2);
Tools::assertCondition(t\svbyte::parse('2')->equals(2) == true);

?>

</body>
</html>