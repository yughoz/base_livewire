<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as MP;
use Auth;
use Livewire\WithPagination;
class Product_list2 extends Component
{

    use WithPagination;
    public $link;     
    public $json;
    public $id_update = false;
    public $searchText = "" ;
    public $searchNumber = "" ;
    // protected $paginationTheme = 'bootstrap';
    // public $dataProduct = [];
    

    public function render()
    {
        $dataProduct = MP::orderBy('updated_at', 'DESC');

        if(!empty($this->searchNumber)){
            $dataProduct->where('id' ,$this->searchNumber);
        } else {
            $dataProduct->where("name", 'like',"%".$this->searchText."%")
            ->orWhere("local_name", 'like',"%".$this->searchText."%");
        }
        

        return view('livewire.product_list.index2', [
            'dataProduct' => $dataProduct->paginate(10),
        ]);
    }
    
    public function get_data()
    {
        
    }
    public function get_video($data)
    {
        $data =  Storage::url('video/'.$p->itemid.'.mp4');
        return $data;
    }

    public function get_img($param)
    {
        $imgarr = json_decode($param->images,true);
        
        if (!empty($imgarr[0])) {
            $random_keys=count($imgarr)-1;
            if ($param->source == "tokped") {
                // dd($imgarr[0]);    
                return $imgarr[rand(0,$random_keys)]['urlThumbnail'] ;
            } else {
                return "https://cf.shopee.co.id/file/".$imgarr[rand(0,$random_keys)];
            }
        }

        return "#";
    }

    public function get_price($data)
    {
        $price = $data->price;
        if (strlen($price)> 8) {
            return number_format(substr($price,0,-5));
        } else {
            return number_format($price);
        }
    }
    

    public function paginationView()
    {
        return 'livewire.product_list.custom-pagination-links-view';
    }

}
