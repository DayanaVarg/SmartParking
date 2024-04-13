
<?PHP 
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends CI_Model {

    public function __construct(){
		  $this->load->database();
	  }
    
    //Listar vehiculos sin salida
    public function  showVehicles(){
        $this->db->join('activitydetails','activitydetails.FK_licensePlate  = vehicle.licensePlate');
        $this->db->order_by('activitydetails.date_Entrance', 'DESC');
        $this->db->order_by('activitydetails.time_Entrance', 'DESC');
        $vehicle =  $this->db->get_where('vehicle', array('activitydetails.date_Finish' => null));
       
        if(!$vehicle->result()){
			    return false;
		    }return $vehicle->result();
    }

    //registrar entrada
    public function create($data, $fechaEn){
        if($this->db->insert('vehicle', $data)){
			if($this->db->insert('activitydetails', $fechaEn)){
				return true;
			};
		}return false;
    }

    public function createHistory($fechaEn){
        if($this->db->insert('activitydetails', $fechaEn)){
            return true;
        };
    }

    //consultar vehiculo
    public function consultVe($license){
        $vehicle =  $this->db->get_where('vehicle', array('vehicle.licensePlate' => $license));
        if(!$vehicle->result()){
            return false;
        }return $vehicle->result();
    }

    //consultar vehiculo sin salida
    public function consultHist($FK_licensePlate){
        $this->db->join('vehicle','vehicle.licensePlate  = activitydetails.FK_licensePlate ');
        $vehicle =  $this->db->get_where('activitydetails', array('activitydetails.date_Finish' => null, 'activitydetails.FK_licensePlate' => $FK_licensePlate));
        if(!$vehicle->result()){
			    return false;
		    }return $vehicle->result();
    }

     //consultar vehiculo sin salida
     public function consultHis($date_Entrance, $time_Entrance, $FK_licensePlate){
        $this->db->join('vehicle','vehicle.licensePlate  = activitydetails.FK_licensePlate ');
        $vehicle =  $this->db->get_where('activitydetails', array('activitydetails.date_Finish' => null, 'activitydetails.date_Entrance' => $date_Entrance, 'activitydetails.time_Entrance'=> $time_Entrance, 'activitydetails.FK_licensePlate' => $FK_licensePlate));
       
        if(!$vehicle->result()){
			    return false;
		    }return $vehicle->result();
    }


    //registra salida
    public function updateF($idDetails, $date_Finish, $time_Finish, $totalCost){
        $this->db->set('date_Finish', $date_Finish);
		$this->db->set('time_Finish', $time_Finish);
        $this->db->set('totalCost', $totalCost);
		$this->db->where('idDetails', $idDetails);

		if($this->db->update('activitydetails')){
			return true;
		} return false;
    }

     //Listar vehiculos 
     public function showHistVehicles(){
        $this->db->join('vehicle', 'vehicle.licensePlate = activitydetails.FK_licensePlate');
        $this->db->order_by('activitydetails.date_Entrance', 'DESC');
        $this->db->order_by('activitydetails.time_Entrance', 'DESC');
        $this->db->where('activitydetails.date_Finish IS NOT NULL');
        $vehicle = $this->db->get('activitydetails');
        
        if(!$vehicle->result()){
            return false;
        }
        return $vehicle->result();
    }


    //listar vehiculo específico
    public function searchHistVehi($license){
        $this->db->join('vehicle', 'vehicle.licensePlate = activitydetails.FK_licensePlate');
        $this->db->order_by('activitydetails.date_Entrance', 'DESC');
        $this->db->order_by('activitydetails.time_Entrance', 'DESC');
        $this->db->where('activitydetails.date_Finish IS NOT NULL');
        $this->db->where('activitydetails.FK_licensePlate', $license);
        $vehicle = $this->db->get('activitydetails');
        
        if(!$vehicle->result()){
            return false;
        }
        return $vehicle->result();
    }

    public function dropHisV($idDetails){
        $this->db->delete('activitydetails', array('idDetails' => $idDetails));
    }

}

?>