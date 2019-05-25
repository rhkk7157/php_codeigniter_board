<?php
class File_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  // //fetch all pictures from db
  function get_pics($idx){
    if(isset($idx)) {
      $this->db->where('id',$idx);
      $query = $this->db->get('ci_test.pictures');
      return  $query->result();
    }else{
      $all_pics = $this->db->get('ci_test.pictures');
      return $all_pics->result();
    }
    // echo $this->db->last_query();
  }

  //save picture data to db
  function store_pic_data($data){
    $insert_data['pic_file1'] = $data['pic_file'];
    $query = $this->db->insert('pictures', $insert_data);
  }

  function fetch_users($limit,$start) {
    $this->db->limit($limit,$start);
    $query = $this->db->get('ci_test.pictures');
    $result = $query->result();
    return $result;
  }

  function fetch_comment($limit,$start) {
    $this->db->limit($limit,$start);
    $query = $this->db->get('ci_test.comment');
    $result = $query->result();
    return $result;
  }

  function count_all() {
    $query = $this->db->get("ci_test.pictures");
    return $query->num_rows();
  }

  function insert_comment($comment,$idx) {
    $data = array(
      'comment'=>$comment,
      'user_id'=>'admin',
      'date' =>date("y-m-d-h:i:s"),
      'img_idx' => $idx
    );
    $query = $this->db->insert('ci_test.comment',$data);
    if($this->db->affected_rows() == '1'){
      return  TRUE;
    }else{
      return FALSE;
    }
  }

  function comment_list($idx,$limit,$start) {
    $this->db->limit($limit,$start);
    $this->db->where('img_idx',$idx);
    $query = $this->db->get('ci_test.comment');
    // echo $this->db->last_query();
    return $query->result();
  }

  function fetch_idx($idx) {  //댓글 idx 대댓글 조회
    $this->db->where('comment_idx',$idx);
    $query = $this->db->get('re_comment');
    $result = $query->result_array();
    echo json_encode($result);
  }

  function count_all_comment($idx) {   //댓글갯수 count
    $this->db->where('img_idx',$idx);
    $query = $this->db->get('ci_test.comment');
    return $query->num_rows();
  }

  function re_comment($idx,$re_comment) { //comment 테이블 idx
    $data = array(
      'comment_idx' => $idx,
      'user_id' => 'guest',
      'date' => date('y-m-d-h:i:s'),
      're_comment' => $re_comment
    );
    $query = $this->db->insert('ci_test.re_comment',$data);
    if($this->db->affected_rows() == '1'){
      return  TRUE;
    }else{
      return FALSE;
    }
  }

  function fetch_re_comment($comment_idx) { //대댓글 조회
    $this->db->where('comment_idx',$comment_idx);
    $query = $this->db->get('re_comment');
    return $query->result();
  }
}
?>
