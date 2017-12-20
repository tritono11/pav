<?php

/**
 * Trasfornma array in un oggetto
 * @param $array , da trasformare
 * @return object, oggetto rappresentate l'array passato
 */
function _arrayToObject($array) {
    return (object) $array;
}

/**
 * Trasforma un oggetto in array
 * @param $object , oggetto da trasformare
 * @return array, array rappresentate l'oggetto passato
 */
function _objectToArray($object) {
    return (array) $object;
}

/**
 * Questa funzione restituisce il valore passato o nel caso venga impostata l'opzione mandatory
 * restituisce un valore di default nel caso la variabile $var sia vuota.
 * @param $var , parametro da visualizzare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usati i seguenti valori:
 *  mandatory => true
 *  default => trans('generic.nodata')
 * @return string
 */
function getField($var, $opz = []) {
    $defaultOpz = [
        'mandatory' => true,
        'default' => trans('generic.nodata'),
    ];
    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    if ($var && !starts_with($var, '0000-00-00')) {
        if (validateDate($var))
            return getReadableDate($var);
        else {
            return $var;
        }
    } else {
        if ($opz->mandatory) {
            return $opz->default;
        } else {
            if (starts_with($var, '0000-00-00'))
                return '';
            else {
                return $var;
            }
        }
    }
}

function getFieldPDF($var, $opz = []) {
    $defaultOpz = [
        'mandatory' => true,
        'default' => trans('generic.nodata'),
    ];
    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    if ($var && !starts_with($var, '0000-00-00')) {
        if (validateDate($var))
            return getReadableDate($var);
        else {
            return $var;
        }
    } else {
        if ($opz->mandatory) {
            return "NON COMPILATO";
        } else {
            if (starts_with($var, '0000-00-00'))
                return '';
            else {
                return $var;
            }
        }
    }
}

/**
 * Questa funzione restituisce il valore passato formattato secondo le opzioni indicate.
 * @param $var , parametro da visualizzare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  symbol => &euro; solo per sistemi windows
 *  precision => 2
 * @return string
 */
