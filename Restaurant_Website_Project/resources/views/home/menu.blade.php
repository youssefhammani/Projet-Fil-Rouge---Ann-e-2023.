@extends('home')

@section('content')

<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Our Menu</h2>
      <p>Check Our <span>Yummy Menu</span></p>
    </div>

    <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

      <li class="nav-item">
        <a class="nav-link active show cattt" data-bs-toggle="tab" onclick="searche1()">
          <h4>All</h4>
        </a>
      </li>

      @foreach ($categories as $item)   
        <li class="nav-item">
          <a class="nav-link active show cattt" data-bs-toggle="tab" onclick="searche({{ $item->id }})">
            <h4>{{ $item->category }}</h4>
          </a>
        </li>
      @endforeach

    </ul>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

      <div class="tab-pane fade active show" id="menu-starters">
        
        <div class="tab-header text-center">
          <p>Menu</p>
          <h3>Starters</h3>
        </div>
        
        <div class="row gy-5">
          
          @foreach ($Product_R as $product)
            <div class="col-lg-4 menu-item" data-category="{{ $product->category_id }}">
              <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
              <h4>{{ $product->name }}</h4>
              <p class="ingredients">
                {{ $product->description }}
              </p>
              <p class="price">
                ${{ $product->price }}

              </p>
              {{-- <a class="text-dark" href=""><h4>Add to buy<i class="bi bi-cart3"></i></h4></a> --}}
              <a type="submit" href="{{ url('buy/'.$product->id) }}" class="btn btn-outline-secondary">Add to buy <i class="bi bi-cart3"></i></a>
            </div><!-- Menu Item -->
          @endforeach
        </div>
      </div><!-- End Starter Menu Content -->

    </div>

  </div>
</section><!-- End Menu Section -->


<script>

function searche(categoryId) {
  let menuItems = document.querySelectorAll('.menu-item');
  
  for (let i = 0; i < menuItems.length; i++) {
      let menuItem = menuItems[i];
      let category = menuItem.getAttribute('data-category');
    
      if (category == categoryId || categoryId == 'all') {
          menuItem.style.display = 'block';
        } else {
          menuItem.style.display = 'none';
        }
      }
    }
    
    function searche1() {
      let menuItems = document.querySelectorAll('.menu-item');
      
      for (let i = 0; i < menuItems.length; i++) {
        let menuItem = menuItems[i];
        let category = menuItem.getAttribute('data-category');
        menuItem.style.display = 'block';
      }
    }
</script>
@endsection