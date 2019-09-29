<?php

namespace App\Http\Controllers;

class CurrenciesController extends Controller
{
    public $ListCurrencies = [];

    public function Translit( $data = NULL )
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $lat, $data);
    }

    public function ConsoleInfo()
    {
        echo 'All currency information has been updated!' . "\r\n";

        foreach( $this->ListCurrencies as $key => $value )
        {
            echo $value->alphabetic_code . ' - ' . $value->rate . "\r\n";
        }
    }
    
    public function Get_all_currencies()
    {
        return view('all_currencies', [ 'ListCurrencies' => $this->ListCurrencies ]);
    }

    public function Get_currency($id)
    {
        echo $this->ListCurrencies[$id]->rate;
    }

    public function __construct()
    {
        $xml = simplexml_load_file( 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date("d/m/Y") );

        foreach( $xml->Valute as $key => $value )
        {
            $this->ListCurrencies[(string)$value->attributes()->ID] = (object)[
                'id'                => (string)$value->attributes()->ID,
                'name'              => (string)$value->Name,
                'english_name'      => (string)$this->Translit($value->Name),
                'alphabetic_code'   => (string)$value->CharCode,
                'digit_code'        => (string)$value->NumCode,
                'rate'              => floatval( str_replace(',', '.', $value->Value) )
            ];
        }
    }
}
