<<?php

// You can call the function save_xml() to output an array of objects into 
// a file in XML format.  The function requires three arguments.
// The first argument should be the name of the PHP array to save.  
// The second argument is the name of the XML file to save the content in. 
// The third argument should be either "overwrite" or "append", depending on
// whether you wish to replace the existing file with just the contents 
// of the current array, or if you want to add the contents of the current
// array to the end of the existing file.
function save_xml ($object_array, $filename, $type_of_save)
{
	// if you are appending data, open the existing file and remove the 
	// closing root tag	so that more data objects can be appended.
	if ($type_of_save == "append")
	{
		// read in the old contents as a single string
		$old_file_contents = file_get_contents($filename);
		
		if (!$old_file_contents)
		{
			die("Error opening file $filename!");
		}
		
		// find the position of the closing root tag, and if found,
		// make a substring starting at the beginning and ending 
		// before the closing root tag, then output it back to the file. 
		$end_tag_position = strpos( $old_file_contents, "</$filename>");
		if (!$end_tag_position === false)
		{
			$new_file_contents = substr( $old_file_contents, 0, $end_tag_position );
			file_put_contents($filename, $new_file_contents);
		}
		
		// re-open the file to append new content.
		$fp = fopen($filename, "a+b");
		if (!$fp) { die("Error opening file $filename."); }
	}
	else
	{
		// if the type_of_save is not append, open the file and overwrite it.
		$fp = fopen($filename, "w+b");
		if (!$fp) { die("Error opening file $filename."); }
		
		// output the XML declaration and the opening root element tag.
		write_line($fp, "<?xml version=\"1.0\"?>\n\n");
		write_line($fp, "<$filename>\n");
	}

	// output the array objects to the file, using the writeXML method of the class.
	foreach ($object_array as $current_object) 
	{
		write_line($fp, $current_object->writeXML());
	}
	
	// output the closing root tag
	write_line($fp, "\n</$filename>");
	
	fclose($fp);
}


// This function writes the content to the specified file, and provides
// an error message if the operation fails.
function write_line ($fp, $line)
{
	if (!fwrite($fp, $line)) 
		die ("Error writing to file!");
}

// The function file_put_contents from the PHP web site does not exist 
// in our server's version of PHP.  This creates it.
if (!function_exists('file_put_contents')) 
{
   define('FILE_APPEND', 1);
   function file_put_contents($filename, $content, $flags = 0) 
   {
       if (!($file = fopen($filename, ($flags & FILE_APPEND) ? 'a' : 'w')))
           return false;
       $n = fwrite($file, $content);
       fclose($file);
       return $n ? $n : false;
   }
}

?> 