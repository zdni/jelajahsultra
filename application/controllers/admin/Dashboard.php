<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends User_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model([
            'kategori_model',
            'users_model',
            'wisata_model',
        ]);
        $this->db->query(
            'SET SESSION sql_mode =
            REPLACE(REPLACE(REPLACE(
            @@sql_mode,
            "ONLY_FULL_GROUP_BY,", ""),
            ",ONLY_FULL_GROUP_BY", ""),
            "ONLY_FULL_GROUP_BY", "")'
        );
	}

	public function index()
    {
        $this->data['wisata'] = count( $this->wisata_model->wisata()->result() );
        $this->data['kategori'] = count( $this->kategori_model->kategori()->result() );
        $this->data['users'] = count( $this->users_model->users()->result() );
        
        $this->data['page'] = 'Beranda';
        $this->render('admin/dashboard');
    }
}
