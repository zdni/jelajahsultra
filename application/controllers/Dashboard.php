<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model([
            'wisata_model',
            'kategori_model',
        ]);
        $this->data['menu_id'] = 'dashboard_index';
        $this->template = 'client';
	}

	public function index()
    {
        // return redirect( base_url('auth/login') );
        $this->data['index'] = true;
        
        $kategori = $this->kategori_model->kategori()->result();
        $this->data['datas'] = $this->wisata_model->wisata_limit( 5 )->result();
        $this->data['kategori'] = $kategori;

        $datas = [];
        foreach ($kategori as $value) {
            $datas[$value->id] = $this->wisata_model->wisata_berdasarkan_kategori( $value->id )->result();
        }
        $this->data['destinasi'] = $datas;
        $this->render('client/index', $this->template);
    }

    public function wisata()
    {
        $this->data['datas'] = $this->wisata_model->wisata()->result();
        $this->data['kategori'] = $this->kategori_model->kategori()->result();

        $this->render('client/daftar-wisata', $this->template);
    }

    public function detail( $wisata_id = NULL )
    {
        if( !$wisata_id ) return redirect( base_url('dashboard/wisata') );
        
        $this->data['data'] = $this->wisata_model->wisata( $wisata_id )->row();

        $this->render('client/detail-wisata', $this->template);
    }

    public function notsonaive()
    {
        $kategori_id = $this->input->get('kategori');
        $keyword = $this->input->get('keyword');

        $datas = $this->wisata_model->wisata_berdasarkan_kategori( $kategori_id )->result();
    }

}
