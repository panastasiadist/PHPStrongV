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

class SVInt16 extends SVInt
{
    /**
     * @ignore
     */
    const CLASS_NAME = 'PHPStrongV\Types\SVInt16';

    /**
     * - 2^16/2
     * @ignore
     */
    protected static $MIN_VALUE = -32768;


    /**
     * (2^32)/2 - 1 (containing 0)
     * @ignore
     */
    protected static $MAX_VALUE = 32767;
}