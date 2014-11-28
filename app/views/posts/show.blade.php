<h1>{{ $post->title }}</h1>
{{ link_to('posts/'.$post->id.'/edit', 'Edit') }}
<div>
	{{ $post->body }}
</div>