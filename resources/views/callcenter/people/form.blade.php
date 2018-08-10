@extends('layouts.app')

@section('content')

<div class="card" id="vue-personal-info">
    <div class="card-header">{{ __('Dados pessoais') }}</div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

        @if (isset($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif

        @if(session()->has('warning'))
        <div class="alert alert-warning">
            {{ session()->get('warning') }}
        </div>
        @endif

        <form method="POST" action="{{ route('persons.store') }}" aria-label="{{ __('Persons') }}">
            @csrf

            @if (isset($person))
            <input name="person_id" type="hidden" value="{{ $person->id }}">
            @endif

            @if (isset($workflow))
            <input name="workflow" type="hidden" value="{{ $workflow }}">
            @endif

            <div class="form-group row">
                <label for="cpf_cnpj" class="col-sm-4 col-form-label text-md-right">{{ __('CNPJ/CPF')}}</label>

                <div class="col-md-6">
                    <input id="cpf_cnpj" type="cpf_cnpj"
                           class="form-control{{ $errors->has('cpf_cnpj') ? ' is-invalid' : '' }}"
                           name="cpf_cnpj"
                           value="{{is_null(old('cpf_cnpj')) ? $person->cpf_cnpj : old('cpf_cnpj')}}"
                           required autofocus
                           v-mask='["###.###.###-##", "##.###.###/####-##"]'
                           {{$person->id ? 'disabled="disabled"' : '' }}
                    >

                    @if ($errors->has('cpf_cnpj'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cpf_cnpj') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Nome Completo')}}</label>

                <div class="col-md-6">
                    <input id="name"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{is_null(old('name')) ? $person->name : old('name')}}"
                           required autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="identification" class="col-sm-4 col-form-label text-md-right">{{ __('RG')}}</label>

                <div class="col-md-6">
                    <input id="identification"
                           class="form-control{{ $errors->has('identification') ? ' is-invalid' : '' }}"
                           name="identification"
                           value="{{is_null(old('identification')) ? $person->identification : old('identification')}}"
                           required autofocus>

                    @if ($errors->has('identification'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('identification') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        @if (isset($workflow) && $workflow)
                        {{ __('Próximo passo >>') }}
                        @else
                        {{ __('Gravar') }}
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if (isset($records))
@include('callcenter.records.index')
@endif

@if (isset($addresses))
@include('callcenter.person_addresses.index')
@endif

@if (isset($contacts))
@include('callcenter.person_contacts.index')
@endif

@endsection
