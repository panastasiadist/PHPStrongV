PHPStrongV Lite
==========
PHPStrongV is a lightweight PHP library which provides object-oriented, method
driven and (optionally) strongly typed common data types for PHP. It is inspired
from .NET primitive type implementation. In addition it boasts a Key-Value
Dictionary implementation, a dynamically adjusted List implementation as well
LIFO Stack and FIFO Queue implementations. PHPStrongV is a developer's swiss
army knife when working with data, providing efficiency, code clearness and
optional strong type safety.


How It Works
============
PHPStrongV implements a class for each data type it provides, providing special
methods to manipulate its data. For example, when creating a PHPStrongV based
string variable $v, you instantiate a instance of SVString class. The variable
is a instantiated SVString class on which you may call methods to manipulate it
such as $v->toUpper() etc.


Requirements
============
PHP 5.3 or newer


Supported Data Types
====================
UTF8 String, Byte, Int16, Int32, UByte, UInt16, UInt32, Double/Float, Boolean


Supported Collections
=====================
Key-Value Dictionary, List, LIFO Stack, FIFO Queue


Basic Usage
==========
Introduction
* Copy lib directory in your project under a directory of your choice.
* Include once PHPStrongV.php file located in lib directory.

To create a new variable you should use special functions as follows:
```php
/*** Create a strongly typed string with value 'test' ***/
$var_string = &svstring('test');

/*** Create a weakly typed string with value 'test' ***/
$var_string = svstring('test');

/*** Change the variable's value ***/
$var_string = 'test 2'; // or
$var_string->set('test 2');

/*** Get the variable's value. returns 'test 2' ***/
$value = $var_string->val();

/*** Make the value uppercase ***/
$value = $var_string->toUpper();

/*** Create an integer 32 with value 10 ***/
$var_int = &svint(10);

/*** Get the value of integer 32 ***/
$var_int->val(); // 10

/*** Will throw an exception as '2' is string and not an integer ***/
$var_int32 = '2';

/*** Will throw an exception as value is out of bounds ***/
$var_int32 = 9223372036854775807;
$var_int32 = 2; // correct

/*** Create a new list which accepts strings ***/
$var_list = &svlist('string');
$var_list->add('element1');
$var_list->addRange(array('element2', 'element3'));
// the list now has the following elements in the order presented:
// element1, element2, element3
// now let's reverse the order of the elements in the list:
$var_list->reverse();
// we read the element at index 0 which is 'element3'
$var_element = var_list->at(0);

/*** Create a new dictionary which accepts strings ***/
$var_dic = &svdictionary('string');
$var_dic->add('key1', 'value1');
$var_value = $var_dic->at('key1'); // will return 'value1'
$var_dic->add('key2', 1); // will throw an exception as 1 is not a string.
```


Data Types & Collections => Classes => Constructor Functions
===================================================================
* Byte                =>      SVByte        =>      svbyte(value)
* Int16               =>      SVInt16       =>      svint16(value)
* Int32               =>      SVInt         =>      svint(value)
* Unsigned Byte       =>      SVUByte       =>      svubyte(value)
* Unsigned Int16      =>      SVUInt16      =>      svuint16(value)
* Unsigned Int32      =>      SVUInt32      =>      svuint32(value)
* Boolean             =>      SVBool        =>      svbool(value)
* Double              =>      SVNumber      =>      svnumber(value)
* String              =>      SVString      =>      svstring(value)
* Dictionary          =>      SVDictionary  =>      svdictionary(type)
* List                =>      SVList        =>      svlist(type)
* Stack               =>      SVStack       =>      svstack(type)
* Queue               =>      SVQueue       =>      svqueue(type)


Additional Information
======================
* Each function is commented. Look in PHPStrongV.php file for more information
and advanced usage.
* You may use the code in examples directory for more examples.
* To use strong type support, don't forget the & in front of each svX function
call.


Lite Version
============
* The GitHub open source version of PHPStrongV does not contain support for
Collections.