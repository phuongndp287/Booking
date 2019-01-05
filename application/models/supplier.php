<?php

class Supplier extends CI_Model
{

    /**
     * SupplerModel constructor.
     */

    function getAll()
    {
        $this->db->select();

    }

    function getAllSuppler()
    {
        $query = $this->db->query();
    }

    //insert data
    function insert_infomation($sup_id, $sup_name, $sup_fullname, $dup_type, $active, $sup_profile_id)
    {
        //dang loi
        $query = $this->db->query("INSERT INTO supplier_mst(sup_id,sup_name,sup_fullname,sup_type,active,sup_profile_id) 
                    VALUES('$sup_id','$sup_name','$sup_fullname','$dup_type','$active','$sup_profile_id')");
    }

    function show_all_suppliers($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->from('supplier_mst');
        $this->db->select("*");
        $query = $this->db->get();
        return $query->result();
    }

    function check_all_id($id)
    {
//        $data = null;
//        $query = $this->db->query("SELECT sup_id FROM supplier_mst WHERE `sup_id`='$id'");
//        $data = $query->result();
//        echo "dung123...". $data;

        $this->db->select("sup_id");
        $this->db->from('supplier_mst');
        $this->db->where('sup_id', $id);
        $query = $this->db->get();
        $data= $query->result();

        if ($data!=null){
//            echo "co id nay..";
            return true;
        }else{
//            echo "khong co id nay ...";
            return false;
        }
    }

    public function total_suppliers()
    {
        $this->db->select('*');
        $this->db->from('supplier_mst');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function show_suppliers( $id)
    {
//        $this->db->limit($limit, $start);
        $this->db->select("*");
        $this->db->from('supplier_mst');
        $this->db->where('sup_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    //phuong thuc xoa

    function delete_supplier($id)
    {
        $this->db->where('sup_id', $id);
        $this->db->delete('supplier_mst');
    }
}