<?php
require_once APPPATH.'../phpqrcode/qrlib.php';


class Vehicle extends CI_Controller{

    public function __construct(){
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('Vehicles');
        $this->load->helper('date');
        date_default_timezone_set('America/Bogota');
	}

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

    //views
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
                    'alerta' => $alerta, // Pasar el mensaje de alerta a la vista
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

    //functions
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
        $idDetails = $this->input->post('idDetails');
        $date_Finish = $this->input->post('date_Finish');
        $time_Finish = $this->input->post('time_Finish');
        $totalCost = $this->input->post('totalCos');

        if (!$this->Vehicles->updateF($idDetails, $date_Finish, $time_Finish, $totalCost)) {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
            redirect('vehicle/registerEn');
        }
        $this->session->set_flashdata('msg', 'Se ha registrado salida con éxito');
        redirect('vehicle/showVehicles');
     }
    
     //Eliminar historal vehiculo
     public function dropHisV(){
        $idDetails = $this->input->post("idDetails");
        if(!$this->Vehicles->dropHisV($idDetails)){
            $this->session->set_flashdata('msg', 'Se ha eliminado con éxito');
            redirect('vehicle/showHistVehicles');
        }
            $this->session->set_flashdata('error', 'Ha ocurrido un error al eliminarlo, intenta de nuevo');
            redirect('vehicle/showHistVehicles');
     
    }
}
?>