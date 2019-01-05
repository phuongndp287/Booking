<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function index()
	{
		// echo "index";
		// die;
	   $data['title'] = 'Login';
	   $data['error'] = '';
	   $this->load->view('backend/login_form', $data);
	}
	function validate_credentials()
	{
		// echo "validate_credentials";
		// die;
	 	$this->load->model('user');
	 	$query = $this->user->validate();
	 	if($query)
	 	{
	 		$data = array(
	 				'username' => $this->input->post('username'),
	 				'is_logged_in' => true,
	 				'role' => $this->user->member_role($this->input->post('username')),
	 				'user_id' => $this->user->member_id($this->input->post('username')),
					'language' => ($this->user->member_language($this->input->post('username')) != null) ? $this->user->member_language($this->input->post('username')) : 'english'
	 				);
	 		$this->session->set_userdata($data);
	 		redirect('admin/dashboard');
	 	}
	 	else
	 	{
	 		$data['error'] = 'Invalid Username or Password';
	     	$data['main_content'] = 'login_form';
	 		$this->load->view('backend/login_form', $data);
	 	}
	}

	function logout()
	{
		// echo "logout";
		// die;
	    $this->session->sess_destroy();
	    $this->index();
	}// ông ơi thế thì khi sự kiện của nguiwuf dùng click vào thì nó sẽ vào đâu trươc ?.
	// trong này nó ko viết contruc nên chưa biết hàm nào chạy trc
	// chỉ có dặt die để xem thôi
	// hàm index kia chạy trc ý tôi là trong cái mô hinh mvc này thì ngươi dung click vào thì nó sẽ vào đâu trước vậy ông
	// cái đó thì khó nói lắm
	// MVC là model view và controller
	// khi ngươi dùng gõ địa chỉ url thì nó sẽ đi vào controller sử lý, nếu controller cần dữ liệu thì nó sẽ vào model để lấy dữ liệu và đổ ra view, còn ko cần dữ liệu thì nó đổ luôn ra view
	//ok ông bây h ông hưỡng dẫn tôi làm cái suppliers nhé tôi 


	//mà ok  rồi ông có gì tí tôi lên tôi làm tiếp 
	//ok cảm ơn ông
	// ko có gì :))

	// đoạn này tôi giải thick luồng của nó rồi như
}

?>
