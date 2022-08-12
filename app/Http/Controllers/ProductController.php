<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as MP;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function get_id($ids)
    {
        $dataProduct = Mp::where('id',$ids)->first();
        $dataTemplate = Setting::where('keys','posting')->first();
        $str = str_replace("{{name}}",$dataProduct->name,$dataTemplate->text);
        $str = str_replace("{{descreiption}}",$dataProduct->description,$str);
        $str = str_replace("{{number}}",$dataProduct->id,$str);
        $link = "Video Not Found";
        $instagram = "Instagram Not Found";
        if (Storage::disk()->exists("public/".$dataProduct->itemid.".mp4")) {
            $link = '<a href="'.Storage::url('public/'.$dataProduct->itemid.'.mp4').'" target="_blank">Video</a>';
        }
        echo('<textarea  rows="30" cols="100">'.$str.'</textarea>'   .'<br/>'.$link);
    }
    
}
