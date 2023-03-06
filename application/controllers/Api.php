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
            'data' => $wisata,
            'rekomendasi' => ''
        ]);
    }

    public function ambilSemuaWisataBerdasarkanRating()
    {
        $wisata = $this->wisata_model->wisata_berdasarkan_rating()->result();
        echo json_encode([
            'data' => $wisata,
            'rekomendasi' => ''
        ]);
    }

    public function ambilWisata( $id = NULL )
    {
        if( !$id ) {
            echo json_encode([
                'data' => [],
                'rekomendasi' => ''
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata( $id )->row();
        if( !$wisata ) {
            echo json_encode([
                'data' => [],
                'rekomendasi' => ''
            ]);
            return;
        }
        echo json_encode([
            'data' => [$wisata],
            'rekomendasi' => ''
        ]);
    }

    public function ambilWisataBerdasarkanKategori( $kategori_id = NULL )
    {
        if( !$kategori_id ) {
            echo json_encode([
                'data' => [],
                'rekomendasi' => ''
            ]);
            return;
        }

        $wisata = $this->wisata_model->wisata_berdasarkan_kategori( $kategori_id )->result();
        if( !$wisata ) {
            echo json_encode([
                'data' => [],
                'rekomendasi' => ''
            ]);
            return;
        }
        echo json_encode([
            'data' => $wisata,
            'rekomendasi' => ''
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

        // rekomendasi
        $hasil_rekomendasi = '';
        $nilai_rekomendasi = 0;

        if( $len_keyword == 0 ) {
            echo json_encode([
                'data' => []
            ]);
            return;
        }
        if( $len_keyword == 1 ) $k = 1;
        if( $len_keyword > 1 ) {
            $k = $ell = 1;
            if( $arr_keyword[0] != $arr_keyword[1] ) $ell = 2;
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
            $keterangan = strtolower($data->keterangan);
            
            $result_jaro_winkler = $this->jaro_winkler( $keyword, $nama );
            if( $result_jaro_winkler > $nilai_rekomendasi ) {
                $hasil_rekomendasi = $nama;
                $nilai_rekomendasi = $result_jaro_winkler;
            }

            $arr_nama = str_split( $nama );
            $len_nama = count( $arr_nama );
            
            // if( $len_keyword > $len_nama ) continue;
            
            // $s = 0;
            // while( $s < $len_nama-2 ) {
            //     if( ($len_nama-$s) < $len_keyword ) {
            //         break;
            //     }
            //     if( $arr_keyword[0] == $arr_nama[$s] && $arr_keyword[1] == $arr_nama[$s+1] ) {
            //         $find = true;
            //         for ($j=0; $j < $len_keyword; $j++) { 
            //             if( $arr_keyword[$j] != $arr_nama[$s+$j] ) {
            //                 $find = false;
            //                 break;
            //             }
            //         }
            //         if( $find ) {
            //             $wisata[] = $data;
            //             break;
            //         }
            //         $s += $ell;
            //     }
            //     if( $len_nama-2 <= $s ) break;
            //     if( $arr_keyword[0] == $arr_nama[$s] && $arr_keyword[1] != $arr_nama[$s+1] ) {
            //         $s += $ell;
            //     }
            //     if( $len_nama-2 <= $s ) break;
            //     if( $arr_keyword[0] != $arr_nama[$s] && $arr_keyword[1] != $arr_nama[$s+1] ) {
            //         $s += $k;
            //     } else {
            //         $s += $k;
            //     }
            // }
            $result = $this->_notsonaive( $k, $ell, $keyword, $keterangan );
            if( !$result ) $result = $this->_notsonaive( $k, $ell, $keyword, $keterangan );
            
            if( $result ) $wisata[] = $data;
                
        }
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start); // dalam miliseconds

        $rekomendasi = '';
        if( !count( $wisata ) ) $rekomendasi = $hasil_rekomendasi;
        
        echo json_encode((object) [
            'execution_time' => $execution_time,
            'data' => $wisata,
            'keyword' => $keyword,
            'rekomendasi' => $rekomendasi,
        ]);
    }

    public function _notsonaive( $k, $ell, $keyword = NULL, $data = NULL )
    {
        if( !$keyword || !$data ) return FALSE;
        
        $arr_data = str_split( $data );
        $len_data = count( $arr_data );
        $arr_keyword = str_split($keyword);
        $len_keyword = count($arr_keyword);

        $s = 0;
        while( $s < $len_data-2 ) {
            if( ($len_data-$s) < $len_keyword ) break;
            
            if( $arr_keyword[0] == $arr_data[$s] && $arr_keyword[1] == $arr_data[$s+1] ) {
                $find = true;
                for ($j=0; $j < $len_keyword; $j++) { 
                    if( $arr_keyword[$j] != $arr_data[$s+$j] ) {
                        $find = false;
                        break;
                    }
                }
                if( $find ) return TRUE;
                $s += $ell;
            }
            
            if( $len_data-2 <= $s ) break;
            if( $arr_keyword[0] == $arr_data[$s] && $arr_keyword[1] != $arr_data[$s+1] ) $s += $ell;
            if( $len_data-2 <= $s ) break;

            if( $arr_keyword[0] != $arr_data[$s] && $arr_keyword[1] != $arr_data[$s+1] ) {
                $s += $k;
            } else {
                $s += $k;
            }
        }
        return FALSE;
    }

    public function jaro( $search = NULL, $value = NULL )
    {
        $len_search = strlen( $search );
        $len_value = strlen( $value );

        $distance = (int) floor ((max($len_search, $len_value))/2)-1;
        $commons_search = $this->common_characters( $search, $value, $distance );
        $commons_value = $this->common_characters( $search, $value, $distance );
	
        if( ($commons_search_len = strlen( $commons_search )) == 0) return 0;
        if( ($commons_value_len = strlen( $commons_value )) == 0) return 0;

        // calculate transpositions
        $transpositions = 0;
        $upper_bound = min( $commons_search_len, $commons_value_len );

        for( $i = 0; $i < $upper_bound; $i++ ) {
            if( $commons_search[$i] != $commons_value[$i] ) $transpositions++;
        }
        $transpositions /= 2.0;

        return ( ($upper_bound/($len_search) + $upper_bound/($len_value) + ($upper_bound - $transpositions)/($commons_search_len)) / 3.0 );
    }

    public function common_characters( $search, $value, $distance )
    {
        $len_search = strlen( $search );
        $len_value = strlen( $value );
        $common_characters = '';
        $matching = 0;

        for ($i = 0; $i < $len_search; $i++) { 
            $no_match = true;
            for ($j = 0; $no_match && $j < $len_value; $j++) { 
                if( ($value[$j] == $search[$i]) && (abs($j-$i) <= $distance) ) {
                    $no_match = false;
                    $matching++;
                    $common_characters .= $search[$i];
                }
            }
        }
        return $common_characters;
    }

    public function prefix_length( $search, $value, $MINPREFIXLENGTH = 4 )
    {
        $n = min( array( $MINPREFIXLENGTH, strlen($search), strlen($value) ) );
        for ($i = 0; $i < $n; $i++) { 
            if( $search[$i] != $value[$i] ) return $i;
        }
        return $n;
    }

    public function jaro_winkler( $search = NULL, $value = NULL )
    {
        if( !$search || !$value ) return 0;
        
        $PREFIXSCALE = 0.1;
        $jaro_distance = $this->jaro( $search, $value );
        $prefix_length = $this->prefix_length( $search, $value );
        $score = round( ($jaro_distance + ($prefix_length * $PREFIXSCALE * (1.0 - $jaro_distance))) * 100, 2);
        
        return $score;
    }
}
