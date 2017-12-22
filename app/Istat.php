<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Istat extends Model
{
    public static function getStatoDDL(){
        
    }
    
    public static function getRegioneDDL($statoCodice = null){
        if ($statoCodice){
            
        } else {
            $res = DB::table('istats')
                    ->select('t_codice_regione','t_denominazione_regione')
                    ->distinct('t_codice_regione')
                    ->pluck('t_denominazione_regione', 't_codice_regione');
        }
    }
}
