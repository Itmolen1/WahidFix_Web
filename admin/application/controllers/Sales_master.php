<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Sales_master extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sales_master_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Sales Master Listing';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function sales_master_listing()
    {        
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $this->load->library('pagination');
        $count = $this->sales_master_model->sales_master_listing_count($searchText);
		$returns = $this->paginationCompress("sales_master_listing/", $count, 10 );
        $data['sales_master'] = $this->sales_master_model->sales_master_listing($searchText, $returns["page"], $returns["segment"]);
        //echo "<pre>";print_r($data);die;
        $this->global['pageTitle'] = APP_NAME.' : Purchase Master Listing';
        $this->loadViews("sales_master_list_view", $this->global, $data, NULL);        
    }  

    function delete_purchase_master()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->sales_master_model->delete_purchase_master($record_num);
        redirect('sales_master_listing','refresh');        
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function sales_master_email()
    {
        $value=$this->input->post();
        /*$to = "zokham8989@gmail.com";
        $subject = "My subject";
        $txt = "Hello world!";
        $headers = "From: info@wahidfix.com\r\n";
        $headers .= "Reply-To: info@wahidfix.com\r\n";
        $headers .= "Return-Path: info@wahidfix.com\r\n";
        $headers .= "Organization: Wahidfix.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
        mail($to,$subject,$txt,$headers);*/

        $data = $this->sales_master_model->get_pm_pdf_data($value['data']);
        //recipient
        if(isset($data['vendor_email']))
        {
            $to=$data['vendor_email'];
        }
        else
        {
            $to = 'zokham8989@gmail.com';
        }
        //echo $to;die;

        //sender
        $from = 'info@wahidfix.com';
        $fromName = 'Wahidfix';

        //email subject
        $subject = 'TAX INVOICE Email with Attachment by Wahidfix'; 

        //attachment file path
        $file="nothing here";
        $file_pointer = FCPATH.'assets/pm_pdf/'.$value['data'].'.pdf';
        //echo $file_pointer;die;
        if (file_exists($file_pointer))  
        { 
            $file = $file_pointer;
        } 
        else 
        { 
        	$_POST['data']=$value['data'];
        	$this->sales_master_pdf($_POST['data']);
        	if (file_exists($file_pointer))  
	        { 
	            $file = $file_pointer;
	        } 
            //echo "The file $file_pointer does not exists"; 
        } 
        //echo $file;die;
        //email body content
        $htmlContent = '<h1>TAX INVOICE Email with Attachment by Wahidfix</h1>
            <p>This email has sent from Wahidfix with attachment.</p>';

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
        if(!empty($file) > 0){
            if(is_file($file)){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($file,"rb");
                $data =  @fread($fp,filesize($file));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
                "Content-Description: ".basename($file)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $from;

        //send email
        $mail = @mail($to, $subject, $message, $headers, $returnpath); 

        //email sending status
        echo $mail?"<h1>Mail sent.</h1>":"<h1>Mail sending failed.</h1>";
    }

   
    public function pm_export_exl()
    {
    	$last = $this->uri->total_segments();
		$record_num = $this->uri->segment($last);
    	$data = $this->sales_master_model->get_pm_pdf_data($record_num);
    	//echo "<pre>";print_r($data);die;
    	
    	  // file name for download
    	//namespace Chirp;
		  $filename = "website_data_" . date('Ymd') . ".xls";

		  header("Content-Disposition: attachment; filename=\"$filename\"");
		  header("Content-Type: application/vnd.ms-excel");
		  echo implode("\t", array_keys($data)) . "\n";
		  echo implode("\t", array_values($data)) . "\n";
		  //$flag = false;
		  /*foreach($data as $row) {
		  	echo "<pre>";print_r($data);die;
		    if(!$flag) {
		      // display field/column names as first row
		      echo implode("\t", array_keys($row)) . "\n";
		      $flag = true;
		    }
		    array_walk($row, __NAMESPACE__ . '\cleanData');
		    echo implode("\t", array_values($row)) . "\n";
		  }*/
		  //exit;
    }

    function cleanData(&$str)
    {
    	$str = preg_replace("/\t/", "\\t", $str);
    	$str = preg_replace("/\r?\n/", "\\n", $str);
    	if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
}
?>