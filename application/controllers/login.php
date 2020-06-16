<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {

        parent::__construct();
        $this->load->model('login_model');
        //$this->isLoggedIn();
    }

	public function index()
	{
		$data['action']='login/getlogin';
		$this->load->view('inc/header');
		$this->load->view('login_view',$data);
		$this->load->view('inc/footer');
	}

	public function getlogin()
	{
		//echo "<pre>hi";print_r($this->input->post());die;
		$input=$this->input->post();
		$tbl_user_email=$this->input->post('username');
		$tbl_user_password=$this->input->post('password');
		//$tbl_user_email=$this->security->xss_clean($this->input->post('username'));
		//$tbl_user_password=$this->security->xss_clean($this->input->post('password'));
		$result=$this->login_model->get($tbl_user_email,$tbl_user_password);
		if($result)
		{
			$this->session->set_userdata('user', $result);
			if($this->session->userdata('referred_from'))
			{
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}
			else
			{
				redirect(base_url(),'refresh');
			}
		}
		else
		{
			$this->session->set_userdata('invalid_login', 'Invalid Username OR Password.');
			redirect('login','refresh');
		}
		
	}

	public function reset_password()
	{
		if($this->input->post())
		{
			$value=$this->input->post();			
			$res=$this->login_model->email_exist($value['email']);
			if($res==1)
			{
				$token = openssl_random_pseudo_bytes(16);
				$token = bin2hex($token);
				$res=$this->login_model->update_token_to_email($token,$value['email']);

		        $to = 'zokham8989@gmail.com';		        
		        $from = 'info@wahidfix.com';
		        $fromName = 'Wahidfix';
		        //email subject
		        $subject = 'Password Reset by Wahidfix'; 

		        //attachment file path
		        $link='<a href="'.base_url().'Forgot_password/token/'.$token.'">Reset Password</a>';
		        $htmlContent = 'Someone requested a password reset for your account. If this was not you, please disregard this email. If you\'d like to continue click the link below.'.$link.'This link will expire in 20 minutes.';
		        //echo "<pre>";print_r($htmlContent);die;
		        //header for sender info
		        $headers = "From: $fromName"." <".$from.">";

		        //boundary 
		        $semi_rand = md5(time()); 
		        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

		        //headers for attachment 
		        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

		        //multipart boundary 
		        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
		        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

		        //preparing attachment
		        
                $message .= "--{$mime_boundary}\n";
                
		            
		        $message .= "--{$mime_boundary}--";
		        $returnpath = "-f" . $from;

		        //send email
		        $mail = @mail($to, $subject, $message, $headers, $returnpath);
				$this->session->set_flashdata('message', 'We have sent you an Email to reset your password please check your inbox and password reset link will expire in 10 minutes.');
				redirect('Forgot_password','refresh');
			}
			else
			{
				$this->session->set_flashdata('message', 'Email Is not Registerd With Us.');
				redirect('Forgot_password','refresh');
			}
			
		}
		else
		{
			$data['action']='login/reset_password';
			$this->load->view('inc/header');
			$this->load->view('forgot_password_view',$data);
			$this->load->view('inc/footer');
		}
	}

	public function update_password()
	{
		if($this->input->post())
		{
			$value=$this->input->post();
			
			$res=$this->login_model->token_validity_check($value['token']);
			//echo "<pre>";print_r($res);die;
			if($res==1)
			{
				$up=$this->login_model->update_new_password($value);
				//echo "<pre>";print_r($up);die;
				if($up==1)
				{
					$this->session->set_flashdata('message', 'Your Password Updated Successfully.');
					redirect('login','refresh');
				}
				else
				{
					$this->session->set_flashdata('message', 'Sorry something went wrong,Plase Try Again.');
					$data['action']='login/reset_password';
					$this->load->view('inc/header');
					$this->load->view('forgot_password_view',$data);
					$this->load->view('inc/footer');
				}
			}
			else
			{
				$this->session->set_flashdata('message', 'Sorry your Password Reset Link is Expired,Plase Try Again.');
				$data['action']='login/reset_password';
				$this->load->view('inc/header');
				$this->load->view('forgot_password_view',$data);
				$this->load->view('inc/footer');
			}
		}
		else
		{
			$last = $this->uri->total_segments();
			$record_num = $this->uri->segment($last-1);
			if($record_num=='token')
			{
				$token=$this->uri->segment($last);
				$res=$this->login_model->token_validity_check($token);
				if($res==1)
				{
					$data['token']=$token;
					$data['action']='login/update_password';
					$this->load->view('inc/header');
					$this->load->view('reset_password_view',$data);
					$this->load->view('inc/footer');
				}
				else
				{
					$this->session->set_flashdata('message', 'Sorry your Password Reset Link is Expired,Plase Try Again.');
					$data['action']='login/reset_password';
					$this->load->view('inc/header');
					$this->load->view('forgot_password_view',$data);
					$this->load->view('inc/footer');
				}
			}
			else
			{
				redirect('login');
			}
		}
		
	}

	public function getlogout()
	{
		//echo "<pre>hi";print_r($this->input->post());die;
		$this->session->unset_userdata('user');
		redirect(base_url(),'refresh');
	}

	public function logout()
	{

	}
}
