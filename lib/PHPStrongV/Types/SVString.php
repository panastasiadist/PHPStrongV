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
use PHPStrongV\Base\SVScalar as SVScalar;

class SVString extends SVScalar
{
    /**
     * @ignore
     */
    const CLASS_NAME = 'PHPStrongV\Types\SVString';

    /**
     * Sets $value as the new value and returns the updated instance.
     * @param string $value
     * @throws Exception if the supplied value is not a string.
     * @return SVString
     */
    public function set ($value) {
        if ($value instanceof self)
            $this->value = $value->val();
        else {
            if (gettype($value) == 'string')
                $this->value = $value;
            else
                throw new \Exception(
                    $this->formatTypeException($value, 'string'));
        }

        return $this;
    }


    /**
     * Appends $value to the end of the string and returns a new updated
     * instance.
     * @param string $value
     * @return SVString
     */
    public function &append($value) {
        $me = $this->val();
        $value = $this->internal_get_string($value, false);

        return svstring($me.$value);
    }


    /**
     * Returns a single character from the string located in the position
     * specified by $charIndex
     * @param integer $charIndex
     * @return string
     */
    public function char($charIndex) {
        $charIndex = $this->internal_get_int($charIndex);
        $chrArray = preg_split('//u', $this->val(), -1, PREG_SPLIT_NO_EMPTY);
        return $chrArray[$charIndex];
    }


    /**
     * Checks if the string contains $value and returns true or false.
     * @param string $value
     * @return boolean
     */
    public function contains($value) {
        $me = $this->val();
        $value = $this->internal_get_string($value);
        return mb_strpos($me, $value) !== false;
    }


    /**
     * Checks if the string equals $target string and returns true or false.
     * @param string $target
     * @return boolean
     */
    public function equals($target) {
        $first = $this->val();
        $second = $this->internal_get_string($target);
        return $first === $second;
	}


    /**
     * Checks if the string ends with $value string and returns true or false.
     * @param string $value
     * @return boolean
     */
    public function endsWith($value) {
        $me = $this->val();
        $value = $this->internal_get_string($value);
		$length = mb_strlen($value);
		if ($length == 0)
            return true;
        else
		    return (mb_substr($me, -$length) === $value);
	}


    /**
     * Returns a new SVString instance according to the format specified by
     * $format and the arguments passed.
     * @param string $format The format of the string with %% as placeholders
     * @return SVString
     */
    public static function &format($format) {
        $args = func_get_args();

        // The first arg is the format
        $argUsed = 0;

        $charArray = static::internal_toCharArray($format);
        $newArray = array();
        for ($idx = 0; $idx < count($charArray) - 1; $idx++) {
            if ($charArray[$idx] == '%' && $charArray[$idx+1] == '%') {
                $newArray[] = $args[++$argUsed];

                // Ignore the second % in the series
                $idx++;
            }
            else
                $newArray[] = $charArray[$idx];
        }

        $newValue = implode('', $newArray);
        return svstring($newValue);
    }


    /**
     * Returns the zero based index of $value if found in the string or false.
     * You may optionally supply $offset as the zero based index to start
     * searching from.
     * @param string $value
     * @param integer $offset
     * @return integer
     */
    public function indexOf($value, $offset = 0) {
        $me = $this->val();
        $value = $this->internal_get_string($value);
        return mb_strpos($me, $value, $offset);
    }


    /**
     * Inserts $value in the string in the zero based position specified by
     * $position and returns a new updated instance.
     * @param string $value
     * @param integer $offset
     * @return SVString
     */
    public function &insert($value, $offset) {
        $charArray = $this->toCharArray();
        $valueArray = static::internal_toCharArray($value);

        array_splice($charArray, $offset, 0, $valueArray);
        $newString = implode('', $charArray);

        return svstring($newString);
    }


    /**
     * Returns the length of the string.
     * @return integer The length of the string
     */
    public function length() {
        return mb_strlen($this->val());
    }


    /**
     * Pads the string $count times from the left (start) with spaces or the
     * optional $padChar and returns the updated instance.
     * @param integer $count
     * @param string $padChar
     * @return SVString
     */
    public function &padLeft($count, $padChar = ' ') {
        return $this->internal_pad(true, false, $count, $padChar);
    }


    /**
     * Pads the string $count times from the right (end) with spaces or the
     * optional $padChar and returns a new updated instance.
     * @param integer $count
     * @param string $padChar
     * @return SVString
     */
    public function &padRight($count, $padChar = '') {
        return $this->internal_pad(false, true, $count, $padChar);
    }


    /**
     * Appends $value to the start of the current string and returns a new
     * updated instance.
     * @param string $value
     * @return SVString
     */
    public function &prepend($value) {
        $me = $this->val();
        return svstring($value.$me);
    }


    /**
     * Removes characters from the string starting from $offset position.
     * Optionally it will remove a number of $count characters starting from
     * $offset position. Returns a new updated instance.
     * @param integer $offset
     * @param integer $limit Optional.
     * @return SVString
     */
    public function &remove($offset, $count = -1) {
        $charArray = $this->toCharArray();
        $length = count($charArray);
        $lcount = 0;

        for ($idx = $offset; $idx < $length; $idx++) {
            unset($charArray[$idx]);

            $lcount++;
            if ($count !== -1 && $count == $lcount)
            break;
        }

        $new = implode('', $charArray);

        return svstring($new);
    }


