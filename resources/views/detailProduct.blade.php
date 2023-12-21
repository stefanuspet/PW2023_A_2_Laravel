@extends('sidebarUser')
@section('content')
<!-- container -->
<div style="width: 90%; background-color: white; margin: 0 auto;border-radius: 30px;">
    <div>
        <div class="container-fluid d-flex gap-4" style="padding-inline: 50px; padding-block: 20px;">
            <div style="width: 40%; height: 380px; background-color: #D9D9D9; display: flex; flex-direction: column; justify-content: center; align-items: center; border-radius: 20px;">
                <div style="overflow: hidden; width: 90%; height: 70%;">
                    <img id="bigPic" src="" alt="asb" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div id="hero" class="d-flex justify-content-start gap-3" style="width: 90%; margin-top: 10px;">
                    <!-- <div style="overflow: hidden; width: 30%; height: 70px; background-color: #1a1e29;">
                        <img src="{{ asset('images/lukisan.jpg') }}" alt="asb" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="overflow: hidden; width: 30%; height: 70px; background-color: #1a1e29;">
                        <img src="{{ asset('images/lukisan.jpg') }}" alt="asb" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="overflow: hidden; width: 30%; height: 70px; background-color: #1a1e29;">
                        <img src="{{ asset('images/lukisan.jpg') }}" alt="asb" style="width: 100%; height: 100%; object-fit: cover;">
                    </div> -->
                </div>
            </div>
            <div style="width: 50%; color: #2D3142;">
                <h1 class="fw-bold fs-3" id="nama_produk"></h1>
                <p class="fw-light mt-3" style="text-align: justify;" id="deskripsi"></p>
                <p class="fw-medium fs-5 mb-0 mt-5" id="start_bid"></p>
                <!-- tulisan dibawah ini harusnya diambil dari uction table -->
                <p class="fw-medium fs-5 m-0" id="time_start"></p>
                <p class="fw-medium fs-5 m-0" id="time_end"></p>
                <p class="fw-bold fs-4 mt-2" style="color: #EF8354;" id="highestbid"></p>
            </div>
        </div>
        <div class="d-flex justify-content-between" style="padding-inline: 50px; padding-block: 20px;">
            <table id="bidTable" class="table table-striped table-hover" style="width: 50%;">
                <thead>
                    <tr>
                        <th scope=" col">Rank</th>
                        <th scope=" col">Nama</th>
                        <th scope=" col">Bid</th>
                        <th scope=" col">Time</th>
                    </tr>
                </thead>
                <tbody id="bidTableBody">
                </tbody>
            </table>
            <div style="background-color: #D9D9D9; border-radius: 10px; width: 40%; padding: 20px;">
                <form id="bidForm" action="{{url('api/bid')}}">
                    <h1 class="fw-bold fs-3">BID Now !!</h1>
                    <div>
                        <label class="form-label" for="increment">Increment Bid</label>
                        <input class="form-control" type="text" name="increment" id="increment" disabled>
                    </div>
                    <div>
                        <label class="form-label" for="harga_bid">Your Bid</label>
                        <input class="form-control" type="number" name="harga_bid" id="harga_bid">
                    </div>
                    <div class="mt-3 d-flex justify-content-center gap-4">
                        <button type="submit" class="btn text-white" style="background-color: #EF8354; width: 100%;">Submit BID</button>
                    </div>
                </form>
                <button onclick="destroy()" id="delete" class="btn text-white mt-2" style="background-color: #2D3142; width: 100%;">Delete BID</button type="button">
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    var currentUrl = window.location.href;
    var productIdMatch = currentUrl.match(/\/detailProduk\/(\d+)/);

    $(document).ready(function() {
        //add BID
        var StatusBID = false;
        check();

        $("#bidForm").submit(function() {
            console.log(StatusBID, "now");
            const harga_bid = $("#harga_bid").val();
            const increment = $("#increment").val();
            event.preventDefault();
            if (harga_bid % increment != 0) {
                alert("Bid harus kelipatan " + increment);
            } else {
                if (StatusBID) {
                    update();
                    console.log("update");
                } else {
                    submitBid();
                    console.log("submit");

                }
            }
        });

        // check if user already bid
        function check() {
            $.ajax({
                url: "/api/bid/check/" + productIdMatch[1],
                type: "GET",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Handle success, e.g., show a success message
                        console.log(response.message);
                        StatusBID = true;
                        // Optionally, update the bid table or other UI elements
                    } else {
                        // Handle error, e.g., show an error message
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed: " + status + ", " + error);
                }
            })
        }

        function update() {
            $.ajax({
                url: "/api/bid/" + productIdMatch[1],
                type: "PUT",
                data: {
                    harga_bid: $("#harga_bid").val(),
                },
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Handle success, e.g., show a success message
                        console.log(response.message);
                        location.href = "/detailProduk/" + productIdMatch[1];
                        // Optionally, update the bid table or other UI elements
                    } else {
                        // Handle error, e.g., show an error message
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed: " + status + ", " + error);
                }
            })
        }

        function submitBid() {
            $.ajax({
                url: $("#bidForm").attr('action'),
                type: "POST",
                data: {
                    id_auction_to_bid: productIdMatch[1],
                    harga_bid: $("#harga_bid").val(),
                },
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Handle success, e.g., show a success message
                        console.log(response.message);
                        location.href = "/detailProduk/" + productIdMatch[1];
                        // Optionally, update the bid table or other UI elements
                    } else {
                        // Handle error, e.g., show an error message
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed: " + status + ", " + error);
                }
            });
        }
        // Make an Ajax request to fetch data
        $.ajax({
            url: "/api/bid/" + productIdMatch[1],
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            dataType: "json",
            success: function(response) {
                // Handle the response and populate the table
                if (response.success) {
                    populateTable(response.data);
                } else {
                    // Handle error or display a message
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle Ajax error
                console.error("Ajax request failed: " + status + ", " + error);
            }
        });

        // Function to populate the table with data
        function populateTable(data) {
            var tableBody = $("#bidTableBody");
            // Clear existing rows
            tableBody.empty();

            // Loop through the data and append rows to the table
            $.each(data, function(index, bid) {
                var row = $("<tr>");
                row.append("<th scope='row'>" + (index + 1) + "</th>");
                row.append("<td>" + bid.user.nama_user + "</td>");
                row.append("<td> Rp " + bid.harga_bid.toLocaleString('id-ID') + "</td>");
                row.append("<td>" + moment(bid.waktu_bid).format('DD-MM-YYYY HH:mm') + "</td>");
                tableBody.append(row);
            });
        }
    });

    const destroy = () => {
        $.ajax({
            url: "/api/bid/" + productIdMatch[1],
            type: "DELETE",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Handle success, e.g., show a success message
                    console.log(response.message);
                    location.href = "/detailProduk/" + productIdMatch[1];
                    // Optionally, update the bid table or other UI elements
                } else {
                    // Handle error, e.g., show an error message
                    console.error(response.message);
                }
            },
        })
    }

    // get product by id
    $(document).ready(function() {
        var currentUrl = window.location.href;
        var productIdMatch = currentUrl.match(/\/detailProduk\/(\d+)/);

        $.ajax({
            url: "/api/produk/" + productIdMatch[1],
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            dataType: "json",
            success: function(data) {
                console.log(data.data.data, "data");
                //var hero = document.getElementById("hero");
                //hero.src = "storage/img/" + data.gambarArray[0].gambar;
                // console.log(data.data.gambarArray[0].gambar);

                // write data to element
                $("#nama_produk").text(data.data.data.product.nama_produk);
                $("#deskripsi").text(data.data.data.product.deskripsi);
                $("#start_bid").text("Start bid : IDR " + data.data.data.product.harga_start.toLocaleString('id-ID'));
                $("#time_start").text("Time Start : " + moment(data.data.data.time_start).format('YYYY-MM-DD HH:mm:ss'));
                $("#time_end").text("Time End : " + moment(data.data.data.time_end).format('YYYY-MM-DD HH:mm:ss'));
                $("#increment").val(data.data.data.product.minimal_inkremen_bid);
                // selanjutnya harusnya diambil dari auction table
                $("#bigPic").attr("src", "{{ asset('storage/img') }}/" + data.data.gambarArray[0].gambar);
                $("#hero").html(showPicture(data.data.gambarArray));

                // highest bid
                if (data.highestBid == null) {
                    $("#highestbid").text("Highest Bid : IDR 0");
                } else {
                    $("#highestbid").text("Highest Bid : IDR " + data.highestBid.toLocaleString('id-ID'));
                }

                //set step di bid form harga bid supaya sesuai min inkremen
                $("#harga_bid").attr("step", data.data.data.product.minimal_inkremen_bid);
            },
            complete: function() {
                // Hide loading icon when the request is complete
                $("#loading-icon").hide();
            }
        });


        function showPicture(gambarArray) {
            var html = '';
            console.log(gambarArray);
            gambarArray.forEach(function(gambar) {
                var imgUrl = "{{ asset('storage/img') }}/" + gambar.gambar;

                html += `
                        <div style="overflow: hidden; width: 30%; height: 70px; background-color: #1a1e29;">
                            <img src="${imgUrl}"+ alt="asb" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        
                    `;
            });
            return html;
        }
    });
</script>

<!-- end container -->
@endsection