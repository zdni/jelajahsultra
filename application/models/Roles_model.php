<?php

class Roles_model extends CI_Model {
    private $_table = 'roles';

    public function create( $data = NULL )
    {
        if ($data) {
            $this->db->insert( $this->_table, $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    public function update( $user_id = NULL, $data = NULL )
    {
        if ($user_id && $data) {
            $this->db->where( $this->_table . '.id', $user_id );
            return $this->db->update( $this->_table, $data );
        }
        return false;
    }

    public function delete( $id = NULL )
    {
        if ( $id ) {
            $this->db->where( $this->_table . '.id', $id );
            return $this->db->delete( $this->_table );
        }
        return false;
    }

    public function roles( $id = NULL )
    {
        $this->db->select( $this->_table . '.*' );
        if ($id) $this->db->where( $this->_table . '.id', $id );
        return $this->db->get( $this->_table );
    }
}

?>