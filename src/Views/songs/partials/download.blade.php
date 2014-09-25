@if($song->mp3_file !== null && $song->mp3_file != '')
<hr>
{{link_to_route('songs.download', 'Download MP3', ['id' => $song->id], ['class' => 'btn btn-primary'])}}
<hr class="visible-xs visible-sm">
@endif