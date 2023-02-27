@foreach ($details as $item)
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center shadow">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ 'menu_img/' . $item->menu_image }}"
                        alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">PRODUCT ID: {{ $item->id }}</div>
                    <h1 class="display-5 fw-bolder text-gray-900">{{ $item->menu_name }}</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-gray-800">{{ 'RM' . $item->price }}</span>
                    </div>
                    <p class="lead text-gray-900">{{ $item->description }}</p>
                    <form id="orderform">
                        <input type="text" hidden name="price" value="{{ $item->price }}">
                        <input type="text" hidden name="foodname" value="{{ $item->menu_name }}">
                        <input type="text" hidden name="url" value="{{ url('/') }}">
                        <span class="text-gray-800">Quantity:</span> <label for="inputQuantity">
                            <input class="form-control text-center" id="inputQuantity" type="number" min="1"
                                value="1" style="max-width: 4rem" name="amount" /></label>
                    </form>
                    <button data-bs-toggle="modal" data-bs-target="#orderModal" id="button" onclick="addOrder()"
                        class="btn btn-outline-success flex-shrink-0 mb-1 mt-2 w-100" name="foodtype"
                        value="{{ $item->id }}">
                        <i class="bi bi-bag-fill"></i> Add to order
                </div>
            </div>
        </div>
        </div>
    </section>
@endforeach
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="orderModalLabel">Order Added !</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body text-gray-800">
                {{ $item->menu_name }} has successfully added to your order
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>
