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

/* Part of this class is based on the work of  Artur Graniszewski
 * Read more on http://php.webtutor.pl/en/2011/04/13/strong-data-typing-in-php-
 * part-ii-autoboxing-and-indestructable-objects-english-version
 */
namespace PHPStrongV\Base;
use PHPStrongV\Helpers\PHPStrongVManager as PHPStrongVManager;

// Class serves as the basis of every PHPStrongV type class.
// Every type class extends this class.
class SVObject
{
    /**
     * Low level storage for each SVObject derived type class.
     * Each type class acts on $value in different ways and transforms its data
     * according to its needs and the behavior it needs to support.
     * For example, an SVInt stores an integer but a SVDictionary stores an
     * associative array.
     * @ignore
     */
    protected $value = null;


    /**
     * Holds the key to the array of Manager which holds the pointer to an
     * instance of SVObject.
     * @ignore
     */
    protected $ref;


    /**
     * @ignore
     */
    public function __destruct() {
        if($this->ref === null) {
            return;
        }

        if(PHPStrongVManager::$memory[$this->ref] instanceof static) {
            PHPStrongVManager::$memory[$this->ref]->setPointer($this->ref);
        }
        else if (is_scalar(PHPStrongVManager::$memory[$this->ref])) {
            $val = PHPStrongVManager::$memory[$this->ref];
            $class = get_class($this);;

            PHPStrongVManager::$memory[$this->ref] = new $class($val);
            PHPStrongVManager::$memory[$this->ref]->setPointer($this->ref);
        }
        else {
            // The new value is not scalar. So it is a class of different type.
            // Because we are in strong type mode, stop here and throw an
            // exception.
            throw new Exception(
                'Cannot cast ' .
                get_class(PHPStrongVManager::$memory[$this->ref]) .
                ' to ' .
                get_class($this)
            );
        }

    }


    /**
     * Returns the value of the instance
     */
    public function val() {
        return $this->value;
    }


    /**
     * @ignore
     */
    public function setPointer($name) {
        $this->ref = $name;
    }


    /**
     * Returns a string representation of the underlying storage field according
     * to the type of its data. More information on
     * http://php.net/manual/en/language.oop5.magic.php#object.tostring
     * @return string
     * @ignore
     */
    public function __toString()
    {
        $value = $this->value;
        $ret = null;
        $type = gettype($value);

        if ($type === 'string')
            $ret = $value;
        else if ($type === 'integer')
            $ret = $value . '';
        else if ($value === 'boolean')
            $ret = $value == true ? 'true' : 'false';
        else if ($value === 'double')
            $ret = $value . '';
        else if ($value === 'array')
            $ret = implode (', ', $value);
        else
            $ret = '';

        return $ret;
    }


    /**
     * Returns a new instance with the value of the current instance.
     * @return mixed
     */
    public function &copy() {
        $factoryMethod = get_class($this);
        return PHPStrongVManager::getNewPointer(
            new $factoryMethod($this->value));
    }


    /**
     * Returns a type incompatibility message by detecting the type of the
     * value supplied and the type needed.
     * @param  mixed $valueGiven The value given which is the reason for the
     * type incompatibility.
     * @param  string $typeExpected The type which is needed.
     * @return string The generated message.
     * @ignore
     */
    protected function formatTypeException($valueGiven, $typeExpected) {
        $type = gettype($valueGiven);
        if ($type === 'object') {
            $type = get_class($valueGiven);
        }

        return
            'Type incompatibility. ' .
            $typeExpected .
            ' expected. ' .
            $type  .
            ' supplied.';
    }
}