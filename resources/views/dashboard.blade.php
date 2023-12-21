@extends('sidebar')
@section('content')
<div class="p-5" style="color: #21272A;">
    <div class="d-flex justify-content-around">
        <div class="d-flex py-5 gap-4 justify-content-center align-items-center p-2 rounded" style="background-color: white; width: 30%;">
            <div style="width: 100px; height: 100px;">
                <img class="img-fluid" src="{{ asset('images/ongoing.png')}}" alt="">
            </div>
            <div class="text-center">
                <div id="total-auctions"></div>
                <p class="m-0">Total</p>
                <p class="m-0">Auction</p>
            </div>
        </div>
        <div class="d-flex py-5 gap-4 justify-content-center align-items-center p-2 rounded" style="background-color: white; width: 30%;">
            <div class="d-flex align-items-center" style="width: 100px; height: 100px;">
                <img class="img-fluid" src="{{ asset('images/participant.png')}}" alt="">
            </div>
            <div class="text-center">
                <div id="total-bid"></div>
                <p class="m-0">Total Bidder</p>
            </div>
        </div>
    </div>
    <div class="pt-5">
        <div class="d-flex justify-content-between">
            <h1 class="fs-2 text-light"><strong>Daftar Lelang Berlangsung</strong></h1>
            <div class="d-flex justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <p class="m-0">show</p>
                    <div style="width: 40px; height: 20px; border: solid 1px; display: flex; align-items: center; padding: 2px;">
                        <input type="text" style="border: none; outline: none; background: transparent; width: 100%; font-size: small;" name="" id="">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <p class="m-0">sort</p>
                    <i class="fa-solid fa-sort-down"></i>
                </div>
            </div>

        </div>
        <table class="table table-striped table-hover" id="table-auction">
            
            
        </table>
    </div>


</div>
<script>
    function updateAuctionData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedUserId');
        console.log('id user di admin edit ' + id);

        $.ajax({
            url: '/api/stat', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function (data) {
                console.log('Auction data received:', data);
                //isi container dengan data baru
                $('#table-auction').html(renderAuctionData(data.auctions));
                
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

    function updateStatAuction() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedUserId');
        console.log('id user di admin edit ' + id);

        $.ajax({
            url: '/api/statAuc', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function (data) {
                console.log('Auction data received:', data);
                //isi container dengan data baru
                $('#total-auctions').html(updateStatistics(data.data));
                
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

    function updateStatBid() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedUserId');
        console.log('id user di admin edit ' + id);
        
        $.ajax({
            url: '/api/statBid', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function (data) {
                console.log('Auction data received:', data);
                //isi container dengan data baru
                $('#total-bid').html(updateStatistics(data.data));
                
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }


    //tampilan ongoing
    function renderAuctionData(auctions) {
        var html = `        
            <thead>
                <tr>
                    <th scope="col">Nama Penjual</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Bid Tertinggi</th>
                    <th scope="col">Last Date</th>
                    <th></th>
                </tr>
            </thead>
        `;

        auctions.forEach(function (item) {
            console.log('id_auction : ', item.id_auction);

            var highestBid = item.bids ? item.bids.harga_bid : 'No Bids';

            html += `
            <tbody>    
                <tr>
                    <th scope="row">${item.seller.nama_user}</th>
                    <td>${item.product.nama_produk}</td>
                    <td>${highestBid}</td>
                    <td>${item.time_end}</td>
                    <td><i class="fa-solid fa-ellipsis"></i></td>
                </tr>
            </tbody>
            `;
        });

        return html;
    }

    function updateStatistics(total) {
        var html = '';
        if (!total || total.length == 0)
        {
            html += `<h1>0</h1>`;
        } else {
            html += `<h1>${total}</h1>`;
        }
        return html;
    }

    //loading data
    updateAuctionData();
    updateStatAuction();
    updateStatBid();

    //represh tiap 1 menit
    setInterval(updateAuctionData, 60000);
</script>
@endsection