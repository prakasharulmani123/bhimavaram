<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Df extends CI_Model
{
/*-----------------------------------------------
construtor Function
-------------------------------------------------*/
function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//---------------------------------------------------
/*----------------------------------------------------
get single row
@	access				public
@	parameter			$where		condition
@	parameter			$like		condition	
------------------------------------------------------*/
	function get_single_row($table,$where=FALSE,$like=FALSE)
		{
		//list where condition
			if($where)
				{
					foreach($where as $key => $value)
						{
							$this->db->where($key,$value);
						}
				}
		//list like condition
			if($like)
				{
					foreach($like as $key => $value)
						{
							$this->db->like($key,$value);
						}
				}
			//select row
			$query=$this->db->get($table);
			return $query->row_array();
			$query->free_result();

	//END get_single_row 
		}
		
		
//---------------------------------------------------

/*---------------------------------------------------
get multiple row
@	access				public
@	parameter			$where		condition
@	parameter			$like		condition	
@	parameter			$limit		string
@	parameter			$table		string
------------------------------------------------------*/
	function get_multi_row($table,$where=FALSE,$like=FALSE,$limit=FALSE,$orderby=FALSE)
		{
		//list where condition
			if($where)
				{
					foreach($where as $key => $value)
						{
							$this->db->where($key,$value);
						}
				}
		//list like condition
			if($like)
				{
					foreach($like as $key => $value)
						{
							$this->db->like($key,$value);
						}
				}
				
		//set limit
			if($limit)
				{
					$this->db->limit($limit);
				}
	//Order by condition
			if($orderby)
				{
					foreach($orderby as $key => $value)
						{
							$this->db->order_by($key,$value);
						}
				}
			else
				{
					$this->db->order_by('id','desc');
				}
				
		//select row
			$query=$this->db->get($table);
			return $query->result_array();
			$query->free_result();

	//END get_multi_row 
		}

//----------------------------------------------------

/*------------------------------------------------------
insert data
@	access				public
@	parameter			$data		array
@	parameter			$table		string
--------------------------------------------------------*/
	function insert_data($table,$data)
		{
			$this->db->insert($table,$data);
			return TRUE;
		}
/*---------------------------------------------------
insert data & return insert_id
@	access				public
@	parameter			$data		array
@	parameter			$table		string
-----------------------------------------------------*/
	function insert_data_id($table,$data)
		{
			$this->db->insert($table,$data);
			return $this->db->insert_id();
		}


//---------------------------------------------------


/*---------------------------------------------------
update record
@	access				public
@	parameter			$data		array
@	parameter			$table		string
@	parameter			$where		condition
-----------------------------------------------------*/
	function update_record($table,$data,$where)
		{
		//list where condition
			foreach($where as $key => $value)
				{
					$this->db->where($key,$value);
				}
			//update record
			$query=$this->db->update($table,$data);
			return TRUE;
	//END update_record
		}
		
//---------------------------------------------------

/*---------------------------------------------------
delete record
@	access				public
@	parameter			$where		condition
@	parameter			$table		string
----------------------------------------------------*/
	function delete_record($table,$where)
		{
	//list where condition
			foreach($where as $key => $value)
				{
					$this->db->where($key,$value);
				}
	//delete record
			$query=$this->db->delete($table);
			return TRUE;
	//END delete_record
		}
//---------------------------------------------------

//---------------------------------------------------
/*---------------------------------------------------
count no. of records
@	access				public
@	parameter			$where		condition
@	parameter			$table		string
@	parameter			$like		condition
-------------------------------------------------------*/
	function get_count($table,$where=FALSE,$like=FALSE)
		{
			//list where condition
			if($where)
				{
					foreach($where as $key => $value)
						{
							$this->db->where($key,$value);
						}
				}
			//list like condition
			if($like)
				{
					foreach($like as $key => $value)
						{
							$this->db->like($key,$value);
						}
				}
			$this->db->from($table);
			return $this->db->count_all_results();		
		}
//----------------------------------------------------
/*-----------------------------------------------------
count all records in a table
@	access				public
@	parameter			$table		string
------------------------------------------------------*/
	function get_total_count($table)
		{
			return $this->db->count_all($table);		
		}
		
//----------------------------------------------------
/*----------------------------------------------------
Get limited rows
@	access				public
@	parameter			$where		condition
@	parameter			$table		string
@	parameter			$count 		string
@	parameter			$offset 	integer
------------------------------------------------------*/
	function get_limited_rows($table,$where=false,$count,$offset,$order=false)
		{
			if($where)
				{
					foreach($where as $key => $value)
						{
							$this->db->where($key,$value);
						}
				}
			
			if($order)
				{
					foreach($order as $k=>$v)
					{
						$this->db->order_by($k,$v);
					}
				}
			else
				{
					$this->db->order_by('id','desc');	
				}
			$query=$this->db->get($table,$count,$offset);		
			return $query->result_array();
			$query->free_result();
		}
//----------------------------------------------------
/*-----------------------------------------------------
Get field value
@	access				public
@	parameter			$where		condition
@	parameter			$table		string
@	parameter			$field		string
-------------------------------------------------------*/
	function get_field_value($table,$where,$field)
		{
			$query=$this->db->get_where($table,$where);		
			$row=$query->row_array();
			return $row[$field];
			$query->free_result();
		}
		
	function doquery($sql)
	{
		return $this->db->query($sql)->result_array();
		
	}

	
	function checkExists($table,$field,$value)
	{
			if($this->get_count($table,array($field=>$value))==0)
			{
				return false;
			}
			else
			{
				$data=$this->get_single_row($table,array($field=>$value));
				return $data['id'];
			}
	}



//---------------------------------------------------
/*---------------------------------------------------
Df_model.php ends
File			Df_model.php	
Location	:	aplication/models/Df_model.php
-------------------------------------------------*/
}
?>