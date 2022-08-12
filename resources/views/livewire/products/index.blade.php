<div>

@include('adminlte::livewire.helpers.modals',['module_code' => 'products','body' => 'helpers.form','modal_id' => 'createModal','action' => 'store()','arr_form' => $form_create])
@include('adminlte::livewire.helpers.modals',['module_code' => 'products','body' => 'helpers.form','modal_id' => 'updateModal','action' => 'update()','arr_form' => $form_update])
@include('adminlte::livewire.helpers.modals',['module_code' => 'products','body' => 'helpers.form','modal_id' => 'createTokpedModal','action' => 'storeTokped()','arr_form' => $form_create_tokped])
@include('adminlte::livewire.helpers.modals',['module_code' => 'products','body' => 'products.upload-videos','modal_id' => 'videoModal','action' => 'storeVideo()','arr_form' => $upload_video,'action_remove' => 'delete_video'])
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $today }}</h3>
        <p>Today Click</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>53 <sup style="font-size: 20px">%</sup>
        </h3>
        <p>Bounce Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>44</h3>
        <p>User Registrations</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>
        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> -->
</div>

<div class="card">
    <div class="card-body">
        @can('create products')        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <span>
                <i data-toggle="tooltip" data-placement="top" title="Add User" class="fa fas fa-plus">Shopee</i>
            </span>
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTokpedModal">
            <span>
                <i data-toggle="tooltip" data-placement="top" title="Add User" class="fa fas fa-plus">Tokped</i>
            </span>
        </button>
        @endcan            
        
        <livewire:datatables.products
            searchable="name,local_name,shop_location"
        />
    </div>
</div>

</div>


