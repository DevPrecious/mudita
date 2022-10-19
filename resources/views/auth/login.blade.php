@extends('layouts.app')

@section('content')
    <div class="grid px-5 md:px-0 2xl:px-0  md:flex 2xl:flex">
        <div class="hidden md:block md:w-1/2 2xl:w-1/2 bg-purple-500">
            <div class="2xl:px-52 2xl:py-52 md:px-20 md:py-32">
                <div class="grid gap-3">
                    <span class="2xl:text-4xl md:text-3xl font-bold text-white">Welcome back!</span>
                    <span class="text-lg text-white">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste nostrum ipsum reiciendis voluptates
                        similique, deserunt facilis iusto id officia in. Fugiat pariatur in exercitationem magni quos quo
                        alias, accusantium neque!
                    </span>
                </div>
            </div>
        </div>
        <div class="md:w-1/2 2xl:w-1/2">
            <div class="grid h-screen place-items-center">
                <form action="{{ route('login') }}" method="POST"
                    class="md:w-[500px] 2xl:w-[500px] w-[600px] p-4 grid gap-3">
                    @csrf
                    @if (session()->has('error'))
                        <div class="p-4 text-white bg-red-500 w-full rounded-md">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <span class="text-2xl font-bold">Create Account</span>
                    <div class="grid gap-2">
                        <label for="" class="text-lg font-semibold">Username</label>
                        <input type="text" name="username"
                            class="border border-gray-300 p-3 rounded-md focus:outline-purple-500" id="">
                        @error('username')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="grid gap-2">
                        <label for="" class="text-lg font-semibold">Password</label>
                        <input type="password" name="password"
                            class="border border-gray-300 p-3 rounded-md focus:outline-purple-500" id="">
                        @error('password')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-purple-500 text-white px-5 py-3 rounded-md w-full">Login</button>
                    </div>
                    <div>
                        <a href="{{ route('show.login') }}" class="hover:text-purple-500 hover:underline">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
