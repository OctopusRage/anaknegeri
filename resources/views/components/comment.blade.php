@foreach ($comments as $comment)
<div class="card mb-2">
  <div class="card-block">    
    <div class="media">  
      <img class="d-flex mr-3 rounded-circle" style="max-width: 48px"  @if($comment->user->profile_img!=null && $comment->anonim == true) src="{{ asset('img/avatars/')}}/{{ $comment->user->profile_img }}" @else src="{{ asset('img/primary.png' )}}" @endif alt="Generic placeholder image">
      <div class="media-body">
        <p class="h6 text-bold mt-2">
          @if($comment->anonim == false) {{$comment->user->name}} @else Anonim @endif
        <br>
        </p>
        <span class="badge badge-info px-3 pt-2 my-2 float-right">
          <h5>{{$comment->item}} : @if($comment->item == "Dana") Rp. @endif {{ $comment->amount }}</h5>
        </span>
        
        <p><small><i class="icon-calendar"></i> &nbsp; <?php echo date('D, d M Y', strtotime($comment->created_at)); ?></small></p>
        <p>{{$comment->comment}}</p>
      </div>
    </div>
  </div>
</div>
@endforeach