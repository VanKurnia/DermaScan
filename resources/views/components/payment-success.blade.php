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
                            class="mb-2 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Proses Transaksi Pembayaran Berhasil
                        </h1>
                        <div class="border-t border-gray-600 mt-4 mb-2"></div>

                        <p
                            class="mb-6 text-lg font-semibold leading-tight tracking-tight text-gray-900 dark:text-white">
                            Detail Transaksi :
                        </p>
                        <div class="mt-2 w-full space-y-2 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                            <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-900 dark:text-white">
                                        Tanggal Pembelian
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $detail_transaksi['purchase_time'] }}
                                    </dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-900 dark:text-white">
                                        Order ID
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $detail_transaksi['order_id'] }}
                                    </dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-900 dark:text-white">
                                        Layanan
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $detail_transaksi['service_purchased'] }}
                                    </dd>
                                </dl>
                                {{-- <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-900 dark:text-white">
                                        Metode Pembayaran
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $detail_transaksi['payment_method'] }}
                                    </dd>
                                </dl> --}}
                                <dl class="flex items-center justify-between gap-4 py-3">
                                    <dt class="text-base font-normal text-gray-900 dark:text-white">
                                        Harga
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $detail_transaksi['amount'] }}
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <div class="border-t border-gray-600 mt-2 mb-6"></div>
                        <div class="space-y-3">
                            <a href="/dashboard">
                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Kembali ke Dashboard
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-layout>
