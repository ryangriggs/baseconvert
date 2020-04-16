function baseconvert($value, $charset, $pad = false, $from_charset = '0123456789')
// Author: Ryan Griggs
// Copyright 2020 - MIT license
// Convert positive integer values between bases.  By default, convert from Base-10 to Base-N
// $value = value to convert (in base matching $from_charset)
// $charset = in-order string or array of characters to use for destination base.  Each character must be unique. 
// $pad = pad the left hand with the 0-th value character to ensure result is at least $pad characters long.  false[default] = do not pad
// $from_charset = the charset for the base-N to convert $value from.  Default = base-10
// Returns value represented in Base-N characters.
// Does not support negative numbers or floating point
{
	// Convert $charset to array
	if (!is_array($charset)) { $charset = str_split($charset); }	// $charset contains array of characters
	
	// Convert $from_charset to array
	if (!is_array($from_charset)) { $from_charset = str_split($from_charset); }

	// Get base sizes:
	$from_base = count($from_charset);	// Converting from this base
	if ($from_base < 2) { throw new Exception("Invalid from_charset. Must be > 1 character."); }	// Base-1 is invalid.
	$to_base = count($charset);			// Converting to this base
	if ($to_base < 2) { throw new Exception("Invalid charset. Must be > 1 character."); }	// Base-1 is invalid.

	// Convert value to array of string characters.
	$value = str_split($value);	
	
	// Convert input base to Base-10 integer:
	$intval = 0;
	foreach ($value as $i => $char)
	{
		$magnitude = count($value) - $i - 1;	// Find position of this character in order to calculate magnitude
		$ordinal = array_search($char, $from_charset);	// Find ordinal position of this character in the original character set.

		// If character is not found, throw error
		if ($ordinal === false) { throw new Exception("Invalid ordinal in baseConvert value: $char"); }

		// Append value of this character to the result
		$intval += ($from_base ** $magnitude) * $ordinal;
	}

	// $intval now contains the Base-10 integer value of $value.

	// Convert to destination base:
	$result = "";
	do
	{
		$m = $intval % $to_base;				// Calculate character position in destination charset
		$result = $charset[$m] . $result;		// Prepend character to result.
		$intval = intval($intval / $to_base);			// Decrease value by magnitude.

	} while ($intval > 0);

	// Pad result:
	if ($pad !== false && is_integer($pad))
	{
		$result = str_pad($result, $pad, $charset[0], STR_PAD_LEFT);	// Left pad with the 0th ordinal character.
	}

	return $result;
} // END baseconvert()
