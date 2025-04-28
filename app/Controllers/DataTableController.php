<?php


namespace App\Controllers;

use App\Controllers\BaseController;

class DataTableController extends BaseController{

    protected $adminModel;

    public function __construct(){
        $this->adminModel=$this->loadModel('Admin');
    }
}





?> 