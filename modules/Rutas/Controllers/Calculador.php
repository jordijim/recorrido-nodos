<?php

namespace Modules\Rutas\Controllers;

class Calculador
{
    protected $cities;
    protected $connections;
    protected $current_route;
    protected $destination_city_key;
    protected $arrival_at_destination;

    public function __construct()
    {
        $this->cities       = ['Logroño','Zaragoza','Teruel','Madrid','Lleida','Alicante','Castellón','Segovia','Ciudad Real'];
        $this->connections  =  [[0,4,6,8,0,0,0,0,0],
                                [4,0,2,0,2,0,0,0,0],
                                [6,2,0,3,5,7,0,0,0],
                                [8,0,3,0,0,0,0,0,0],
                                [0,2,5,0,0,0,4,8,0],
                                [0,0,7,0,0,0,3,0,7],
                                [0,0,0,0,4,3,0,0,6],
                                [0,0,0,0,8,0,0,0,4],
                                [0,0,0,0,0,7,6,4,0]];
        $this->current_route = [];
        $this->arrival_at_destination = false;
    }

    /**
     * @param String $origin
     * @param String $destination
     */
    public function inicio(String $origin, String $destination) :void
    {
        $city_key = array_search($origin,$this->cities,false);
        $this->destination_city_key = array_search($destination,$this->cities,false);
        $this->add_to_final_route($city_key, 0);

        while( $this->arrival_at_destination == false ){
            $this->get_low_cost_from_city($this->current_route[count($this->current_route)-1]['city_key'], null);
            dd($this->current_route);
        }

        dd($this->current_route);
    }

    /**
     * @param int $city_key
     * @param int|null $avoid_city
     */
    private function get_low_cost_from_city(int $city_key, ?int $avoid_city) :void
    {
        $minimum_value = false;
        $key_value     = 0;
        for($i=0; $i<count($this->connections[$city_key]); $i++){
            if( $i == $city_key ) continue;
            if( !is_null($avoid_city) ){
                if( $i == $avoid_city ) continue;
            }

            if( ($this->connections[$city_key][$i] < $minimum_value) && $this->connections[$city_key][$i] > 0 ){
                $minimum_value = $this->connections[$city_key][$i];
                $key_value     = $i;
            }
        }

        if( $this->city_key_exist_in_array_route($key_value) == false ){
            if($minimum_value !== false){
                $this->add_to_final_route($key_value,$minimum_value);
                if( $key_value == $this->destination_city_key ) $this->arrival_at_destination = true;
            }
            else
                $this->remove_and_search_new_city();
        }
    }

    /**
     * @param int $city_key
     * @return bool
     */
    private function city_key_exist_in_array_route(int $city_key) :bool
    {
        foreach($this->current_route as $current_city){
            if($current_city['city_key'] === $city_key) return true;
        }
        return false;
    }

    private function remove_and_search_new_city() :void
    {
        $city_key_not_valid = $this->current_route[count($this->current_route)-1]['city_key'];
        $last_valid_city_key = $this->current_route[count($this->current_route)-2]['city_key'];
        $this->get_low_cost_from_city($last_valid_city_key, $city_key_not_valid);
    }

    /**
     * @param int $city_key
     * @param int $cost
     */
    private function add_to_final_route(int $city_key, int $cost) :void
    {
        array_push($this->current_route,[
            'city_key'  => $city_key,
            'city_name' => $this->cities[$city_key],
            'cost'      => $cost
        ]);
    }
}
