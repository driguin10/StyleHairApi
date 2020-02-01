<?php

class GerarSerial
{
    public function gerar($request)
    {
        $serial = $request->getAttribute('serial');
        echo "Serial Para Ativação:  " . md5($serial);
    }

}
