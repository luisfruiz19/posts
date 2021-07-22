@component('mail::message')
# Notificacion de Correo

Hola mi nombre es {{ $name }} necesito informacion del proyecto {{ $proyect }}<br>
mis datos son :
<ul>
    <li>nombre: {{$name}}</li>
    <li>dni: {{$dni}}</li>
    <li>telefono: {{$phone}}</li>
    <li>email: {{$email}}</li>
</ul>
<br>
deseo ser contactado mediante {{ $contacted }}
<br>
comentarios : {{$comments}}

Gracias,<br>
{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} . All rights reserved.
    @endcomponent
@endslot
@endcomponent

