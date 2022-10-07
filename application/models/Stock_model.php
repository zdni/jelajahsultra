<?php

class Stock_model extends CI_Model {
    private $_table = 'stock';

    public function tambah( $data = NULL )
    {
        if ( $data ) {
            $this->db->insert( $this->_table, $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    public function ubah( $id = NULL, $data = NULL )
    {
        if ( $id && $data ) {
            $this->db->where( $this->_table . '.id', $id );
            return $this->db->update( $this->_table, $data );
        }
        return false;
    }

    public function hapus( $id = NULL )
    {
        if ( $id ) {
            $this->db->where( $this->_table . '.id', $id );
            return $this->db->delete( $this->_table );
        }
        return false;
    }

    public function stock( $station_id = NULL, $fuel_id = NULL )
    {
        $this->db->select( $this->_table . '.*' );
        $this->db->select( 'fuel.nama AS nama_bahan_bakar' );
        $this->db->select( 'station.nama AS nama_spbu' );
        
        if( $station_id ) $this->db->where( $this->_table . '.station_id', $station_id);
        if( $fuel_id ) $this->db->where( $this->_table . '.fuel_id', $fuel_id);

        $this->db->join(
            'fuel',
            'fuel.id = ' . $this->_table . '.fuel_id',
            'join'
        );
        $this->db->join(
            'station',
            'station.id = ' . $this->_table . '.station_id',
            'join'
        );

        return $this->db->get( $this->_table );
    }
}

?>