    /**
     * Search for $search in the string and replace with $replace and returns
     * a new updated instance.
     * @param $search
     * @param $replace
     * @return SVString
     */
    public function &replace($search, $replace)
    {
        $me = $this->val();
        $new = str_replace($search, $replace, $me);

        return svstring($new);
    }


    /**
     * Checks if the string starts with $value and returns true or false.
     * @param string $value
     * @return boolean
     */
    public function startsWith($value) {
        $me = $this->val();
        $value = $this->internal_get_string($value);
        $length = mb_strlen($value);
        if ($length == 0) return true;
		return mb_substr($me, 0, $length) === $value;
	}


    /**
     * Splits the string by $delimeter and returns an array with the parts of
     * string.
     * @param $delimeter
     * @return array
     */
    public function split($delimeter) {
        $me = $this->val();
        $delimeter = $this->internal_get_string($delimeter);
        $parts = array();
        foreach (explode($delimeter, $me) as $part)
            $parts[] = svstring($part);
        return $parts;
    }


    /**
     * Returns a new instance with the part of the string starting from
     * left-most $offset.
     * Optionally returns only the first $count characters starting from $offset
     * @param integer $offset
     * @param integer $count Optional.
     * @return SVString
     */
    public function &substring($offset, $count = null) {
        if ($count !== null)
            $partString = mb_substr($this->val(), $offset, $count);
        else
            $partString = mb_substr($this->val(), $offset);

        return svstring($partString);
    }


    /**
     * Returns a new updated instance with the text uppercased. Optionally pass
     * $offset to uppercase only the character specified by $offset.
     * @param integer $charIndex Optional.
     * @return SVString
     */
    public function &toUpper($offset = null) {
        if ($offset == null)
            $newString = mb_convert_case($this->val(), MB_CASE_UPPER);
        else if (is_int($offset))
        {
            $chrArray = $this->toCharArray();
            $chrArray[$offset] = mb_convert_case($chrArray[$offset], MB_CASE_UPPER);
            $newString = implode('', $chrArray);
        }
        else
            $newString = $this->val();

        return svstring($newString);
    }


    /**
     * Returns a new updated instance with the text lowercased. Optionally pass
     * $offset to lowercase only the character specified by $offset.
     * @param integer $charIndex Optional.
     * @return SVString
     */
    public function &toLower($offset = null) {
        if ($offset == null)
            $newString = mb_convert_case($this->val(), MB_CASE_LOWER);
        else if (is_int($offset))
        {
            $chrArray = $this->toCharArray();
            $chrArray[$offset] = mb_convert_case($chrArray[$offset], MB_CASE_LOWER);
            $newString = implode('', $chrArray);
        }
        else
            $newString = $this->val();

        return svstring($newString);
    }


    /**
     * Returns an array with the characters of the string
     * @return array
     */
    public function toCharArray() {
        $value = $this->val();
        return static::internal_toCharArray($value);
    }


    /**
     * Removes all leading spaces in the string and returns a new updated
     * instance.
     * @return SVString
     */
    public function &trimLeft() {
        return $this->internal_trim(true, false);
    }


    /**
     * Removed all trailing spaces in the string and returns a new updated
     * instance.
     * @return SVString
     */
    public function &trimRight() {
        return $this->internal_trim(false, true);
    }


    /**
     * @ignore
     */
    private function internal_get_int($value) {
        $type = gettype($value);
        if (
            $type == 'integer' ||
            $type == 'SVInt' ||
            $type == 'SVInt32' ||
            $type == 'SVInt64' ||
            $type == 'SVUInt32' ||
            $type == 'SVUInt64')
            return $value;
        else
            throw new \Exception($this->formatTypeException($value, 'integer'));
    }


    /**
     * @ignore
     */
    private function internal_get_string($value) {
        $type = gettype($value);
        if ($type == 'string')
            return $value;
        else if ($value instanceof static)
            return $value->val();
        else
            throw new \Exception($this->formatTypeException($value, 'string'));
    }


    /**
     * @ignore
     */
    private static function internal_toCharArray($value) {
        return preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
    }


    /**
     * @ignore
     */
    private function &internal_pad($left, $right, $count, $padChar) {
        $me = $this->val();
        for ($idx = 0; $idx < $count; $idx++) {
            if ($left) $me = $padChar . $me;
            if ($right) $me = $me . $padChar;
        }
        return svstring($me);
        //return $this->makeVal($me);
    }


    /**
     * @ignore
     */
    private function &internal_trim($left = true, $right = true) {
        $regexLetterPattern = '\s';

        if (($left || $right) === false)
            throw new Exception('Abnormal function call');

        if ($left)
            $regexPatternArray[] = '^(' . $regexLetterPattern . ')+';

        if ($right)
            $regexPatternArray[] = '(' . $regexLetterPattern . ')+$';

        $regexPattern = implode('|', $regexPatternArray);

        $newString = mb_ereg_replace ($regexPattern, "", $this->val());

        return svstring($newString);
        //return $this->makeVal($newString);
    }



}