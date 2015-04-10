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


echo '<h4>Testing String Operations</h4>';
Tools::assertCondition(svstring('L')->append('|aδ')->prepend('pδ|')->val() === 'pδ|L|aδ');
Tools::assertCondition(svstring('Lα')->char(1) === 'α');
Tools::assertCondition(svstring('Lα')->contains('α') === true);
Tools::assertCondition(svstring('Lα')->copy()->val() === 'Lα');
Tools::assertCondition(svstring('Lα')->equals('Lα') === true);
Tools::assertCondition(svstring('Lα')->endsWith('α') === true);
Tools::assertCondition(svstring('Lα')->endsWith('Lα') === true);
Tools::assertCondition(t\svstring::format('arg %% arg %%', 'α', 'b') == 'arg α arg b');
Tools::assertCondition(t\svstring::format('arg %% arg %%', 'α', 'b')->val() === 'arg α arg b');
Tools::assertCondition(svstring('Δημοκρατία')->indexOf('ία', 0) === 8);
Tools::assertCondition(svstring('Δημοκρατία')->indexOf('ΊΑ', 0) === FALSE);
Tools::assertCondition(svstring('Δημοκρατία')->indexOf('ΊΑ', 0) === FALSE);
Tools::assertCondition(svstring('Δημοκρατία')->insert('Democracy|', 0)->val() === 'Democracy|Δημοκρατία');
Tools::assertCondition(svstring('Δημοκρατία')->insert('|Democracy|', 2)->val() === 'Δη|Democracy|μοκρατία');
Tools::assertCondition(svstring('Δημοκρατία')->insert('Democracy|', 0) == 'Democracy|Δημοκρατία');
Tools::assertCondition(svstring('Δημοκρατία')->insert('|Democracy|', 2) == 'Δη|Democracy|μοκρατία');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->length() === 20);
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->padLeft(2, 'A')->padRight(2, 'B') == 'AAΔημοκρατία|DemocracyBB');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->padLeft(2, 'A')->padRight(2, 'B')->length() === 24);
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->remove(10) == 'Δημοκρατία');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->remove(10, 1) == 'ΔημοκρατίαDemocracy');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->replace('Δημοκρατία', 'Ειρήνη') == 'Ειρήνη|Democracy');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->startsWith('Δη') === true);
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->startsWith('ΔΗ') === false);
Tools::assertCondition(count(svstring('Δημοκρατία|Democracy')->split('|')) === 2);
$array = svstring('Δημοκρατία|Democracy')->split('|');
Tools::assertCondition($array[0] == 'Δημοκρατία');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->substring(10) == '|Democracy');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->substring(10, 3) == '|De');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->toLower() == 'δημοκρατία|democracy');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->toLower(11) == 'Δημοκρατία|democracy');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->toUpper() == 'ΔΗΜΟΚΡΑΤΊΑ|DEMOCRACY');
Tools::assertCondition(svstring('Δημοκρατία|Democracy')->toUpper(9) == 'ΔημοκρατίΑ|Democracy');
Tools::assertCondition(svstring('  Δημοκρατία|Democracy')->trimLeft() == 'Δημοκρατία|Democracy');
Tools::assertCondition(svstring('Δημοκρατία|Democracy  ')->trimRight() == 'Δημοκρατία|Democracy');
Tools::assertCondition(svstring(svstring('Δημοκρατία|Democracy')) == 'Δημοκρατία|Democracy');

$v = &svstring('Democracy');
$g = $v->toLower();
Tools::assertCondition($v == 'Democracy' && $g == 'democracy');
Tools::assertCondition($v->val() === 'Democracy' && $g->val() === 'democracy');

Tools::printMessage('Assigning a new value...OK');
$v = &svstring('test');
$v = 'test 2';
$v = '2';

Tools::printMessage('Type incompatibility exception should be raised...');
$v = &svstring('test');
$v = 'test 2';
$v = 2; // should throw an exception because we are in strong type mode



?>

</body>
</html>