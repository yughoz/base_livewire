<?php

namespace App\Http\Livewire\Helpers;

use Livewire\Component;

class Form extends Component
{
    
    public $get_data;
    public $action;
    public $modal_id;
    public $local_name ="1234";
    public $module_code;
    public $arr_form = [
        "local_name" => [
            "type" => "text",
        ],

        "link" => [
            "type" => "text",
        ],

    ];

    // public function mount($arr_form)
    // {
    //     $this->arr_form = $arr_form;
    // }
    public function render()
    {
        // dd($this->arr_form);    
        return view('livewire.helpers.form');
    }

    public function wording($value)
    {
        $value = str_replace("-"," ",$value);
        $value = str_replace("_"," ",$value);
        $value = ucfirst($value);
        return $value;
    }
}
