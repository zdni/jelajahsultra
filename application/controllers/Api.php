<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model([
            'wisata_model',
            'kategori_model',
        ]);
	}

    public function ambilSemuaKategori()
    {
        $kategori = $this->kategori_model->kategori()->result();
        echo json_encode([
            'data' => $kategori
        ]);
    }

    public function ambilKategori( $id = NULL )
    {
        if( !$id ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $kategori = $this->kategori_model->kategori( $id )->row();
        if( !$kategori ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }
        echo json_encode([
            'data' => [$kategori]
        ]);
    }

    public function ambilSemuaWisata()
    {
        $wisata = $this->wisata_model->wisata()->result();
        echo json_encode([
            'data' => $wisata
        ]);
    }

    public function ambilSemuaWisataBerdasarkanRating()
    {
        $wisata = $this->wisata_model->wisata_berdasarkan_rating()->result();
        echo json_encode([
            'data' => $wisata
        ]);
    }

    public function ambilWisata( $id = NULL )
    {
        if( !$id ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata( $id )->row();
        if( !$wisata ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }
        echo json_encode([
            'data' => [$wisata]
        ]);
    }

    public function ambilWisataBerdasarkanKategori( $kategori_id = NULL )
    {
        if( !$kategori_id ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata_berdasarkan_kategori( $kategori_id )->result();
        if( !$wisata ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }
        echo json_encode([
            'data' => $wisata
        ]);
    }

    public function likeWisata( $wisata_id = NULL ) 
    {
        if( !$wisata_id ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata( $wisata_id )->row();
        if( !$wisata ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $result = $this->wisata_model->ubah( $wisata_id, ['rating' => ($wisata->rating + 1)] );
        if( !$result ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata( $wisata_id )->row();
        echo json_encode([
            'data' => $wisata
        ]);
        return;
    }

    public function dislikeWisata( $wisata_id = NULL ) 
    {
        if( !$wisata_id ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata( $wisata_id )->row();
        if( !$wisata ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        if( $wisata->rating <= 0 ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $result = $this->wisata_model->ubah( $wisata_id, ['rating' => ($wisata->rating - 1)] );
        if( !$result ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata( $wisata_id )->row();
        echo json_encode([
            'data' => $wisata
        ]);
        return;
    }

    public function notsonaive()
    {
        $kategori_id = $this->input->get('kategori');
        $keyword = strtolower($this->input->get('keyword'));
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
            $k = 1;
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

        $datas = $this->wisata_model->wisata_berdasarkan_kategori( $kategori_id )->result();
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
            while( $s < $len_nama-2 ) {
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
                if( $len_nama-2 <= $s ) break;
                if( $arr_keyword[0] == $arr_nama[$s] && $arr_keyword[1] != $arr_nama[$s+1] ) {
                    $s += $ell;
                }
                if( $len_nama-2 <= $s ) break;
                if( $arr_keyword[0] != $arr_nama[$s] && $arr_keyword[1] != $arr_nama[$s+1] ) {
                    $s += $k;
                } else {
                    $s += $k;
                }
            }
        }
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start); // dalam miliseconds
        
        echo json_encode((object) [
            'execution_time' => $execution_time,
            'data' => $wisata,
            'keyword' => $keyword,
        ]);
    }

}
