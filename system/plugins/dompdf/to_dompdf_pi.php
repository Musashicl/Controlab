<php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function generarPdf($html, $filename, $tamayo, $orientacion, $stream=TRUE) {
		require_once("dompdf/dompdf_config.inc.php"); 
		if ( isset($html) ) {
	        $html = stripslashes($html);
	        $dompdf = new DOMPDF();
	        $dompdf->load_html($html);
	        $dompdf->set_paper($tamayo, $orientacion);
	        $dompdf->render();
	        if ($stream) {
	            $dompdf->stream($filename . ".pdf");
	        } else {
	            $CI = & get_instance();
	            $CI->load->helper('file');
	            write_file("./invoices_temp/invoice_$filename.pdf", $dompdf->output());
	        }
 		}
	}
?>