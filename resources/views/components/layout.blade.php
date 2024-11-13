<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Job Board</title>
        @vite(['resources/css/app.css'],['resources/js/app.js'])
    </head>
    <body class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-100 from-10% via-sky-200 via-30% to-emerald-300 to-90% bg-slate-700">
        <nav class="mb-8 flex justify-between text-lg font-medium">
            <ul class="flex space-x-2">
                <li>
                    <a href="{{ route('jobs.index')}}">Home</a>
                </li>
            </ul>

            <ul class="flex space-x-2">
            @auth
            <li>
            <a href="{{ route('my-job-applications.index')}}">{{ auth()->user()->name ?? 'Anynomous'}}: Applications
            </a>
            </li>
            <li>
                <a href="{{ route('my-jobs.index')}}">My Jobs</a>
            </li>
            <li>
                <form action="{{ route('auth.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Logout</button>
                </form>
            </li>
            {{-- Logged in  --}}
                @else
                    <li>
                        <a href="{{ route('auth.create')}}">Sign in </a>
                    </li>
                    
                    {{-- Not Logged in  --}}
               @endauth
            </ul>
        </nav>

        @if (session('success'))
        <div role="alert" class="my-8 rounded-md border-l-4 border-green-500 bg-green-200 p-4 text-green-700 opacity-75">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif
        @if (session('error'))
        <div role="alert" class="my-8 rounded-md border-l-4 border-red-500 bg-red-200 p-4 text-red-700 opacity-75">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
        @endif
        {{-- @if (session('success'))
        <div role="alert" class="my-8 rounded-md border-l-4 border-green-500 bg-green-200 p-4 text-green-700 opacity-75">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif --}}
    
        {{ $slot }}

    </body>
</html>
