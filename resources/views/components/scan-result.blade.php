<x-layout-menu>
    <main class="p-4 md:ml-64 h-auto pt-20">
        <div class="min-h-screen">
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-fit mb-4">
                <?php if (!isset($data)) {
                    // data dummy
                    $data = [
                        'disease' => 'Moles',
                        'overview' => 'Moles are common skin growths that are usually brown or black in color. They can appear anywhere on the skin and vary in size, shape, and texture. While most moles are harmless, some may develop into melanoma, a type of skin cancer.',
                        'symptoms' => ['Pigmented spots on the skin', 'Round or oval shape', 'Even coloration', 'Smooth or slightly raised surface'],
                        'causes' => ['Clusters of melanocytes (pigment-producing cells)', 'Genetic predisposition', 'Sun exposure'],
                        'treatments' => ['Observation (for benign moles)', 'Surgical removal (if concerning features or changes are observed)', 'Biopsy (if melanoma is suspected)'],
                        'probability' => 0.6,
                        'time' => '0.066 seconds',
                    ];
                    $preview = 'https://images.theconversation.com/files/45159/original/rptgtpxd-1396254731.jpg';
                }
                ?>

                @if ($otherResult !== [] && count($otherResult) > 1)
                    <?php
                    // debugging
                    // dump($otherResult);
                    
                    usort($otherResult, function ($a, $b) {
                        return $b['probability'] <=> $a['probability'];
                    });
                    
                    ?>
                @endif

                @if (isset($data['probability']))
                    <?php
                    // debugging
                    // dump($data);
                    ?>

                    <section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8">
                        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                            <div class="mx-auto max-w-5xl">
                                <div class="mx-auto max-w-2xl space-y-6 mb-12">
                                    {{-- disease name --}}
                                    <h2
                                        class="text-xl font-semibold text-center text-gray-900 dark:text-white sm:text-2xl">
                                        Hasil Diagnosis : <span class="text-amber-500"> {{ $data['disease'] }} </span>
                                    </h2>

                                    {{-- image preview --}}
                                    <div class="my-8 xl:mb-16 xl:mt-12 flex justify-center">
                                        <img class="w-80 rounded-lg shadow" src="{{ $preview }}" alt="preview" />
                                    </div>

                                    {{-- chart akurasi/probability --}}
                                    <p
                                        class="text-lg font-semibold text-center text-gray-900 dark:text-white sm:text-lg mb-2">
                                        Tingkat Akurasi : <span class="text-green-500">
                                            {{ number_format($data['probability'] * 100, 2) }}%
                                        </span>
                                    </p>
                                    <div class="max-w-lg mx-auto mt-2 mb-1">
                                        <canvas id="probabilityChart" class="h-16"></canvas>
                                    </div>

                                    {{-- disease overview --}}
                                    <p class="text-base font-normal text-justify text-black dark:text-white">
                                        {{ $data['overview'] }}
                                    </p>

                                    @if (isset($data['symptoms']))
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Karakteristik {{ $data['disease'] }} :
                                        </h3>

                                        <ul
                                            class="list-outside list-disc space-y-4 pl-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                            <li>
                                                <span class="font-semibold text-gray-900 dark:text-white">
                                                    Gejala {{ $data['disease'] }} :
                                                </span>
                                                <ul class="list-decimal">
                                                    @foreach ($data['symptoms'] as $symptom)
                                                        <li>{{ $symptom }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li>
                                                <span class="font-semibold text-gray-900 dark:text-white">
                                                    Penyebab {{ $data['disease'] }} :
                                                </span>
                                                <ul class="list-decimal">
                                                    @foreach ($data['causes'] as $cause)
                                                        <li>{{ $cause }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li>
                                                <span class="font-semibold text-gray-900 dark:text-white">
                                                    Perawatan {{ $data['disease'] }} :
                                                </span>
                                                <ul class="list-decimal">
                                                    @foreach ($data['treatments'] as $treatment)
                                                        <li>{{ $treatment }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    @endif

                                    {{-- chart hasil ai lain --}}
                                    @if ($otherResult !== [] && count($otherResult) > 1)
                                        <p
                                            class="text-lg font-semibold text-center text-gray-900 dark:text-white sm:text-lg mb-2">
                                            Probabilitas Diagnosis AI :
                                        </p>
                                        <div class="max-w-lg mx-auto mt-2 mb-1">
                                            <canvas id="otherResultChart" class="h-64"></canvas>
                                        </div>
                                    @endif

                                    <dd
                                        class="inline-flex items-center rounded bg-amber-100 px-2.5 py-0.5 text-center text-medium font-semibold text-amber-600 dark:bg-amber-800 dark:text-amber-300 mt-3">
                                        Hasil ini hanya untuk referensi awal. Untuk diagnosis dan perawatan medis lebih
                                        lanjut, silakan konsultasikan dengan dokter.
                                    </dd>
                                </div>

                                <div class="text-center">
                                    <a href="{{ $back }}"
                                        class="mb-2 mr-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                        Kembali
                                    </a>
                                </div>

                            </div>
                        </div>
                    </section>
                @endif

            </div>
        </div>
    </main>

    {{-- handling chart --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('probabilityChart').getContext('2d');
            const textColor = "#6b7280";

            new Chart(ctx, {
                type: 'bar',
                data: {
                    // labels: ["{{ $data['disease'] }}"],
                    labels: ["Akurasi : "],
                    datasets: [{
                        // label: "Tingkat Akurasi",
                        data: [{{ $data['probability'] * 100 }}], // Ubah ke persen
                        backgroundColor: 'rgb(27, 181, 94, 0.5)', // Warna biru transparan
                        borderColor: 'rgb(27, 181, 94, 0.9)', // Warna biru solid
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // Buat bar chart horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Menghapus legend
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 100, // Maksimum 100% untuk probabilitas
                            ticks: {
                                callback: function(value) {
                                    return value + "%"; // Tambahkan '%' di label
                                },
                                color: textColor
                            },
                            grid: {
                                color: textColor
                            }
                        },
                        y: {
                            ticks: {
                                color: textColor
                            },
                            grid: {
                                color: textColor
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 0, // Hilangkan padding atas
                            bottom: 0 // Hilangkan padding bawah
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('otherResultChart').getContext('2d');
            const textColor = "#6b7280";

            // Ambil data dari PHP dan ubah ke format JSON yang aman
            const labels = <?php echo json_encode(array_column($otherResult, 'disease')); ?>;
            const dataValues = <?php echo json_encode(
                array_map(function ($value) {
                    return $value * 100; // Ubah nilai dari 0-1 ke 0-100
                }, array_column($otherResult, 'probability')),
            ); ?>;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Gunakan array JSON yang telah dikonversi
                    datasets: [{
                        label: "Tingkat Akurasi",
                        data: dataValues, // Gunakan array JSON yang telah dikonversi
                        backgroundColor: 'rgba(27, 181, 94, 0.5)', // Warna hijau transparan
                        borderColor: 'rgba(27, 181, 94, 0.9)', // Warna hijau solid
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'x', // Buat bar chart horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Menghapus legend
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100, // Maksimum 100% untuk probabilitas
                            ticks: {
                                callback: function(value) {
                                    return value + "%"; // Tambahkan '%' di label
                                },
                                color: textColor
                            },
                            grid: {
                                color: textColor
                            }
                        },
                        x: {
                            ticks: {
                                callback: function(value, index, ticks) {
                                    let label = this.getLabelForValue(value);
                                    return label.length > 15 ? label.substring(0, 12) + "..." : label;
                                },
                                color: textColor
                            },
                            grid: {
                                color: textColor
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 0, // Hilangkan padding atas
                            bottom: 0 // Hilangkan padding bawah
                        }
                    }
                }
            });
        });
    </script>


    {{-- inisiasi ulang flowbite --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.initFlowbite) {
                window.initFlowbite(); // Pastikan Flowbite diinisialisasi ulang
            }
        });
    </script>
</x-layout-menu>
