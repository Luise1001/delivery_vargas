<div class="slider">
    <div class="type-order-title">Conductores</div>
    <div id="usuarios">
        @if ($drivers)
            @foreach ($drivers as $driver)
                <div class='card-list'>
                    <div class='card-list-header'>
                        <strong class='me-auto'>{{ $driver->created_at->format('d/m/y') }} </strong>
                        <small> {{ $driver->updated_at->format('d/m/y H:i:s') }} </small>
                    </div>
                    <div class='card-list-body'>
                        <div class='list-img'>
                            @if ($driver->photo == true)
                                @php
                                    $id = $driver->id;
                                @endphp
                                <img class="img-list"
                                    src="{{ asset("assets/storage/profile/users/$id/photo/perfil.jpg") }}"
                                    alt="Foto de Perfil">
                            @else
                                @php
                                    $letter = $driver->username[0];
                                @endphp
                                <img class="img-list"
                                    src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                                    alt="Foto de Perfil">
                            @endif
                        </div>
                        <div class='list-data'>
                            <div class='card-list-title'> {{$driver->username}} </div>
                            <div class='list-text'>
                                <div>{{$driver->email}} <a class='list-link' href="mailto:{{$driver->email}}" target='_blank'><i
                                            class='fa-solid fa-envelope'></i></a></div>
                                <div><a href=" {{route('user.list.edit', [$driver->id])}} " class='list-link convertir-usuario'>Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>