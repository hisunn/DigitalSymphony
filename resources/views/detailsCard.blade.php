@foreach ($details as $item)
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center shadow">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ 'menu_img/' . $item->menu_image }}"
                        alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">PRODUCT ID: {{ $item->id }}</div>
                    <h1 class="display-5 fw-bolder">{{ $item->menu_name }}</h1>
                    <div class="fs-5 mb-5">
                        <span>{{ 'RM' . $item->price }}</span>
                    </div>
                    <p class="lead">{{ $item->description }}</p>
                    <form action="{{ url('/insertOrder') }}" method="GET">
                        <input type="text" hidden name="price" value="{{ $item->price }}">
                        <input type="text" hidden name="foodname" value="{{ $item->menu_name }}">
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="number"
                                min="1" value="1" style="max-width: 4rem" name="amount" />
                            <button type="submit" class="ml-2 btn btn-outline-success flex-shrink-0" name="foodtype"
                                value="{{ $item->id }}">
                                <i class="bi-cart-fill me-1"></i>
                                Add to order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endforeach
