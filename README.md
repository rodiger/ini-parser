INI to Array & Array to INI
===========================

This package convert INI file to Array and you can create INI from an Array. Please upload your INI file to "public" folder.

Features
--------

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Easy to use to any framework or even a plain php file


Example
-------

Load vendor autoload
<pre>
<code>
require_once '../vendor/autoload.php';
</code>
</pre>

Call Namespace
<pre>
<code>
use rodiger\iniParser\iniParser;
</code>
</pre>

Create object and call Ini2Array function with a filename parameter. Please upload the file to public folder
<pre>
<code>
$hehe = new iniParser();
$hehe->iniFileToArray( "test.ini" );
</code>
</pre>

Get array stucture
<pre>
<code>
print_r( $hehe );
</code>
</pre>

---------------------------------------------------------------------------------------------------------------

JSON sample data
<pre>
<code>
$jsondata = '{
    "owner": {
        "name": "John",
        "organization": "APP Inc."
    },
    "database": {
        "name": "default",
        "server": "192.0.2.62",
        "host": "localhost",
        "port": "143",
        "file1": "payroll1.dat",
        "file2": "payroll2.dat",
        "file3": "payroll3.dat"
    },
    "hello": {
        "key1": "value1",
        "key2": "value2",
        "key3": "value3"
    }
}';
</code>
</pre>

Convert JSON code to Array
<pre>
<code>
$result = json_decode( $jsondata, true );
</code>
</pre>

Call arrayToIniFile function with 2 paramter: Array, and filename.ini. In public folder you can check the new file. Get array stucture.
<pre>
<code>
echo $hehe->arrayToIniFile( $result, "new.ini" );
</code>
</pre>
