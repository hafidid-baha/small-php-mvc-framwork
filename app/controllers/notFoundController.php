<?php
namespace MVCF\CONTROLLERS;

class notFoundController extends abstractController{
    public function defaultAction(){
        $this->view();
    }
}