<?php
// Start the PHP code block that will read the XML data file and convert it
// to a PHP object that we can then use when we build the xhtml content the'
// browser will be sent.


// Define a class for each <product> in the XML data file.  Each object will
// have properties (ie, variables) for each of the allowed tags or 
// sub-elements within the <product>.  It will also have a constructor method,
// and a simple method for updating a property.

require 'jobclass.php';

// Create an array to hold the products defined in the XML datafile.
$jobs_for_display = array(); //was $products?

// Use these variables to keep track of which product the XML parser is 
// currently processing and which element tag we are within.
$currentProductId = "";
$currentTag = "";


// This is a function to open the XML file and create the XML parser.
// It returns the file pointer and parser.
function create_parser ($filename) 
{
// open the XML data file in read only mode
	if ( !($fp = fopen($filename, "r")) ) {
    	die("Cannot locate XML data file: $filename");
	}
	
// initialize PHP's XML parser
	$parser = xml_parser_create();
	
// set the event handlers for the parser.  Notice that we're not processing
// any of the non-product content, so we don't need a default event handler.
	xml_set_element_handler($parser, 'startElement', 'endElement');
	xml_set_character_data_handler($parser, 'characterData');
	
// turn on case folding so all element and attribute names are uppercase.
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, true);
	
	return array($parser, $fp);
}


// This is a function to read in the data one line at a time and parse it.  
// When you call the parser, use an IF statement so you can report an error
// if it fails.
function parse ($parser, $fp) 
{
	while ($data = fgets($fp)) 
	{
		if ( !xml_parse($parser, $data, feof($fp)) ) 
		{
			die(sprintf("XML error: %s at line %d", 
			   xml_error_string(xml_get_error_code($parser)),  
			   xml_get_current_line_number($parser)));
		}
	}
}

// This function processes the open tag for each element, including
// its attributes.
function startElement($parser, $name, $attrs) 
{
	// make these global variables accessible within the function.
	global $jobs_for_display;
	global $currentProductId;
	global $currentTag;
	
	// set the global $currentTag entry to be the current tag being processed.
	$currentTag = $name;
	
	// If the element is a <product>, create a new object for it and add it 
	// to the $products array, using the id attribute of the <product> as the key.
	// When starting a new product, also set the $currentProductId variable.
	if ($name == "JOB")
	{
		// If there is a product without an ID attribute, exit and report an error.
		if ( !array_key_exists("ID", $attrs) )
		{
			die("Invalid element '$name' in XML file.  Missing ID attribute.");
		}
		
		$jobs_for_display[$attrs["ID"]] = new Job($attrs["ID"]);
		$currentProductId = $attrs["ID"];
	}
}


// This function processes the closing tag for each element.
function endElement($parser, $name) 
{
	// make these global variables accessible within the function.
	global $currentProductId;
	global $currentTag;
	
	// clear the current tag variable when the element is complete
	$currentTag = "";
	
	// When ending a product, also reset the $currentProductId variable.
	if ($name == "JOB") 
	{
		$currentProductId = "";
	}
}


// This function processes the data within the tags for each element.
function characterData($parser, $data) 
{
	// make these global variables accessible within the function.
	global $jobs_for_display;
	global $currentProductId;
	global $currentTag;
	
	// we only want to process the content from tags within a product, 
	// so check if the product id variable has been set yet.
	if ($currentProductId != "") 
	{
		// when parsing the contents of a product, check if the current
		// tag is one of the valid sub-elements defined in the object.
		// If so, add the content data of the sub-element as the value of
		// the corresponding property of the current object.
		if ( in_array($currentTag, $jobs_for_display[$currentProductId]->valid_tags) ) 
		{
			$jobs_for_display[$currentProductId]->addData($currentTag, $data);
		}
	}
}


// Everything we need is now defined, so try to create the parser.  
// If that succeeds, parse it to read in the XML data and populate
// the $products array, then free up the resources.
if ( list($parser, $fp) = create_parser('jobs.xml') ) 
{
	parse($parser, $fp);
	fclose($fp);
	xml_parser_free($parser);
}

// Our data is now ready to be used.  Closing the PHP block.
?>