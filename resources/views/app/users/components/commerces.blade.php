<div class="slider">
    <div class="type-order-title">Usuarios de Comercios</div>
    <div id="comercios">
        @if ($commerces)
            @foreach ($commerces as $user)
            <div class='card-list'>
                <div class='card-list-header'>
                    <strong class='me-auto'>{{ $user->created_at->format('d/m/y') }} </strong>
                    <small> {{ $user->updated_at->format('d/m/y H:i:s') }} </small>
                </div>
                <div class='card-list-body'>
                    <div class='list-img'>
                        @if ($user->photo == true)
                            @php
                                $id = $user->id;
                            @endphp
                            <img class="img-list"
                                src="{{ asset("assets/storage/profile/users/$id/photo/perfil.jpg") }}"
                                alt="Foto de Perfil">
                        @else
                            @php
                                $letter = $user->username[0];
                            @endphp
                            <img class="img-list"
                                src="{{ asset("assets/storage/profile/letters/$letter.jpg") }}"
                                alt="Foto de Perfil">
                        @endif
                    </div>
                    <div class='list-data'>
                        <div class='card-list-title'> {{$user->username}} </div>
                        <div class='list-text'>
                            <div>{{$user->email}} <a class='list-link' href="mailto:{{$user->email}}" target='_blank'><i
                                        class='fa-solid fa-envelope'></i></a></div>
                            <div> <a href=" {{route('user.list.edit', [$user->id])}} " class='list-link convertir-usuario'>Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>