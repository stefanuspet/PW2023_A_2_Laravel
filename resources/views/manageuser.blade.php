@extends('sidebar')

@section('content')

<style>
    .card {
        border-radius: 10px;
        border: none;
        margin-top: 10px;
    }

    .btn-custom {
        color: white;
        background-color: #ef8354;
        border-color: #ef8354;
    }

    .btnnumber {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        width: 50px;
    }
</style>


<div class="container-fluid pb-3" style="background-color: #2d3142;">
    <div class="row">
        <div class="col-6">
            <h1 class="my-2 ml-3" style="color: #ef8354;"><strong>Manage User</strong> </h1>
        </div>
        <div class="col-6 p-3">
            <form class="form-inline float-end">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                    <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                </button>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-3">
            <h4 class=" ml-3 text-light"> User Count : </h4>
        </div>
        <div class="col">
            <input type="text" class="rounded btnnumber" id="countuser" readonly>
        </div>
    </div>

    <div id="userCardsContainer" class="row"></div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah yakin ingin menghapus user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-custom" id="confirmbtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    function fetchUsers() {
        const accessToken = localStorage.getItem('access_token');
        $.ajax({
            url: "{{ url('api/admin/showuser') }}",
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function(response) {
                console.log(response);

                displayUsers(response.users);
                $('#countuser').val(response.users.length);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function displayUsers(users) {
        var container = $('#userCardsContainer');

        // Clear existing content in the container
        container.html('');

        // Loop through the users and create a card for each
        users.forEach(function(user) {
            var card = `
                <div class="card col-5 mx-4">
                    <div class="card-header" style="background-color: white">
                        <strong>${user.username}</strong>                        
                        <button type="button" class="close" aria-label="Close" onclick="openDeleteModal(${user.id_user})">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="${user.profile_pic ? "{{ asset('storage/img') }}/" + user.profile_pic : "{{ asset('img/profil_pic.jpg') }}"}" alt="Profile Picture" class="img-fluid rounded-circle">
                            </div>
                            <div class="col-7">
                                <p>ID: ${user.id_user}</p>
                                <p>Name: ${user.nama_user}</p>
                                <p>Email: ${user.email_user}</p>
                            </div>
                            <div class="col-1 mt-auto">
                                <a href="#" onclick="saveUserIdToLocalStorage(${user.id_user})">
                                    <button type="button" class="btn btn-primary float-end rounded-circle " style="border:none; background-color: #ef8354;">
                                        <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;

            // Append the card to the container
            container.append(card);

        });
    }

    function saveUserIdToLocalStorage(userId) {
        localStorage.setItem('selectedUserId', userId);
        console.log(userId);
        window.location.href = "{{ url('admineditprofil') }}";
    }

    function openDeleteModal(userId) {
        localStorage.setItem('usertodelete', userId);
        $('#deleteModal').modal('show');
    }


    $(document).ready(function() {
        fetchUsers();

        $('#confirmbtn').click(function() {
            const accessToken = localStorage.getItem('access_token');
            const userId = localStorage.getItem('usertodelete');
            $.ajax({
                url: "api/admin/deleteuser/" + userId,
                method: "DELETE",
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>

@endsection