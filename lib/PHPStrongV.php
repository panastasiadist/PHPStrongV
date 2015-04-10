<?php
/*******************************************************************************
 * COPYRIGHT (c) 2015 Panagiotis Anastasiadis
 * https://twitter.com/panastas91
 * https://www.linkedin.com/in/panastasiadis
 *
 * THIS FILE IS PART OF PHPStrongV.
 * PROVIDED UNDER THE TERMS AND CONDITIONS DESCRIBED IN LICENSE.md
 *******************************************************************************
 */

/* NOTES
 * When testing if value is integer, double, string, gettype function is used
 * instead of is_X PHP functions. Performance reasons.
 */

/* TODO
 * 1: Implement some internal functions (for ex. in SVString) as macros using
 * a PHP preprocessor. It will reduce the function call overhead.
 */

/* HOW TO USE
 * 1. Include this file in your project.
 *
 * 2. Call any of the svX functions according to documentation. Each svX
 * function returns a new class representing a specific type (Integer etc).
 *
 * 3. If you want to use the strong type feature, always use & in front of
 * each svX function call as shown in the examples directory. This will ensure
 * that you won't overwrite a variable returned by an svX function with a value
 * of another type. For example:
 * $v = svint(2);
 * $v = 'test'; // $v will now be an integer with a value of 2. Note that there
 *              // is no & in front of svint(2).
 * $v = &svint(2);
 * $v = 'test'; // It will raise an exception because we tried changing its type
 *              // from integer to a string. Note that there is a & in front of
 *              // svint(2).
 *
 * 4. Read the documentation for the available API.
 */

use PHPStrongV\Helpers\PHPStrongVManager as PHPStrongVManager;
use PHPStrongV\Types\SVBool as SVBool;
use PHPStrongV\Types\SVByte as SVByte;
use PHPStrongV\Types\SVInt as SVInt;
use PHPStrongV\Types\SVInt16 as SVInt16;
use PHPStrongV\Types\SVInt32 as SVInt32;
use PHPStrongV\Types\SVNumber as SVNumber;
use PHPStrongV\Types\SVString as SVString;
use PHPStrongV\Types\SVUByte as SVUByte;
use PHPStrongV\Types\SVUInt16 as SVUInt16;
use PHPStrongV\Types\SVUInt32 as SVUInt32;


spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    $path = dirname(__FILE__)  . '/' . implode('/', $parts) . '.php';
    if (is_file($path))
        require_once ($path);
});



mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');


/**
 * Returns a new SVString with $value as initial value.
 * Applicable values: any string
 * @param $value
 * @return SVString
 */
function &svstring ($value) {
    return PHPStrongVManager::getNewPointer(new SVString($value));
}


/**
 * Returns a new SVByte with $value as initial value.
 * Applicable values: -128 => 127
 * @param integer|SVByte $value
 * @return SVByte
 */
function &svbyte ($value) {
    return PHPStrongVManager::getNewPointer(new SVByte($value));
}

/**
 * Returns a new SVUByte with $value as initial value.
 * Applicable values: 0 => 255
 * @param integer|SVUByte $value
 * @return SVUByte
 */
function &svubyte ($value) {
    return PHPStrongVManager::getNewPointer(new SVUByte($value));
}


/**
 * Returns a new SVInt(Alias to SVInt32) with $value as initial value
 * Applicable values: -2147483648 => 2147483647
 * @param integer|SVInt32|SVInt16|Byte $value
 * @return SVInt
 */
function &svint ($value) {
    return PHPStrongVManager::getNewPointer(new SVInt($value));
}


/**
 * Returns a new SVInt16 with $value as initial value.
 * Applicable values: -32768 => 32767
 * @param integer|SVInt16|SVByte $value
 * @return SVInt16
 */
function &svint16 ($value) {
    return PHPStrongVManager::getNewPointer(new SVInt16($value));
}


/**
 * Returns a new SVUInt16 with $value as initial value.
 * Applicable values: 0 => 65535
 * @param integer|SVUInt16|SVUByte $value
 * @return SVUInt16
 */
function &svuint16 ($value) {
    return PHPStrongVManager::getNewPointer(new SVUInt16($value));
}


/**
 * Returns a new SVInt32 with $value as initial value.
 * Applicable values: -2147483648 => 2147483647
 * @param integer|SVInt32|SVInt16|Byte $value
 * @return SVInt32
 */
function &svint32 ($value) {
    return PHPStrongVManager::getNewPointer(new SVInt32($value));
}


/**
 * Returns a new SVUInt32 with $value as initial value.
 * Applicable values: 0 => 4294967295
 * @param integer|SVUInt32|SVUInt16|SVUByte $value
 * @return SVUInt32
 */
function &svuint32 ($value) {
    return PHPStrongVManager::getNewPointer(new SVUInt32($value));
}


/**
 * Returns a new SVNumber with $value as initial value.
 * Applicable values: Integer, Double, SVInt32, SVInt16, SVByte,
 * SVUInt32, SVUInt16, SVUByte
 * @param integer|double $value
 * @return SVNumber
 */
function &svnumber ($value) {
    return PHPStrongVManager::getNewPointer(new SVNumber($value));
}


/**
 * Returns a new SVBool with $value as initial value.
 * Applicable values: SVBool, true, false
 * @param boolean|SVBool $value
 * @return SVBool
 */
function &svbool ($value) {
    return PHPStrongVManager::getNewPointer(new SVBool($value));
}