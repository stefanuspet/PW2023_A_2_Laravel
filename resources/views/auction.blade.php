@extends('sidebar')

@section('content')
<style>
    .content {
        background-color: #2d3142;
        color: #ffffff;
    }

    .auc-display {
        width: 100%;
        color: #4f5d75;
        height: max-content;
        background-color: white;
        border-radius: 8px;
        margin: 0 auto;
        margin-top: 5%;
        font-family: 'Poppins';
    }

    .shade-text {
        color: #bfc0c0;
        font-size: 12px;
    }

    .auc-pic {
        height: 250px;
    }

    .price {
        font-family: 'Bayon';
        color: #ef8354;
    }

    .soon {
        width: 95%;
        height: 300px;
        color: #ffffff;
        background-color: #2d3142;
        border: 1px solid #bfc0c0;
        border-radius: 8px;
        margin: auto;
        margin-top: 10%;
        font-family: 'Poppins';
    }

    .list-side, .list-block {
        background-color: #2d3142;
        border: none;
        color: #ffffff;
        font-family: 'Lato';
        text-align: left;
        border-bottom: 1px solid #bfc0c0;
    }

    .list-group-item:hover {
        background-color: #192133;
    }

    .list-block {
        padding-right: 10px;
        display: block;
        overflow: auto;
        height: 240px;
    }

    .list-block::-webkit-scrollbar {
        background-color: #000000;
        width:4px;
    }

    .list-block::-webkit-scrollbar-thumb {
        background: #ef8354;
        border-radius: 25px;
    }

    .card:hover {
        box-shadow: 1px 8px 20px grey;
        -webkit-transition:  box-shadow .2s ease-in;
    }

