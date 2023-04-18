@extends('layouts.app')

@section('title', 'Login')

@section('content')

<x-guest-layout>
    <div class="row ">
        <div class="d-flex justify-content-center">
            <x-auth-card>
                <x-slot name="logo">
                    
                </x-slot>

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Esqueceu sua senha? sem problema. Insira seu email cadastrado e você receberá um link de redefinição de senha.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                @include('includes.validations-form')

                <div class="col-8 ">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="btn btn-success">
                                {{ __('Recuperar senha') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </x-auth-card>
        </div>
    </div>
</x-guest-layout>

@endsection