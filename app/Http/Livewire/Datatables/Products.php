<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Product;
use Auth;

class Products extends LivewireDatatable
{
    public $model = Product::class;
    public $module_name = "user";
    // ::with('roles')->latest()
    /**s
     * Write code on Method
     *
     * @return response()
     */

    public function builder()
    {
        $dataBuilder = Product::query()->with('roles');
        return $dataBuilder;
    }

    public function columns()
    {
        return [
            
            Column::name('created_at'),
            Column::name('id')->label('ID'),
            Column::name('source'),
            Column::name('name'),
            Column::name('local_name'),
            Column::name('price'),
            Column::name('stock'),
            Column::name('url'),
            Column::name('rating_start'),
            Column::callback(['itemid'], function ($id) {
                return view('livewire.products.action-videos', ['id' => $id, 'module_name' => $this->module_name]);
            })->label('Video'),
            Column::callback(['itemid', 'name'], function ($id, $name) {
                return view('adminlte::livewire.helpers.table-actions', ['id' => $id, 'module_name' => $this->module_name]);
            }),
        ];
    }
}
