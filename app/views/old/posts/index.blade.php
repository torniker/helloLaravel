<ul>
@foreach($posts as $post)
	<li>
		{{ link_to('posts/'.$post->id, $post->title) }}
	</li>
@endforeach
</ul>