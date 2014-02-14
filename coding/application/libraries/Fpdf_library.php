<?php 

require_once "fpdf/fpdf.php";

class Fpdf_library {

	var $ci;
	var $fpdf;

	function __construct(){
		$this->ci =& get_instance();
		$this->fpdf = new FPDF();
	}
	
	function WordWrap(&$text, $maxwidth)
	{
	    $text = trim($text);
	    if ($text==='')
	        return 0;
	    $space = $this->fpdf->GetStringWidth(' ');
	    $lines = explode("\n", $text);
	    $text = '';
	    $count = 0;
	
	    foreach ($lines as $line)
	    {
	        $words = preg_split('/ +/', $line);
	        $width = 0;
	
	        foreach ($words as $word)
	        {
	            $wordwidth = $this->fpdf->GetStringWidth($word);
	            if ($wordwidth > $maxwidth)
	            {
	                // Word is too long, we cut it
	                for($i=0; $i<strlen($word); $i++)
	                {
	                    $wordwidth = $this->fpdf->GetStringWidth(substr($word, $i, 1));
	                    if($width + $wordwidth <= $maxwidth)
	                    {
	                        $width += $wordwidth;
	                        $text .= substr($word, $i, 1);
	                    }
	                    else
	                    {
	                        $width = $wordwidth;
	                        $text = rtrim($text)."\n".substr($word, $i, 1);
	                        $count++;
	                    }
	                }
	            }
	            elseif($width + $wordwidth <= $maxwidth)
	            {
	                $width += $wordwidth + $space;
	                $text .= $word.' ';
	            }
	            else
	            {
	                $width = $wordwidth + $space;
	                $text = rtrim($text)."\n".$word.' ';
	                $count++;
	            }
	        }
	        $text = rtrim($text)."\n";
	        $count++;
	    }
	    $text = rtrim($text);
	    return $count;
	}

	function generatePDF($data, $d = 0){
		$this->fpdf = new FPDF('L', 'cm', array(29,29));
		$this->fpdf->AddPage();
		
		// bg image
		$this->fpdf->Image(cdn_url() . '/images/voucher/voucher_basic_edited.jpg', 0, 0);
		
		// nomor order
		$this->fpdf->SetFont('Arial', 'I', 23); 
		$text = strtoupper( $data['no_voucher'] ); 
		$this->fpdf->Text(6, 2.45, $text); 
		
		$this->fpdf->SetTextColor(52,73,93);
		$this->fpdf->SetFont('helvetica', 'B', 50); 
		$text = strtoupper( $data['prize_name_line1'] ); 
		$mid_x = 8.5; // the middle of the "PDF screen", fixed by now.
		$this->fpdf->Text($mid_x - ($this->fpdf->GetStringWidth($text) / 2), 6, $text); 
		
		$this->fpdf->SetTextColor(52,73,93);
		$this->fpdf->SetFont('helvetica', 'B', 40); 
		$text = strtoupper( $data['prize_name_line2'] ); 
		$mid_x = 8.5; // the middle of the "PDF screen", fixed by now.
		$this->fpdf->Text($mid_x - ($this->fpdf->GetStringWidth($text) / 2), 8.3, $text);
		
		$this->fpdf->SetTextColor(255,255,255);
		$this->fpdf->SetFont('helvetica', '', 22); 
		$text = $data['valid_until_string']; 
		$this->fpdf->Text(7.8, 12.4, $text); 
		
		$image_merchant = $data['merchant_logo']; 
		$this->ci->load->library('mediamanager');
		$image_merchant = $this->ci->mediamanager->getPhotoUrl($image_merchant, "155x185");
		$this->fpdf->Image(cdn_url() . $image_merchant, 24.3, 1.95);
		
		$this->fpdf->SetTextColor(0,0,0);
		$this->fpdf->SetFont('helvetica', '', 15); 
		$text = $data['business_name']; 
		$this->fpdf->Text(18.1, 7.6, $text); 
		
		if (!empty($data['voucher_website']) && $data['voucher_website'] != "http://"){
			$text = $data['voucher_website'];
			$this->fpdf->Text(18.1, 8.8, $text); 
			
			$text = $data['voucher_email'];
			$this->fpdf->Text(18.1, 9.9, $text); 
			
			if (!empty($data['voucher_phone'])){
				$text = 'Phone: '.$data['voucher_phone'];
				$this->fpdf->Text(18.1, 11.1, $text); 
			}
		}else{
			$text = $data['voucher_email'];
			$this->fpdf->Text(18.1, 8.8, $text); 
			
			$text = 'Phone: '.$data['voucher_phone'];
			$this->fpdf->Text(18.1, 9.9, $text); 
		}
		
		//$text = "www.lapaksquare.com"; 
		//$this->fpdf->Text(18.1, 8.8, $text); 
		
		//$text = "Email: lapaksquare@gmail.com"; 
		//$this->fpdf->Text(18.1, 9.9, $text); 
		
		//$text = "Phone: +62-821-6350-4980"; 
		//$this->fpdf->Text(18.1, 11.1, $text); 
		
		$this->fpdf->SetTextColor(105,206,187);
		$this->fpdf->SetFont('helvetica', 'U', 17); 
		$text = "winner@activorm.com"; 
		$this->fpdf->Text(18.1, 14, $text); 
		
		$this->fpdf->SetTextColor(152,153,153);
		$this->fpdf->SetFont('helvetica', '', 12); 
		//$text = "- Ongkos kirim ditanggung pemenang atau konfirmasi terlebih dahulu saat diambil dari kantor Activorm.\n- Voucher tidak dapat dipindah-tangankan.\n- Voucher hanya berlaku untuk satu kali request.\n- Voucher tidak berlaku untuk Reseller atau Dropship.
		//";
		$text = str_replace("#BR#", "\n", $data['syarat_ketentuan']);
		$this->fpdf->SetLeftMargin(1.5);
		$this->fpdf->SetXY(1.5, 16.5);
		$this->WordWrap($text, 12);
		$this->fpdf->Write(0.6, $text);
		
		//$text = "- Informasikan pihak Kaos Loe nomor voucher untuk konfirmasi spesifikasi kaos pilihan.\n- Pilihan kaos dapat dilihat di album foto \nFacebook Fanpage KaosLoe : Ready to Print! KaosLoe
		//";
		$text = str_replace("#BR#", "\n", $data['cara_penggunaan']);
		$this->fpdf->SetLeftMargin(15.3);
		$this->fpdf->SetXY(15.3, 16.5);
		$this->WordWrap($text, 12);
		$this->fpdf->Write(0.6, $text);
		
		//$d = $this->input->get_post("d");
		$time = sha1(time().SALT);
		if (!empty($d)){
			$this->fpdf->Output($time . ".pdf", "D");
		}else{
			$this->fpdf->Output($time . ".pdf", "I");
		}
	}
	
}