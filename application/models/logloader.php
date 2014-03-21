<?php

class Logloader extends CI_Model
{
    

    public function record_count($table) {
        return $this->db->count_all($table);
    }

    public function fetch_logs($table,$limit, $start) {
        $this->db->order_by("id", "desc"); 
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
}
   ?>