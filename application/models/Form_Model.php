<?php
class Form_Model extends CI_Model
{
	public function select($tbl,$con='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);
			
		$q = $this->db->get();
		return $q->result();

	}

	public function insert($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();

	}
}
?>