@extends('email.email_template')

@section('emailContent')
    <p style="font-size:22px;padding:0px;margin:0px 0px 40px 0px;line-height:30pxÇ; color: #18093F; opacity: 0.5;">Proceda a confirmar su cuenta</p>

    <div style="display: flex !important; justify-content: center !important;">
        <p style="display:inline-block;margin:auto;" align="center"><a href="{{ $link }}" class="verify-button" target="_blank">Verificar</a></p>
    </div>
@endsection
