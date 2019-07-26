<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Summary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('summary', 'Summary:') !!}
    {!! Form::text('summary', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <div class="fileupload fileupload-new" data-provides="fileupload">
        <div class="fileupload-preview thumbnail" style="width: 500px; height: 300px">
        </div>

        <div>
            <span class="btn btn-default btn-file">
                <span class="fileupload-new">
                    Add Image
                </span>
                {!! Form::file('image', ['accept' => 'image/*']) !!}
            </span>
            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">
                Delete
            </a>
        </div>
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'name' => 'content', 'id' => 'editor1']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('news.index') !!}" class="btn btn-default">Cancel</a>
</div>
