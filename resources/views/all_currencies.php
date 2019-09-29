<h2>Курсы валют к рублю:</h2>
<ul>
<?
    foreach( $ListCurrencies as $key => $value )
    {
        echo '<li><a href="currencies/'.$value->id.'"><b>' . $value->alphabetic_code . '</b> - ' . $value->name . ' ( '.$value->english_name.' )</a></li>' . "\r\n";
    }

?>
<ul>