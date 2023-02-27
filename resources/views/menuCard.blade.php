@foreach ($menu as $item)
<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        <img class="card-img-top" src="{{ 'menu_img/'.$item->menu_image }}" alt="food_pic" />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder text-gray-900">{{$item->menu_name }}</h5>
                <!-- Product price-->
                <p class="text-gray-800">RM {{$item->price}}</p>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="food?type={{$item->id }}">View Details</a></div>
        </div>
    </div>
    </div>
@endforeach
