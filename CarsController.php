<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends MY_Controller {

	public function index($year = 2013){
		$search = $year;
		if($year != 2011 && $year != 2015){	
			$start 	= $year - 1;
			$end 	= $year + 1;
		}else{
			if($year == 2011){
				$start = 2011;
				$year = 2012;
				$end = 2013;
			}
			if($year == 2015){
				$start = 2013;
				$year = 2014;
				$end = 2015;
			}
		}

		$searchYear = $start.','.$year.','.$end;

		$query = 'SELECT *, GROUP_concat(year,":",price) as theprice
								FROM car_price A join car B  on A.car_id = B.car_id WHERE year in('.$searchYear.') group by A.car_id order by year';

		$car_price  = $this->db->query($query)->result();

		//print_r($car_price);exit;
		$data = [];
		$id = '';
		foreach($car_price as $car){
			$price = explode(',',$car->theprice);
			$data[] = [
				'car_name' 	=> $car->car_name,
				substr($price[0],0,4) 	=> substr($price[0],5,strlen($price[0])),
				substr($price[1],0,4) 	=> substr($price[1],5,strlen($price[1])),
				substr($price[2],0,4) 	=> substr($price[2],5,strlen($price[2])),				
			];
		}

		foreach($data as $k => $a){
			ksort($a, SORT_NUMERIC);
			$data[$k] = $a;
		}

		$this->mViewData['years']	= [$start,$year,$end]; 
		$this->mViewData['data'] 	= $data;
		$this->mViewData['search']	= $search;

		$this->render('cars', 'full_width');
	}

}
