@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h4>Laravel Ajax CRUD</h4>
            <a class="btn btn-primary" href="{{url('cricketer')}}">Cricketer</a>
            <a class="btn btn-primary" href="{{url('catagory')}}">Catagory</a>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Name</th>
                        <th scope="col">Post</th>
                        <th scope="col">Gender</th>
                        {{-- <th scope="col">Photo</th> --}}
                        <th width="20%" scope="col">Action</th>
                        </tr>
                    </thead>
                     <tbody>
                    </tbody> 
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 id="addform">Add New Teacher</h5>
                    <h5 id="upform">Update Teacher</h5>
                </div>
                <div class="card-body">
                    <form id="dataform">
                        @csrf
                  <div class="form-group">
                    <label for="id">Name</label>
                    <input type="hidden" id="id" name="id">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    <span class="text-danger" id="name_err"></span>
                  </div>
                <div class="form-group">
                    <label for="id">Post Type</label>
                    <select name="cat_id" id="" class="form-control">
                        <option value="">Select one</option>
                        <option value="3"> one</option>
                        <option value="4"> two</option>
                    </select>
                    <span class="text-danger" id="cat_err"></span>
                </div>
                <div class="form-group">
                    <label for="id">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                        <label class="form-check-label" for="male">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                        <label class="form-check-label" for="female">Female</label>
                      </div> <br>
                      <span class="text-danger" id="gender_err"></span>
                </div>
                {{-- <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" class="form-control-file" id="image">
                  </div> --}}
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
@endsection
@section('script')
<script>
    $('#upform').hide()
    $('#upbtn').hide()
    $.ajaxSetup({
        headers: {'X-CSRF-Token' : '{{csrf_token()}}'}
    })
    function getData(){
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/teacher/all",
            success: function(response){
                var html =""
                $.each(response,function(key, value){
                    html = html + "<tr>"
                    html = html + "<td> "+ value.id + "</td>"
                    html = html + "<td> "+ value.name + "</td>"
                    html = html + "<td> "+ value.cat_id + "</td>"
                    html = html + "<td> "+ value.gender + "</td>"
                    // html = html + "<td> "+ value.image + "</td>"
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
        $('#name_err').text('')
        $('#cat_err').text('')
        $('#gender_err').text('')
    }

        $('#addbtn').on('click',function(e){
        e.preventDefault();
        var data = $('#dataform').serialize()
        var url = '{{ url('teacher/store') }}'
        $.ajax({
            url:url,
            type:'post',
            data:data,
            success: function(response){
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
            error: function(error){
                $('#name_err').text(error.responseJSON.errors.name)
                $('#cat_err').text(error.responseJSON.errors.cat_id)
                $('#gender_err').text(error.responseJSON.errors.gender)
                console.log(error)
            }
        })
    })

    // Edit Data 

    function edit(id){
    //    $.ajax({
    //        type: 'get',
    //        dataType : 'json',
    //        url: 'catagory/edit/' + id,
    //        success : function(response){
    //         $('#addform').hide()
    //         $('#addbtn').hide()
    //         $('#upform').show()
    //         $('#upbtn').show()
    //         $('#name').val(response.name)
    //         $('#id').val(response.id)
    //            console.log(response)
    //        },
    //        error: function(error){
    //            console.log(error)
    //        }

    //    })
    }

    // Update Data 
    // $('#upbtn').on('click',function(e){
    //     e.preventDefault();
    //     var data = $('#dataform').serialize()
    //     var id = $('#id').val()
    //     $.ajax({
    //         type : 'post',
    //         data: data,
    //         url: 'catagory/update/'+ id,
    //         success: function(response){
    //             getData()
    //             $('#upform').hide()
    //             $('#upbtn').hide()
    //             $('#addform').show()
    //             $('#addbtn').show()
    //             reset()
    //             const Toast = Swal.mixin({
    //                 toast: true,
    //                 position: 'top-end',
    //                 showConfirmButton: false,
    //                 timer: 3000,
    //                 timerProgressBar: true
    //                 })

    //                 Toast.fire({
    //                 icon: 'success',
    //                 title: 'Catagory updated successfully'
    //             })
    //         },
    //         error: function (error){
    //             $('#name_err').text(error.responseJSON.errors.name)
    //         }
    //     })
    // })

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
                    url: 'teacher/destroy/' + id,
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