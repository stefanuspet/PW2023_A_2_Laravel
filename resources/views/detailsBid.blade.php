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
        padding: 3%;
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
        margin: 5px;
    }

    .image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .label-form {
        font-size: 15px;
        color: #4f5d75;
    }

    .table, th, td {
        text-align: center;
    }
</style>
<div class="content p-4">
    <div id="tab">

    </div>
    <div class="container">
        <div class="form-auc">
            <div id="data-bid"></div>
                    
            <div id="alert-container" class="pt-2"></div>
        </div>
    </div>
</div>

<script>
    function fetchBidData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('idAuc');
        console.log('id auction' + id);
        $.ajax({
            url: 'api/bidder/' + id,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (data) {
                console.log(data);
                var bids = data.data.data

                $("#data-bid").html(showData(bids));
                $("#tab").html(showTab(data.data.auction));
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

    $(document).ready(function() {
        fetchBidData();

        $(document).on("click", ".delete-item", function (e) {
            const accessToken = localStorage.getItem('access_token');
            e.preventDefault();
            var itemId = $(this).closest('tr').find('td[data-item-id]').data('item-id');
            console.log(itemId);
            $.ajax({
                type: "DELETE",
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                url: 'api/bidder/'+ itemId,
                    success: function(response) {
                        console.log(response);
                        $("#alert-container").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Bid berhasil dihapus
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

    function showData(data) {
        var html = `
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Bidder Name</th>
                    <th scope="col">Amount (IDR)</th>
                    <th scope="col">Is Winner</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
        `;
        var firstLoop = true;

        data.forEach(function(item) {
            html += `
                <tr>
                    <th scope="row">${item.user.nama_user}</th>
                    <td>${item.harga_bid}</td>
                    <td data-item-id="${item.id_bid}">${firstLoop ? 'Yes' : 'No'}</td>
                    <td><a href="#" class="delete-item"><i class="fa-solid fa-trash-can" style="color: #ef8354;"></i></a></td>
                </tr>
            `;
            firstLoop = false;
        });

        html += `
                </tbody>
            </table>
        `;

        return html;
    }

    function showTab (auction)
    {
        console.log(auction);
        var html = `
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a href="#" onclick="moveToProduk(${auction.product.id_produk})" class="nav-link text-white">Product</a>
                </li>
                <li class="nav-item">
                    <a href="#" onclick="moveToBidding(${auction.id_auction})" class="nav-link active" aria-current="page">Bidding</a>
                </li>
            </ul>
        `;

        return html;
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