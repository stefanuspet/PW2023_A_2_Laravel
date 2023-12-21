@extends('sidebar')

@section('content')
<style>
    .content {
        background-color: #2d3142;
        color: #ffffff;
        font-family: 'Source Sans Pro';
    }
    #container {
        max-width: 80%;  
    }

    .step-container {
      position: relative;
      text-align: center;
      transform: translateY(-43%);
    }

    .step-circle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #ef8354;
      border: 2px solid #ffffff;
      line-height: 30px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
      cursor: pointer; /* Added cursor pointer */
    }

    .step-line {
      position: absolute;
      top: 16px;
      left: 50px;
      width: calc(100% - 100px);
      height: 2px;
      background-color: #ef8354;
      z-index: -1;
    }

    .progress-bar {
        background-color: #ef8354;
    }
    
    #multi-step-form{
		overflow-x: hidden;
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
        height: 118px;
        width: 118px;
        border: none;
        margin: 5px;
    }

    .form-auc {
        width: 100%;
        color: #ffffff;
        height: max-content;
        background-color: transparent;
        border-radius: 8px;
        margin: 0 auto;
        padding: 4%;
        font-family: 'Source Sans Pro';
    }

    .form-control, .form-select {
        background-color: transparent;
        color: white;
    }

    .form-control::placeholder {
        color: #bfc0c0; 
    }

    .step {
        padding-right: 10px;
        display: block;
        overflow: auto;
        height: 350px;
        overflow-x: hidden;
    }

    .step::-webkit-scrollbar {
        background-color: #000000;
        width:5px;
    }

    .step::-webkit-scrollbar-thumb {
        background: #ef8354;
        border-radius: 25px;
    }

    .valid-box {
        width: 100%;
        color: #4f5d75;
        height: max-content;
        background-color: #ffffff;
        border-radius: 8px;
        margin: 0 auto;
        padding: 4%;
        font-family: 'Source Sans Pro';
    }

    .status-valid {
        display: flex;
        width: 60px;
        height: min-content;
        border: 1px solid #4f5d75;
        background-color: transparent;
        color: #4f5d75;
        text-align: center;
        justify-content: center;
        padding: 5px;
    }

    .status-invalid {
        display: flex;
        width: 60px;
        height: min-content;
        background-color: #ef8354;
        color: #ffffff;
        text-align: center;
        justify-content: center;
        padding: 5px;
    }
