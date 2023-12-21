@extends('sidebar')

@section('content')
<style>
    .content {
        background-color: #2d3142;
        color: #ffffff;
    }

    .icon-box {
        display: flex;
        width: 30px;
        height: 30px;
        border: 1px solid #ffffff;
        background-color: transparent;
        color: #ffffff;
        text-align: center;
        justify-content: center;
        padding: 5px;
    }

    .form-auc {
        width: 100%;
        color: #4f5d75;
        height: max-content;
        background-color: white;
        border-radius: 8px;
        margin: 0 auto;
        padding: 4%;
        font-family: 'Source Sans Pro';
    }

    .img-big {
        border-radius : 8px;
        height: 300px;
        width: 300px;
        border: 1px solid #ffffff;
        padding: 5px;
        background-color: transparent;
    }

    .img-small {
        border-radius : 8px;
        height: 95px;
        width: 95px;
        border: none;
        margin: 2px;
    }

    .image-container {
        display: flex;
        flex-direction: column;
    }

    .label-form {
        font-size: 15px;
        color: #4f5d75;
    }
</style>
<div class="content p-4">
    <div id="tab">

    </div>
    <form id="myForm">
        <div class="container">
            <div class="row justify-content-end">
                <div id="alert-container" class="pt-2"></div>
                    <div class="d-flex justify-content-end text-align-end">
                        <button type="submit" class="icon-box rounded-left">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button type="button" id="deleteProduk" class="icon-box rounded-right">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
            </div>
            <div class="row justify-content-center p-3">
                <div class="col-5">
                    <div class="image-container">
                        <img src="{{ asset('img/default.jpg') }}" alt="catikku" class="img-big">
                        <div class="d-flex">
                            <div id="image-container"></div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-auc">
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" class="form-control form-control-md" placeholder="Masukkan Nama" >
                            </div>
                            <div class="col-sm-4">
                                <label for="id_kategori_produk" class="form-label">Kategori</label>
                                <div id="showKategori"></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="deskripsi" class="form-label"><strong>Deskripsi</strong></label>
                            <fieldset>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control form-control-sm text-decoration-none" placeholder="Deskripsikan Barang Anda..."></textarea>
                            </fieldset>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label for="harga_start" class="form-label">Price Starts In</label>
                                <input type="number" id="harga_start" name="harga_start" class="form-control form-control-md" placeholder="IDR" >
                            </div>
                            <div class="col-sm-6">
                                <label for="minimal_inkremen_bid" class="form-label">Price Increment</label>
                                <input type="number" id="minimal_inkremen_bid" name="minimal_inkremen_bid" class="form-control form-control-md" placeholder="IDR">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm mt-3" style="background-color: #ef8354; color: #ffffff; width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-image"></i> Show Certificate
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- modal sertif -->
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">
                <img id="sertif" alt="Gambar" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    

    function fetchProdukData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedIdProduk');
        console.log('id auction' + id);
        $.ajax({
            url: 'api/auction/' + id,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (data) {
                var product = data.data.data;
                console.log(product);
                $("#nama_produk").val(product.nama_produk);
                $("#deskripsi").val(product.deskripsi);
                $("#harga_start").val(product.harga_start);
                $("#minimal_inkremen_bid").val(product.minimal_inkremen_bid);
                $("#image-container").html(showPicture(data.data.gambarArray));
                $("#sertif").attr('src', "{{ asset('storage/img') }}/" + product.sertifikat);
                $("#showKategori").html(showKategori(product.kategori_produk.jenis_kategori));
                $("#tab").html(showTab(product));
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

    $(document).ready(function() {
        fetchProdukData();
        //update data produk
        $("#myForm").submit(function(e) {
            
            e.preventDefault();
            const accessToken = localStorage.getItem('access_token');
            const id = localStorage.getItem('selectedIdProduk');
            console.log(id);

            $.ajax({
                type: "PUT",
                url: 'api/auction/'+ id,
                data: $(this).serialize(),
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                },
                    success: function(response) {
                        console.log(response);
                        $("#alert-container").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Produk berhasil diubah
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                        setTimeout(() => {
                            window.location.href = "{{ url('auction') }}";
                        }, 5000);
                    },
                    error: function(response) {
                        console.log(response);
                        $("#alert-container").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ${response.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                    }
                });
            });
            //basically hapus auctionnya
            $("#deleteProduk").click(function(e) {
                const accessToken = localStorage.getItem('access_token');
                const id = localStorage.getItem('selectedIdProduk');
                e.preventDefault();
                $.ajax({
                    type: "DELETE",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    url: 'api/auction/'+ id,
                        success: function(response) {
                            console.log(response);
                            $("#alert-container").html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> Auction berhasil dihapus
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                            setTimeout(() => {
                                window.location.href = "{{ url('auction') }}";
                            }, 5000);
                        },
                        error: function(response) {
                            console.log(response);
                            $("#alert-container").html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> ${response.responseJSON.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                        }
                    });
                });
    });

    function showPicture(gambar) {
        var html = '';
        var maxImages = 3;
        
        gambar.slice(0, maxImages).forEach(function (item) {
            var imgUrl = "{{ asset('storage/img') }}/" + item.gambar;
            html += `
                <img src="${imgUrl}" alt="Gambar" class="img-small p-0" style="border: 2px solid #ef8354;" onclick="enlargeImage('${imgUrl}')">
            `;
        });

        return html;
    }

    function showKategori(selectedCategory) {
        console.log(selectedCategory);
        var html = `
            <select id="id_kategori_produk" name="id_kategori_produk" class="form-select" data-bs-theme="light">
                <option value="">Pilih Kategori</option>
                <option value="1" ${selectedCategory === 'Art and Collectibles' ? 'selected' : ''}>Art and Collectibles</option>
                <option value="2" ${selectedCategory === 'Fashion' ? 'selected' : ''}>Fashion</option>
                <option value="3" ${selectedCategory === 'Otomotif' ? 'selected' : ''}>Otomotif</option>
                <option value="4" ${selectedCategory === 'Real Estate' ? 'selected' : ''}>Real Estate</option>
                <option value="5" ${selectedCategory === 'Sport' ? 'selected' : ''}>Sport</option>
                <option value="6" ${selectedCategory === 'Jewelry' ? 'selected' : ''}>Jewelry</option>
            </select>
        `;

        return html;
    }

    function showTab (product)
    {
        console.log(product);
        var html = `
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a href="#" onclick="moveToProduk(${product.id_product})" class=" nav-link active">Product</a>
                </li>
                <li class="nav-item">
                    <a href="#" onclick="moveToBidding(${product.auction.id_auction})" class="nav-link text-white" aria-current="page">Bidding</a>
                </li>
            </ul>
        `;

        return html;
    }

    function enlargeImage(imgUrl) {
            var bigImageContainer = document.querySelector('.img-big');
            bigImageContainer.src = imgUrl;
        }

    function moveToBidding(auctionId) {
        localStorage.setItem('idAuc', auctionId);
        console.log(auctionId);
        window.location.href = "{{ url('detailsBid') }}"
    }

    function moveToProduk(auctionId) {
        localStorage.setItem('idProduk', auctionId);
        console.log(auctionId);
        window.location.href = "{{ url('details') }}"
    }
</script>
@endsection