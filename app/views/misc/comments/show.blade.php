<div class="ibox float-e-margins">
    <div class="ibox-title no-height"><h2>Comments ({{ $comments->count() }})</h2></div>
    <div class="ibox-content no-padding">

      <ul class="list-group"><div class="comments-list">
        @foreach($comments as $comment)
          <li class="list-group-item">
          <p><a class="text-info" href="{{ URL::to('freelancer',$comment->user->id) }}">{{ "@".$comment->user->username }} {{ $comment->user_badge() }}</a>&nbsp;&nbsp;{{ $comment->message }} </p>
          <small class="block text-muted"><i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}</small>
          </li>
        @endforeach
      </ul>
      </div>
</div>