</style>
<div class="content p-2">
    <div id="container" class="container mt-5">
      
    <div class="row d-flex justify-content-center text-align-center mt-0 mb-4">
        <div class="col-md-2 text-start">&nbsp;ITEM</div>
        <div class="col-md-4 text-center">&ensp;&ensp;&nbsp;&nbsp;SHIPPING</div>
        <div class="col-md-4 text-start">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;BID</div>
        <div class="col-md-2 text-end">VALIDATION</div>
    </div>
    <div class="progress px-1" style="height: 3px;">
        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    
    <div class="step-container d-flex justify-content-between">
        <div class="step-circle" onclick="displayStep(1)">1</div>
        <div class="step-circle" onclick="displayStep(2)">2</div>
        <div class="step-circle" onclick="displayStep(3)">3</div>
        <div class="step-circle" onclick="displayStep(4)">4</div>
    </div>

    <form id="multi-step-form" id="data-item">
        <div class="step step-1 ">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-flex justify-content-end align-text-center">
                        <img src="{{ asset('img/default.jpg') }}" alt="catikku" class="img-big">
                    </div>
                    <div class="col-6 d-flex justify-content-start align-text-center">
                        <div class="container">
                            <div class="row row-cols-2" id="image-container">
                                
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-sm mt-3" style="background-color: #ffffff; color: #4f5d75; width: 250px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-image"></i> <strong>Show Certificate</strong>
                                </button>
                            </div>
                        </div>     
                    </div>
                </div>
                
                <div class="row">
                    <div id="myForm" class="form-auc">
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control form-control-md" placeholder="Masukkan Nama">
                            </div>
                            <div class="col-sm-4">
                                <label for="kategori" class="form-label">Kategori</label>
                                <div id="showKategori"></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="desc" class="form-label"><strong>Deskripsi</strong></label>
                            <fieldset>
                                <textarea name="desc" id="desc" cols="30" rows="5" class="form-control form-control-sm text-decoration-none" placeholder="Deskripsikan Diri Anda..."></textarea>
                            </fieldset>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label for="start" class="form-label">Price Starts In</label>
                                <input type="number" id="price" name="price" class="form-control form-control-md" placeholder="IDR">
                            </div>
                            <div class="col-sm-6">
                                <label for="start" class="form-label">Price Increment</label>
                                <input type="number" id="min" name="min" class="form-control form-control-md" placeholder="IDR">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn next-step" style="background-color: #ef8354;">Next</button>
            </div>
        </div>

        <div class="step step-2">
                <div class="row">
                    <div id="myForm" class="form-auc">
                        <div class="row">
                            <div class="col-12">
                                <label for="sender" class="form-label">Nama Pengirim</label>
                                <input type="text" id="sender" name="sender" class="form-control form-control-md" placeholder="Masukkan Nama" >
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="desc" class="form-label"><strong>Alamat Pengirim</strong></label>
                            <fieldset>
                                <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control form-control-sm" placeholder="Deskripsikan Diri Anda..."></textarea>
                                
                            </fieldset>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label for="kategori" class="form-label">Jasa Pengirim</label>
                                <div id="showKirim">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="start" class="form-label">No. Telp</label>
                                <input type="number" id="notelp" name="notelp" class="form-control form-control-md" placeholder="Masukkan No. Telp" >
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="d-flex justify-content-end">
                <button type="button" class="btn prev-step" style="background-color: none; border: 1px solid #ef8354; color: white; margin-right: 10px;">Previous</button>
                <button type="button" class="btn next-step" style="background-color: #ef8354;">Next</button>
            </div>
        </div>

        <div class="step step-3">
            <div class="mb-3">
                <div class="form-auc">
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="start" class="form-label">ID Lelang</label>
                            <input type="number" id="idAuc" name="idAuc" class="form-control form-control-md" placeholder="Auto Inc" >
                        </div>
                        <div class="col-sm-6">
                            <label for="start" class="form-label">Tanggal Lelang</label>
                            <input type="date" id="start-date" name="start" class="form-control form-control-md" placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="start" class="form-label">Waktu Mulai</label>
                            <input type="time" id="start-time" name="start" class="form-control form-control-md" placeholder="Auction Start">
                        </div>
                        <div class="col-sm-6">
                            <label for="start" class="form-label">Waktu Selesai</label>
                            <input type="time" id="end-time" name="start" class="form-control form-control-md" placeholder="IDR">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn prev-step" style="background-color: none; border: 1px solid #ef8354; color: white; margin-right: 10px;">Previous</button>
                <button type="button" class="btn next-step" style="background-color: #ef8354;">Next</button>
            </div>
        </div>

        <div class="step step-4">
            <div class="mb-3">
                <div class="valid-box">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Checking Category</th>
                            <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Item Checking</td>
                                <td>
                                    <div class="status-invalid rounded" id="validation-1">Valid</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Shipping Checking</td>
                                <td><div class="status-invalid rounded" id="validation-2">Valid</div></td>
                            </tr>
                            <tr>
                                <td>Bid Checking</td>
                                <td><div class="status-invalid rounded" id="validation-3">Valid</div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="updateVerified">
                <input type="hidden" id="verified" name="verified" value="1">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn prev-step" style="background-color: none; border: 1px solid #ef8354; color: white; margin-right: 10px;">Previous</button>
                    <button type="button" class="btn next-step" style="background-color: #ef8354;">Verify</button>
                </div>
            </div>
        </div>
    </form>

    <div id="alert-container" class="pt-2"></div>

    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="validationModalLabel">Validation Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure the data is valid?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmValidation">Confirm</button>
                </div>
                
            </div>
        </div>
    </div>
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
    //buat nampilin foto2 yang beda
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.img-small').forEach(function (thumbnail) {
            thumbnail.addEventListener('click', function () {
                document.querySelectorAll('.img-small').forEach(function (imgSmall) {
                    imgSmall.style.border = 'none';
                });
                
                thumbnail.style.border = '2px solid #ef8354';

                var largeImageUrl = thumbnail.src.replace('img-small', 'img-big'); // Mengganti path ke gambar besar
                document.querySelector('.img-big').src = largeImageUrl;
            });
        });
    });
    //kode progress bar
    var currentStep = 1;
    var updateProgressBar;

    function displayStep(stepNumber) {
        if (stepNumber >= 1 && stepNumber <= 3) {
        $(".step-" + currentStep).hide();
        $(".step-" + stepNumber).show();
        currentStep = stepNumber;
        updateProgressBar();
        }
    }

    function fetchAuctionData() {
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedId');
        console.log('id auction' + id);
        $.ajax({
            url: 'api/verif/'+id,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (data) {
                var auction = data.data.data;
                console.log(auction);
                $("#nama").val(auction.product.nama_produk);
                $("#desc").val(auction.product.deskripsi);
                $("#price").val(auction.product.harga_start);
                $("#min").val(auction.product.minimal_inkremen_bid);
                $("#sender").val(auction.seller.nama_user);
                $("#alamat").val(auction.seller.alamat);
                $("#notelp").val(auction.seller.no_telp_user);
                $("#idAuc").val(auction.id_auction);
                $("#start-date").val(getFormattedDate(auction.time_start));
                $("#start_time").val(getFormattedTime(auction.time_start));
                $("#end-time").val(getFormattedTime(auction.time_end));
                $("#image-container").html(showPicture(data.data.gambarArray));
                $("#sertif").attr('src', "{{ asset('storage/img') }}/" + auction.product.sertifikat);
                $("#showKategori").html(showKategori(auction.product.kategori_produk.jenis_kategori));
                $("#showKirim").html(showKirim(auction.shipment.jenis_shipment));
            },
            error: function (error) {
                console.error('Error fetching auction data:', error);
            }
        });
    }

  $(document).ready(function() {
    fetchAuctionData();

    $('#multi-step-form').find('.step').slice(1).hide();
  
    $(".next-step").click(function() {
      if (currentStep < 4) {
        $('#validationModal').modal('show');
      } else if (currentStep == 4) {
        // Update Verified
        const accessToken = localStorage.getItem('access_token');
        const id = localStorage.getItem('selectedId');
        console.log('id user di admin edit ' + id);
        if (!accessToken) {
            console.error('Access token not available. Redirect to login.');
            window.location.href = 'api/login';
            return;
        }

        var formData = {
            verified: $('#verified').val()
        };

        $.ajax({
            type: "PUT",
            url: 'api/verif/'+ id,
            data: formData,
            headers: {
                'Authorization': 'Bearer ' + accessToken,
            },
            success: function(response) {
                console.log(response);
                $("#alert-container").html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Verifikasi telah dilakukan
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
      }
    });

    $("#confirmValidation").click(function() {
        // Close the modal
        $('#validationModal').modal('hide');
        //ubah status valid di step 4
        console.log(currentStep);
        updateValidationStatus(currentStep);

        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
        currentStep++;
        setTimeout(function() {
            $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
            $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
            updateProgressBar();
        }, 500);
    });

    $(".prev-step").click(function() {
      if (currentStep > 1) {
        $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
        currentStep--;
        setTimeout(function() {
          $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
          $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
          updateProgressBar();
        }, 500);
      } 
    });

    updateProgressBar = function() {
      var progressPercentage = ((currentStep - 1) / 3) * 100;
      $(".progress-bar").css("width", progressPercentage + "%");
    }
  });

    

    function updateValidationStatus(step) {
        console.log(step);
        var validationId = "#validation-" + step;
        $(validationId).removeClass("status-invalid").addClass("status-valid").html("Valid");
    }

    function showPicture(gambar) {
        var html = '';
        var max = 4;
        
        gambar.slice(0, max).forEach(function (item) {
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
            <select id="kategori" name="kategori" class="form-select" data-bs-theme="light">
                <option value="">Pilih Kategori</option>
                <option value="Art and Collectibles" ${selectedCategory === 'Art and Collectibles' ? 'selected' : ''}>Art and Collectibles</option>
                <option value="Fashion" ${selectedCategory === 'Fashion' ? 'selected' : ''}>Fashion</option>
                <option value="Otomotif" ${selectedCategory === 'Otomotif' ? 'selected' : ''}>Otomotif</option>
                <option value="Real Estate" ${selectedCategory === 'Real Estate' ? 'selected' : ''}>Real Estate</option>
                <option value="Sport" ${selectedCategory === 'Sport' ? 'selected' : ''}>Sport</option>
                <option value="Jewelry" ${selectedCategory === 'Jewelry' ? 'selected' : ''}>Jewelry</option>
            </select>
        `;

        return html;
    }

    function showKirim(selectedCategory) {
        console.log(selectedCategory);
        var html = `
            <select id="kategori" name="kategori" class="form-select" data-bs-theme="light">
                <option value="">Pilih Kategori</option>
                <option value="JNE" ${selectedCategory === 'JNE' ? 'selected' : ''}>JNE</option>
                <option value="Tiki" ${selectedCategory === 'Tiki' ? 'selected' : ''}>Tiki</option>
                <option value="Pos Indonesia" ${selectedCategory === 'Pos Indonesia' ? 'selected' : ''}>Pos Indonesia</option>
            </select>
        `;

        return html;
    }

    function enlargeImage(imgUrl) {
            var bigImageContainer = document.querySelector('.img-big');
            bigImageContainer.src = imgUrl;
        }
  
    function getFormattedDate(dateTimeString) {
        const date = new Date(dateTimeString);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function getFormattedTime(dateTimeString) {
        const date = new Date(dateTimeString);
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
    }
</script>
@endsection