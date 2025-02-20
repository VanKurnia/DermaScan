<x-layout-menu>
    <main class="p-4 md:ml-64 h-fit min-h-screen pt-20">
        <div class="rounded-lg h-fit min-h-screen mb-4">
            <section class="bg-gray-50 dark:bg-gray-900 pt-5">
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
                            @if (session('status') === 'profile-information-updated')
                                <div class="text-center">
                                    <h1 class="text-base font-bold leading-tight tracking-tight text-green-500">
                                        {{-- {{ session('status') }} --}}
                                        Informasi Profil Anda Berhasil Diperbarui
                                    </h1>
                                </div>
                            @endif
                            <form class="space-y-4" action="{{ route('user-profile-information.update') }}"
                                method="POST">
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
                                <div class="flex flex-col items-center justify-center">
                                    @if ($premium_info['status'] === 'premium')
                                        <dd
                                            class="mb-1 inline-flex  items-center rounded bg-primary-100 px-2.5 py-0.5 text-sm font-semibold text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                            <svg class="me-1 h-4 w-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                                                </path>
                                            </svg>
                                            Premium
                                        </dd>
                                        <p class="font-light text-center text-gray-500 sm:text-md dark:text-gray-400">
                                            Premium hingga {{ $premium_info['end-date'] }}
                                        </p>
                                        <br>
                                    @endif


                                    @if ($premium_info['premium_scans'] > 0)
                                        <dd
                                            class="inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-sm font-semibold text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                            Premium scans left : {{ $premium_info['premium_scans'] }}
                                        </dd>
                                    @endif
                                </div>
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama</label>
                                    <input type="text" name="name" id="name"
                                        placeholder="Tuliskan nama anda..." required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ auth()->user()->name }}">
                                    @error('name')
                                        <span class="text-sm text-red-500 mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Tuliskan email anda..." required=""
                                        value="{{ auth()->user()->email }}">
                                    @error('email')
                                        <span class="text-sm text-red-500 mt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full font-bold text-base text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Update Profile
                                </button>

                                @if (!isset(auth()->user()->google_id))
                                    <div class="align-center">
                                        <a href="{{ route('profile.password') }}"
                                            class="w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M17 14H12.6586C11.8349 16.3304 9.61244 18 7 18C3.68629 18 1 15.3137 1 12C1 8.68629 3.68629 6 7 6C9.61244 6 11.8349 7.66962 12.6586 10H23V14H21V18H17V14ZM7 14C8.10457 14 9 13.1046 9 12C9 10.8954 8.10457 10 7 10C5.89543 10 5 10.8954 5 12C5 13.1046 5.89543 14 7 14Z">
                                                </path>
                                            </svg>
                                            Ganti Password
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout-menu>
