@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h4>Laravel Ajax CRUD with Modal</h4>
            <a class="btn btn-primary" href="{{url('teacher')}}">Teacher</a>
            <a class="btn btn-primary" href="{{url('catagory')}}">Catagory</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" onclick="addmodal()">
                        Add New
                      </button>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Name</th>
                        <th scope="col">email</th>
                        <th width="20%" scope="col">Action</th>
                        </tr>
                    </thead>
                     <tbody>
                    </tbody> 
                </table>
                </div>
            </div>
        </div>

        {{-- Modal  --}}
<div class="modal fade" id="datamodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form id="dataform">
                    @csrf
                    <input type="hidden" id="id" name="id">
              <div class="form-group">
                <label for="cat_id">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                <span class="text-danger" id="name_err"></span>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="E-Mail">
                <span class="text-danger" id="email_err"></span>
              </div>
            
              <div class="form-group">
                <div class="col-sm-10">
                  <button type="submit" id="addbtn" class="btn btn-primary">Add New</button>
                  <button type="submit" id="upbtn" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
            </div>
        </div>
        
    </div>
</div>

    </div>
</div>
@endsection
@section('script')
<script>
    var mymodal = $('#datamodal')
    $.ajaxSetup({
        headers: {'X-CSRF-Token' : '{{csrf_token()}}'}
    })
    function getData(){
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/cricketer/all",
            success: function(response){
                var html =""
                $.each(response,function(key, value){
                    html = html + "<tr>"
                    html = html + "<td> "+ value.id + "</td>"
                    html = html + "<td> "+ value.name + "</td>"
                    html = html + "<td> "+ value.email + "</td>"
                    html = html + "<td>"
                    html = html + "<button class='btn btn-sm btn-secondary' onclick='edit("+value.id+")'><i class='fa fa-edit'></i></button> | "
                    html = html + "<button class='btn btn-sm btn-danger' onclick='deleted("+value.id+")'><i class='fa fa-trash'></i></button>"
                    html = html + "</td>"
                    html = html + "</tr>"
                })
                $('tbody').html(html)
            }
        })
    }
    getData()
    function reset(){
        $('#name').val('')
        $('#email').val('')
        $('#name_err').text('')
        $('#email_err').text('')
    }


    function addmodal(){
        mymodal.modal('show');
        mymodal.find('.modal-title').text('Add New Cricketer');
        $('#addbtn').show();
        $('#upbtn').hide();
    }

$('#addbtn').on('click',function(e){
    e.preventDefault();
    var data = $('#dataform').serialize();
    var url = "{{ url('/cricketer/store') }}"
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function(response){
            mymodal.modal('hide');
                getData()
                reset()
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                    })

                    Toast.fire({
                    icon: 'success',
                    title: 'Cricketer created successfully'
                })
            },
        error: function (error){
            $('#name_err').text(error.responseJSON.errors.name)
            $('#email_err').text(error.responseJSON.errors.email)
        }
    })
})

    // Edit Data 
function edit(id){
        mymodal.modal('show');
        mymodal.find('.modal-title').text('Update Cricketer');
        $('#upbtn').show();
        $('#addbtn').hide();
        $.ajax({
            type: 'get',
            dataType: 'json',
            url:'cricketer/edit/' + id,
            success: function (response) {
                $('#id').val(response.id)
                $('#name').val(response.name)
                $('#email').val(response.email)
            }
        })
}
$('#upbtn').on('click',function(e){
    e.preventDefault();
    var id = $('#id').val();
    var data = $('#dataform').serialize();
    var url = '{{ url("cricketer/update") }}/' + id
    $.ajax({
        url: url,
        type:'post',
        data:data,
        success: function(response){
            mymodal.modal('hide');
                getData()
                reset()
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                    })

                    Toast.fire({
                    icon: 'success',
                    title: 'Cricketer updated successfully'
                })
        },
        error: function(error){
            $('#name_err').text(error.responseJSON.errors.name)
            $('#email_err').text(error.responseJSON.errors.email)
        }
    })
})

    // Delete Data 
    function deleted(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'get',
                    dataType : 'json',
                    url: 'cricketer/destroy/' + id,
                    success : function(response){
                            getData()
                    },
                    error: function(error){
                        console.log(error)
                    }
                })
            }
        })

       
    }
    
           

</script>
    
@endsection