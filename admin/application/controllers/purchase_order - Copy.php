<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Purchase_order extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_order_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->global['pageTitle'] = APP_NAME.' : Purchase Order Listing';
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    function purchase_order_listing()
    {        
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $this->load->library('pagination');
        $count = $this->purchase_order_model->purchase_order_listing_count($searchText);
		$returns = $this->paginationCompress("purchase_order_listing/", $count, 10 );
        $data['purchase_order'] = $this->purchase_order_model->purchase_order_listing($searchText, $returns["page"], $returns["segment"]);
        //echo "<pre>";print_r($data);die;
        $this->global['pageTitle'] = APP_NAME.' : Purchase Order Listing';
        $this->loadViews("purchase_order_list_view", $this->global, $data, NULL);        
    }  

    function add_new_purchase_order()
    {
        if($this->input->post())
        {
            $value=$this->input->post();
            $value['purchase_order_image']=NULL;
            if(isset($_FILES))
            {
                /*image upload*/
                $dir='assets/po/';
                $n=pathinfo($_FILES['purchase_order_image']['name']);
                $ex=$n['extension'];
                $uid=uniqid('po_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($_FILES['purchase_order_image']['name'],PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['purchase_order_image']['tmp_name'],$tfile))
                    {
                        $img['purchase_order_image']=ADMIN_PATH.$tfile;
                        $value['purchase_order_image']=$img['purchase_order_image'];
                    }
                    else
                    {
                        $this->add_new_purchase_order();
                    }
                }
                /*image upload*/
            }
            /*1.get all records from session table and add all the data in boi table */
            $sid=$this->session->userdata['purchase_order_item']['po_boi_po_id_session'];
            $poid = $this->purchase_order_model->add_new_purchase_order($value,$sid);
            $all_session=$this->purchase_order_model->get_all_by_session_id($sid);
            $this->purchase_order_model->insert_session_to_boi($all_session,$poid);
            /*1.get all records from session table and add all the data in boi table */
            if(isset($this->session->userdata['purchase_order_item']['po_boi_po_id_session']))
            {
            	$this->session->unset_userdata('purchase_order_item');
            }
            redirect('purchase_order_listing');
        }
        else
        {
        	if(isset($this->session->userdata['purchase_order_item']['po_boi_po_id_session']))
            {
            	$this->session->unset_userdata('purchase_order_item');
            }
            $data['action']='add_new_purchase_order';
            $data['vendor']=$this->purchase_order_model->get_vendor_list();
            $data['item']=$this->purchase_order_model->get_item_list();
            $data['unit']=$this->purchase_order_model->get_unit_list();
            $data['bill_no']=$this->purchase_order_model->get_bill_no();
            $logindata = array('po_boi_po_id_session'=>uniqid('po_'));
            $this->session->set_userdata('purchase_order_item',$logindata);
            $this->global['pageTitle'] = APP_NAME.' : Add New Purchase Order';
            $this->loadViews("add_new_purchase_order_view", $this->global, $data, NULL);
        }
    }

    function add_po_boi_session()
    {
        if($this->input->post())
        {
            $value=$this->input->post();
            $result=$this->purchase_order_model->add_po_boi_session($value);
            $finalresult=$this->get_result($result['po_boi_po_id_session']);
            echo json_encode($finalresult);
        }
    }

    function edit_po_boi_session()
    {
    	if($this->input->post())
    	{
    		$value=$this->input->post();
    		$finalresult=$this->get_result($value['session_id']);
    		echo json_encode($finalresult);
    	}
    }

    function delete_po_boi_session()
    {
        if($this->input->post())
        {
            $record_num=$this->input->post();
            $get_session=$this->purchase_order_model->get_po_boi_po_id_session($record_num['data']);
            $result=$this->purchase_order_model->delete_po_boi_session($record_num['data']);
            $finalresult=$this->get_result($get_session);
            echo json_encode($finalresult);
        }        
    }    

    function get_result($po_boi_po_id_session)
    {
        $result=$this->purchase_order_model->get_items_by_session_id($po_boi_po_id_session);
        $finalresult='';
        $subtotal=0.0;
        $taxamount=0.0;
        $grandtotal=0.0;
        for($i=0;$i<count($result);$i++)
        {
            $finalresult.='<tr><td>'.($i+1).'</td><td>'.$result[$i]['item_master_name'].'</td><td>'.$result[$i]['po_boi_detail_session'].'</td><td>'.$result[$i]['item_unit_name'].'</td><td>'.$result[$i]['po_boi_qty_session'].'</td><td>'.$result[$i]['po_boi_rate_session'].'</td><td>'.$result[$i]['po_boi_total_session'].'<a href="JavaScript:void(0);" id="'.$result[$i]['po_boi_id_session'].'" class="btn btn-sm btn-danger deleteServices" style="float: right" onclick="return del_poi_id('.$result[$i]['po_boi_id_session'].')">Delete</a></td></tr>';
            $subtotal+=$result[$i]['po_boi_total_session'];
        }
        $taxamount=($subtotal*5/100);
        $grandtotal=$subtotal+$taxamount;
        $send=array('finalresult'=>$finalresult,'subtotal'=>$subtotal,'taxamount'=>$taxamount,'grandtotal'=>$grandtotal);
        return $send;
    }
    
    function edit_purchase_order()
    {
        if($this->input->post())
        {
        	$value=$this->input->post();

             /*Image upload*/
            if(isset($_FILES) && $_FILES['purchase_order_image']['name']!='')
            {
                $dir='assets/vehicle/';
                $n=pathinfo($_FILES['purchase_order_image']['name']);
                $ex=$n['extension'];
                $uid=uniqid('insu_');
                $tfile=$dir.$uid.'.'.$ex;
                $img=array();
                $imageFileType = strtolower(pathinfo($tfile,PATHINFO_EXTENSION));   
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg")
                {
                    if ( move_uploaded_file($_FILES['purchase_order_image']['tmp_name'],$tfile))
                    {
                        $img['purchase_order_image']=ADMIN_PATH.$tfile;
                    }
                    else
                    {
                        redirect('purchase_order_listing','refresh');
                    }
                }
                $value['purchase_order_image']=$img['purchase_order_image'];                
                $un=str_replace(FRONT_PATH,'',$value['purchase_order_image_old']);
                //echo $_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un;die;
                $u=unlink($_SERVER['DOCUMENT_ROOT'].'/karigar/'.$un);
            }
            else
            {
                $value['purchase_order_image']=$value['purchase_order_image_old'];
            }
            /*Image upload*/




        	//move session values to boi
        	$sid=$this->session->userdata['purchase_order_item']['po_boi_po_id_session'];
            $all_session=$this->purchase_order_model->get_all_by_session_id($sid);
            $this->purchase_order_model->insert_session_to_boi($all_session,$value['purchase_order_id']);
            $result = $this->purchase_order_model->update_purchase_order($value);
            if(isset($this->session->userdata['purchase_order_item']['po_boi_po_id_session']))
            {
            	$this->session->unset_userdata('purchase_order_item');
            }
            redirect('purchase_order_listing');
        }
        else
        {
            if(isset($this->session->userdata['purchase_order_item']['po_boi_po_id_session']))
            {
            	$this->session->unset_userdata('purchase_order_item');
            }
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);
            if(is_numeric($record_num))
            {
                $data['purchase_order'] = $this->purchase_order_model->get_po_by_id($record_num);
            }
            $data['boi']=$this->purchase_order_model->get_all_boi_by_poid($record_num);
            if(empty($data['boi']))
            {
            	$logindata = array('po_boi_po_id_session'=>$data['purchase_order']['po_boi_po_id_session']);
            	$this->session->set_userdata('purchase_order_item',$logindata);
            	$data['session_id']=$data['purchase_order']['po_boi_po_id_session'];
            	/*move all boi records to session table*/
            	//$res=$this->purchase_order_model->inset_boi_to_session($data['boi']);
            	//echo "<pre>sd";print_r($data);die;
            }
            else
            {
            	$logindata = array('po_boi_po_id_session'=>$data['boi'][0]['po_boi_po_id_session']);
            	$this->session->set_userdata('purchase_order_item',$logindata);
            	$data['session_id']=$data['boi'][0]['po_boi_po_id_session'];
            	/*move all boi records to session table*/
            	$res=$this->purchase_order_model->inset_boi_to_session($data['boi']);
            	//echo "<pre>sd";print_r($data);die;
            }
            $data['action']='edit_purchase_order';
            $data['vendor']=$this->purchase_order_model->get_vendor_list();
            $data['item']=$this->purchase_order_model->get_item_list();
            $data['unit']=$this->purchase_order_model->get_unit_list();
            //echo "<pre>";print_r($data);die;
            $this->global['pageTitle'] = APP_NAME.' : Add New Purchase Order';
            $this->loadViews("add_new_purchase_order_view", $this->global, $data, NULL);
        }
    }

    function delete_purchase_order()
    {
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        $result = $this->purchase_order_model->delete_purchase_order($record_num);
        redirect('purchase_order_listing','refresh');        
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

    public function purchase_order_pdf()
    {
        require_once(FCPATH.'application\libraries\TCPDF-master\tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $value=$this->input->post();
        $data = $this->purchase_order_model->get_po_pdf_data($value['data']);
        $boi =  $this->purchase_order_model->get_all_boi_by_poid_pdf($data['purchase_order_id']);
        //echo "<pre>";print_r($value['data']);die;

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Wahid Fix');
        $pdf->SetTitle('Purchase Order');
        $pdf->SetSubject('Purchase Order');
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
        $html='<u><b>Purchase Order</b></u>';
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
                <td align="center">'.$boi[$i]['po_boi_qty'].'</td>
                <td align="center">'.$boi[$i]['item_unit_name'].'</td>
                <td align="center">'.$boi[$i]['po_boi_rate'].'</td>
                <td align="right">'.number_format($boi[$i]['po_boi_total'],2,'.','').'</td>
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
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_order_sub_total'],2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">VAT (5%)</td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_order_tax_per'],2,'.','').'</td>
            </tr>';
        $html.= '
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Tax Amount</td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_order_tax_amt'],2,'.','').'</td>
            </tr>';
        $html.= '<tr>
        		<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
                <td align="center" style="border: 1px solid black;">Grand Total  </td>
                <td align="right" style="border: 1px solid black;">'.number_format($data['purchase_order_grand_total'],2,'.','').'</td>
            </tr>';
        $html.='</table>';
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Print some HTML Cells

        if($i<10)
        {
        	$pdf->Ln(80);
        }
        /*$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
        $html='<table height="100"><tr><td></td></tr></table>';
        $pdf->SetFillColor(255,255,0);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'C', true);
        $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);*/

        $tbl ='<table cellspacing="0" cellpadding="1" border="1" align="center"><tr><td>Terms & Condition</td>
		        <td>Customer Notes</td></tr><tr><td rowspan="3">'.$data['purchase_order_tc'].'<br /></td>
		        <td>'.$data['purchase_order_vendor_notes'].'</td><td>COL 3 - ROW 1</td></tr></table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');

    	$pdf->Ln(20);
		$tbl=' Accepted By ( Name & Signature )';
		$tbl1=' Issue By ( Name & Signature )';
		//$pdf->writeHTML($tbl, true, false, false, false, '');
		$pdf->Cell(0, 0, $tbl.'                          '.$tbl1, 1, 1, 'C', 0, '', 3);
		
		
		//$pdf->writeHTML($tbl, true, false, false, false, '');
        // reset pointer to the last page
        $pdf->lastPage();
        $filelocation = FCPATH.'\\assets\\po_pdf';  
        $fileNL = $filelocation.'\\'.$value['data'].'.pdf';
        $pdf->Output($fileNL, 'F'); 
        //echo FCPATH.$fileNL;
        $var=base_url().'/assets/po_pdf/'.$value['data'].'.pdf';
        echo json_encode(stripcslashes($var));
    }
}
?>