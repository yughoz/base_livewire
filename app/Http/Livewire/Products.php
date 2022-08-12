<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\Product as MP;
use Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Products extends Component
{
    use WithFileUploads;
    //INIT
    public $id_update = false;
    //END INIT
    
    public $link;     
    public $json;

    public $local_name;
    public $url;
    public $ids;
    public $idC;
    public $video;
    public $resource;
    public $today;
    
    public $form_create_tokped = [
        "json" => [
            "type" => "textarea",
        ],

    ];

    public $form_create = [
        "idC" => [
            "type" => "text",
        ],
        "json" => [
            "type" => "textarea",
        ],

    ];

    public $form_update = [
        "local_name" => [
            "type" => "textarea",
        ],
        "url" => [
            "type" => "text",
        ],
        "ids" => [
            "type" => "text",
        ],
        // "resource" => [
        //     "type" => "text",
        // ],

    ];

    public $upload_video = [
        "video" => [
            "type" => "file",
        ],

    ];


    public function render()
    {
        $this->today = MP::whereDate('created_at', Carbon::today())->count();
        return view('livewire.products.index');
    }


    public function wording($value)
    {
        $value = str_replace("-"," ",$value);
        $value = str_replace("_"," ",$value);
        $value = ucfirst($value);
        return $value;
    }
    
    public function get_data()
    {
        
    }
    


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // $this->validate([
        //     'link'     => 'required',
        // ]);

        $jsonData = json_decode($this->json);
     
        // dd($jsonData->data);
        $prodGet = Mp::where('itemid',$jsonData->data->itemid)->first();

        if ($prodGet) {
            $prodGet->update([
                'itemid' => $jsonData->data->itemid,
                'name' => $jsonData->data->name,
                'local_name' => $jsonData->data->name,
                'price' => $jsonData->data->price,
                'stock' => $jsonData->data->stock,
                'rating_start' => $jsonData->data->item_rating->rating_star,
                'historical_sold' => $jsonData->data->historical_sold,
                'shop_location' => $jsonData->data->shop_location,
                'description' => $jsonData->data->description,
                'images' => json_encode($jsonData->data->images),
                'source' => "shopee",
            ]);
        } else {
            $product = MP::create([
                'id'   => $this->idC,
                'itemid' => $jsonData->data->itemid,
                'name' => $jsonData->data->name,
                'local_name' => $jsonData->data->name,
                'price' => $jsonData->data->price,
                'stock' => $jsonData->data->stock,
                'rating_start' => $jsonData->data->item_rating->rating_star,
                'historical_sold' => $jsonData->data->historical_sold,
                'shop_location' => $jsonData->data->shop_location,
                'description' => $jsonData->data->description,
                'images' => json_encode($jsonData->data->images),
                'source' => "shopee",
            ]);
        }




        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    } 
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function storeVideo()
    {
        $extension = $this->video->extension();
        $this->video->storePubliclyAs('public', $this->id_update.".".$extension);
        $this->dispatchBrowserEvent('hide_modal', ['item' => ""]);

        $this->emit('refreshLivewireDatatable');
        // $this->emit('hide_modal');
    }
    public function storeTokped()
    {
       // $this->validate([
       //     'link'     => 'required',
       // ]);

       $jsonDataRaw = json_decode($this->json);
    //    dd($jsonDataRaw[0]);

       $jsonData = $jsonDataRaw[0]->data->pdpGetLayout;
    
    //    dd($jsonData->components[4]->data);
       $prodGet = Mp::where('itemid',$jsonData->basicInfo->id)->first();


        $price = 0;
        // dd($jsonData->components[3]->data[0]);
        if(!empty($jsonData->components[2]->data[0]->children[0]->price)){
            $price = $jsonData->components[2]->data[0]->children[0]->price;
        } else if(!empty($jsonData->components[3]->data[0]->price->value)){
            $price = $jsonData->components[3]->data[0]->price->value;
        }


       if ($prodGet) {
           $prodGet->update([
                'itemid' => $jsonData->basicInfo->id,
                'name' => $this->wording($jsonData->basicInfo->alias),
                //    'local_name' => $this->wording($jsonData->basicInfo->alias),
                'price' => $price,
                'stock' => $jsonData->components[2]->data[0]->totalStockFmt ?? 0,
                'rating_start' => $jsonData->basicInfo->stats->rating,
                'historical_sold' => intval($jsonData->basicInfo->txStats->itemSoldFmt),
                'shop_location' => $jsonData->basicInfo->shopName,
                'description' => $jsonData->components[4]->data[0]->content[5]->subtitle,
                'images' => json_encode($jsonData->components[0]->data[0]->media),
                'source' => "tokped",
                // 'url' => "http",
           ]);
       } else {
           $product = MP::create([
                'itemid' => $jsonData->basicInfo->id,
                'name' => $this->wording($jsonData->basicInfo->alias),
                'local_name' => $this->wording($jsonData->basicInfo->alias),
                'price' => $price,
                'stock' => $jsonData->components[2]->data[0]->totalStockFmt ?? 0,
                'rating_start' => $jsonData->basicInfo->stats->rating,
                'historical_sold' => intval($jsonData->basicInfo->txStats->itemSoldFmt),
                'shop_location' => $jsonData->basicInfo->shopName,
                'description' => $jsonData->components[4]->data[0]->content[5]->subtitle,
                'images' => json_encode($jsonData->components[0]->data[0]->media),
                'source' => "tokped",
           ]);
       }




       $this->resetInputFields();
       $this->emit('reloadAll');
       $this->emit('refreshLivewireDatatable');
   }

    public function edit($id)
    {
        $this->updateMode = true;
        $dataEdit = Mp::where('itemid',$id)->first();
        $this->id_update = $id;
        $this->url = $dataEdit->url;
        $this->local_name = $dataEdit->local_name;
        $this->resource = $dataEdit->resource;
        $this->ids = $dataEdit->id;
        
        // echo print_r($setting->roles->first()->id);
    }

    public function cancel()
    {
        $this->id_update = false;
        $this->resetInputFields();

    }

    public function update()
    {
        $validatedDate = $this->validate([
            'url' => 'required',
            'local_name' => 'required',
            'ids' => 'required',
        ]);

        if ($this->id_update) {

            $setting = Mp::where('itemid', $this->id_update)->first();
            $setting->update([
                'url' => $this->url,
                'local_name' => $this->local_name,
                'id' => $this->ids,
            ]);

            // $setting->givePermissionTo('add');

            if (!empty($this->role)) {
                $setting->roles()->detach();
                $setting->assignRole($this->role);
            }

            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields(){
        $this->json = '';
        $this->link = '';
        $this->idC = '';
        
    }

    public function delete($id)
    {
        if($id){
            Mp::where('itemid',$id)->delete();
            session()->flash('message', 'Mps Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }


    public function delete_video($id)
    {
        if($id){
            Storage::delete('public/'.$id.".mp4");
        }
        $this->emit('refreshLivewireDatatable');
    }

}
