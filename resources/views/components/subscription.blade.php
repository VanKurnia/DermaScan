<x-layout-menu>
    <main class="p-4 md:ml-64 h-full pt-20">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-fit min-h-screen mb-4">
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                            Nikmati akses penuh ke fitur premium Dermascan, dapatkan akses tak terbatas dengan harga
                            terbaik
                        </h2>
                        <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">
                            Lebih hemat, lebih praktis! Dapatkan hasil scan detail dan rekomendasi perawatan eksklusif.
                        </p>
                    </div>
                    <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                        <!-- Pricing Card -->
                        {{-- 1 bulan --}}
                        <div
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="mb-4 text-2xl font-semibold">1 Bulan</h3>
                            <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                                Coba sekarang! Akses penuh Dermascan selama 1 bulan untuk deteksi dini.
                            </p>
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-xl font-extrabold">Rp. 50.000</span>
                            </div>
                            <button id="pay-button-1b"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                                Beli
                            </button>
                        </div>

                        {{-- 3 bulan --}}
                        <div
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="mb-4 text-2xl font-semibold">3 Bulan</h3>
                            <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                                Lebih hemat! Dapatkan akses eksklusif selama 3 bulan dengan harga spesial untuk
                                perawatan kulit berkelanjutan.
                            </p>
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-xl font-extrabold">Rp. 115.000</span>
                            </div>
                            <button id="pay-button-3b"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                                Beli
                            </button>
                        </div>

                        {{-- 6 bulan --}}
                        <div
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="mb-4 text-2xl font-semibold">6 Bulan</h3>
                            <p class="font-light text-sm text-gray-500 sm:text-lg dark:text-gray-400">
                                Pilihan terbaik! Akses premium 6 bulan dengan harga lebih hemat. Kulit sehat, kantong
                                tetap aman!
                            </p>
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-xl font-extrabold">Rp. 175.000</span>
                            </div>
                            <button id="pay-button-6b"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                                Beli
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        function handlePayment(amount, service_purchased) {
            fetch('/payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        amount: amount,
                        service_purchased: service_purchased // Kirim jenis paket ke backend
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = '/success?order_id=' + data.order_id;
                                fetch('/payment/update-status', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            order_id: data.order_id,
                                            payment_status: 'success',
                                            response_data: result,
                                            service_purchased: service_purchased // Update jenis paket di database
                                        })
                                    })
                                    .then(updateData => {
                                        // console.log('Database updated:', updateData);
                                    })
                                    .catch(error => {
                                        console.error('Error updating database:', error);
                                    });
                            },
                            onPending: function(result) {
                                // Handle pending payment, misalnya tampilkan pesan
                                alert('Pembayaran pending. Silahkan tunggu konfirmasi.');
                                // Bisa juga redirect ke halaman status pending
                                // window.location.href = '/pending?order_id=' + data.order_id;
                            },
                            onError: function(result) {
                                // Handle error
                                alert('Pembayaran gagal. Silahkan coba lagi.');
                                console.error('Payment error:', result);
                            },
                            onClose: function() {
                                window.location.href = '/subscription';
                                fetch('/cancelPayment', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            order_id: data.order_id,
                                        })
                                    })
                                    .then(updateData => {
                                        // console.log('Database updated:', updateData);
                                    })
                                    .catch(error => {
                                        console.error('Error updating database:', error);
                                    });
                            }
                        });
                    } else {
                        alert('Transaksi gagal!');
                    }
                })
                .catch(error => {
                    console.error('Error fetching payment data:', error);
                    alert('Terjadi kesalahan. Silahkan coba lagi.');
                });
        }

        // Contoh penggunaan untuk 3 tombol yang berbeda:
        document.getElementById('pay-button-1b').addEventListener('click', function() {
            handlePayment(50000, 'SUB-1');
        });

        document.getElementById('pay-button-3b').addEventListener('click', function() {
            handlePayment(115000, 'SUB-3');
        });

        document.getElementById('pay-button-6b').addEventListener('click', function() {
            handlePayment(175000, 'SUB-6');
        });
    </script>
</x-layout-menu>
