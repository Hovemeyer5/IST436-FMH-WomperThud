<?
	class contact
	{
		//get contacts and groups all or with search parameters
		public function getContactsGroups($search = "")
		{
			//use database
			global $db;
			//define variables
			$contacts = "";
			$groups = "";
			$all = "";
			//make search parameter all upper case
			//get contacts matching search parameter
			$contacts = $db->select("contact", "c_id, CONCAT_WS(' ', c_fname, c_mi, c_lname) as name", "CONCAT_WS(' ', c_fname, c_lname) LIKE '%".$search."%' or
					   CONCAT_WS(' ', c_fname, c_mi, c_lname) LIKE '%".$search."%' or
					   CONCAT_WS('. ', CONCAT_WS(' ', c_fname, c_mi), c_lname) LIKE '%".$search."%'", "name Desc");
			
			//get groups matching search parameter
			$groups = $db->select("groups", "g_id, g_name as name", "UPPER(g_name) LIKE '%".$search."%'", "name ASC");
			
			//return an array of both
			if($groups == "" and $contacts != "")
			{
				return $contacts;	
			}
			elseif($groups != "" and $contacts == "")
			{
				return $groups;	
			}
			elseif($groups != "" and $contacts != "")
			{
				//merge arrays
				$all = array_merge($contacts, $groups);
				//sort to alphabetic order
				$allN = [];
				$smallestValue = $all[0][name][0];
				$smallestKey = 0;
				while(!empty($all))
				{
					foreach($all as $key=>$value)
					{
						if($value[name] < $smallestValue)
						{
							$smallestKey = $key;
							echo $key;
						}
					}
					array_push($allN, array_slice($all, $smallestKey, 1)[0]);

					unset($all[$smallestKey]);
					$all = array_values($all);
					$smallestKey = array_keys($all)[0];
					$smallestValue = $all[$smallestKey][name][0];
				}
				//return alphabetized merged array
				return $allN;	
			}
			else
			{
				return $contacts;
			}
			
			
			
		}
		//function to get a contact by it's id
		public function getContactById($c_id)
		{
			//use database
			global $db;
			//define variables
			$contact = "";
			$addresses = "";
			$emails = "";
			$urls = "";
			$phones = "";
			
			//get contact
			$contact = $db->select("contact", "*", "c_id=$c_id");
			
			//get all things that each contact could have multiple of and sort by type
			$addresses = $db->select("address, type", "a_id, a_street, a_city, a_state, a_zip, a_type, t_name", "a_type = t_id and c_id=".$c_id, "a_type");
			$emails = $db->select("email, type", "e_id, e_email, e_type, t_name", "e_type = t_id and c_id=".$c_id, "e_type");
			$urls = $db->select("url, type", "url_id, url_url, url_type, t_name", "url_type = t_id and c_id=".$c_id, "url_type");
			$phones = $db->select("phone, type", "p_id, p_number, p_type, t_name", "p_type = t_id and c_id=".$c_id, "url_type");
			
			//add extraneious fields to contact array
			$contact[0]['adds'] = $addresses;
			$contact[0]['emails'] = $emails;
			$contact[0]['urls'] = $urls;
			$contact[0]['phones'] = $phones;
			
			//return contact
			return $contact[0];	
		}
		//function to get a group by ID with it's members Id's
		public function getGroupById($g_id)
		{
			//use database
			global $db;
			//define variables
			$group = "";
			$members = "";
			//get group
			$group = $db->select("groups", "*", "g_id=$g_id");
			//get members id's and their names
			$members = $db->select("contact_group, contact", "contact_group.c_id, CONCAT_WS(' ', c_fname, c_mi, c_lname) as c_name", "g_id=$g_id And contact_group.c_id = contact.c_id");
			//get first address of each member
			foreach($members as $key=>$member)
			{
				//get first prioritized address
				$members[$key]['address'] = $db->select("address, type", "a_id, a_street, a_city, a_state, a_zip, t_name", "a_type = t_id and c_id=".$member['c_id'], "a_type", 1)[0];
			}
			//add members to group array
			$group[0]['members'] = $members;
			//return group
			return $group[0];
		}
		//add a contact
		public function addContact($table, $columns = '*', $where = null, $orderby = null, $limit = null)
		{

		}
		//delete a contact
		public function deleteContact()
		{

		}
		//add a group
		public function addGroup($table, $columns = '*', $where = null, $orderby = null, $limit = null)
		{

		}
		//delete group
		public function deleteGroup()
		{

		}
		//add contact to group
		public function addContactToGroup($table, $values, $columns=null)
		{

		}
		//delete  contact from group
		public function deleteContactFromGroup($table, $values, $columns=null)
		{

		}	
	}
?>