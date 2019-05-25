<?php

class Member extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('pagination');
  }

  public function index() {
    $this->load->view('new/img_test');
  }



}
?>
