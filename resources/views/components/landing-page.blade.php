<x-layout>
    <section class="bg-white dark:bg-gray-900 flex items-center min-h-screen">
        <div
            class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:flex lg:flex-row-reverse">
            <div class="lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('storage/images/landing-page.png') }}" class="w-[150%] min-h-32" alt="illustration">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-6xl font-extrabold tracking-tight leading-none md:text-7xl xl:text-8xl text-primary-600 dark:text-white">
                    DERMASCAN
                </h1>
                <p
                    class="max-w-2xl mb-6 font-medium text-gray-500 lg:mb-8 min-[320px]::text-xl md:text-2xl lg:text-3xl dark:text-gray-400">
                    "Analisis Kulit Cerdas untuk Anda"
                </p>
                <a href="/login"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Mulai
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Lihat Penawaran
                </a>
            </div>
        </div>
    </section>
</x-layout>
