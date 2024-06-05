@extends('admin.layout.app')

@section('main')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @if(Session::has('success'))
                    <p>{{ Session::get('success') }}</p>
                    @endif
                    <a href="categories.html" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="" name="categoryForm" id="categoryForm">
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                            </div>
                            <p class="error_name"></p>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">	
                            </div>
                            <p class="error_slug"></p>
                        </div>	
                       
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                               <select class="form-control" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Block</option> 
                            </select>	
                            </div>
                        </div>	
                        <p class="error_status"></p>									
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
           </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('custom.Js')
<script type="text/javascript">

$("#categoryForm").submit(function(e){
    e.preventDefault();
    $.ajax({
        url : "{{ route('category.store') }}",
        type : "POST",
        data : $('#categoryForm').serialize(),
        dataType : "json",
        success : function(response){
            if(response.status == true){
                window.location.href = "{{ route('category.list') }}"
            }else{
                var errors  = response.errors
                if(errors.name){
                    $(".error_name").html(errors.name[0]);
                }else{
                    $(".error_name").html('');
                }
                if(errors.slug){
                    $(".error_slug").html(errors.slug[0]);
                }else{
                    $(".error_slug").html('');
                }
                if(errors.status){
                    $(".error_status").html(errors.status[0]);
                }else{
                    $(".error_status").html('');
                }
            }
        } , error: function(jqXHR , exception){
            console.log("something went wrong");
        }
    });
});


// script for slug generate

$("#name").change(function(){
    $.ajax({
        url : "{{ route('getslug') }}",
        type : "get",
        data :{title : $("#name").val()},
        dataType : "json",
        success : function(response){
            if(response.status == true){
                $("#slug").val(response.slug);
            }
        }
    });
});

</script>

@endsection