<?php

namespace App\Views;

abstract class View {

    protected static string $filename;
    private array $data;
    public static string $charset;
    public static string $favicon;
    public static string $title;

    public function __construct(array $data){
        $this->data = $data;
    }

    // Getters & Setters

    public function getFilename():string {
        return static::$filename;
    }
    public function getData():array {
        return $this->data;
    }
    public function setData(array $data):void {
        $this->data = $data;
    }

    // Methods

    public function getContent():string|false {
        return file_get_contents($this->getFilename());
    }

    public function getHtml():string {
        return str_replace(array_map(fn($s)=>"{{".$s."}}", array_keys($this->getData())), array_values($this->getData()), $this->getContent());
    }

    public function display():void {
        echo $this->getHtml();
    }
}

?>