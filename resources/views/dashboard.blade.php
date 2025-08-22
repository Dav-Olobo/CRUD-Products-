@extends('layout')

@section('title', 'Dashboard')
@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>{{ __("You're logged in!") }}</p>

                <div class="mt-4">
                    <a href="{{ route('products.create') }}" class="btn btn-primary me-2">
                        Create Product
                    </a>

                    <a href="{{ route('products.index') }}" class="btn btn-success">
                        Manage Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
