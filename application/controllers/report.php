<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Report extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('cezpdf');
	}
}



function generarPdf() {
 
        $this->load->plugin('to_dompdf');
        $html = $this->load->view('layout/general',NULL,true);
        generarPdf($html, 'reporte','letter','portrait');
 
 }
/* End of file report.php */
/* Location: ./application/controllers/report.php */