<?php
class Admin extends CI_Controller{
 
 function __construct(){
     parent::__construct();
 
     if($this->session->userdata('status') != "login"){
         redirect(base_url("auth"));
     }
 }

 function index(){
     $this->template->load('dashboard');
 }
}