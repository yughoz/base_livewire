<?php

namespace App\Http\Livewire\Datatables;
date_default_timezone_set('Asia/Jakarta');

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Product;
use App\Models\View_product as VP;
use Auth;

class Report extends LivewireDatatable
{
    public $model = Product::class;
    public $module_name = "product";
    // ::with('roles')->latest()
    /**s
     * Write code on Method
     *
     * @return response()
     */

    public function builder()
    {
        $dataBuilder = VP::query();
        return $dataBuilder;
    }

    public function columns()
    {
        return [
            
            Column::name('created_at'),
            Column::name('product_id')->label('ID'),
            Column::name('fingerprint'),
        ];
    }
}
