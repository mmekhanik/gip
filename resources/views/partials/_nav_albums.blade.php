
@if(isset($sorted_albums) && count($sorted_albums))
   
    @foreach($sorted_albums as $album)
        <a class="item" href="{{ route('albums', ['album_id'=>$album->id]) }}">{{$album['name']}}</a>
    @endforeach

    <a class="item item-all-entities" style="background-color: #f3f3f3 !important; font-weight: bold !important;" href="{{ route('albums') }}">View Gallery</a>
   
   
@endif
