<?php
    require 'userclass.php';

    // Create an array to hold the products defined in the XML datafile.
    $users_for_display = array(); //was $products?
    
    // Use these variables to keep track of which user the XML parser is 
    // currently processing and which element tag we are within.
    $currentProductId1 = "";
    $currentTag1 = "";
    
    
    // This is a function to open the XML file and create the XML parser.
    // It returns the file pointer and parser.
    function create_parser1 ($filename) 
    {
    // open the XML data file in read only mode
        if ( !($fp = fopen($filename, "r")) ) {
            die("Cannot locate XML data file: $filename");
        }
        
    // initialize PHP's XML parser
        $parser = xml_parser_create();
        
    // set the event handlers for the parser.  Notice that we're not processing
    // any of the non-product content, so we don't need a default event handler.
        xml_set_element_handler($parser, 'startElement1', 'endElement1');
        xml_set_character_data_handler($parser, 'characterData1');
        
    // turn on case folding so all element and attribute names are uppercase.
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, true);
        
        return array($parser, $fp);
    }
    
    
    // This is a function to read in the data one line at a time and parse it.  
    // When you call the parser, use an IF statement so you can report an error
    // if it fails.
    function parse1 ($parser, $fp) 
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
    function startElement1($parser, $name, $attrs) 
    {
        // make these global variables accessible within the function.
        global $users_for_display;
        global $currentProductId1;
        global $currentTag1;
        
        // set the global $currentTag1 entry to be the current tag being processed.
        $currentTag1 = $name;
        
        // If the element is a <product>, create a new object for it and add it 
        // to the $products array, using the id attribute of the <product> as the key.
        // When starting a new product, also set the $currentProductId1 variable.
        if ($name == "USER")
        {
            // If there is a product without an ID attribute, exit and report an error.
            if ( !array_key_exists("ID", $attrs) )
            {
                die("Invalid element '$name' in XML file.  Missing ID attribute.");
            }
            
            $users_for_display[$attrs["ID"]] = new User($attrs["ID"]);
            $currentProductId1 = $attrs["ID"];
        }
    }
    
    
    // This function processes the closing tag for each element.
    function endElement1($parser, $name) 
    {
        // make these global variables accessible within the function.
        global $currentProductId1;
        global $currentTag1;
        
        // clear the current tag variable when the element is complete
        $currentTag1 = "";
        
        // When ending a product, also reset the $currentProductId1 variable.
        if ($name == "USER") 
        {
            $currentProductId1 = "";
        }
    }
    
    
    // This function processes the data within the tags for each element.
    function characterData1($parser, $data) 
    {
        // make these global variables accessible within the function.
        global $users_for_display;
        global $currentProductId1;
        global $currentTag1;
        
        // we only want to process the content from tags within a product, 
        // so check if the product id variable has been set yet.
        if ($currentProductId1 != "") 
        {
            // when parsing the contents of a product, check if the current
            // tag is one of the valid sub-elements defined in the object.
            // If so, add the content data of the sub-element as the value of
            // the corresponding property of the current object.
            if ( in_array($currentTag1, $users_for_display[$currentProductId1]->valid_tags) ) 
            {
                $users_for_display[$currentProductId1]->addData($currentTag1, $data);
            }
        }
    }
    
    
    // Everything we need is now defined, so try to create the parser.  
    // If that succeeds, parse it to read in the XML data and populate
    // the $products array, then free up the resources.
    if ( list($parser, $fp) = create_parser1('users.xml') ) 
    {
        parse1($parser, $fp);
        fclose($fp);
        xml_parser_free($parser);
    }
    
    // Our data is now ready to be used.  Closing the PHP block.
    
    
    ?>