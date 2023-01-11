<?php
class Job 
{
	// define the properties corresponding to valid attributes and sub-elements.
	var $id;
	var $job_name;
	var $category;
	var $location;
    var $date;
    var $skills_materials;
	var $volunteer_id;
	var $finished;
	var $requestor_id;
	
	// define an array listing which sub-element tags we want to process 
	// in this script.
	var $valid_tags = array ( 'JOB_NAME', 'CATEGORY', 'LOCATION', 'DATE', 'SKILLS_MATERIALS', 'VOLUNTEER_ID', 'FINISHED', 'REQUESTOR_ID' );

	// this is the constructor function which assigns the product id property.
	function Job ($newID) 
	{
		$this->id = $newID;
	}

    function writeXML ()
	{
		// Define some special characters to help format your output.
		$tab = "\t";
		$newline = "\n";
		
		// Change the primary object tag to be the name of the class.
		$xml_string = $newline . $tab . '<job id="' . $this->id . '">' . $newline;
		
		// Add one line for each property, outputing that property in an appropriate XML tag.
		$xml_string .= $tab . $tab . '<job_name>' . $this->job_name . '</job_name>' . $newline;
		$xml_string .= $tab . $tab . '<category>' . $this->category . '</category>' . $newline;
		$xml_string .= $tab . $tab . '<location>' . $this->location . '</location>' . $newline;
        $xml_string .= $tab . $tab . '<date>' . $this->date . '</date>' . $newline;
        $xml_string .= $tab . $tab . '<skills_materials>' . $this->skills_materials . '</skills_materials>' . $newline;
        $xml_string .= $tab . $tab . '<volunteer_id>' . $this->volunteer_id . '</volunteer_id>' . $newline;
        $xml_string .= $tab . $tab . '<finished>' . $this->finished . '</finished>' . $newline;
		$xml_string .= $tab . $tab . '<requestor_id>' . $this->requestor_id . '</requestor_id>' . $newline;
		
		// Add the closing tag for the object, changing it to have the name of the class.
		$xml_string .= $tab . '</job>' . $newline;
		
		// Return the XML string.
		return $xml_string;
	}

	
	// this function is used to add data to one of the other properties.
	function addData ($prop, $new_value) 
	{
		$prop = strtolower($prop);
		$this->$prop = $new_value;
	}
}
?>