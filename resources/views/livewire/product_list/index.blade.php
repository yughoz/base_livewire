<div class="container bootdey">
  <div class=" p-4" style="background-color: {{$this->getcolor()}};">

      <h4 class="text-white">Unik Cek</h4>
      <span class="text-white">Barang unik dan pasti berguna</span>
    </div>
  <nav class="navbar navbar-expand-sm navbar-light" style="background-color: {{$this->getcolor()}};">
    <form class="form-inline my-2 my-md-0" wire:submit.prevent="submitSearch" >
      <input class="form-control" type="text" placeholder="Ketik Nomor/Nama" wire:model.debounce.500ms="searchNumText">
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample03">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" wire:click="home" style="color:#ededed;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" wire:click="filter_source('shopee')" style="color:#ededed;">Shopee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" wire:click="filter_source('tokped')" style="color:#ededed;">Tokped</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#ededed;">Kategori</a>
          <div class="dropdown-menu" aria-labelledby="dropdown03">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <main role="main">
    <div class="row product-list"> @foreach ($dataProduct as $p) <div class="col-md-4">
        <section class="panel"> 
          @if (Storage::disk()->exists("public/".$p->itemid.".mp4") ) 
            <div class="embed-responsive embed-responsive-16by9 divVideo">
                <video class="embed-responsive-item {{$p->itemid}} " controls muted id="v_{{$p->itemid}}" val="{{ $app->make('url')->to('/').Storage::url('public/'.$p->itemid.'.mp4')}}">
                    <source src="{{ $app->make('url')->to('/').Storage::url('public/'.$p->itemid.'.mp4')}}" id="{{$p->itemid}}"> Your browser does not support the video tag.
                </video>
                <a href="{{$p->url}}" target="_blank" class="adtocartVideos"  wire:click="show_add({{$p->id}})">
                  <img src="{{ $app->make('url')->to(($p->source =='shopee' ? '/storage/shopee.ico' : '/storage/tokopedia.ico')) }}" class="imgChart"  alt="" />
                  <!-- <i class="fa fa-shopping-cart"></i> -->
                </a>
            </div>
          @else 
            <div class="pro-img-box">
              <img src="{{ $this->get_img($p) }}" alt="" />
              <a href="{{$p->url}}" target="_blank" class="adtocart"  wire:click="show_add({{$p->id}})">
                <img src="{{ $app->make('url')->to(($p->source =='shopee' ? '/storage/shopee.ico' : '/storage/tokopedia.ico')) }}" class="imgChart"  alt="" />
                <!-- <i class="fa fa-shopping-cart"></i> -->
              </a>
            </div> 
          @endif <div class="panel-body text-center">
            <h4>
              <a href="{{$p->url}}" target="_blank" class="pro-title" wire:click="show_add({{$p->id}})"> No {{$p->id}}. {{$p->local_name}} ({{$p->source}})
              </a>
            </h4>
            <p class="price">RP {{ $this->get_price($p)}}</p>
          </div>
        </section>
      </div> @endforeach
      <!-- <div class="col-md-4"><section class="panel"><div class="pro-img-box"><img src="https://via.placeholder.com/250x220/6495ED/000000" alt="" /><a href="#" class="adtocart"><i class="fa fa-shopping-cart"></i></a></div><div class="panel-body text-center"><h4><a href="#" class="pro-title">
                                Leopard Shirt Dress
                            </a></h4><p class="price">$300.00</p></div></section></div> -->
    </div>
    <section class="panel">
      <div class="panel-body">
        <div class="pull-right">
          {{ $dataProduct->links() }}
          <!-- <ul class="pagination pagination-sm pro-page-list"><li><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">»</a></li></ul> -->
        </div>
      </div>
    </section>
    
  </main>
</div>


<script>
    
    document.addEventListener('livewire:load', function () {
        console.log("fp",$.fingerprint());
        @this.fingerprint = $.fingerprint()
 
    })

    window.addEventListener('video_src', (e) => {
      $('video').each(function() {
        console.log("video_src",$(this).attr("val"));

        $(this).html('<source src="'+$(this).attr("val")+'">' );


        // videoSrc = $(this).attr('src', '##');
        // $("#divVideo video")[0].load();
        // $video[0].load();
        // $video[0].play();

          // alert( this.id );
      });
    });

</script>