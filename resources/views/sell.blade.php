@extends('sidebarUser')

@section('content')

<style>
    .konten {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;

        color: black;
    }

    .steps {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        position: relative;
        padding: 30px;
    }

    .step-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background-color: grey;
        transition: .4s;
        opacity: 1;
    }

    .step-button[aria-expanded="true"] {
        width: 55px;
        height: 55px;
        background-color: #ef8354;
        color: white;
        border: 3px solid white;
    }

    .step-button:disabled {
        opacity: 1 !important;
        background-color: #ef8354;
    }

    .done {
        background-color: #ef8354;
        color: white;
    }

    .step-item {
        z-index: 10;
        text-align: center;
    }

    .step-title {
        color: white;
    }

    #progress {
        position: absolute;
        width: 80%;
        z-index: 5;
        height: 8px;
        margin-left: 23px;
        margin-bottom: 18px;
        appearance: none;
    }

    /* to customize progress bar */
    #progress::-webkit-progress-value {
        background-color: #ef8354 !important;
        transition: .5s ease;
    }

    #progress::-webkit-progress-bar {
        background-color: grey;
    }



    .submit {
        background-color: #ef8354;
        color: white;
        border: none;
        width: 50%;
        border-radius: 15px;
    }

    /* Custom CSS to change the primary color */
    .btn-custom {
        color: white;
        background-color: #ef8354;
        border-color: #ef8354;
    }

    .btn-outline-custom {
        color: #ef8354;
        border-color: #ef8354;
    }

    .btn-custom:hover {
        color: white;
        background-color: #ef8354;
        border-color: #ef8354;
    }

    .btn-outline-custom:hover {
        color: #ef8354;
        border-color: #ef8354;
    }
</style>

