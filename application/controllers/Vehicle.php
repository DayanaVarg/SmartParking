<?php
require_once APPPATH.'../phpqrcode/qrlib.php';
require 'vendor/autoload.php';

class Vehicle extends CI_Controller{

    public function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('Vehicles');
        $this->load->helper('date');
        date_default_timezone_set('America/Bogota');
	}

//views
    
    //Mostrar vehiculos sin salida
    public function showVehicles(){
        if($this->session->userdata('is_logged')){
            $data =array(
                'vehi' => $this->Vehicles->showVehicles(),
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'script_url' => base_url('assets/js/function.js') 
            );
            
            $this->load->view('admin/dashboard', $data);
        }
        else{
            redirect('login');
        }
    }

    //Formulario registro de entrada
    public function registerEn(){
        if($this->session->userdata('is_logged')){
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'fecha_actual'=>date('Y-m-d'),
				'hora_actual'=>date('H:i:s'),
            );

            $this->load->view('vehicle/registerEn', $data);
        }else{
            redirect('login');
        }
    }
    //Registrar Salida
    public function registerFin(){
        if($this->session->userdata('is_logged')){
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'script_url' => base_url('assets/js/script.php') ,
                'fecha_actual'=>date('Y-m-d'),
				'hora_actual'=>date('H:i:s'),
            );
            $this->load->view('vehicle/registerFin', $data);
        }else{
            redirect('login');
        }
    }

    //Registrar Salida Form
    public function registerF(){
        if($this->session->userdata('is_logged')){
            $date_Entrance = $this->input->get('fecha');
            $time_Entrance = $this->input->get('hora');
            $FK_licensePlate = $this->input->get('placa');
            if($this->Vehicles->consultVe($FK_licensePlate)){
                if($this->Vehicles->consultHis($date_Entrance, $time_Entrance, $FK_licensePlate)){
                    $data = array(
                        'navbar' => $this->load->view('layout/navbar', '', TRUE),
                        'footer'=>$this->load->view('layout/footer', '', TRUE),
                        'vehi' =>$this->Vehicles->consultHis($date_Entrance, $time_Entrance, $FK_licensePlate),
                        'fecha_actual'=>date('Y-m-d'),
                        'hora_actual'=>date('H:i:s'),
                    );
                    $this->load->view('vehicle/registerFormF', $data);
                }else{
                    $alerta = array(
                        'tipo' => 'error',
                        'mensaje' => '¡El vehiculo ya cuenta con la salida!'
                    );
                    $data = array(
                        'navbar' => $this->load->view('layout/navbar', '', TRUE),
                        'footer' => $this->load->view('layout/footer', '', TRUE),
                        'alerta' => $alerta, 
                    );
                    $this->load->view('vehicle/registerFin', $data);
                    return; 
                }
            }else{
                $alerta = array(
                    'tipo' => 'error',
                    'mensaje' => '¡El vehiculo no existe!'
                );
                $data = array(
                    'navbar' => $this->load->view('layout/navbar', '', TRUE),
                    'footer' => $this->load->view('layout/footer', '', TRUE),
                    'alerta' => $alerta, 
                );
                $this->load->view('vehicle/registerFin', $data);
                return; 
            }
        

           
        }else{
            redirect('login');
        }
    }

    //Vista Historial de vehículos
    public function showHistVehicles(){
        if($this->session->userdata('is_logged')){
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->showHistVehicles(),
                'script_url' => base_url('assets/js/function.js') 
            );
            $this->load->view('vehicle/vehicleHist', $data);
        }else{
            redirect('login');
        }
    }

    
    //Vista Historial de vehículos tabla
    public function showHistVehiclesT(){
        if($this->session->userdata('is_logged')){
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->showHistVehicles(),
                'script_url' => base_url('assets/js/exportHisVehi.js') 
            );
            $this->load->view('vehicle/vehicleHistTable', $data);
        }else{
            redirect('login');
        }
    }

    //consultar historial vehiculo especifico
    public function searchHistVeh(){
        if($this->session->userdata('is_logged')){
            $license = $this->input->post('license');
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->searchHistVehi($license),
                'script_url' => base_url('assets/js/function.js') 
            );
            $this->load->view('vehicle/vehicleHist', $data);
        }else{
            redirect('login');
        }
    }


    //Listado de vehiculos
    public function showVehiclesL(){
        if($this->session->userdata('is_logged')){
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->listVehi(),
                'script_url' => base_url('assets/js/function.js') 
            );
            $this->load->view('vehicle/vehicleList', $data);
        } else{
            redirect('login');
        }
    }

    //Listado de Vehículos tabla
    public function showListVehiclesT(){
        if($this->session->userdata('is_logged')){
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->listVehi(),
                'script_url' => base_url('assets/js/exportVehi.js') 
            );
            $this->load->view('vehicle/vehicleListTable', $data);
        } else{
            redirect('login');
        }
    }

    
    //consultar vehiculo
    public function searchVeh(){
        if($this->session->userdata('is_logged')){
            $license = $this->input->post('license');
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->consultVe($license),
                'script_url' => base_url('assets/js/function.js') 
            );
            $this->load->view('vehicle/vehicleList', $data);
        } else{
            redirect('login');
        }
    }
      
    //Vista Actualizar Vehículo
    public function updateVeh(){
        if($this->session->userdata('is_logged')){
            $license = $this->input->post('license');
            $data = array(
                'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'vehi' => $this->Vehicles->consultVe($license),
                'script_url' => base_url('assets/js/function.js') 
            );
            $this->load->view('vehicle/updateVehicle', $data);
        } else{
            redirect('login');
        }
    }

