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
            // TODO
        } else {
            $res = [''  => __('generic.select')] + DB::table('istats')
                    ->select('t_codice_regione','t_denominazione_regione')
                    ->distinct('t_codice_regione')
                    ->orderBy('t_denominazione_regione')
                    ->pluck('t_denominazione_regione', 't_codice_regione')->all();
        }
        return $res;
    }
    
    public static function getProvinciaDDL($regioneCodice = null){
        $res = null;
        if ($regioneCodice){
            $res = [''  => __('generic.select')] + DB::table('istats')
                    ->select('t_codice_provincia','t_denominazione_provincia')
                    ->where('t_codice_regione',$regioneCodice)
                    ->pluck('t_denominazione_provincia', 't_codice_provincia')->all();
            
        } else {
            $res = [''  => __('generic.select')] + DB::table('istats')
                    ->select('t_codice_provincia','t_denominazione_provincia')
                    ->distinct('t_denominazione_provincia')
                    ->pluck('t_denominazione_provincia', 't_codice_provincia')->all();
        }
        return $res;
    }
    
    public static function getComuneDDL($provinciaCodice = null){
        $res = null;
        if ($provinciaCodice){
            $res = [''  => __('generic.select')] + DB::table('istats')
                    ->select('t_codice_alfanumerico_comune','t_denominazione_comune')
                    ->where('t_codice_provincia', $provinciaCodice)
                    ->pluck('t_denominazione_comune', 't_codice_alfanumerico_comune')->all();
        } else {
            $res = [''  => __('generic.select')] + DB::table('istats')
                    ->select('t_codice_alfanumerico_comune','t_denominazione_comune')
                    ->distinct('t_codice_alfanumerico_comune')
                    ->pluck('t_denominazione_comune', 't_codice_alfanumerico_comune')->all();
        }
        return $res;
    }
}
