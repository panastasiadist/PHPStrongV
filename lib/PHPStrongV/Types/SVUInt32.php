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

namespace PHPStrongV\Types;
use PHPStrongV\Types\SVInt as SVInt;

class SVUInt32 extends SVInt
{
    /**
     * @ignore
     */
    const CLASS_NAME = 'PHPStrongV\Types\SVUInt32';

    /**
     * @ignore
     */
    protected static $MIN_VALUE = 0;

    /**
     * (2^32) - 1 (containing 0)
     * @ignore
     */
    protected static $MAX_VALUE = 4294967295;
}