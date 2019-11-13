<div class="table-responsive">
    <table class="table" id="news-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Image</th>
        <th>Summary</th>
        <th>Content</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($news as $news)
            <tr>
                <td>{!! $news->name !!}</td>
            <td><img src="{!! $news->image !!}" width="50px" height="50px"></td>
            <td>{!! $news->summary !!}</td>
            <td>{!! $news->content !!}</td>
                <td>
                    {!! Form::open(['route' => ['news.destroy', $news->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('news.show', [$news->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('news.edit', [$news->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'id' => 'confirm_delete']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>