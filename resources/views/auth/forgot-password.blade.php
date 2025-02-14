<x-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ asset('storage/images/logo-text-white.png') }}" class="max-h-16 mb-3 dark:block hidden"
                    alt="Logo">
                <img src="{{ asset('storage/images/logo-text-dark.png') }}" class="max-h-16 mb-3 dark:hidden"
                    alt="Logo">
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class="text-center">
                        <h1
                            class="mb-8 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Reset Password
                        </h1>
                        @if (session('status'))
                            <p class="text-xl font- leading-tight tracking-tight text-green-500">
                                {{-- A fresh verification link has been sent to your email address. --}}
                                {{ session('status') }}
                            </p>
                        @endif
                    </div>

                    <div class="border-t border-gray-600 my-2"></div>

                    <form class="space-y-2 md:space-y-2" action="{{ route('password.email') }}" method="POST">
                        @csrf

                        <div>
                            <label for="email"
                                class="block mb-2 text-xl text-center font-semibold text-gray-900 dark:text-white">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tuliskan email anda..." required="">
                            @error('email')
                                <span class="text-sm text-red-500 mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full font-bold text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Kirim Reset Password Link
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
