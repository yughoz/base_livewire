<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as MP;
use App\Models\View_product as VP;
use Auth;
use Livewire\WithPagination;
date_default_timezone_set("Asia/Jakarta");

class Product_list extends Component
{
    use WithPagination;
    public $link;     
    public $json;
    public $id_update = false;
    public $searchText = "" ;
    public $searchNumber = "" ;
    public $searchNumText = "" ;
    public $fingerprint = "" ;
    public $source = "" ;
    public $color_shopee = "#ee4d2d";
    public $page = 1;
 
    protected $queryString = [
        'searchNumText' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],
        'source' => ['except' => ''],
    ];
    // protected $paginationTheme = 'bootstrap';
    public $dataProducts = [];
    

    public function render()
    {
        $dataProduct = MP::orderBy('updated_at', 'DESC');

        // if(!empty($this->searchNumber)){
        //     $dataProduct->where('id' ,$this->searchNumber);
        // } else {
        //     $dataProduct->where("name", 'like',"%".$this->searchText."%")
        //     ->orWhere("local_name", 'like',"%".$this->searchText."%");
        // }
        if(!empty($this->searchNumText)){
            if (intval($this->searchNumText) > 0) {
                $dataProduct->where('id' ,intval($this->searchNumText));
                // dd($dataProduct); 
            } else {
                $dataProduct->where(function($query) {
                    $query->where("name", 'like',"%".$this->searchNumText."%");
                    $query->orWhere("local_name", 'like',"%".$this->searchNumText."%");
                });
                
                // $dataProduct->where("name", 'like',"%".$this->searchNumText."%")
                // ->orWhere("local_name", 'like',"%".$this->searchNumText."%");
            }
        } 
        
        if (!empty($this->source)) {
            $dataProduct->where('source',$this->source);
            // dd($this->source);
        }

        return view('livewire.product_list.index', [
            'dataProduct' => $dataProduct->paginate(10),
        ]);
    }

    public function updatingSearchNumText()
    {
        $this->resetPage();
    }


    public function home()
    {
        $this->searchNumText = null;
        $this->source = null;
        $this->resetPage();
    }

    public function filter_source($source)
    {
        $this->resetPage();
        $this->dispatchBrowserEvent('video_src', ['item' => ""]);
        $this->source = $source;
    }

    public function submitSearch()
    {
        
    }

    public function getcolor()
    {
        if ($this->source == "shopee") {
            return "#ee4d2d";
        } elseif ($this->source == "tokped") {
            return "#04b023";
        }
        return "#b00404";
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

    public function show_add($product_id)
    {
        // dd($product_id);
        $uid =  $this->fingerprint."_".date('Ymd')."_".$product_id;
        $prodGet = VP::where(['uid'=>$uid])->first();
        if (!$prodGet) {
            VP::create([
                "uid" => $uid,
                "product_id" => $product_id,
                "fingerprint" => $this->fingerprint,
            ]);
        }
    }
    
    public function paginationView()
    {
        return 'livewire.product_list.custom-pagination-links-view';
    }

}
