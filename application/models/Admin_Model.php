<?php
class Admin_Model extends CI_Model
{
	public function select($tbl,$con='',$order_by='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);
			// if ($order_by)
					$this->db->order_by(!empty($order_by)?$order_by:"id",!empty($order_by)?"Asc":"Desc");
		$q = $this->db->get();
		return $q->result();

	}

	public function select_hourly($tbl,$mall_id)
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where("tstp > DATE_SUB('".tstp."', INTERVAL 24 HOUR) AND mall_id='$mall_id'");		
		$this->db->order_by("id", "Desc");
		$q = $this->db->get();
		return $q->result();

	}

	public function select_ongoing_orders($tbl)
	{
		$this->db->select('*');
		$this->db->from($tbl);
			$this->db->where('order_status IN(1)');

					$this->db->order_by("id", "Desc");
		$q = $this->db->get();
		return $q->result();

	}

	public function select_complete_orders($tbl)
	{
		$this->db->select('*');
		$this->db->from($tbl);
			$this->db->where('order_status IN(3,4)');

					$this->db->order_by("id", "Desc");
		$q = $this->db->get();
		return $q->result();

	}

	public function join_select($select,$tbl1,$tbl2,$on,$con='')
	{
		$this->db->select($select);
		$this->db->from($tbl1);
		$this->db->join($tbl2, $on, 'INNER');	
		if ($con)
			$this->db->where($con);
		#$this->db->order_by("id", "Desc");
		
		$q = $this->db->get();
		return $q->result();

	}

	public function user_wallet($select,$tbl1,$tbl2,$on,$con='')
	{
		$this->db->select($select);
		$this->db->from($tbl1);
		$this->db->join($tbl2, $on, 'INNER');	
		if ($con)
			$this->db->where($con);
		$this->db->order_by("w.id", "Desc");
		
		$q = $this->db->get();
		return $q->result();

	}

	public function triple_join_select($select,$tbl1,$tbl2,$tbl3,$on2,$on3,$join1,$join2,$con='')
	{
		$this->db->select($select);
		$this->db->from($tbl1);
		$this->db->join($tbl2, $on2, $join1);	
		$this->db->join($tbl3, $on3, $join2);	
		if ($con)
			$this->db->where($con);
		$q = $this->db->get();
		return $q->result();

	}


	public function selectrow($tbl,$con='',$con1='',$con2='',$con3='')
	{
		$this->db->select('*');
		$this->db->from($tbl);

		if ($con)
			$this->db->where($con);

			if ($con1)
				$this->db->where($con1);

				if ($con2)
					$this->db->where($con2);

					if ($con3)
						$this->db->where($con3);



		$q = $this->db->get();
		return $q->row();

	}
	public function insert($tbl,$data)
	{
		$this->db->insert($tbl,$data);
		return $this->db->insert_id();

	}
	public function update($tbl,$data,$con='')
	{
		if ($con)
		$this->db->where($con);
		$this->db->update($tbl,$data);
		return $this->db->affected_rows();
	}

	public function update_without_condition($tbl,$data)
	{
		$this->db->update($tbl,$data);
		return $this->db->affected_rows();
	}

	public function delete($tbl,$con='')
	{
		$this->db->where($con);
		return $this->db->delete($tbl);
	}
	// ------------------------------------------

	// public function get_question_list()
	// {
	// 	$q=$this->db->select('q.*, s.subject,')
	// 	->from('quiz as q')
	// 	->join('subjects as s', 'q.subject_id=s.id')
	// 	->get()->result();
	// 	return $q;
	// }


}
