<?php 

class User
{
	// Define the required id property.  Each object must have an id attribute.
	var $id;

	// Define properties to hold the info in sub-elements of the XML object.  
	// These are the names of the valid elements nested within each of the 
	// object tags.
	// ------------------------------------------------------------------------
	// ADD A PROPERTY VARIABLE FOR EACH VALID SUB-ELEMENTS IN THE XML FILE.  
	// ------------------------------------------------------------------------
	var $name;
	var $email;
	var $phone;
    var $city;
	var $state;
	var $country;
    var $contact_preference;
	var $bio;
	var $password;

	// If you have a sub-element that can appear more than once per XML object, 
	// you must define it as an array.  For example, each product in my sample
	// XML file might have more than one <warning> element, so this property
	// must be an array in PHP.
	var $job_taken = array();
    var $job_finished = array();

    var $valid_tags = array ( 'NAME', 'EMAIL', 'PHONE', 'CITY', 'STATE', 'COUNTRY', 'CONTACT_PREFERENCE',
    'BIO', 'PASSWORD', 'JOB_TAKEN', 'JOB_FINISHED' );

	// This is the constructor function which assigns the product id property.
	// ------------------------------------------------------------------------
	// CHANGE THE FUNCTION NAME TO BE THE SAME AS THE CLASS NAME.
	// ------------------------------------------------------------------------
	function User ($newID) 
	{
		$this->id = $newID;
	}


	// This function is used to convert the object back into an XML string.
	// ------------------------------------------------------------------------
	// CHANGE THE FUNCTION CONTENTS TO OUTPUT YOUR OBJECT'S PROPERTIES, AS
	// DESCRIBED BELOW.
	// ------------------------------------------------------------------------
	function writeXML ()
	{
		// Define some special characters to help format your output.
		$tab = "\t";
		$newline = "\n";
		
		// Change the primary object tag to be the name of the class.
		$xml_string = $newline . $tab . '<user id="' . $this->id . '">' . $newline;
		
		// Add one line for each property, outputing that property in an appropriate XML tag.
		$xml_string .= $tab . $tab . '<name>' . $this->name . '</name>' . $newline;
		$xml_string .= $tab . $tab . '<email>' . $this->email . '</email>' . $newline;
		$xml_string .= $tab . $tab . '<phone>' . $this->phone . '</phone>' . $newline;
        $xml_string .= $tab . $tab . '<city>' . $this->city . '</city>' . $newline;
		$xml_string .= $tab . $tab . '<state>' . $this->state . '</state>' . $newline;
		$xml_string .= $tab . $tab . '<country>' . $this->country . '</country>' . $newline;
        $xml_string .= $tab . $tab . '<contact_preference>' . $this->contact_preference . '</contact_preference>' . $newline;
        $xml_string .= $tab . $tab . '<bio>' . $this->bio . '</bio>' . $newline;
		$xml_string .= $tab . $tab . '<password>' . $this->password . '</password>' . $newline;
		
		// If you have any properties that are arrays, use a loop to 
		// add each existing instance of the XML string.
		foreach ($this->job_taken as $job_taken)
		{
			$xml_string .= $tab . $tab . '<job_taken>' . $job_taken . '</job_taken>' . $newline;
		}

        foreach ($this->job_finished as $job_finished)
		{
			$xml_string .= $tab . $tab . '<job_finished>' . $job_finished . '</job_finished>' . $newline;
		}
		
		// Add the closing tag for the object, changing it to have the name of the class.
		$xml_string .= $tab . '</user>' . $newline;
		
		// Return the XML string.
		return $xml_string;
	}


	// This function is used to add data to one of the object's properties.
	// You probably do not need to make any changes to this function.
	function addData ($prop, $new_value) 
	{
		// Convert the property name to lower case.
		$prop = strtolower($prop);
		
		// Check if the property has been defined as an array.
		if ( is_array($this->$prop) )
		{
			// If so, add the new element to the end of the existing array.
			$temp_array = array( $new_value );
			$this->$prop = array_merge( $this->$prop, $temp_array );
		}
		else
			// Otherwise, just set the property to its new value.
			$this->$prop = $new_value;
	}
}

?>