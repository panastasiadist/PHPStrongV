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

namespace PHPStrongV\Helpers;

// THIS CODE IS BASED ON THE WORK OF Artur Graniszewski
// Read more on http://php.webtutor.pl/en/2011/04/13/strong-data-typing-in-php-part-ii-autoboxing-and-indestructable-objects-english-version
// The purpose of this class is to hold pointers to each SVObject based.
// It it used to enforce strongly typed SVObject based variables
// To learn more have a look at the URL above
//

class PHPStrongVManager
{
    protected static $counter;
    public static $memory = array();

    public static function & getNewPointer($dataType) {
        $name = ++self::$counter;
        PHPStrongVManager::$memory[$name] = $dataType;

        if (
            is_object($dataType) &&
            in_array('setPointer', get_class_methods($dataType))) {
                $dataType->setPointer($name);
        }
        return PHPStrongVManager::$memory[$name];
    }

    private function __construct() { }
}