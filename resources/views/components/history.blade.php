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

                        @if (count($history) >= 1)
                            @foreach ($history as $eachHistory)
                                <div class="mt-6 flow-root sm:mt-8">
                                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <div class="grid items-center gap-4 pb-4 md:grid-cols-10 md:gap-6 md:py-6">
                                            {{-- Image Preview --}}
                                            <div class="md:col-span-2">
                                                <img class="rounded-lg shadow w-full h-auto object-cover"
                                                    src="{{ asset('storage/' . $eachHistory->image_url) }}"
                                                    alt="preview" />
                                            </div>

                                            {{-- Disease Name --}}
                                            <a href="{{ '/history-details/' . $eachHistory->id }}"
                                                class="font-semibold text-gray-900 hover:underline dark:text-white md:col-span-3">
                                                {{ $eachHistory->disease_name }}
                                            </a>

                                            {{-- Accuracy --}}
                                            <dl class="flex items-center space-x-2 md:col-span-2">
                                                <dt class="font-medium text-gray-900 dark:text-white">Akurasi:</dt>
                                                <dd class="text-gray-500 dark:text-gray-400">
                                                    {{ $eachHistory->confidence }}</dd>
                                            </dl>

                                            {{-- Scan Time --}}
                                            <dl class="flex items-center space-x-2 md:col-span-2">
                                                <dd class="text-gray-500 dark:text-gray-400">
                                                    {{ $eachHistory->created_at }}</dd>
                                            </dl>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('history.destroy', $eachHistory->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus scan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <div class="md:col-span-1 justify-self-end">
                                                    <button type="submit"
                                                        class="flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="gap-4 items-center justify-between mt-8">
                                <h2 class="text-lg text-center font-semibold text-gray-600 dark:text-gray-400">
                                    -- Anda belum memiliki riwayat scan --
                                </h2>
                            </div>
                        @endif


                        {{-- pagination --}}
                        <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                            <ul class="flex h-8 items-center -space-x-px text-sm">
                                {{-- Tombol Previous --}}
                                @if ($history->onFirstPage())
                                    <li>
                                        <span
                                            class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-gray-200 px-3 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                                            </svg>
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $history->previousPageUrl() }}"
                                            class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif

                                {{-- Halaman --}}
                                @foreach ($history->getUrlRange(1, $history->lastPage()) as $page => $url)
                                    <li>
                                        <a href="{{ $url }}"
                                            class="flex h-8 items-center justify-center border {{ $history->currentPage() == $page ? 'border-primary-300 bg-primary-50 text-primary-600' : 'border-gray-300 bg-white text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} px-3 leading-tight dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($history->hasMorePages())
                                    <li>
                                        <a href="{{ $history->nextPageUrl() }}"
                                            class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                            </svg>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <span
                                            class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-gray-200 px-3 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                            </svg>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>

                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout-menu>
