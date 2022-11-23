<?php

class TextFile
{
    protected $date = [];

    public function __construct($dir)  //read file
    {
        $res = fopen($dir, 'r');
        $count = 0;
        while (!feof($res)) {
            $this->date[$count] = fgets($res);
            $count++;
        }
        fclose($res);
    }
}
