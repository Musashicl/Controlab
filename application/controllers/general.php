<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class General extends CI_Controller {
    
    function __construct() {
        parent::__construct();
		$loggedIn = $this->auth->isLoggedIn();
         if (!$loggedIn) redirect('login','refresh');
      
          
    }
    
    
    
    
    
    
    function index() {
        $data['title'] = 'Control Laboratorio';
        //$data['page'] = 'ingreso/datagrid';
        $data['recs'] = Model\Ingresos::all();
        //$data['recs'] = $est->Estado->estado;
        $this->load->view('layout/general',$data);
        
        
        
    }
    
    function grid(){
        
        //grid config

        $sort_by = $this->input->post('sort_by') ? $this->input->post('sort_by') : 'id' ;
        $sort_order = ($this->input->post('sort_order') ? $this->input->post('sort_order') : 'asc');        
        $offset = $this->input->post('offset') ? $this->input->post('offset') : $this->uri->segment(3);
	$reorder = ($this->input->post('reorder')  ? $this->input->post('reorder') : 'true' );	
        $config['base_url'] = base_url().'general/grid/';
        $config['total_rows'] = $this->db->get('ingresos')->num_rows();
        $config['per_page'] = $this->input->post('per_page') ? $this->input->post('per_page') : '10' ;
	$config['num_links'] = 3;
				
        $this->pagination->initialize($config); 
        
        $this->table->clear(); //limpia tabla
        $ingresos = Model\Ingresos::limit($config['per_page'], $offset )->order_by($sort_by, $sort_order)->all(); //recupera ingresos
        // set table heading
        $heads = array('id' => 'ID', 
                       'ticket' => 'Ticket', 
                       'asset' => 'Asset', 
                       'estado_id' => 'Estado', 
                       'tipo_id' => 'Tipo',
                       'fingreso' => 'Fecha Ingreso',
                       'motivo' => 'Motivo',
                       'descripcion' => 'Descripcion',
                       'fsalida' => 'Fecha Salida', 
                       'diagnostico' => 'Diagnostico',
                       'ubicacion_id' => 'Ubicacion' );
        
		$heading= array();
		foreach ($heads as $name=>$head ) {
                        if ($reorder == 'false' && $name == $sort_by) {
                            $sort = $sort_order ;
                        } else {
                            $sort = ( $sort_order == 'asc' && $name == $sort_by ) ? 'desc' : 'asc';
                        }
                        $sorted = "sort_order=\"$sort\" ";
                        $class_sort = "class=\"sort_$sort_order current_sort\""; 
                        
                        //$fullhead = '<a'. (($name == $sort_by && $sort_order == 'desc' ) ? 'sort_order="desc" class="sort_desc" ' : 'sort_order="asc" class="sort_asc"'). 'name="'.$name.'" >'.$head.'</a>';
			$fullhead = "<a ". (($name == $sort_by) ? $class_sort : '' ). " name=\"$name\" $sorted >$head</a>";
			array_push($heading, $fullhead);
			
		}
		
		
        $this->table->set_heading($heading);
        //$grid->heading($headings);

        // hide some collumn, set table heading, set template
        //$hidden = array('email');
        //$template = array( 'table_open' => '<table border="1" cellpadding="4" cellspacing="0">');

        foreach ($ingresos as $i ) {
            
            if ($i->fsalida != '') {
                $fsalida = date_format(new Datetime($i->fsalida), 'd-m-Y H:i');
            } else {
                $fsalida = 'En Proceso';
            }
            
            $this->table->add_row(array(
                $i->id, 
                $i->ticket, 
                $i->asset,
                Model\Estados::find($i->estado_id)->estado, 
                Model\Tipos::find($i->tipo_id)->tipo, 
                date_format(new Datetime($i->fingreso), 'd-m-Y H:i'),
                $i->motivo, 
                $i->descripcion,
                $fsalida,
                $i->diagnostico,
                Model\Ubicaciones::find($i->ubicacion_id)->ubicacion
            ));
            
        }
        
        $data['grid'] = $this->table->generate();
        $data['pagination'] = $this->pagination->create_links(); 
		$data['per_page'] = $config['per_page'];
        
        if ($this->input->post('ajax')) {
          $grid = $this->load->view('ajax/ingresoGrid', $data, TRUE);
          echo json_encode(array('grid' => $grid, 'pag' => $data['pagination'])) ;
        } else {
            $this->load->view('ingreso/datagrid', $data);
        }

        
        
        
    }
    
    
    
    
    function addIngresoForm () {
        
        $data['estados'] = $this->_estadoList();
        $data['tipos'] = $this->_tipoList(); 
        $data['ubicacion'] = $this->_ubiList();
        
        $this->load->view('ingreso/addIngreso', $data);
        
    }
    
    function addIngreso() {
        $ingre = New Model\Ingresos();
        
        $ingre->ticket = trim($this->input->post('ticket'));
		$ingre->asset = trim($this->input->post('asset'));
        $ingre->estado_id = trim($this->input->post('estado_id'));
        $ingre->tipo_id = trim($this->input->post('tipo_id'));
        $ingre->fingreso = date_format( new Datetime(trim($this->input->post('fingreso'))), 'Y-m-d H:i:s');
        $ingre->motivo = trim($this->input->post('motivo'));
        $ingre->descripcion = trim($this->input->post('descripcion'));
        $ingre->diagnostico = trim($this->input->post('diagnostico'));
        $ingre->ubicacion_id = trim($this->input->post('ubicacion_id'));
        
        $this->output->set_content_type('application/json');
        
         if (! $ingre->save(TRUE)) {
             $error = $ingre->errors;
             //echo json_encode(array(error => $error));
             $this->output->set_output(json_encode(array('error' => $error)));
             
         } else {
             //echo json_encode(array('id' => Model\Ingresos::last_created()->id));
             $this->output->set_output(json_encode(array('id' => Model\Ingresos::last_created()->id)));
         }
         
    }
    
    function editIngresoForm () {
        
        
        $data['ingreso'] = Model\Ingresos::find($this->input->post('id'));
        $data['fingreso'] = date_format(new DateTime($data['ingreso']->fingreso),'d/m/Y H:i'); 
        if ($data['ingreso']->fsalida != '') {
            $data['fsalida'] = date_format(new Datetime($data['ingreso']->fsalida), 'd/m/Y H:i');
        } else {
            $data['fsalida'] = 'En Proceso';
        }
        $data['estados'] = $this->_estadoList();
        $data['tipos'] = $this->_tipoList(); 
        $data['ubicacion'] = $this->_ubiList();
        $this->load->view('ingreso/editIngreso', $data);
    }
    
    function editIngreso() {
        
        //print_r ($this->input->post());
        
        $ingreso = Model\Ingresos::find($this->input->post('id'));
        
        $ingreso->ticket = trim($this->input->post('ticket'));
		$ingreso->asset = trim($this->input->post('asset'));
        $ingreso->estado_id = trim($this->input->post('estado_id'));
        $ingreso->tipo_id = trim($this->input->post('tipo_id'));
        $ingreso->fingreso = date_format( new Datetime(trim($this->input->post('fingreso'))), 'Y-m-d H:i:s');
        $ingreso->motivo = trim($this->input->post('motivo'));
        $ingreso->descripcion = trim($this->input->post('descripcion'));
        if (trim($this->input->post('fsalida')) != "En Proceso") {
            $ingreso->fsalida = date_format( new Datetime(trim($this->input->post('fsalida'))), 'Y-m-d H:i:s');
        }
        //$ingreso->fsalida = date_format($this->input->post('fsalida'), 'Y-m-d H:i:s');
        $ingreso->diagnostico = trim($this->input->post('diagnostico'));
        $ingreso->ubicacion_id = trim($this->input->post('ubicacion_id'));
        
        $this->output->set_content_type('application/json');
        
         if (! $ingreso->save()) {
             $error = $ingreso->errors;
             //echo json_encode(array(error => $error));
             $this->output->set_output(json_encode(array('error' => $error)));
             
         } else {
             //echo json_encode(array('id' => Model\Ingresos::last_created()->id));
             $this->output->set_output(json_encode(array('edited' => 'Se edito ingreso Id <strong>'. $ingreso->id .'</strong> correctamente')));
         }
        
    }
	
	
	function deleteIngreso () {
		
		if ( $this->input->post('id') ) {
		
			if ($this->session->userdata('userRole') == 'admin'){
				if ( Model\Ingresos::delete( $this->input->post('id') )) {
					return json_encode(array('ok' => "Se elimino correctamente el ingreso Id $this->input->post('id') ") ); 
				} else {
					return json_encode(array('error' => 'No se pudo borrar el ingreso....') );
				}
				
			} else {	
				return json_encode(array('error' => 'No tiene permisos suficientes para borrar un ingreso') );
			}
			
		} else {
			return json_encode(array('error' => 'No se encuentra el id de ingreso que desea borrar') );
			
		}
			
	}
    
    
    function _tipoList() {
        $tipo = Model\Tipos::all();
        foreach ($tipo as $t) {
            $tipoList[$t->id] = $t->tipo;
        }
        return $tipoList;
    }
    
    function _estadoList() {
        $estados = Model\Estados::all();
        foreach ($estados as $i => $est)  {
            $estadoList[$est->id] = $est->estado;
        }
        return $estadoList;
    }
    
    function _ubiList() {
        $ubic = Model\Ubicaciones::all();
        foreach ($ubic as $u) {
            $ubiList[$u->id] = $u->ubicacion;
        }
        return $ubiList;
    }
    
    function killsess() {
        $this->session->destroy();
        redirect('/general','location');
    }
    
    function generarSoe() {
	
		//generar doc. de entrega de equipos guardarlo en carpeta reportes.
        $this->load->helper('pdf');
		
		if ($this->input->post('id')) {
			$data['ingreso'] = Model\Ingresos::find($this->input->post('id'));
			if ($data['ingreso']->soe != '') {
				$this->load->view('reportes/editarSoe',$data);
				
			}
			
			
			
		}
		
		
		/*
        $html = $this->load->view('layout/general',NULL,true);
        generarPdf($html, 'reporte','letter','portrait');
        */
 	}
	
	function generarEntrega() {
		
		// generar pdf de entrega de equipo para equipos de preparacion
		
		//
	}
    
}


/* End of file general.php */
/* Location: ./application/controllers/general.php */

