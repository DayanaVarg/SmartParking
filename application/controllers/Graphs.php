<?php

class Graphs extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Vehicles');
		$this->load->library(array('session'));
	}
	
//Vista estadísticas
	public function index(){
		if($this->session->userdata('is_logged')){
			$cars = $this->Vehicles->getCar();
			$mot = $this->Vehicles->getMot();
			$total = $cars + $mot;

			$graph_dat = [
				['Mes', 'Total']
			];
			
			$meses = [
				'01' => 'Ene',
				'02' => 'Feb',
				'03' => 'Mar',
				'04' => 'Abr',
				'05' => 'May',
				'06' => 'Jun',
				'07' => 'Jul',
				'08' => 'Ago',
				'09' => 'Sep',
				'10' => 'Oct',
				'11' => 'Nov',
				'12' => 'Dic'
			];
			
			foreach ($meses as $numero => $abreviatura) {
				$totalT = 0;
				$result = $this->Vehicles->getfecE($numero)->result_array();
				
				foreach ($result as $row) {
					$totalT += (float) $row['totalCost'];
				}
			
				$graph_dat[] = [$abreviatura, $totalT];
			}

			$data = array(
				'graph_data' => array(
					array('label' => 'Carros', 'value' => $cars, 'color' => '#3366cc'),
					array('label' => 'Motos', 'value' => $mot, 'color' => '#dc3912'),
					array('label' => 'Total', 'value' => $total, 'color' => '#ff9900'),
				),
				
				'graph_dat' =>json_encode($graph_dat),
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
                'cars' => $this->Vehicles->getCar(),
                'mot' => $this->Vehicles->getMot(),
                'total' => $cars + $mot,
	
			);
		
			$this->load->view('vehicle/viewGraphic',$data);
		}else{
			redirect('login');
		}
	}
}