</style>
<div class="content">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="justify-content-center text-alignment-center p-5 auc-display">
                    <div class="row">
                        <div class="col-lg-9 text-start">
                            <h2><strong>ONGOING AUCTION</strong></h2>
                        </div>
                        <div class="col-lg-3 d-flex justify-content-end align-items-end">
                            <p class="m-0 shade-text">See more</p>
                        </div>
                    </div>
                    <!-- Auction display -->
                    <div class="row row-cols-2" id="auction-container">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="justify-content-center text-alignment-center p-3 soon">
                    <div class="row">
                        <div class="col-lg-9 text-start">
                            <h6><strong>SOON TO BE LAUNCHED</strong></h6>
                        </div>
                        <div class="col-lg-3 d-flex justify-content-end align-items-end">
                            <p class="m-0 shade-text">See more</p>
                        </div>
                    </div>

                    <ul class="list-group list-block" id="soon-container">
                        
                    </ul>
                </div>

                <div class="justify-content-center text-alignment-center p-3 soon">
                    <div class="row">
                        <div class="col-lg-9 text-start">
                            <h6><strong>HISTORY</strong></h6>
                        </div>
                        <div class="col-lg-3 d-flex justify-content-end align-items-end">
                            <p class="m-0 shade-text">See more</p>
                        </div>
                    </div>
                    <ul class="list-group list-block" id="history-container">
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //fungsi nya ongoing
    function updateAuctionData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedUserId');
        console.log('id user di admin edit ' + id);

        $.ajax({
            url: '/api/manageAuc', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function (data) {
                console.log('Auction data received:', data.data);
                //isi container dengan data baru
                $('#auction-container').html(renderAuctionData(data.data));
                
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

    //fungsi nya soon to be launched
    function updateSoonData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedUserId');
        console.log('id user di admin edit ' + id);
        
        $.ajax({
            url: '/api/manageSoon', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function (data) {
                console.log('Auction data received:', data.data);
                //isi container dengan data baru
                $('#soon-container').html(renderSoonData(data.data));
                
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

    //fungsi nya history
    function updateHistoryData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedUserId');
        console.log('id user di admin edit ' + id);

        $.ajax({
            url: '/api/manageHistory', 
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            success: function (data) {
                console.log('Auction data received:', data.data);
                //isi container dengan data baru
                $('#history-container').html(renderHistoryData(data.data));
                
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }


    //tampilan ongoing
    function renderAuctionData(auctions) {
        var html = '';

        auctions.forEach(function (item) {
            console.log('id_auction : ', item.id_auction);

            var daysRemain = calculateRemainingDays(item.time_end);
            var imageUrl = item.product.gambar ? "{{ asset('storage/img') }}/"+ item.product.gambar : '';
            console.log(imageUrl);

            html += `
                <div class="col">
                    <a href="#" class="text-decoration-none" onclick="saveIdProdukToLocalStorage(${item.product.id_produk})">
                        <div class="card">
                            <div class="card-body text-start">
                                <h4 class="card-text"><strong>${item.product.nama_produk}</strong></h4>
                            </div>
                            <img src="${imageUrl}" alt="catikku" class="img-fluid auc-pic">
                            <div class="card-body text-start">
                                <h1 class="price m-0"><strong>IDR ${numberWithCommas(item.product.harga_start)}</strong></h1>
                                <p class="card-text shade-text m-0">
                                    ${daysRemain} days left
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            `;
        });

        return html;
    }

    //tampilan soon to be launched
    function renderSoonData(auctions) {
        var html = '';

        auctions.forEach(function (item) {
            console.log('id_soon : ', item.verified);

            // Conditionally set the content based on item.verified
            var contentHtml = (item.verified == 0) ?
                `
                <div class="col-md-10 m-0">
                    ${item.product.nama_produk}
                    <p style="color: #ef8354; font-size: 14px;">Waiting for confirmation</p>
                </div>
                <div class="col-md-2 text-end m-0">
                    <i class="fa-solid fa-bell" style="color: #ef8354;"></i>
                </div>
                `
                :
                `
                <div class="col m-0">
                    ${item.product.nama_produk}
                    <p style="color: #ffffff; font-size: 14px;">Ready to be launched</p>
                </div>
                `;

            // Conditionally include the link based on item.verified
            var linkHtml = (item.verified == 0) ? `<a href="#" onclick="saveIdToLocalStorage(${item.id_auction})" class="text-decoration-none">` : '';
            console.log(contentHtml);
            html += `
                ${linkHtml}
                    <li class="list-group-item list-side">
                        <div class="row" style="height: 40px;">
                            <div class="justify-content-center align-items-start">
                                <div class="row p-0">
                                    ${contentHtml}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-end align-items-end">
                                <p class="m-0 shade-text">In ${item.time_start}</p>
                            </div>
                        </div>
                    </li>
                ${(item.verified == 0) ? '</a>' : ''}
            `;
        });

        return html;
    }

    function renderHistoryData(auctions) {
        var html = '';

        auctions.forEach(function (item) {
            console.log('id_history : ', item.time_end);
            html += `
                <a href="#" onclick="saveIdProdukToLocalStorage(${item.product.id_produk})" class="text-decoration-none">
                    <li class="list-group-item list-side">
                        <div class="row" style="height: 40px;">
                            <div class="justify-content-center align-items-start">
                                <div class="row p-0">
                                    <div class= "col m-0">
                                        ${item.product.nama_produk}
                                        <p style="color: #ffffff; font-size: 14px;">Sold for IDR {{ number_format(40000000, 0) }}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-end align-items-end">
                                <p class="m-0 shade-text">In ${item.time_end}</p>
                            </div>
                        </div>
                    </li>
                </a>
            `;
        });

        return html;
    }


    // Fungsi misahin nol
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    //htiung sisa hari
    function calculateRemainingDays(endDate) {
        var endDateObj = new Date(endDate);
        console.log(endDateObj);
        var timeDiff = endDateObj.getTime() - Date.now();
        console.log(timeDiff);
        var remainingDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        return remainingDays;
    }

    function saveIdToLocalStorage(auctionId) {
        localStorage.setItem('selectedId', auctionId);
        console.log(auctionId);
        window.location.href = "{{ url('verification') }}"
    }

    function saveIdProdukToLocalStorage(auctionId) {
        localStorage.setItem('selectedIdProduk', auctionId);
        console.log(auctionId);
        window.location.href = "{{ url('details') }}"
    }


    // Update loading data
    updateAuctionData();
    updateSoonData();
    updateHistoryData();

    // represh tiap 1 menit
    setInterval(updateAuctionData, 60000);
</script>
@endsection