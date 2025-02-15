<x-layout-menu>
    <main class="p-4 md:ml-64 h-fit min-h-screen pt-20">
        <div class="rounded-lg h-fit min-h-screen mb-4">
            <section class="bg-gray-50 dark:bg-gray-900 pt-0">
                <div class="flex flex-col items-center justify-start px-6 py-8 mx-auto h-screen lg:py-0">
                    <div
                        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <div class="text-center">
                                <h1
                                    class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                    Account Settings
                                </h1>
                            </div>
                            @if (session('status'))
                                <?php
                                if (session('status') === 'password-updated') {
                                    $alert = 'password anda berhasil diperbarui';
                                } else {
                                    $alert = session('status');
                                }
                                ?>
                                <div class="text-center">
                                    <h1 class="text-base font-bold leading-tight tracking-tight text-green-500">
                                        {{ $alert }}
                                    </h1>
                                </div>
                            @endif
                            <form class="space-y-4" action="{{ route('user-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex justify-center">
                                    @if (isset(auth()->user()->google_avatar))
                                        <img class="w-28 h-28 rounded-full" src="{{ auth()->user()->google_avatar }}"
                                            alt="user photo" referrerpolicy="no-referrer" />
                                    @else
                                        <svg class="w-28 h-28 rounded-full text-gray-500 dark:text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM6.02332 15.4163C7.49083 17.6069 9.69511 19 12.1597 19C14.6243 19 16.8286 17.6069 18.2961 15.4163C16.6885 13.9172 14.5312 13 12.1597 13C9.78821 13 7.63095 13.9172 6.02332 15.4163ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>

                                {{--  --}}
                                <div>
                                    <label for="current_password"
                                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                                        Current Password
                                    </label>
                                    <input type="password" minlength="8" name="current_password" id="current_password"
                                        placeholder="Tuliskan password anda sekarang..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required="">
                                    @error('current_password', 'updatePassword')
                                        <?php
                                        if ($message === 'The provided password does not match your current password.') {
                                            $alert = 'Password yang anda masukkan tidak sesuai dengan password anda sekarang';
                                        }
                                        ?>
                                        <p class="text-sm text-red-500 mt-1">
                                            <strong>{{ $alert }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                                        New Password
                                    </label>
                                    <input type="password" minlength="8" name="password" id="password"
                                        placeholder="Tuliskan password baru anda..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required="">
                                    @error('password', 'updatePassword')
                                        <?php
                                        if ($message === 'The password field confirmation does not match.') {
                                            $alert = 'Password yang anda masukkan tidak sesuai';
                                        }
                                        ?>
                                        <p class="text-sm text-red-500 mt-1">
                                            <strong>{{ $alert }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                                        Konfirmasi password
                                    </label>
                                    <input type="password" minlength="8" name="password_confirmation"
                                        id="password_confirmation" placeholder="Tuliskan ulang password baru anda..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required="">
                                </div>
                                {{--  --}}

                                <button type="submit"
                                    class="w-full font-bold text-base text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout-menu>
