<?php

class MY_Controller extends CI_Controller
{
  public $title = 'PMB KM UNSRI';
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('lib_log');
	}

	public function template($data, $role = 'admin')
	{
      if ($role == 'admin') {
        return $this->load->view('admin/template/layout', $data);
      } elseif ($role == 'penilai') {
        return $this->load->view('penilai/template/layout', $data);
      } elseif ($role == 'kepaladinas') {
        return $this->load->view('kepaladinas/template/layout', $data);
      }  
      return false;
	}

	public function POST($name)
	{
		return $this->input->post($name);
	}

	public function flashmsg($msg, $type = 'success',$name='msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-'.$type.' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>');
	}

	public function flashmsg2($msg, $type = 'success',$name='msg2')
	{ 
     
		return $this->session->set_flashdata($name, '<div class="alert alert-'.$type.' role="alert">'.$msg.' </div>     ');
	}

	public function upload($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $id  );
			$config = [
				'file_name' 		=> $id  ,
				'allowed_types'		=> 'pdf',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
			
		}
		return FALSE;
	}

	public function uploadform($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $id . '.docx');
			$config = [
				'file_name' 		=> $id . '.docx',
				'allowed_types'		=> 'doc|docx',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
