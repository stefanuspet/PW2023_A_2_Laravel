@extends('sidebarUser')
@section('content')

<style>
    .carousel {
        overflow: hidden;
    }

    .carousel-inner {
        margin: 0;
        padding: 0;
    }

    .carousel-item {
        transition: transform 0.5s ease;
    }

    .carousel img {
        object-fit: cover;
    }
</style>

<h1 class="text-center text-light" style="font-family: 'Poppins', sans-serif; font-size:50px;"><strong>HOME</strong></h1>

<!-- carousel -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="height: 100%;margin-top: 30px; margin-bottom: 40px;">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active bg-dark" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="bg-dark" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class="bg-dark" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset ('img/Slide1.png')}}" class="d-block w-100" alt="slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{asset ('img/Slide2.png')}}" class="d-block w-100" alt="slide 2">
        </div>
        <div class="carousel-item">
            <img src="{{asset ('img/Slide3.png')}}" class="d-block w-100" alt="slide 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- container on going -->
<div style=" width: 90%; background-color: white; margin: 0 auto;border-radius: 30px;" class="mb-4">
    <div class="container-fluid" style="padding-inline: 50px; padding-block: 20px;">
        <div class="mb-5">
            <h1 class="fw-bold fs-2">On Going Auction</h1>
            <div class="d-flex justify-content-start gap-5" id="produk-container">
                <!-- Product cards will be appended here -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "/api/produk",
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                // Check if the response has at least one foto element
                if (response.foto.length > 0) {
                    response.data.forEach(function(produk, index) {
                        // Use inline JavaScript to pass data to the client
                        var imageUrl = "{{ asset('storage/img/') }}/" + response.foto[index].gambar;

                        var card = $(
                            '<a href="/detailProduk/' + produk.id_auction + '" style="width: 30%; ">' +
                            '<div class="card text-white" style="border-radius: 20px;overflow: hidden; background-color: #2d3142;">' +
                            '<img src="' + imageUrl + '" class="card-img-top" alt="gambar produk" style="height:40vh;">' +
                            '<div class="card-body">' +
                            '<p class="p-0 mb-2" id="judul">' + produk.product.nama_produk + '</p>' +
                            '<p class="p-0 mb-1" id="increment">Increment : Rp ' + produk.product.minimal_inkremen_bid.toLocaleString('id-ID') + '</p>' +
                            '<p class="p-0 mb-2" id="time">Open until : ' + moment(produk.time_end).format('DD-MM-YYYY') + '</p>' +
                            '<h1 class="fs-5 fw-bold" style="color: #ed8359;" id="start">Bid Start Rp : ' + produk.product.harga_start.toLocaleString('id-ID') + '</h1>' +
                            '</div>' +
                            '</div>' +
                            '</a>'
                        );

                        // Append the card to the container
                        $("#produk-container").append(card);
                    });
                } else {
                    console.error('No foto elements in the response.');
                }
            }

        });
    });
</script>

@endsection