function getMoney($var, $opz = []) {
    if ($var == '') {
        return '€ 0,00';
    }

    $defaultOpz = [
        'symbol' => '&euro;',
        'precision' => 2,
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    //NB: La funzione money_format non è usabile sotto ambienti microsoft
    if (_isWindows())
        return $opz->symbol . " " . number_format($var, $opz->precision);
    return money_format("%." . $opz->precision . "n", $var);
}

function getMoneyPDF($var, $opz = []) {
    if ($var == '') {
        return '0,00';
    }

    $defaultOpz = [
        'symbol' => '',
        'precision' => 2,
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    //NB: La funzione money_format non è usabile sotto ambienti microsoft
    if (_isWindows())
        return $opz->symbol . " " . number_format($var, $opz->precision);
    return money_format("%." . $opz->precision . "n", $var);
}

function getNumber($var, $opz = []) {
    if ($var == '') {
        $var =0;
    }
        $defaultOpz = [
        'symbol' => '',
        'precision' => 2,
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    //NB: La funzione money_format non è usabile sotto ambienti microsoft
    if (_isWindows())
        return $opz->symbol . " " . number_format($var, $opz->precision);
    return number_format($var, $opz->precision) . $opz->symbol;

//    return number_format("%." . $opz->precision . "n", $var);
}

/**
 * Questa funzione restituisce il valore passato formattato secondo le opzioni indicate.
 * @param $var , parametro da visualizzare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  symbol => &euro;
 *  precision => 2
 * @return string
 */
function getPercent($var, $opz = []) {
    $defaultOpz = [
        'symbol' => '%',
        'precision' => 2,
    ];
    $opz = _arrayToObject(array_merge($defaultOpz, $opz));
    return number_format($var, $opz->precision) . $opz->symbol;
}

function getHours($var, $opz = []) {

    return floor($var);
}

function getMinutes($var, $opz = []) {

    return round(60 * ($var - getHours($var)));
}

/**
 * Verifica se il sistema su cui sta girando php è windows o altro
 * @return bool
 */
function _isWindows() {
    if (substr(strtoupper(PHP_OS), 0, 3) == "WIN")
        return true;
    return false;
}

/**
 * Questa funzione restituisce il valore passato formattato secondo le opzioni indicate.
 * @param $date, parametro da formattare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  format => Y-m-d
 *  format_out => d/m/Y
 * @return string
 */
function getReadableDate($date, $opz = []) {
    if ($date === null || $date == '')
        return '';

    $defaultOpz = [
        'format' => 'Y-m-d',
        'format_out' => 'd/m/Y',
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    if ($date instanceof Carbon\Carbon)
        $d = $date;
    else
    if ($date == '0000-00-00')
        return trans('generic.nodata');
    $d = DateTime::createFromFormat($opz->format, $date);
    if ($d) {
        return $d->format($opz->format_out);
    }
}

function getReadableDateTimeHM($date) {
    $opz = [
        'format_out' => 'd/m/Y H:i',
    ];
    return getReadableDateTime($date, $opz);
}

function getReadableDateTime($date, $opz = []) {
    if ($date === null || $date == '')
        return '';

    $defaultOpz = [
        'format' => 'Y-m-d H:i:s',
        'format_out' => 'd/m/Y',
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    if ($date instanceof Carbon\Carbon)
        $d = $date;
    else
    if ($date == '0000-00-00 00:00:00')
        return trans('generic.nodata');
    $d = DateTime::createFromFormat($opz->format, $date);
    if ($d) {
        return $d->format($opz->format_out);
    }
}

/**
 * Questa funzione cerca fra i parametri di input passati al controller per verificare che ci siano date da trattare
 * Per il salvataggio delle date su database
 * @param $date, parametro da formattare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  format_out => Y-m-d
 *  format => d/m/Y
 * @return string
 */
function checkforDatestoSave($k, $v) {
    if (starts_with($k, "d_")) {
        if ($v != '')
            return setSaveDate($v);
        else
            return null;
    } else
        return $v;
}

/**
 * La funzione verifica se il campo è di tipo date ( d_ ) quindi converte la data
 * da formato mysql a formato data italiano.
 * @return string
 */
function checkforDatestoRead($k, $v) {
    if (starts_with($k, "d_")) {
        if ($v != '')
            return getReadableDate($v);
        else
            return null;
    } else
        return $v;
}

/**
 * Questa funzione restituisce il valore passato formattato secondo le opzioni indicate.
 * Per il salvataggio delle date su database
 * @param $date, parametro da formattare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  format_out => Y-m-d
 *  format => d/m/Y
 * @return string
 */
function setSaveDate($date, $opz = []) {
    $defaultOpz = [
        'format_out' => 'Y-m-d',
        'format' => 'd/m/Y',
    ];
    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    $d = DateTime::createFromFormat($opz->format, $date);
    if ($d)
        return $d->format($opz->format_out);
    else
        return '';
}

/**
 * Questa funziona restituisce se la stringa passata è una data valida rispeto alla formattazione indicata
 * @param $date , stringa da validare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  format => Y-m-d (per formattazioni diverse utilizzare la documentazione di php)
 * @return bool
 */
function validateDate($date, $opz = []) {
    $defaultOpz = [
        'format' => 'Y-m-d',
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));

    $d = DateTime::createFromFormat($opz->format, $date);
    return $d && $d->format($opz->format) == $date;
}

/**
 * Questa funzione restituisce il valore passato arrotondato alle cifre indicate.
 * @param $var , parametro da arrotondare
 * @param array $opz , contiene le varie opzioni disponibili, nel caso non venga specificato verranno usai i seguenti valori:
 *  precision => 2
 * @return float
 */
function getRounded($var, $opz = []) {
    $defaultOpz = [
        'precision' => 2,
    ];

    $opz = _arrayToObject(array_merge($defaultOpz, $opz));
    return round($var, $opz->precision);
}

/**
 * Questa funzione invia un email ad un singolo utente, con possibilità di inviare uno o più allegati.
 * @param $view , contiene la vista da utilizzare per l'email
 * @param $to , contiene l'email a cui sarà inviato il messaggio
 * @param $subject , contiene l'oggetto con cui verrà inviata l'email
 * @param $data , contiene le informazioni che verranno usate dalla vista per completarsi
 * @param array $attachments , contiene l'elenco dei file da inserire come alleggato (path) [optional]
 */
function sendSingleEmail($view, $to, $subject, $data, $attachments = []) {
    $from = Config::get('mail.from');
    Mail::send($view, $data, function ($message) use ($from, $to, $subject, $attachments) {
        $message->from($from['address'], $from['name']);
        $message->to($to, $to);
        $message->subject($subject);

        foreach ($attachments as $attachment) {
            $message->attach($attachment);
        }
    });
}

/**
 * Questa funzione invia un email ad una serie di utenti in bcc, con possibilità di inviare uno o più allegati.
 * @param $view , contiene la vista da utilizzare per l'email
 * @param $tos , contiene l'elenco dell'email a cui sarà inviato il messaggio
 * @param $subject , contiene l'oggetto con cui verrà inviata l'email
 * @param $data , contiene le informazioni che verranno usate dalla vista per completarsi
 * @param array $attachments , contiene l'elenco dei file da inserire come alleggato (path), può essere omesso
 */
function sendMultipleEmail($view, $tos, $subject, $data, $attachments = []) {
    $from = Config::get('mail.from');
    Mail::send($view, $data, function ($message) use ($from, $tos, $subject, $attachments) {
        $message->from($from['address'], $from['name']);
        foreach ($tos as $to) {
            $message->bcc($to, $to);
        }

        $message->subject($subject);

        foreach ($attachments as $attachment) {
            $message->attach($attachment);
        }
    });
}

/**
 * Questa funzione verifica che l'utente loggato abbia almeno uno dei ruoli indicati.
 * @param $role , contiene il/i ruolo/i da verificare (accetta sia un array che una stringa)
 * @return bool, restituisce true se l'utente ha almeno uno dei ruoli indicati, false in tutti gli altri casi
 */
function checkRole($role) {
    if (!is_array($role)) {
        switch ($role) {
            case 'UMC':
                $role = ['UMC', 'AUMC'];
                break;
            default:
                $role = [$role];
                break;
        }
    }
    if (Auth::check() && Auth::user()->role()) {
        if (in_array(Auth::user()->role()->name, $role)) {
            return true;
        }
    }
    return false;
}

/**
 * Questa funzione verifica che l'utente loggato abbia almeno uno dei permessi indicati.
 * @param $permission , contiene il/i permesso/i da verificare (accetta sia un array che una stringa)
 * @return bool, restituisce true se l'utente ha almeno uno dei permessi indicati, false in tutti gli altri casi
 */
function checkPermission($permission) {
    if (!is_array($permission))
        $permission = [$permission];
    if (Auth::check() && Auth::user()->role()) {
        if (Auth::user()->hasPermission($permission)) {
            return true;
        }
    }
    return false;
}

/**
 * Questa funzione verifica se una determinata entita è in uno stato specifico.
 * @param $entity , rappresenta l'entità di interesse
 * @param $column , rappresenta il campo dell'entità da verificare
 * @param $value , rappresenta il valore che si deve verificare
 * @param $segmentlast , rappresenta l'url della pagina da cui ricavare idoperazione
 * @return bool, restituisce false se la condizione è verificata e quindi il submenu non deve essere visualizzato
 */
function showSubMenu($entity, $column, $value, $segmentlast) {
    $exists = true;

    if ($entity != "null" && !empty($entity)) {
        if (isValidQuerystring($segmentlast)) {
            $arrayqs = decodingQuerystring($segmentlast);
            if (isset($arrayqs['idoperazione'])) {

                $exists = \Illuminate\Support\Facades\DB::table
                                        ($entity)
                                ->where('i_operazione_id', $arrayqs['idoperazione'])
                                ->where($column, '=', $value)
                                ->count() == 1;
            }
        }
    }
    return $exists;
}

/**
 * Questa funzione verifica se l'area corrente è contenuta nell'elenco appena passato
 * @param $area , contiene la/le area/e da verificare (accetta sia un array che una string)
 * @return string, restituisce active quando positivo
 */
function isActiveArea($area) {
    if (!is_array($area))
        $area = [$area];
    return count(Request::segments()) > 0 && in_array(Request::segments()[0], $area) ? 'active' : '';
}

/**
 * Rappresenta il menù in base al sistema di provenienza
 * @return string, restituisce l'HTML del menù
 */
function getMenu() {
    $menu = '<ul class="nav navbar-nav superiore"><li class="' . isActiveArea(['home', 'login']) . '"><a href="' . url('home') . '">' . trans('navigation.home') . '</a></li>';
    if (Auth::check()) {
        $amenu = DB::table("role_menu")->where('b_active', 'Y')->orderby('i_order')->get();
        if ($amenu) {
            foreach ($amenu as $smenu) {
                $role = explode(",", $smenu->t_role);
                if (checkRole($role))
                    if ($smenu->t_area == 'pentaho')
                        $menu .= '<li class="' . isActiveArea([$smenu->t_area]) . '"><a href="' . $smenu->t_sistema . '" target="_blank">' . trans('navigation.' . str_replace('/', '_', $smenu->t_area)) . '</a></li>';
                    else {
                        $menu .= '<li class="' . isActiveArea([$smenu->t_area]) . '"><a href="' . completeURL($smenu->t_area, $smenu->t_sistema) . '">' . trans('navigation.' . $smenu->t_area) . '</a></li>';
                    }
            }
        }
    }
    $menu .= "</ul>";
    return $menu;
}

/**
 * Rappresenta il sottomenù in base al sistema di provenienza
 * @return string, restituisce l'HTML del menù
 */
function getSubMenu() {
    $menu = '';
    if (Auth::check()) {
        $segment = Request::segment(1);
        $amenu = DB::table("role_submenu")->where('t_area_master', $segment)->where('b_active', 'Y')->orderby('i_order')->get();
        if ($amenu) {
            $segments = Request::segments();
//            foreach ($segments as $isegment) {
//                $segmentlast = $isegment;
//            }

            $segmentlast = array_pop($segments);

            $menu = '<ul class="nav navbar-nav superiore">';
            if ($amenu) {
                foreach ($amenu as $smenu) {
                    $role = explode(",", $smenu->t_role);
                    if (checkRole($role)) {
                        $menu .= '<li class="' . isActiveArea([$smenu->t_area]) . '"><a href="' . completeURL($smenu->t_area, $smenu->t_sistema) . (isValidQuerystring($segmentlast) ? '/' . $segmentlast : '') . '">' . trans('navigation.' . str_replace('/', '_', $smenu->t_area)) . '</a></li>';
                    }
                }
            }
            $menu .= "</ul>";
        }
    }
    return $menu;
}

/**
 * Rappresenta il menù di pagina in base alla sottoarea di provenienza
 * @return string, restituisce l'HTML del menù
 */
function getPageMenu($sottoarea) {
    $menu = '';
    if (Auth::check()) {
        $segment = $sottoarea;
        $amenu = DB::table("role_submenu")->where('t_area_master', $segment)->where('b_active', 'Y')->orderby('i_order')->get();
        if ($amenu) {
            $segments = Request::segments();
            foreach ($segments as $isegment) {
                $segmentlast = $isegment;
            }

            $menu = '<ul class="nav navbar-nav inferiore ">';
            if ($amenu) {
                foreach ($amenu as $smenu) {
                    $role = explode(",", $smenu->t_role);
                    if (checkRole($role) && showSubMenu($smenu->t_entita, $smenu->t_entita_colonna, $smenu->t_entita_colonna_valore, $segmentlast)) {

                        $menu .= '<li class="' . isActiveArea([$smenu->t_area]) . '"><a href="' . completeURL($smenu->t_area, $smenu->t_sistema) . (isValidQuerystring($segmentlast) ? '/' . $segmentlast : '') . '">' . trans('navigation.' . str_replace('/', '_', $smenu->t_area)) . '</a></li>';
                    }
                }
            }
            $menu .= "</ul>";
        }
    }
    return $menu;
}

/**
 * Restituisce l'url di single sign on
 * @param $area , URL destinazione
 * @param $sistemadest , sistema di destinazione
 * @return string, url completo
 */
function completeURL($area, $sistemadest = '') {
    $sistema = Config::get('app.sistema');
    if ($sistemadest == '') {
        if (Cache::has('areatable')) {
            $areatable = Cache::get('areatable');
        } else {
            $areatable = DB::table('area')->get();
            Cache::put('areatable', $areatable, 30);
        }

        foreach ($areatable as $arearow) {
            if ($arearow->t_area == $area) {
                $sistemadest = $arearow->t_sistema;
            } else {
                $sistemadest = $sistema;
            }
        }
    }

    if ($sistema != $sistemadest)
        return (getProtocol() . $sistemadest . '/sso_login/' . Session::get('TOKEN') . '?to=' . $area);
    else
        return (url($area));
}

/**
 * Encoding querystring
 * @param $params , array di parametri per il querystring URL, i parametri per il corretto funzionamento delle breadcrumb devono essere id[nomeentità al singolare]
 * @return string, encoding del querystring
 */
function encodingQuerystring($params) {
    if (!is_array($params))
        $params = [$params];
    if (Config::get('app.encrypt'))
        return base64_encode(http_build_query($params));
    else
        $output = http_build_query($params);
    return $output;
}

/**
 * Decoding querystring in array
 * @return array, , array di parametri per il querystring URL
 */
function decodingQuerystring($qs) {
    if (Config::get('app.encrypt'))
        parse_str(base64_decode($qs), $params);
    else
        parse_str($qs, $params);

    if (count($params) > 0 && reset($params) != '')
        return $params;
    return null;
}

/**
 * Verifica se l'informazione passata è un querystring valido
 * @return bool
 */
function isValidQuerystring($qs) {
    if (decodingQuerystring($qs) === null)
        return false;
    return true;
}

/**
 * Restituzione oggetti filtrati (DB::table, Model)
 * @param $obj , oggetto eloquent da filtrare
 * @param $filter , array filtri
 * @param $opz , opzioni del dataset (ordinamento / limiti)
 * @return oggetto filtrato ordinato e con limiti inseriti
 */
function getByFilter($obj, $filter = [], $opz = []) {
    foreach ($filter as $k => $v) {
        if (is_numeric($v))
            $obj = $obj->where($k, $v);
        elseif (is_array($v))
            $obj = $obj->where($k, key($v), $v[key($v)]);
        else
            $obj = $obj->where($k, 'LIKE', "%$v%");
    }
    if (array_key_exists('order', $opz)) {
        foreach ($opz['order'] as $k => $v) {
            $obj = $obj->orderBy($k, $v);
        }
    }
    if (array_key_exists('limit', $opz)) {
        $obj = $obj->limit($opz['limit']);
    }
    if (array_key_exists('paginate', $opz)) {
        return $obj->paginate($opz['paginate']);
    } else {
        return $obj->get();
    }
}

function countByFilter($obj, $filter = [], $opz = []) {
    foreach ($filter as $k => $v) {
        if (is_numeric($v))
            $obj = $obj->where($k, $v);
        elseif (is_array($v))
            $obj = $obj->where($k, key($v), $v[key($v)]);
        else
            $obj = $obj->where($k, 'LIKE', "%$v%");
    }
    if (array_key_exists('order', $opz)) {
        foreach ($opz['order'] as $k => $v) {
            $obj = $obj->orderBy($k, $v);
        }
    }
    if (array_key_exists('limit', $opz)) {
        $obj = $obj->limit($opz['limit']);
    }
    if (array_key_exists('paginate', $opz)) {
        return $obj->paginate($opz['paginate']);
    } else {
        return $obj->count();
    }
}

/**
 * Resistuisce se il protocollo corrente è http o https
 * @return https:// o http://
 */
function getProtocol() {
    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        return $protocol = 'https://';
    else
        return $protocol = 'http://';
}

/**
 * Resistuisce se il protocollo corrente è http o https
 * @return https:// o http://
 */
function getvaluesfromObject($object) {
    if (is_object($object))
    {
    $values = array_values(get_object_vars($object));
    return $values;
    }
    else return null;

}

/**
 * Stampa in maniera formatta una coppia di chiave/valore per la visualizzazione
 * @param $key, la chiave relativa al file delle traduzioni
 * @param $value, il valore da mostrare
 * @return string, restituisce l'HTML
 */
function layoutKeyValue($key, $value, $textright = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . trans($key) . ':</div><div class="col-sm-7 col-md-7 col-lg-7' . ( $textright ? ' text-right' : ' text-left') . '">' . $value . '&nbsp;</div></div>';
}

function layoutKeyValueop($key, $value) {
    return '<div class="row"><div class="col-sm-12 col-md-12 col-lg-12"> <span class="bold">' . trans($key) . ':</span> ' . $value . '</div></div> <hr style="color: #0056b2; margin-top:0px;">';
}

function layoutKeyValueopBtn($key, $value, $href, $btntxt) {
    return '<div class="row"><div class="col-sm-12 col-md-12 col-lg-12"> <span class="bold">' . trans($key) . ': </span> ' . $value .
            '<a href=' . $href . ' class="btn btn-warning "> ' . $btntxt . '</a>' . '</div></div> <hr style="color: #0056b2; margin-top:0px;">';
}

function layoutKeyValueED($key, $value) {
    return '<span class="bold">' . trans($key) . ': </span>' . $value;
}

function ddlKeyValueED($label, $value, $key, $list, $required = 0) {
    return '<div class="bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::select($key, $list, $value, array('class' => 'form-control ' . ($required ? 'required' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div>';
}

/**
 * Decodica i campi S/N in Si/No
 * @param $value
 * @return mixed
 */
function decodeYN($value) {
    return ($value == 'Y' || $value == 'S') ? trans('generic.yes') : trans('generic.no');
}

function decodeMF($value) {
    if ($value == 'M')
        return trans('generic.male');
    elseif ($value == 'F')
        return trans('generic.female');
    else
        return trans('generic.aggregato');
}

/**
 * Stampa in maniera formattata un campo input con il relativo label
 * @param $label, la chiave relativa al file delle traduzioni
 * @param $value, il valore da mostrare
 * @param $key, campo id dell'input
 * @param int $required, se il campo deve essere mostrato come obbligatorio o no
 * @return string, restituisce l'HTML
 */
function fieldKeyValue($label, $value, $key, $required = 0, $textright = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' .
            Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' .
            Form::text($key, $value, array('class' => 'form-control ' . ($required ? 'required' : '') . ( $textright ? ' text-right' : ' text-left'),
                'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

function numberKeyValue($label, $value, $key, $limits, $required = 0, $textright = 0) {
    $classes = array_merge(array('class' => 'form-control ' . ($required ? 'required' : '') . ( $textright ? ' text-right' : ' text-left'),
        'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : ''), $limits);
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' .
            Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' .
            Form::number($key, $value, $classes) . '</div></div>';
}

function monthKeyValue($label, $value, $key, $required = 0, $textright = 0) {
    $classes = array_merge(array('class' => 'form-control ' . ($required ? 'required' : '') . ( $textright ? ' text-right' : ' text-left'),
        'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : ''), []);
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' .
            Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' .
            Form::selectMonth($key, $value, $classes) . '</div></div>';
}

function fieldKeyValuenRe($label, $value, $key, $required = 0, $textright = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' .
            Form::label($key, trans($label) . ':', array('class' => 'control-label ')) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' .
            Form::text($key, $value, array('class' => 'form-control ' . ( $textright ? ' text-right' : ' text-left'),
                'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

function fieldKeyValueED($label, $value, $key, $required = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::text($key, $value, array('class' => 'form-control ' . ($required ? 'required' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

function fieldKeyValuelg4($label, $value, $key, $required = 0) {
    return Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . Form::text($key, $value, array('class' => 'form-control ' . ($required ? 'required' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : ''));
}

/**
 * Stampa in maniera formattata un campo textarea con il relativo label
 * @param $label, la chiave relativa al file delle traduzioni
 * @param $value, il valore da mostrare
 * @param $key, campo id dell'input
 * @param int $required, se il campo deve essere mostrato come obbligatorio o no
 * @return string, restituisce l'HTML
 */
function textareaKeyValue($label, $value, $key, $required = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::textarea($key, $value, array('class' => 'form-control ' . ($required ? 'required' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

/**
 * Stampa in maniera formattata un campo input con datapicker con il relativo label
 * @param $label, la chiave relativa al file delle traduzioni
 * @param $value, il valore da mostrare
 * @param $key, campo id dell'input
 * @param int $required, se il campo deve essere mostrato come obbligatorio o no
 * @return string, restituisce l'HTML
 */
function dateKeyValue($label, $value, $key, $required = 0, $notfuture = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::text($key, $value, array('class' => 'form-control datePicker ' . ($required ? 'required ' : '') . ($notfuture ? 'notfuture' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

function dateKeyValuenRe($label, $value, $key, $required = 0, $notfuture = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ')) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::text($key, $value, array('class' => 'form-control datePicker ' . ($notfuture ? 'notfuture' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

function dateTimeKeyValue($label, $value, $key, $required = 0, $notfuture = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::text($key, $value, array('class' => 'form-control datetimePicker ' . ($required ? 'required ' : '') . ($notfuture ? 'notfuture' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

/**
 * Stampa in maniera formattata un campo select con il relativo label
 * @param $label, la chiave relativa al file delle traduzioni
 * @param $value, il valore da mostrare
 * @param $key, campo id dell'input
 * @param $list, array contenente i possibili valori a scelta
 * @param int $required, se il campo deve essere mostrato come obbligatorio o no
 * @return string, restituisce l'HTML
 */
function ddlKeyValue($label, $value, $key, $list, $required = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ' . ($required ? 'required' : ''))) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::select($key, $list, $value, array('class' => 'form-control ' . ($required ? 'required' : ''), 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

function ddlKeyValuenRe($label, $value, $key, $list, $required = 0) {
    return '<div class="row underline"><div class="col-sm-5 col-md-5 col-lg-5 bold">' . Form::label($key, trans($label) . ':', array('class' => 'control-label ')) . '</div><div class="col-sm-7 col-md-7 col-lg-7">' . Form::select($key, $list, $value, array('class' => 'form-control ', 'placeholder' => Lang::has('' . $label . '_text') ? trans('' . $label . '_text') : '')) . '</div></div>';
}

/**
 * Restituisce l'html formattato solo se il campo ha qualcosa da mostrare
 * @param $key, relativa alla traduzione da mostrare
 * @param $value, il valore da mostrare
 * @return string, restituisce l'HTML
 */
function attributeKeyValue($key, $value) {
    if ($value != '')
        return '<div class="col-sm-12 col-md-12 col-lg-12">' . layoutKeyValue($key, $value) . '</div>';
    else
        return '';
}

/**
 * Aggiunge una notifica all'elenco che verrà gestito tramite code
 * @param int $tipoNotifica , Tipo di notifica da voler inviare (Vedi le costanti nel model TipoNotifica)
 * @param int $priorità , Livello di priorità di invio delle notifiche, a numero basso corissponde una priorità bassa
 * @param $userTarget , Utente a cui verrà inviata la notifica, può essere null nel caso la notifica non è associata ad uno specifo utente del sistema
 * @param $to , Indicazione dell'informazione per l'invio della notifica (email, cellulare), nel caso venga indicato il campo $userTarget può essere omesso
 * @param $from , Indicazione dell'informazione che indicherà chi sta inviando la notifica (email, cellulare), nel caso il campo è omesso verranno usato i parametri di configurazione per il metodo di notifica scelto
 * @param $subject , Testo da usare come oggetto, può essere omesso
 * @param $body , Testo contente il messaggio da inviare
 * @return notifica appena creata
 */
function notifica($tipoNotifica = TipoNotifica::POPUP, $priorità = 1, $userTarget = null, $to = null, $from = null, $subject = null, $body, $url = null) {
    $notifica = new Notifica;
    $notifica->i_tipo_notifica_id = $tipoNotifica;
    $notifica->i_priorita = $priorità;
    $notifica->i_user_target_id = $userTarget;
    $notifica->t_to = $to;
    $notifica->t_from = $from;
    $notifica->t_subject = $subject;
    $notifica->t_body = $body;
    $notifica->t_url = $url;
    $notifica->save();
    return $notifica;
}

/**
 * Recupera e avvia lo scaricamento di un attachment
 * @param $attId, id dell'attachment
 */
function download($attId) {
    try {
        $attachment = Attachment::find($attId);
        if ($attachment) {
            $file = $attachment->t_percorso . $attachment->t_nomefile;
            $stream = fopen($file, "r");
            $headers = [
                "Content-type" => $attachment->t_content_type,
                "Content-Length" => filesize($file),
                "Content-Disposition" => 'attachment; filename="' . $attachment->t_filename . '"'
            ];

            return Response::stream(function () use ($stream) {
                        fpassthru($stream);
                    }, 200, $headers);
        }
    } catch (Exception $e) {
        //NB: Inserire gestione errore file non trovato
    }
}

/**
 * Carica su FS e crea i record specifici per le varie entità
 * @param $entity, il nome dell'entità su cui si sta effetuando il caricamento es. operazione
 * @param $idEntity, id dell'entità passata
 * @param $file, oggetto di tipo UploadFile
 * @param int $tipoDocumento, tipologia del documento
 * @param string $integrazione, se è un integrazione
 * @return Attachment|null
 */
function upload($entity, $idEntity, $file, $otherentity = null, $otherdata = null, $tipoDocumento = 1, $integrazione = 'N') {
    $upload_dir = Config::get('app.upload_dir') . "/" . (new DateTime('Europe/Rome'))->format('Ym') . "/";

    File::makeDirectory($upload_dir, 0777, true, true);

    $tokenFilename = Uuid::generate(4);
    if ($file->isValid()) {
        $originalFilename = $file->getClientOriginalName();
        $contentType = $file->getMimeType();
        $file->move($upload_dir, $tokenFilename);
        $attachment = new Attachment;
        $attachment->t_filename = $originalFilename;
        $attachment->t_content_type = $contentType;
        $attachment->t_percorso = $upload_dir;
        $attachment->t_nomefile = $tokenFilename;
        $attachment->i_tipo_documento_id = $tipoDocumento;
        $attachment->save();
        if ($otherdata && $otherentity) {
            DB::table($entity . "_attachment")->insert([
                'i_' . $entity . '_id' => $idEntity,
                $otherentity => $otherdata,
                'i_attachment_id' => $attachment->i_attachment_id,
                'user_created' => Auth::user()->id,
//            'b_integrazione' => $integrazione
            ]);
        } else {
            DB::table($entity . "_attachment")->insert([
                'i_' . $entity . '_id' => $idEntity,
                'i_attachment_id' => $attachment->i_attachment_id,
                'user_created' => Auth::user()->id,
//            'b_integrazione' => $integrazione
            ]);
        }

        return $attachment;
    } else {
        return null;
    }
}

/**
 * Decodica i campi S/N con un booleano
 * @param $var, il valore del campo S/N
 * @return bool
 */
function bool($var) {
    if ($var == 'Y')
        return true;
    else
        return false;
}

/**
 * Codifica i campi treu/false con un 'Y' | 'N'
 * @param $var, il valore del campo treu/false
 * @return bool
 */
function setBool($var) {
    if ($var)
        return 'Y';
    else
        return 'N';
}

/**
 * Wrapper per l'utilizzo delle StoredProcedure restituendo gli errori e l'esito
 * @param $sp, SP da chiamare es. "CALL SP_ESEMPIO(?)"
 * @param array $params, i parametri da passare alla StoredProcedure se necessario
 * @return object, esito
 */
function callSp($sp, $params = []) {
    $result = DB::select($sp, $params)[0];
    if ($result->{'@esito'}) {
        return _arrayToObject([
            'esito' => 1,
            'messaggi' => []
        ]);
    } else {
        return _arrayToObject([
            'esito' => 0,
            'messaggi' => explode('|', $result->{'@messaggio'})
        ]);
    }
}

/**
 * Restituisce l'icona che rappresenta il file che si vuole mostrare
 * @param $mimetypes, il content type
 * @return mixed
 */
function getIconMimetypes($mimetypes) {
    $mimetypes = str_replace('application/', '', $mimetypes);
    return Config::get("mimetypes.$mimetypes", Config::get('mimetypes.default'));
}

function sTooltip($titolo) {
    return 'title="" data-toggle="tooltip" data-trigger="hover" data-placement="right"  data-original-title="' . $titolo . '"';
}

function sInfo($titolo) {
    return '<i class="fa fa-info-circle text-primary" ' . sTooltip($titolo) . ' ></i>';
}

function sWarning($titolo) {
    return '<i class="fa fa-exclamation-triangle  text-alert" ' . sTooltip($titolo) . ' ></i>';
}

/**
 * Decodica i campi Y/N con un Si/No
 * Utilizzata in ReportExcelController
 * @param $var, il valore del campo S/N
 * @return bool
 */
function boolSN($var) {
    if ($var == 'Y')
        return 'Si';
    else
        return 'No';
}

/**
 * La funzione verifica se il campo è di tipo flag boolean ( b_ )
 * Quindi restituisce Si/No
 * da formato mysql a formato data italiano.
 * @return string
 */
function checkforBooltoRead($k, $v) {
    if (starts_with($k, "b_")) {
        if ($v != '')
            return boolSN($v);
        else
            return null;
    } else
        return $v;
}

function time_to_decimal($time) {
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0]) + ($timeArr[1] / 60);
    return $decTime;
}

function convertTime($dec) {
    $hours = floor($dec);
    $decminutes = $dec - $hours;
    $minutes = round($decminutes * 60);

    return lz($hours) . ":" . lz($minutes);
}

// lz = leading zero
function lz($num) {
    return (strlen($num) < 2) ? "0{$num}" : $num;
}


