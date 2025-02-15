<x-layout-menu>
    <main class="p-4 md:ml-64 h-fit min-h-screen pt-20">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-fit min-h-screen mb-4">
            <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                    <div class="mx-auto max-w-5xl">
                        <div class="gap-4 items-center justify-between">
                            <h2 class="text-xl text-center font-semibold text-gray-900 dark:text-white sm:text-2xl">
                                Scan History
                            </h2>
                        </div>

                        {{-- item list --}}
                        <div class="mt-6 flow-root sm:mt-8">
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                {{--  --}}
                                <div class="grid gap-4 pb-4 md:grid-cols-10 md:gap-6 md:py-6">
                                    <a href="#"
                                        class="content-center font-semibold text-gray-900 hover:underline dark:text-white sm:col-span-10 lg:col-span-3">
                                        #Disease Name
                                    </a>
                                    <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-3">
                                        <dt class="font-medium text-gray-900 dark:text-white">
                                            #Akurasi :
                                        </dt>
                                        <dd class=" text-gray-500 dark:text-gray-400">
                                            ?%
                                        </dd>
                                    </dl>
                                    <dl class="flex items-center space-x-2 sm:col-span-4 lg:col-span-2">
                                        <dt class="font-medium text-gray-900 dark:text-white">
                                            Waktu Scan:
                                        </dt>
                                        <dd class=" text-gray-500 dark:text-gray-400">
                                            08 Feb 2026
                                        </dd>
                                    </dl>
                                    <div class="sm:col-span-2 md:justify-self-end lg:col-span-2">
                                        <button type="button"
                                            class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                                {{--  --}}
                            </div>
                        </div>

                        {{-- pagination --}}
                        <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                            <ul class="flex h-8 items-center -space-x-px text-sm">
                                <li>
                                    <a href="#"
                                        class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m15 19-7-7 7-7" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                </li>
                                <li>
                                    <a href="#" aria-current="page"
                                        class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m9 5 7 7-7 7" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout-menu>
