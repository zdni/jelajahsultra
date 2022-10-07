<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Admin_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model([
            'kategori_model',
        ]);
        $this->data['menu_id'] = 'kategori_index';
	}

	public function index()
    {
        $this->data['datas'] = $this->kategori_model->kategori()->result();
        $this->data['page'] = 'Kategori Wisata';
        $this->render('admin/kategori');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Kategori Wisata', 'required');

        $alert = 'error';
        $message = 'Gagal Menambah Data Kategori Wisata Baru! <br> Silahkan isi semua inputan!';
        if ( $this->form_validation->run() )
        {
            $nama = $this->input->post('nama');

            $data['nama'] = $nama;
        
            if( $this->kategori_model->tambah( $data ) )
            {
                $alert = 'success';
                $message = 'Berhasil Membuat Kategori Wisata Baru!';
            } else {
                $message = 'Gagal Membuat Kategori Wisata Baru!';
            }
        }

        $this->session->set_flashdata('alert', $alert);
        $this->session->set_flashdata('message', $message);
        return redirect( base_url('admin/kategori') );
    }

    public function ubah()
    {
        $this->form_validation->set_rules('nama', 'Nama Kategori Wisata', 'required');

        $alert = 'error';
        $message = 'Gagal Mengubah Data Kategori Wisata Baru! <br> Silahkan isi semua inputan!';
        if ( $this->form_validation->run() )
        {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');

            $data['nama'] = $nama;
        
            if( $this->kategori_model->ubah( $id, $data ) )
            {
                $alert = 'success';
                $message = 'Berhasil Mengubah Kategori Wisata!';
            } else {
                $message = 'Gagal Mengubah Kategori Wisata!';
            }
        }

        $this->session->set_flashdata('alert', $alert);
        $this->session->set_flashdata('message', $message);
        return redirect( base_url('admin/kategori') );
    }

    public function hapus()
    {
        if( !$_POST ) return redirect( base_url('admin/kategori') );

        $alert = 'error';
        $message = 'Gagal Menghapus Kategori Wisata!';

        $this->form_validation->set_rules('id', 'Id Kategori Wisata', 'required');
        if( $this->form_validation->run() )
        {
            $id = $this->input->post('id');
            if( $this->kategori_model->hapus( $id ) )
            {
                $alert = 'success';
                $message = 'Berhasil Menghapus Kategori Wisata!';
            }
        }
        
        $this->session->set_flashdata('alert', $alert);
        $this->session->set_flashdata('message', $message);
        return redirect( base_url('admin/kategori') );
    }
}
