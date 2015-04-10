<?php
/*******************************************************************************
 * COPYRIGHT (c) 2014 Panagiotis Anastasiadis
 * THIS FILE IS PART OF PHPStrongV.
 * PROVIDED UNDER THE TERMS AND CONDITIONS DESCRIBED IN LICENSE.md
 *******************************************************************************
 */

namespace PHPStrongV\Base;
use PHPStrongV\Base\SVObject as SVObject;

class SVScalar extends SVObject
{
    /**
     * Creates a new instance supplying the initial value needed for the
     * operation of the type class.
     * @param mixed $value
     */
    public function __construct ($value) {
        $this->set($value);
    }


    /**
     * Accessor function which sets the value of the underlying data storage
     * field needed by each SVObject derived type class.
     * @param mixed $value
     */
    public function set ($value) {
        $this->value = $value;
    }





    /**
     * Checks if the current value is equal to the supplied value.
     * @param  $value
     */
    public function equals($value) {
        if ($value instanceof static)
            return $this->value === $value->val();
        else if ($this->value === $value)
            return true;
        else
            return false;
    }
}