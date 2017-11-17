<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CitieModel extends CI_Model {
    var $table = "cities";
    
    public function getStateId($id){
        $this->db->where('id_cities', $id);
        $query = $this->db->get($this->table)->row();

        return $query->id_states;
    }
}