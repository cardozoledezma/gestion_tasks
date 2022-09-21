<?php

namespace App\Controllers;
use App\Models\Product;


class ProductController{

    public function index(){
        $product = new Product;
        $product->getAll();
    }

    public function create(){

    }

    public function show(){

    }

    public function store(){

    }
}


?>