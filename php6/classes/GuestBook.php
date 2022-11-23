<?php

class GuestBook {

    protected $date=[];
    protected $dir;
    public function __construct($dir)
    {
        $res = fopen($dir, 'r');
        $count = 0;
        while (!feof($res)) {
            $this->date[$count] = fgets($res);
            $count++;
        }
        $this->dir = $dir;
        fclose($res);
    }

    public function getData(): array
    {
        return ($this->date);
    }

    public function append($text)
    {
        $this->date [$i = count($this->date)] = $text . PHP_EOL;

    }

    public function save()
    {
        file_put_contents($this->dir, $this->date);
    }
}