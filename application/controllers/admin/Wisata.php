<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata extends Admin_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model([
            'wisata_model',
            'kategori_model',
        ]);
		$this->load->library('upload');
        $this->data['menu_id'] = 'wisata_index';
	}

	public function index()
    {
        $this->data['datas'] = $this->wisata_model->wisata()->result();
        $this->data['kategori'] = $this->kategori_model->kategori()->result();
        
        $this->data['page'] = 'Wisata';
        $this->render('admin/wisata/index');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama Wisata', 'required');
        $this->form_validation->set_rules('jam_operasional', 'Jam Operasional', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        $alert = 'error';
        $message = 'Gagal Menambah Data wisata Baru! <br> Silahkan isi semua inputan!';
        if ( $this->form_validation->run() )
        {
            $nama = $this->input->post('nama');
            $jam_operasional = $this->input->post('jam_operasional');
            $lokasi = $this->input->post('lokasi');
            $fasilitas = $this->input->post('fasilitas');
            $keterangan = $this->input->post('keterangan');
            $kategori_id = $this->input->post('kategori_id');

            $data['nama'] = $nama;
            $data['jam_operasional'] = $jam_operasional;
            $data['lokasi'] = $lokasi;
            $data['fasilitas'] = $fasilitas;
            $data['keterangan'] = $keterangan;
            $data['kategori_id'] = $kategori_id;
        
            if($_FILES['image']['name']){
				$uploaded_foto = $this->upload_image( 'wisata' . time() );
                $image = $uploaded_foto['file_name'];
				$data['image'] = $image;
			}

            if( $this->wisata_model->tambah( $data ) )
            {
                $alert = 'success';
                $message = 'Berhasil Membuat Wisata Baru!';
            } else {
                $message = 'Gagal Membuat Wisata Baru!';
            }
        }

        $this->session->set_flashdata('alert', $alert);
        $this->session->set_flashdata('message', $message);
        return redirect( base_url('admin/wisata') );
    }

    public function detail( $wisata_id = NULL )
    {
        if( !$wisata_id ) return redirect( base_url( 'admin/wisata' ) ); 

        $this->data['data'] = $this->wisata_model->wisata( $wisata_id )->row();
        $this->data['page'] = 'Detail Wisata';
        $this->render('admin/wisata/detail');
    }

    public function ubah()
    {
        $this->form_validation->set_rules('nama', 'Nama Wisata', 'required');
        $this->form_validation->set_rules('jam_operasional', 'Jam Operasional', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        $alert = 'error';
        $message = 'Gagal Mengubah Data Wisata Baru! <br> Silahkan isi semua inputan!';
        if ( $this->form_validation->run() )
        {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $jam_operasional = $this->input->post('jam_operasional');
            $lokasi = $this->input->post('lokasi');
            $fasilitas = $this->input->post('fasilitas');
            $keterangan = $this->input->post('keterangan');
            $kategori_id = $this->input->post('kategori_id');

            $data['nama'] = $nama;
            $data['jam_operasional'] = $jam_operasional;
            $data['lokasi'] = $lokasi;
            $data['fasilitas'] = $fasilitas;
            $data['keterangan'] = $keterangan;
            $data['kategori_id'] = $kategori_id;
        
            if($_FILES['image']['name']){
				$uploaded_foto = $this->upload_image( 'wisata' . time() );
                $image = $uploaded_foto['file_name'];
				$data['image'] = $image;
			}
        
            if( $this->wisata_model->ubah( $id, $data ) )
            {
                $alert = 'success';
                $message = 'Berhasil Mengubah Wisata!';
            } else {
                $message = 'Gagal Mengubah Wisata!';
            }
        }

        $this->session->set_flashdata('alert', $alert);
        $this->session->set_flashdata('message', $message);
        return redirect( base_url('admin/wisata') );
    }

    public function hapus()
    {
        if( !$_POST ) return redirect( base_url('admin/wisata') );

        $alert = 'error';
        $message = 'Gagal Menghapus Wisata!';

        $this->form_validation->set_rules('id', 'Id Wisata', 'required');
        if( $this->form_validation->run() )
        {
            $id = $this->input->post('id');
            if( $this->wisata_model->hapus( $id ) )
            {
                $alert = 'success';
                $message = 'Berhasil Menghapus Wisata!';
            }
        }
        
        $this->session->set_flashdata('alert', $alert);
        $this->session->set_flashdata('message', $message);
        return redirect( base_url('admin/wisata') );
    }

    public function upload_image( $title )
    {
        $config['upload_path']          = './uploads/wisata/';
		$config['overwrite']            = true;
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 2048;
		$config['file_name']			= $title;

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')) {
			$this->session->set_flashdata('alert', 'error');   
			$this->session->set_flashdata('message', $this->upload->display_errors());   
			return redirect( base_url('admin/wisata') );
		} else {
			$uploaded_data = $this->upload->data();
		}
		return $uploaded_data;
    }
}
