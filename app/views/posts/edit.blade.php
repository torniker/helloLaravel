{{ Form::open(array('url' => 'posts/'.$post->id, 'method' => 'put')) }}
    {{ Form::text('title', $post->title) }}
    {{ Form::textarea('body', $post->body) }}
    {{ Form::submit('Save') }}
{{ Form::close() }}