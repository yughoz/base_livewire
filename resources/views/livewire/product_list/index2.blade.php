<div class="container bootdey">
  <!-- <nav class="navbar navbar-toggleable-sm bg-faded navbar-light fixed-top fixed-top-2">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="/" class="navbar-brand">One</a>
    <div class="navbar-collapse collapse" id="navbar1">
        <ul class="navbar-nav">
            ..
        </ul>
    </div>
</nav> -->
<!-- <nav class="navbar  navbar-dark bg-dark">
  <span class="navbar-brand mb-0 h1">Navbar</span>

</nav> -->
<div class="bg-dark p-4">
          <a class="nav-link" href="#"><h4 class="text-white">Unik Cek</h4></a>
  
      
      <span class="text-muted">Barang unik dan pasti berguna</span>
    </div>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
    <form class="form-inline my-2 my-md-0">
      <input class="form-control" type="text" placeholder="Ketik Nomor/Nama" wire:model="searchNumber">
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample03">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Shopee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tokped</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
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
        <section class="panel"> @if (Storage::disk()->exists("public/".$p->itemid.".mp4")) <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" controls loop muted>
              <source src="{{ Storage::url('public/'.$p->itemid.'.mp4')}}"> Your browser does not support the video tag.
            </video>
          </div> @else <div class="pro-img-box">
            <img src="{{ $this->get_img($p) }}" alt="" />
            <a href="{{$p->url}}" target="_blank" class="adtocart">
              <i class="fa fa-shopping-cart"></i>
            </a>
          </div> @endif <div class="panel-body text-center">
            <h4>
              <a href="{{$p->url}}" target="_blank" class="pro-title"> No {{$p->id}}. {{$p->local_name}}
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