<div class="container-fluid " style="background-color: #2d3142;">


    <div class="container col-8 p-3 ">
        <h1 style="text-align: center;" class="mb-2 text-light"> <strong> SELL WITH US</strong></h1>

        <div class="steps">
            <progress id="progress" value=0 max=100></progress>
            <div class="step-item">
                <button class="step-button text-center btn btn-primary " type="button" data-bs-toggle="collapse" data-bs-target="#step1" aria-expanded="true" aria-controls="step1">
                    1
                </button>
                <div class="step-title">
                    Input Barang
                </div>
            </div>
            <div class="step-item">
                <button class="step-button text-center btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#step2" aria-expanded="false" aria-controls="step2">
                    2
                </button>
                <div class="step-title">
                    Input Pengiriman
                </div>
            </div>
            <div class="step-item">
                <button class="step-button text-center btn btn-primary " type="button" data-bs-toggle="collapse" data-bs-target="#step3" aria-expanded="false" aria-controls="step3">
                    3
                </button>
                <div class="step-title">
                    Input Bid
                </div>
            </div>
            <div class="step-item">
                <button class="step-button text-center btn btn-primary " type="button" data-bs-toggle="collapse" data-bs-target="#step4" aria-expanded="false" aria-controls="step4">
                    4
                </button>
                <div class="step-title">
                    Verifikasi Admin
                </div>
            </div>
        </div>

        <div class="container konten px-5 pt-3 ">
            <div class="step-content " id="step1">
                <h2 style="text-align: center; color:grey ">Insert Barang</h2>
                <form action="{{ url('api/sell/storeProduk') }}" id="formproduk" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6 pr-3">
                            <label for="nama_produk" class="col-form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="form-group col-6 pl-2">
                            <label for="id_kategori_produk" class="col-form-label">Kategori</label>
                            <!-- <div class="col-sm-10"> -->
                            <select class="form-control" id="id_kategori_produk" name="id_kategori_produk" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="1">Art and Collectibles</option>
                                <option value="2">Fashion</option>
                                <option value="3">Otomotif</option>
                                <option value="4">Real Estate</option>
                                <option value="5">Sport</option>
                                <option value="6">Jewelry</option>
                            </select>
                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="harga_start" class="col-form-label">Harga Awal (Rp)</label>
                            <input type="number" class="form-control" id="harga_start" name="harga_start" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="minimal_inkremen_bid" class="col-form-label">Min Bid Inkremen (Rp)</label>
                            <input type="number" class="form-control" id="minimal_inkremen_bid" name="minimal_inkremen_bid" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gambar_barang" class="col-4 col-form-label">Gambar Barang</label>
                        <div class="col-8">
                            <input type="file" class="form-control-file" id="gambar_barang" name="gambar_barang[]" multiple required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-2"></div>
                        <div class="col-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="punya_sertifikat" name="punya_sertifikat" value="1">
                                <label class="form-check-label" for="punya_sertifikat">
                                    Punya Sertifikat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="gambar_sertifikat_row" style="display: none;">
                        <div class="col-2"></div>
                        <div class="col-10">
                            <label for="gambar_sertifikat" class="col-4 col-form-label">Gambar Sertifikat</label>
                            <div class="col-8">
                                <input type="file" class="form-control-file" id="gambar_sertifikat" name="gambar_sertifikat">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary submit">Submit</button>
                        </div>
                    </div>
                </form>
                <div id="alert-container1"></div>
            </div>

            <div class="step-content collapse" id="step2">
                <h2 style="text-align: center; color:grey ">Insert Pengiriman</h2>
                <form action="{{ url('api/sell/storeShipment') }}" id="formshipment" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nama_user" class="col-form-label">Nama Pengirim</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" required>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-form-label">Alamat Pengirim</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="no_telp_user" class="col-form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp_user" name="no_telp_user" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 pr-3">
                            <label for="jenis_shipment" class="col-form-label">Jasa Pengiriman</label>
                            <select class="form-control" id="jenis_shipment" name="jenis_shipment" required>
                                <option value="">-- Pilih Jasa Pengiriman --</option>
                                <option value="JNE">JNE</option>
                                <option value="Tiki">Tiki</option>
                                <option value="Pos Indonesia">Pos Indonesia</option>
                            </select>
                        </div>
                        <div class="form-group col-6 pl-2">
                            <label for="harga" class="col-form-label">Harga Pengiriman (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                    </div>

                    <div class="form-group col-12  text-center">
                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </div>
                </form>
                <div id="alert-container2"></div>
            </div>

            <!-- Step 3 Content -->
            <div class="step-content collapse" id="step3">
                <h2 style="text-align: center; color:grey ">Insert Bid</h2>
                <form id="formauction" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="tanggal_start" class="col-form-label">Tanggal Start Bid</label>
                            <input type="date" class="form-control" id="tanggal_start" name="tanggal_start" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="time_start" class="col-form-label">Waktu Start</label>
                            <input type="time" class="form-control" id="time_start" name="time_start" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="tanggal_end" class="col-form-label">Tanggal End Bid</label>
                            <input type="date" class="form-control" id="tanggal_end" name="tanggal_end" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="time_end" class="col-form-label">Waktu End</label>
                            <input type="time" class="form-control" id="time_end" name="time_end" required>
                        </div>
                    </div>
                    <div class="form-group col-12  text-center">
                        <button type="submit" class="btn btn-primary submit">Post</button>
                    </div>
                </form>
                <div id="alert-container3"></div>
            </div>

            <!-- Step 4 Content -->
            <div class="step-content collapse" id="step4">
                <div class="row">
                    <div class="col">
                        <h3 style="text-align: center;"><strong>Please wait until our admin verifies your data...</strong></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-3">
                        <img src="{{ asset('img/waiting.jpg') }}" alt="Waiting" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div> <!--  container penutup -->

        <div class="row">
            <div class="col-6">
                <button class="btn btn-outline-custom" id="prevBtn">Previous Step</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-custom" id="nextBtn">Next Step</button>
            </div>
        </div>
    </div>

    <!-- toast
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Success</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Form submitted successfully!
        </div>
    </div> -->

</div>

<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>



<script>
    $(document).ready(function() {
        var currentStep = 1;
        var totalSteps = $('.step-content').length;
        var stepButtons = $('.step-button');

        // Disable step buttons
        stepButtons.prop('disabled', true);

        // Show the first step content
        $('#step1').collapse('show');


        // Step button click event
        stepButtons.on('click', function() {
            var clickedIndex = $(this).index('.step-button') + 1;

            if (clickedIndex > currentStep) {
                for (var i = currentStep; i < clickedIndex; i++) {
                    $('#step' + i).collapse('show');
                    stepButtons.eq(i - 1).addClass('done');
                }
            } else if (clickedIndex < currentStep) {
                for (var i = currentStep; i > clickedIndex; i--) {
                    $('#step' + i).collapse('hide');
                    stepButtons.eq(i - 1).removeClass('done');
                }
            }

            currentStep = clickedIndex;
            updateProgressBar();
        });

        // Previous button click event
        $('#prevBtn').on('click', function() {
            if (currentStep > 1) {
                $('#step' + currentStep).collapse('hide');
                currentStep--;
                $('#step' + currentStep).collapse('show');
                updateProgressBar();
            }

            // Change Next Step button text on Step 4
            if (currentStep === 4) {
                $('#nextBtn').text('Publish Bid');
            } else {
                $('#nextBtn').text('Next Step');
            }
        });

        // Next button click event
        $('#nextBtn').on('click', function() {
            if (currentStep < totalSteps) {
                $('#step' + currentStep).collapse('hide');
                currentStep++;
                $('#step' + currentStep).collapse('show');
                updateProgressBar();
            }

            // Change Next Step button text on Step 4
            if (currentStep === 4) {
                $('#nextBtn').text('Publish Bid');
            } else {
                $('#nextBtn').text('Next Step');
            }
        });

        // Function to update progress bar value
        function updateProgressBar() {
            var progressValue = (currentStep - 1) * 100 / (totalSteps - 1);
            $('#progress').attr('value', progressValue);
        }
    });

    function fetchUser() {
        const accessToken = localStorage.getItem('access_token');

        $.ajax({
            url: 'api/profile',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function(response) {
                // Process the user data as needed
                console.log(response);

                var user = response.user;

                // Update user information
                $("#nama_user").val(user.nama_user);
                $("#no_telp_user").val(user.no_telp_user);
                $("#alamat").val(user.alamat);
            },
            error: function(response) {
                console.log(response);
            },
        });
    }


    $(document).ready(function() {
        var idproduk;
        var idshipment;
        fetchUser();

        $('#punya_sertifikat').change(function() {
            if (this.checked) {
                $('#gambar_sertifikat_row').show();
            } else {
                $('#gambar_sertifikat_row').hide();
            }
        });

        $('#formproduk').submit(function(e) {
            e.preventDefault();
            const accessToken = localStorage.getItem('access_token');
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr("action"),
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    idproduk = response.idproduk;
                    $("#alert-container1").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Data Produk Disimpan!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                },
                error: function(response) {
                    console.log(response);
                    $("#alert-container1").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ${response.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                }
            });
        });

        $('#formshipment').submit(function(e) {
            e.preventDefault();
            const accessToken = localStorage.getItem('access_token');
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr("action"),
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    idshipment = response.idshipment;
                    $("#alert-container2").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Data Shipment Disimpan!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                },
                error: function(response) {
                    console.log(response);
                    $("#alert-container2").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ${response.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                }
            });
        });

        $('#formauction').submit(function(e) {
            e.preventDefault();
            const accessToken = localStorage.getItem('access_token');
            var formData = new FormData(this);

            $.ajax({
                url: 'api/sell/storeAuction/' + idproduk + '/' + idshipment,
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $("#alert-container3").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Data Auction Disimpan!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                },
                error: function(response) {
                    console.log(response);
                    $("#alert-container3").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ${response.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                }
            });
        });
    });
</script>
@endsection