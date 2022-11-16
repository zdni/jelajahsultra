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
        $this->data['keyword'] = $this->input->get('keyword') ? $this->input->get('keyword') : '';
        $this->data['kategori_id'] = $this->input->get('kategori_id') ? $this->input->get('kategori_id') : [];
        $this->data['execution_time'] = 0;
        

        $this->data['kategori'] = $this->kategori_model->kategori()->result();
        if( $this->data['keyword'] == '' ) {
            $this->data['datas'] = $this->wisata_model->wisata()->result();
        } else {
            $datas = $this->cari( $this->data['kategori_id'], $this->data['keyword'] );
            $this->data['datas'] = $datas['results'];
            $this->data['execution_time'] = $datas['execution_time'];
        }

        $this->render('client/daftar-wisata', $this->template);
    }

    public function detail( $wisata_id = NULL )
    {
        if( !$wisata_id ) return redirect( base_url('dashboard/wisata') );
        
        $this->data['data'] = $this->wisata_model->wisata( $wisata_id )->row();

        $this->render('client/detail-wisata', $this->template);
    }

    public function cari( $kategori_id, $keyword )
    {
        $results = [];
        $execution_time = 0;
        if( count($kategori_id) > 0 ) {
            foreach ($kategori_id as $kategori) {
                $datas = $this->wisata_model->wisata_berdasarkan_kategori( $kategori )->result();
                $results = array_merge( $results, $this->notsonaive( $datas, $keyword )['datas'] );
                $execution_time += $this->notsonaive( $datas, $keyword )['execution_time'];
            }
        } else {
            $datas = $this->wisata_model->wisata()->result();
            $results = $this->notsonaive( $datas, $keyword )['datas'];
            $execution_time += $this->notsonaive( $datas, $keyword )['execution_time'];
        }
        
        return [
            'results' => $results,
            'execution_time' => $execution_time,
        ];
    }
    
    public function notsonaive( $datas, $keyword ) 
    {
        $arr_keyword = str_split($keyword);
        $len_keyword = count($arr_keyword);
        $k = 0;

        if( $len_keyword == 0 ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }
        if( $len_keyword == 1 ) {
            // $k = 1;
            return [
                'datas' => [],
                'execution_time' => 0
            ];
        }
        if( $len_keyword > 1 ) {
            $k = 1;
            if( $arr_keyword[0] != $arr_keyword[1] ) {
                $ell = 2;
            } else {
                $ell = 1;
            }
        }

        if( $k == 0 ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = [];

        $time_start = microtime(true); 
        foreach ($datas as $data) {
            $nama = strtolower($data->nama);
            $arr_nama = str_split( $nama );
            $len_nama = count( $arr_nama );
            
            if( $len_keyword > $len_nama ) {
                continue;
            }
            
            $s = 0;
            while( $s < $len_nama ) {
                if( ($len_nama-$s) < $len_keyword ) {
                    break;
                }
    
                if( $arr_keyword[0] == $arr_nama[$s] && $arr_keyword[1] == $arr_nama[$s+1] ) {
                    $find = true;
                    for ($j=0; $j < $len_keyword; $j++) { 
                        if( $arr_keyword[$j] != $arr_nama[$s+$j] ) {
                            $find = false;
                            break;
                        }
                    }
                    if( $find ) {
                        $wisata[] = $data;
                        break;
                    }
                    $s += $ell;
                }
                if( $arr_keyword[0] == $arr_nama[$s] && $arr_keyword[1] != $arr_nama[$s+1] ) {
                    $s += $ell;
                }
                if( $arr_keyword[0] != $arr_nama[$s] && $arr_keyword[1] != $arr_nama[$s+1] ) {
                    $s += $k;
                } else {
                    $s += $k;
                }
            }
        }
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start); // dalam miliseconds

        return [
            'datas' => $wisata,
            'execution_time' => $execution_time
        ];
    }

}
