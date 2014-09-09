@extends('emails.layouts.basic')

@section('content')
<table class="main" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="content-wrap">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="content-block">
                        Password Reset
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        To reset your password, complete this form:
                    </td>
                </tr>
                <tr>
                    <td class="content-block">
                        {{ link_to('password/reset/'.$token, 'Reset Password', ['class' => 'btn-primary']) }}
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