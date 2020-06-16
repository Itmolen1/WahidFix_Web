<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Purchase_master extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_master_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Purchase Master Listing';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function purchase_master_listing()
    {        
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $this->load->library('pagination');
        $count = $this->purchase_master_model->purchase_master_listing_count($searchText);
		$returns = $this->paginationCompress("purchase_master_listing/", $count, 10 );
        $data['purchase_master'] = $this->purchase_master_model->purchase_master_listing($searchText, $returns["page"], $returns["segment"]);
        //echo "<pre>";print_r($data);die;
        $this->global['pageTitle'] = APP_NAME.' : Purchase Master Listing';
        $this->loadViews("purchase_master_list_view", $this->global, $data, NULL);        
    }  

    function add_new_purchase_master()
    {
        if($this->input->post())
        {
            $value=$this->input->post();
            $value['purchase_master_image']='N.A.';
            //echo "<pre>";print_r($value['purchase_master_image']['error']);die;
            if(isset($_FILES) && $_FILES['purchase_master_image']['error']==0)
            {
                /*image upload*/
                $dir='assets/po/';
                $n=pathinfo($_FILES['purchase_master_image']['name']);
                $ex=$n['extension'];
                $uid=uniqid('po_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($_FILES['purchase_master_image']['name'],PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['purchase_master_image']['tmp_name'],$tfile))
                    {
                        $img['purchase_master_image']=ADMIN_PATH.$tfile;
                        $value['purchase_master_image']=$img['purchase_master_image'];
                    }
                    else
                    {
                        $this->add_new_purchase_master();
                    }
                }
                /*image upload*/
            }
            /*1.get all records from session table and add all the data in boi table */
            $sid=$this->session->userdata['purchase_master_item']['pm_boi_pm_id_session'];
            $pmid = $this->purchase_master_model->add_new_purchase_master($value,$sid);
            $all_session=$this->purchase_master_model->get_all_by_session_id($sid);
            $this->purchase_master_model->insert_session_to_boi($all_session,$pmid);
            /*1.get all records from session table and add all the data in boi table */
            if(isset($this->session->userdata['purchase_master_item']['pm_boi_pm_id_session']))
            {
            	$this->session->unset_userdata('purchase_master_item');
            }
            redirect('purchase_master_listing');
        }
        else
        {
        	if(isset($this->session->userdata['purchase_master_item']['pm_boi_pm_id_session']))
            {
            	$this->session->unset_userdata('purchase_master_item');
            }
            $data['action']='add_new_purchase_master';
            $data['vendor']=$this->purchase_master_model->get_vendor_list();
            $data['item']=$this->purchase_master_model->get_item_list();
            $data['unit']=$this->purchase_master_model->get_unit_list();
            $data['bill_no']=$this->purchase_master_model->get_bill_no();
            $logindata = array('pm_boi_pm_id_session'=>uniqid('pm_'));
            $this->session->set_userdata('purchase_master_item',$logindata);
            $this->global['pageTitle'] = APP_NAME.' : Add New Purchase Master';
            $this->loadViews("add_new_purchase_master_view", $this->global, $data, NULL);
        }
    }

    function add_pm_boi_session()
    {
        if($this->input->post())
        {
            $value=$this->input->post();
            $result=$this->purchase_master_model->add_pm_boi_session($value);
            $finalresult=$this->get_result($result['pm_boi_pm_id_session']);
            echo json_encode($finalresult);
        }
    }

    function edit_pm_boi_session()
    {
    	if($this->input->post())
    	{
    		$value=$this->input->post();
    		$finalresult=$this->get_result($value['session_id']);
    		echo json_encode($finalresult);
    	}
    }

    function delete_pm_boi_session()
    {
        if($this->input->post())
        {
            $record_num=$this->input->post();
            $get_session=$this->purchase_master_model->get_pm_boi_pm_id_session($record_num['data']);
            $result=$this->purchase_master_model->delete_pm_boi_session($record_num['data']);
            $finalresult=$this->get_result($get_session);
            echo json_encode($finalresult);
        }        
    }    

    function get_result($pm_boi_pm_id_session)
    {
        $result=$this->purchase_master_model->get_items_by_session_id($pm_boi_pm_id_session);
        $finalresult='';
        $subtotal=0.0;
        $taxamount=0.0;
        $grandtotal=0.0;
        for($i=0;$i<count($result);$i++)
        {
            $finalresult.='<tr><td>'.($i+1).'</td><td>'.$result[$i]['item_master_name'].'</td><td>'.$result[$i]['pm_boi_detail_session'].'</td><td>'.$result[$i]['item_unit_name'].'</td><td>'.$result[$i]['pm_boi_qty_session'].'</td><td>'.$result[$i]['pm_boi_rate_session'].'</td><td>'.$result[$i]['pm_boi_total_session'].'<a href="JavaScript:void(0);" id="'.$result[$i]['pm_boi_id_session'].'" class="btn btn-sm btn-danger deleteServices" style="float: right" onclick="return del_poi_id('.$result[$i]['pm_boi_id_session'].')">Delete</a></td></tr>';
            $subtotal+=$result[$i]['pm_boi_total_session'];
        }
        $taxamount=($subtotal*5/100);
        $grandtotal=$subtotal+$taxamount;
        $send=array('finalresult'=>$finalresult,'subtotal'=>$subtotal,'taxamount'=>$taxamount,'grandtotal'=>$grandtotal);
        return $send;
    }
    
    function edit_purchase_master()
    {
        if($this->input->post())
        {
        	$value=$this->input->post();

             /*Image upload*/
            if(isset($_FILES) && $_FILES['purchase_master_image']['name']!='')
            {
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['purchase_master_image']['name']);
                $ex=$n['extension'];
                $uid=uniqid('insu_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['purchase_master_image']['tmp_name'],$tfile))
                    {
                        $img['purchase_master_image']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        redirect('purchase_master_listing','refresh');
                    }
                }
                $value['purchase_master_image']=$img['purchase_master_image'];                
                $un=str_replace(FRONT_PATH,'',$value['purchase_master_image_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/'.$un);
            }
            else
            {
                $value['purchase_master_image']=$value['purchase_master_image_old'];
            }
            /*Image upload*/




        	//move session values to boi
        	$sid=$this->session->userdata['purchase_master_item']['pm_boi_pm_id_session'];
            $all_session=$this->purchase_master_model->get_all_by_session_id($sid);
            $this->purchase_master_model->insert_session_to_boi($all_session,$value['purchase_master_id']);
            $result = $this->purchase_master_model->update_purchase_master($value);
            if(isset($this->session->userdata['purchase_master_item']['pm_boi_pm_id_session']))
            {
            	$this->session->unset_userdata('purchase_master_item');
            }
            redirect('purchase_master_listing');
        }
        else
        {
            if(isset($this->session->userdata['purchase_master_item']['pm_boi_pm_id_session']))
            {
            	$this->session->unset_userdata('purchase_master_item');
            }
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            if(is_numeric($record_num))
            {
                $data['purchase_master'] = $this->purchase_master_model->get_po_by_id($record_num);
            }
            $data['boi']=$this->purchase_master_model->get_all_boi_by_poid($record_num);
            if(empty($data['boi']))
            {
            	$logindata = array('pm_boi_pm_id_session'=>$data['purchase_master']['pm_boi_pm_id_session']);
            	$this->session->set_userdata('purchase_master_item',$logindata);
            	$data['session_id']=$data['purchase_master']['pm_boi_pm_id_session'];
            	/*move all boi records to session table*/
            	//$res=$this->purchase_master_model->inset_boi_to_session($data['boi']);
            	//echo "<pre>sd";print_r($data);die;
            }
            else
            {
            	$logindata = array('pm_boi_pm_id_session'=>$data['boi'][0]['pm_boi_pm_id_session']);
            	$this->session->set_userdata('purchase_master_item',$logindata);
            	$data['session_id']=$data['boi'][0]['pm_boi_pm_id_session'];
            	/*move all boi records to session table*/
            	$res=$this->purchase_master_model->inset_boi_to_session($data['boi']);
            	//echo "<pre>sd";print_r($data);die;
            }
            $data['action']='edit_purchase_master';
            $data['vendor']=$this->purchase_master_model->get_vendor_list();
            $data['item']=$this->purchase_master_model->get_item_list();
            $data['unit']=$this->purchase_master_model->get_unit_list();
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Add New Purchase Master';
            $this->loadViews("add_new_purchase_master_view", $this->global, $data, NULL);
        }
    }

    function delete_purchase_master()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->purchase_master_model->delete_purchase_master($record_num);
        redirect('purchase_master_listing','refresh');        
    }

    function vehicle_no_exists()
    {
        $vehicle_id = $this->input->post("vehicle_id");
        $vehicle_no = $this->input->post("vehicle_no");
        if(empty($vehicle_id)){
            $result = $this->vehicle_model->vehicle_no_exists($vehicle_no);
        } else {
            $result = $this->vehicle_model->vehicle_no_exists($vehicle_no, $vehicle_id);
        }
        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = APP_NAME.' : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function purchase_master_get_payment_record_details()
    {
    	$value=$this->input->post();
    	$result=$this->purchase_master_model->purchase_master_get_payment_record_details($value['data']);
    	echo json_encode($result);
    }

    function purchase_master_add_payment_record()
    {
    	$value=$this->input->post();
    	$this->purchase_master_model->purchase_master_add_payment_record($value);
    	redirect('purchase_master_listing','refresh');
    	//echo json_encode($value);
    }

    function purchase_master_email()
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

        $data = $this->purchase_master_model->get_pm_pdf_data($value['data']);
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
        	$this->purchase_master_pdf($_POST['data']);
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

    public function purchase_master_pdf()
    {
        require_once(FCPATH.'application/libraries/TCPDF-master/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $value=$this->input->post();
        $data = $this->purchase_master_model->get_pm_pdf_data($value['data']);
        $boi =  $this->purchase_master_model->get_all_boi_by_poid_pdf($data['purchase_master_id']);
        //echo "<pre>";print_r($data);die;

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Wahid Fix');
        $pdf->SetTitle('TAX INVOICE');
        $pdf->SetSubject('TAX INVOICE');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        // add a page
        $pdf->AddPage();

		$pdf->SetFont('times', '', 20);// set font
        $html='<u><b>TAX INVOICE</b></u>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'C', true);

        $pdf->SetFont('times', '', 14);
        //$html = '<span align="left"><u>Bill To :</u></span><span align="right"><u>Ship To :</u></span>';
        //$pdf->writeHTMLCell(0, 0, '', '', $html,0, 1, 0, true, 'R', true);
        $pdf->Cell(50, 5, 'Bill To :');
        $pdf->Cell(130, 5, 'Ship To:',0,0,$align='R');
		$pdf->Ln(6);

		$pdf->SetFont('times', '', 10);
		$html=$data['vendor_salutation'].' '.$data['vendor_name'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html,0,0,$align='R');
		$pdf->Ln(6);

		$html=$data['vendor_billing_attention'];
		$html1=$data['vendor_shipping_attention'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);

		$html=$data['vendor_billing_address'].','.$data['vendor_billing_city'];
		$html1=$data['vendor_shipping_address'].','.$data['vendor_shipping_city'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);

		$html=$data['vendor_billing_country'];
		$html1=$data['vendor_shipping_country'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);

		$html='Phone :'.$data['vendor_billing_phone'];
		$html1='Phone :'.$data['vendor_shipping_phone'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);

		$html='Fax :'.$data['vendor_billing_fax'];
		$html1='Fax :'.$data['vendor_shipping_fax'];
		$pdf->Cell(50, 5,$html);
        $pdf->Cell(130, 5, $html1,0,0,$align='R');
		$pdf->Ln(6);        

        $pdf->SetFont('times', 'B', 16);

        $html = '<table border="1" cellpadding="5">
            <tr>
                <th align="center">Sr. No</th>
                <th align="center">Description</th>
                <th align="center">Qty</th>
                <th align="center">Unit</th>
                <th align="center">Rate</th>
                <th align="center">Amount</th>
            </tr>';
        $pdf->SetFont('times', '', 10);
        for($i=0;$i<count($boi);$i++)
        {
        
        $html .='<tr>
                <td align="center">'.($i+1).'</td>
                <td align="center">'.$boi[$i]['item_master_name'].'</td>
                <td align="center">'.$boi[$i]['pm_boi_qty'].'</td>
                <td align="center">'.$boi[$i]['item_unit_name'].'</td>
                <td align="center">'.$boi[$i]['pm_boi_rate'].'</td>
                <td align="right">'.number_format($boi[$i]['pm_boi_total'],2,'.','').'</td>
            </tr>';
        
        }
        $html.='</table><table border="0" cellpadding="5">';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Subtotal</td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_master_sub_total'],2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">VAT (5%)</td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_master_tax_per'],2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Tax Amount</td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_master_tax_amt'],2,'.','').'</td>
            </tr>';
        $html.= '<tr>
        		<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Grand Total  </td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_master_grand_total'],2,'.','').'</td>
            </tr>';
        $html.='</table>';
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Print some HTML Cells

        if($i>=1 && $i<=3)
        {
        	$pdf->Ln(80);
        }
        elseif ($i>=4 && $i<=6)
        {
            $pdf->Ln(50);
        }
        elseif ($i==7 || $i==8)
        {
            $pdf->Ln(40);
        }
        elseif ($i==9 || $i==10)
        {
            $pdf->Ln(25);
        }
        elseif ($i==11 || $i==12)
        {
            $pdf->Ln(10);
        }
        /*$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
        $html='<table height="100"><tr><td></td></tr></table>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);*/

        $tbl ='<table cellspacing="0" cellpadding="1" border="1" align="center"><tr><td>Terms & Condition</td>
		        <td>Customer Notes</td></tr><tr><td rowspan="3">'.$data['purchase_master_tc'].'<br /></td>
		        <td>'.$data['purchase_master_vendor_notes'].'</td><td>COL 3 - ROW 1</td></tr></table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');

    	$pdf->Ln(20);
		$tbl=' Accepted By ( Name & Signature )';
		$tbl1=' Issue By ( Name & Signature )';
		//$pdf->writeHTML($tbl, true, false, false, false, '');
		$pdf->Cell(0, 0, $tbl.'                          '.$tbl1, 1, 1, 'C', 0, '', 3);
		
		
		//$pdf->writeHTML($tbl, true, false, false, false, '');
        // reset pointer to the last page
        $pdf->lastPage();
        $filelocation = FCPATH.'//assets//pm_pdf';  
        $fileNL = $filelocation.'//'.$value['data'].'.pdf';
        $pdf->Output($fileNL, 'F'); 
        //echo FCPATH.$fileNL;
        $var=base_url().'/assets/pm_pdf/'.$value['data'].'.pdf';
        echo json_encode(stripcslashes($var));
    }

    public function pm_export_exl()
    {
    	$last = $this->uri->total_segments();
		$record_num = $this->uri->segment($last);
    	$data = $this->purchase_master_model->get_pm_pdf_data($record_num);
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