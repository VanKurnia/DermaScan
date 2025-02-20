<x-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-fit min-h-screen lg:py-0">
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
                            Verifikasi Akun Anda
                        </h1>
                        @if (session('resent'))
                            <p class="text-xl font- leading-tight tracking-tight text-gray-900 dark:text-white">
                                A fresh verification link has been sent to your email address.
                            </p>
                        @endif
                        <p class="text-lg font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                            {{-- Before proceeding, please check your email for a verification link --}}
                            Sebelum melanjutkan, silahkan cek email anda untuk melakukan verifikasi
                        </p>

                        <div class="border-t border-gray-600 my-2"></div>

                        <p class="text-base font-medium leading-tight tracking-tight text-gray-900 dark:text-white">
                            Jika anda belum menerima email :
                        </p>
                    </div>
                    <form class="space-y-2 md:space-y-2" action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full font-bold text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Kirim Ulang ke Email Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
