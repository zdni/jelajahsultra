<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerryRavindran
{
	
	function __construct() {
	}

    public function search( $keyword, $filter, $datas )
    {
        $time_start = microtime(true); 
        $results = [];
        
        // pre processing
        $keyword = strtolower( $keyword );
        $key_length = strlen($keyword);
        $key_array = str_split($keyword);
        $key_array_sort = $key_array;
        sort($key_array_sort);
        $key_array_sort[] = '*';
        $key_array_sort[] = '*';
        
        $tabel_BRbc_shift = [];

        foreach ($key_array_sort as $key) {
            $tabel_BRbc_shift[$key] = [];
            foreach ($key_array_sort as $key_) {
                $tabel_BRbc_shift[$key][$key_] = $key_length+2;
            }
        }
        foreach ($tabel_BRbc_shift as $key => $value) {
            $tabel_BRbc_shift[$key][$key_array[0]] = $key_length+1;
        }
        for ($i=0; $i < $key_length; $i++) { 
            if( $i == ($key_length-1)) {
                $tabel_BRbc_shift[$key_array[$i]]['*'] = $key_length-($i);
            } else {
                $tabel_BRbc_shift[$key_array[$i]][$key_array[$i+1]] = $key_length-($i);
            }
        }
        foreach ($tabel_BRbc_shift as $key => $value) {
            $tabel_BRbc_shift[$key_array[$key_length-1]][$key] = 1;
        }

        // fase pencarian
        foreach ($datas as $data) {
            $kata = $data->$filter;
            
            $kata = strtolower( $kata );
            $kata_array = str_split($kata);
            $kata_length = strlen($kata);
    
            $end = $key_length;
            $start = 0;
            while( $end <= $kata_length ) {
                if( substr( $kata, $start, $end ) == $keyword ) {
                    $results[] = $data;
                    break;
                } else {
                    if( $end+$start >= $kata_length || $end+$start+1 >= $kata_length ) break;
    
                    $a = in_array( $kata_array[$end+$start], $key_array ) ? $kata_array[$end+$start] : '*';
                    $b = in_array( $kata_array[$end+$start+1], $key_array ) ? $kata_array[$end+$start+1] : '*';
                    $start = $start + $tabel_BRbc_shift[$a][$b];
                }
            }
        }
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start); // dalam miliseconds
        return [$results, $execution_time];
    }
}
