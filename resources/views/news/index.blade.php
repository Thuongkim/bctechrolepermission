@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">News</h1>
    <h1 class="pull-right">
       <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('news.create') !!}">Add New</a>
   </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('news.table')
        </div>
    </div>
    <div class="text-center">

    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    document.getElementById("confirm_delete").addEventListener("click", function(event){
      event.preventDefault()
      var form = event.target.form;
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      })
      console.log(result);
      debugger;
      .then((result) => {
          if (result.value) {
             form.submit();
             Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
          }
          else {
            swal("Your imaginary file is safe!");
          }
    })

  });

</script>
@endsection
