@extends('emails.layouts.basic')

@section('content')
<table class="main" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="content-wrap">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="content-block">
                        Hello {{$user_first_name}},
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        "{{$song_title}}" by {{$song_artist}} was suggested by {{$suggester_first_name}}.
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        {{ link_to_route('songs.show', 'Vote Now', ['id' => $song_id], ['class' => 'btn-primary']) }}
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        &mdash; Song Suggest
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@stop