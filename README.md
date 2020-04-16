# baseconvert
PHP arbitrary base conversion function

baseconvert is a fast and simple PHP function that converts numbers from/to arbitrary bases.  It can convert from Base-10 to any other base, including binary, octal, hex, or any arbitrary Base-N you can imagine.  It can also convert between arbitrary bases.  Want to convert from binary to Octal?  What about from Hex to a base containing 23 alphanumeric digits?  Yep, it works!

It can pad the result with the 0-th digit as needed.

The base character set is customizable, so any characters can be used.

Function parameters:

baseconvert($value, $charset, $pad, $from_charset)

 - $value = the value to convert (in any base, must match the characters listed in $from_charset)
 - $charset = the list of digits to use for the output base. Each digit must be unique, and can be listed as a string with no spaces or array of digits.  A base must contain at least 2 characters.
 - $pad - left-pad the result to $pad digits, usign the 0-th ordinal of the base $charset.  Set to false [default] to skip padding, or specify the total length of the result.  Results longer than $pad digits will be returned as-is.
 - $from_charset - the character set to use when interpreting $value.  By default, this is "0123456789" which is Base-10. 

Examples:

// From Base-10 to other bases:

// Convert Base-10 value "100" to Base-2 using the characters 0 and 1.  (binary)

baseconvert(100, "01");  // Result: 1100100


// Convert Base-10 value "100" to Base-2 using the characters 0 and 1 (binary) and pad to 8 digits

baseconvert(100, "01", 8);   // Result: 01100100

// Convert Base-10 value "100" to Hexadecimal

baseconvert(100, "0123456789abcdef");   // Result: 64

// From other bases to Base-10

// Convert hex value 0xDEADBEEF to decimal

baseconvert("DEADBEEF", "0123456789", false, "0123456789ABCDEF");     // Result: 3735928559

// Convert binary value 10010100101110 to decimal

baseconvert("10010100101110", "0123456789", false, "01");   // Result 9518


// Convert between arbitrary bases:

// Convert Octal 03773 to Hex:

baseconvert("03773", "0123456789abcdef", false, "01234567");  // Result: 7fb

// Convert value "GACT" (Base-4 using the characters "A", "C", "G", "T"), to Base-3 using the characters "X", "Y" and "Z":

baseconvert("GACT", "XYZ", false, "ACGT");  // Result YZXXX

// Convert binary 1011010110101011 to Base-12 using the characters !, @, #, $, %, ^, &, *, =, :, ?, +

baseconvert("1011010110101011", "!@#$%^&*=:?+", false, "01");   // Result: ##?+*

... I think you get the idea.

