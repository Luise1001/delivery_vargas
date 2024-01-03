@extends('app.layouts.index')

@section('meta')
    <meta name="theme-color" content="#fce944" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/schedules/style.css') }}">
@endsection

@section('messages')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('titulo-app')
    <div class="titulo-app">
        <button class="back-button" onclick=history.back()><i class="fa-solid fa-arrow-left"></i></button>
        MI HORARIO
    </div>
@endsection

@section('content')
    <div class="principal-layout">
        <div class="schedule">
            <form id="schedule_form" action="{{ route('commerce.schedule.update') }}" method="post">
                @csrf
                @method('PUT')
                @if ($mySchedule)    
                    @foreach ($mySchedule as $day)
                        <div class="form-check form-switch schedule-switch">
                            <div class="text-switch">
                                <input type="hidden" name="day_id" value="{{ $day->day_id }}">
                                {{ $day->day->day }}
                            </div>
                            <div class="input-hour">
                                <input class="open" type="time" name="open" value="{{$day->open}}">
                                <input class="close" type="time" name="close" value="{{$day->close}}">
                            </div>
                            <div class="enable-switch">
                                <input class="form-check-input switch-time selector" type="checkbox" checked role="switch">
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($days)
                    @foreach ($days as $day)
                        <div class="form-check form-switch schedule-switch">
                            <div class="text-switch">
                                <input type="hidden" name="day_id" value="{{ $day->id }}">
                                {{ $day->day }}
                            </div>
                            <div class="input-hour">
                                <input hidden class="open" type="time" name="open" value="08:00">
                                <input hidden class="close" type="time" name="close" value="12:00">
                            </div>
                            <div class="enable-switch">
                                <input class="form-check-input switch-time selector" type="checkbox" role="switch">
                            </div>
                        </div>
                    @endforeach
                @endif
                @error('schedules')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="container">
                    <button class="save-button" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        const selectors = document.querySelectorAll(".selector");
        const open = document.querySelectorAll(".open");
        const close = document.querySelectorAll(".close");
        const form = document.getElementById("schedule_form");
        const array = [];

        form.addEventListener("submit", (e) => {
            e.preventDefault();
            selectors.forEach(selector => {

                if (selector.checked) {
                    const schedule = {
                        day_id: selector.parentElement.parentElement.querySelector(
                            "input[name='day_id']").value,
                        open: selector.parentElement.parentElement.querySelector(".open").value,
                        close: selector.parentElement.parentElement.querySelector(".close").value
                    }

                    array.push(schedule);
                }
            });

            let data = JSON.stringify(array);
            let input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "schedule");
            input.setAttribute("value", data);
            form.appendChild(input);
            form.submit();
        });

        $('.selector').on('change', function(e) {
            selectors.forEach(selector => {
                if (selector.checked) {
                    selector.parentElement.parentElement.querySelector(".open").hidden = false;
                    selector.parentElement.parentElement.querySelector(".close").hidden = false;
                } else {
                    selector.parentElement.parentElement.querySelector(".open").hidden = true;
                    selector.parentElement.parentElement.querySelector(".close").hidden = true;
                }
            });
        });
    </script>
@endsection
