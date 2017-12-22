<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $res;
    }
    
    public static function getProvinciaDDL($regioneCodice = null){
        if ($regioneCodice){
            
        } else {
            $res = DB::table('istats')
                    ->select('t_codice_provincia','t_denominazione_provincia')
                    ->distinct('t_denominazione_provincia')
                    ->pluck('t_denominazione_provincia', 't_codice_provincia');
        }
        return $res;
    }
    
    public static function getComuneDDL($provinciaCodice = null){
        if ($provinciaCodice){
            
        } else {
            $res = DB::table('istats')
                    ->select('t_codice_alfanumerico_comune','t_denominazione_comune')
                    ->distinct('t_codice_alfanumerico_comune')
                    ->pluck('t_denominazione_comune', 't_codice_alfanumerico_comune');
        }
        return $res;
    }
}
