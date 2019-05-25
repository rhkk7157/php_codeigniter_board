<?php

class Upload extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('pagination');
  }

  // public function index() {
  //   $this->load->view('member/login');
  // }

  public function insert() {
    $this->load->view('member/upload_form', array('error' => ' ' ));
  }

  public function upload_file() {
    $cpt = count($_FILES['multipleFiles']['name']);
    $config = array();
    $config['upload_path'] = "C:\Bitnami\wampstack-7.1.18-1\apache2\htdocs\ci_practice\uploads";  //  './uploads/'
    $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
  // $config['allowed_types'] = 'mp4';
    $config['max_size'] = 0;
    $config['overwrite'] = FALSE;

    for($i=0; $i<$cpt; $i++) {
      $_FILES['userfile']['name'] = $_FILES['multipleFiles']['name'][$i];
      $_FILES['userfile']['type'] = $_FILES['multipleFiles']['type'][$i];
      $_FILES['userfile']['tmp_name'] = $_FILES['multipleFiles']['tmp_name'][$i];
      $_FILES['userfile']['error'] = $_FILES['multipleFiles']['error'][$i];
      $_FILES['userfile']['size'] = $_FILES['multipleFiles']['size'][$i];

      $this->load->library('upload');
      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload()) {
        $error = array('error' => $this->upload->display_errors());
        $this->load->view('member/upload_form', $error);
      }else{
        $upload_data = $this->upload->data(); //date() 업로드한 파일에 관련된 데이터를 배열로 리턴해주는 함수
        $data['pic_file'] = $upload_data['file_name'];
        $data= $this->File_model->store_pic_data($data);
        // $this->load->view('member/upload_success', $upload_data);
      }
    }
  }

  public function index() {
    $this->load->library("pagination");
    $config['base_url'] = base_url().'Upload/index/';
    $config["total_rows"] = $this->File_model->count_all();
    $config["per_page"] = 5;
    $config["uri_segment"] = 3;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $page=($this->uri->segment(3))? $this->uri->segment(3):0;

    $data['links'] = $this->pagination->create_links();
    // $data['picture_list'] = $this->File_model->get_all_pics();
    $data['count']=$this->File_model->fetch_users($config["per_page"],$page);
    $this->load->view('member/picture_list',$data);
  }

  public function gets() {  //view 페이지
    $idx = $this->uri->segment(3);  //글번호
    $data['pic'] = $this->File_model->get_pics($idx);
    $this->load->library("pagination");
    $config['base_url'] = base_url().'Upload/gets/'.$idx;
    $config["total_rows"] = $this->File_model->count_all_comment($idx);
    $config["per_page"] = 3;
    $config["uri_segment"] = 4;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $page=($this->uri->segment(4))? $this->uri->segment(4):0;
    $data['links'] = $this->pagination->create_links();
    $data['comment'] = $this->File_model->comment_list($idx,$config["per_page"],$page);
    $this->load->view('member/board_view',$data);
  }

  public function fetch_c_idx() {
    $c_idx = $this->input->post('c_idx');
    $this->File_model->fetch_idx($c_idx);
  }

  public function insert_comment() {
    $idx = $this->uri->segment(3);  //comment 테이블의 idx
    $comment = $this->input->post('comment');
    $rows = $this->File_model->insert_comment($comment,$idx);
    if($rows == '1') {
      // echo "<script type='text/javascript'>window.alert('입력되었습니다.');</script>";
      redirect(base_url().'Upload/gets/'.$idx);
    }else{
      // echo "<script type='text/javascript'>window.alert('다시 시도해주세요.');</script>";
      redirect(base_url().'Upload');
    }
  }

  public function re_comment() {  //대댓글 입력
    $idx = $this->input->post('idx'); //맨처음댓글 idx (comment idx)
    $re_comment = $this->input->post('re_comment');
    $this->File_model->re_comment($idx,$re_comment);
  }

}
?>