//------------------------------------ functions -------------------------------------------
    //Registrar entrada de vehiculo
    public function registerEnt(){
        $dir = 'temp/';

        if(!file_exists($dir)){
            mkdir($dir);
        }

        $size = 10;
        $level = 'M';
        $frameSize = 3;

        if($this->session->userdata('is_logged')){
            $license = $this->input->post('licenseP');
            $type = $this->input->post('type');
            $color = $this->input->post('color');
            $date_E = $this->input->post('date_E');
            $time_E = $this->input->post('time_E');
            
            $data = array(
                'licensePlate' => $license,
                'type' => $type,
                'color' => $color,
            );

            $fechaEn = array(
                'date_Entrance' => $date_E,
                'time_Entrance' => $time_E,
                'FK_licensePlate' => $license
            );

            $qr = json_encode(array(
                'FechaEntrada' => $date_E,
                'HoraEntrada' => $time_E,
                'Placa' => $license
            ));

            if(!$this->Vehicles->consultVe($license)){
			        if (!$this->Vehicles->create($data, $fechaEn)) {
                        $this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
                        redirect('vehicle/showVehicles');
                    }
                    $this->session->set_flashdata('msg', 'Se ha registrado con éxito');
	        	    $filename = $dir.$license.'.png';
	                QRcode::png($qr, $filename, $level, $size,$frameSize);
	                $data = array(
	                    'qrCode' => $filename,
	                    'license' => $license,
	                    'type' => $type,
	                    'color' => $color,
	                );
	                $this->load->view('vehicle/qrEntrance', $data);           
            }else{
                if(!$this->Vehicles->consultHist($license)){
                    if (!$this->Vehicles->createHistory($fechaEn)) {
                        $this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
                        redirect('vehicle/showVehicles');
                    }
                    $this->session->set_flashdata('msg', 'Se ha registrado con éxito');
                    $filename = $dir.$license.'.png';
                    QRcode::png($qr, $filename, $level, $size,$frameSize);
                    $data = array(
	                    'qrCode' => $filename,
	                    'license' => $license,
	                    'type' => $type,
	                    'color' => $color,
	                );
                    $this->load->view('vehicle/qrEntrance', $data);
                }else{
                    $this->session->set_flashdata('error', 'El vehículo ya se encuentra en el parqueadero, por favor registre la salida');
                    redirect('vehicle/showVehicles');
                }
            }
  
        }else{
            redirect('login');
        }
    }

     //Registrar salida de vehiculo

     public function registerFins(){
        if($this->session->userdata('is_logged')){
            $IVA= 0.19;
            $idDetails = $this->input->post('idDetails');
            $date_Finish = $this->input->post('date_Finish');
            $time_Finish = $this->input->post('time_Finish');
            $subtotal = $this->input->post('totalCos');
            $subtotal1 = $subtotal * $IVA;
            $totalCost = $subtotal1 + $subtotal;
            

            if (!$this->Vehicles->updateF($idDetails, $date_Finish, $time_Finish, $totalCost)) {
                $this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
                redirect('vehicle/registerEn');
            }
            $data = array(
                'IVA' => $subtotal1,
                'subtotal' => $subtotal,
                'vehi' => $this->Vehicles->Fact($idDetails),
            );
            $this->session->set_flashdata('msg', 'Se ha registrado salida con éxito');
            $this->load->view('vehicle/ticketFinish', $data);           
        }else{
            redirect('login');
        }
     }
    
     //Eliminar historal vehiculo
     public function dropHisV(){
        if($this->session->userdata('is_logged')){
            $idDetails = $this->input->post("idDetails");
            if(!$this->Vehicles->dropHisV($idDetails)){
                $this->session->set_flashdata('msg', 'Se ha eliminado con éxito');
                redirect('vehicle/showHistVehicles');
            }
                $this->session->set_flashdata('error', 'Ha ocurrido un error al eliminarlo, intenta de nuevo');
                redirect('vehicle/showHistVehicles');
        }else{
            redirect('login');
        }
    }

    //importar historial de vehiculos
    
	function uploadDoc()
	{
		$uploadPath = 'uploads/';
		if(!is_dir($uploadPath))
		{
			mkdir($uploadPath,0777,TRUE); 
		}

		$config['upload_path']=$uploadPath;
		$config['allowed_types'] = 'csv|xlsx|xls';
		$config['max_size'] = 1000000000;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('file'))
		{
			$fileData = $this->upload->data();
			return $fileData['file_name'];
		}
		else
		{
			return false;
		}
	}

	
	//Importar historial de vehículos

	public function importHV(){
		if($this->session->userdata('is_logged')){
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$upload_status =  $this->uploadDoc();
			if($upload_status!=false)
			{
				$inputFileName = 'uploads/'.$upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$firstRow = true;
				foreach($sheet->getRowIterator() as $row)
				{
					if ($firstRow) {
						$firstRow = false;
						continue; 
					}
					$license = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
					$type =$spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
					$color =$spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
					$DaEntrance =$spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex())->getValue();
					$TiEntrance =$spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex())->getValue();
                    $DaFinish =$spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex())->getValue();
                    $TiFinish =$spreadsheet->getActiveSheet()->getCell('G'.$row->getRowIndex())->getValue();
                    $totalCostCell = $spreadsheet->getActiveSheet()->getCell('H'.$row->getRowIndex())->getValue();
                    $totalCost = str_replace(['$', '.'], '', $totalCostCell);
                   
				   
                    $data = array(
                        'licensePlate' => $license,
                        'type' => $type,
                        'color' => $color,
                    );
        
                    $fechaEn = array(
                        'date_Entrance' => $DaEntrance,
                        'time_Entrance' => $TiEntrance,
                        'date_Finish' => $DaFinish,
                        'time_Finish' => $TiFinish,
                        'totalCost' => $totalCost,
                        'FK_licensePlate' => $license
                    );

                    if(!$this->Vehicles->consultVe($license)){
                        if (!$this->Vehicles->create($data, $fechaEn)) {
                            $this->session->set_flashdata('error', 'Ha ocurrido un error');
                            redirect('vehicle/showHistVehicles');
                        }           
                    }else{
                        if (!$this->Vehicles->createHistory($fechaEn)) {
                            $this->session->set_flashdata('error', 'Ha ocurrido un error');
                            redirect('vehicle/showHistVehicles');
                        }
                    }
					$count_Rows++;
				}
				$this->session->set_flashdata('msg','Importado con éxito');
				redirect(base_url('vehicle/showHistVehicles'));
			}
			else
			{
				$this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('vehicle/showHistVehicles'));
			}
			}
		}else{
			redirect('login');
		}
	}

    
	
	//Importar vehículos

	public function importV(){
		if($this->session->userdata('is_logged')){
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$upload_status =  $this->uploadDoc();
			if($upload_status!=false)
			{
				$inputFileName = 'uploads/'.$upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$firstRow = true;
                foreach($sheet->getRowIterator() as $row)
                {
                    if ($firstRow) {
                        $firstRow = false;
                        continue; 
                    }
                    $license = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex())->getValue();
                    $type = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex())->getValue();
                    $color = $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex())->getValue();

                    $data = array(
                        'licensePlate' => $license,
                        'type' => $type,
                        'color' => $color,
                    );
                    $this->db->insert('vehicle',$data);
					$count_Rows++;
                }
                
				$this->session->set_flashdata('msg','Importado con éxito');
				redirect(base_url('vehicle/showVehiclesL'));
               
			}
			else
			{
				$this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('vehicle/showVehiclesL'));
			}
			}
		}else{
			redirect('login');
		}
	}

    //Actualizar Vehiculo
    public function updateV(){
        if($this->session->userdata('is_logged')){
            $license = $this->input->post('license');
            $color = $this->input->post('color');

            if(!$this->Vehicles->updateV($color,$license)){
                $this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('vehicle/showVehiclesL'));
            }else{
                $this->session->set_flashdata('msg','Actualizado con éxito');
				redirect(base_url('vehicle/showVehiclesL'));
				
			}
        }else{
            redirect('login');
        }
    }
}
?>
