<?php
namespace App\Services;
use App\Radio;
class Getchild
{
    public function get_child($main_category){
        $child_id_array = array();
        foreach($main_category->childs as $child){
          if(count($child->childs)) {
                foreach($this->get_child($child) as $ids){
                    array_push($child_id_array,$ids);
                }
          }else {
            array_push($child_id_array, $child->id);
          }
       }  
       return $child_id_array;     
       }
}

