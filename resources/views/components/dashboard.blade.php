<x-layout-menu>
    <main class="p-4 md:ml-64 h-auto pt-20">
        <div class="min-h-screen">
            <div class="mx-auto max-w-screen-sm text-center mb-2 mt-5 lg:mb-6">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Scan Kulit Anda
                </h2>

                {{-- manage premium service --}}
                @if ($premium_info['status'] === 'premium')
                    <dd
                        class="mb-3 inline-flex  items-center rounded bg-primary-100 px-2.5 py-0.5 text-sm font-semibold text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                        <svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                            </path>
                        </svg>
                        Premium
                    </dd>
                    <br>
                @endif


                @if ($premium_info['premium_scans'] > 0)
                    <dd
                        class="mb-3 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-sm font-semibold text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                        Premium scans left : {{ $premium_info['premium_scans'] }}
                    </dd>
                @endif

                <p class="text-gray-500 font-medium sm:text-xl dark:text-gray-400">
                    DermaScan memanfaatkan model vision transformer dalam menganalisa kondisi kulit anda. Silahkan pilih
                    metode pengiriman gambar berikut :
                </p>
            </div>

            {{-- Image Option --}}
            <div id="uploadOption" class="grid grid-cols-1 sm:grid-cols-2 sm:mb-2 md:px-20 lg:px-40">
                {{-- real-time --}}
                <div class="h-32 md:h-64 flex justify-center items-center mb-3">
                    <button id="openCamera">
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 h-32 md:h-64 flex flex-col justify-center items-center max-w-fit max-h-fit p-5">
                            <svg aria-hidden="true"
                                class="w-32 h-32 lg:w-52 lg:h-52 p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white group"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M20.7134 8.12811L20.4668 8.69379C20.2864 9.10792 19.7136 9.10792 19.5331 8.69379L19.2866 8.12811C18.8471 7.11947 18.0555 6.31641 17.0677 5.87708L16.308 5.53922C15.8973 5.35653 15.8973 4.75881 16.308 4.57612L17.0252 4.25714C18.0384 3.80651 18.8442 2.97373 19.2761 1.93083L19.5293 1.31953C19.7058 0.893489 20.2942 0.893489 20.4706 1.31953L20.7238 1.93083C21.1558 2.97373 21.9616 3.80651 22.9748 4.25714L23.6919 4.57612C24.1027 4.75881 24.1027 5.35653 23.6919 5.53922L22.9323 5.87708C21.9445 6.31641 21.1529 7.11947 20.7134 8.12811ZM9 3H14V5H9.82843L7.82843 7H4V19H20V11H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7L9 3ZM12 18C8.96243 18 6.5 15.5376 6.5 12.5C6.5 9.46243 8.96243 7 12 7C15.0376 7 17.5 9.46243 17.5 12.5C17.5 15.5376 15.0376 18 12 18ZM12 16C13.933 16 15.5 14.433 15.5 12.5C15.5 10.567 13.933 9 12 9C10.067 9 8.5 10.567 8.5 12.5C8.5 14.433 10.067 16 12 16Z">
                                </path>
                            </svg>
                            <span class="mt-2 font-semibold text-gray-900 dark:text-white">
                                Ambil Gambar
                            </span>
                        </div>
                    </button>
                </div>

                {{-- upload-file --}}
                <div class="h-32 md:h-64 flex justify-center items-center mb-3">
                    <form id="uploadScanForm" action="/scan-image" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- hidden input file --}}
                        <input type="file" id="fileInput" class="hidden" accept="image/*" onchange="previewFile()">
                        {{-- button --}}
                        <a href="#" onclick="document.getElementById('fileInput').click(); return false;">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 h-32 md:h-64 flex flex-col justify-center items-center max-w-fit max-h-fit p-5">
                                <svg aria-hidden="true"
                                    class="w-32 h-32 lg:w-52 lg:h-52 p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white group"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M15 4H5V20H19V8H15V4ZM3 2.9918C3 2.44405 3.44749 2 3.9985 2H16L20.9997 7L21 20.9925C21 21.5489 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5447 3 21.0082V2.9918ZM13 12V16H11V12H8L12 8L16 12H13Z">
                                    </path>
                                </svg>
                                <span class="mt-2 font-semibold text-gray-900 dark:text-white">
                                    Upload gambar
                                </span>
                            </div>
                        </a>
                    </form>
                </div>
            </div>

            {{-- web camera --}}
            <div id="canvasFrame" class="hidden mx-auto text-center mb-6 mt-5 lg:mb-3">
                <div
                    class="relative w-full max-w-[724px] aspect-[724/543] border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 p-5 mx-auto flex justify-center items-center">
                    <video id="cameraPreview" autoplay
                        class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg hidden"></video>
                    <canvas id="canvas" class="absolute top-0 left-0 w-full h-full hidden"></canvas>
                </div>
            </div>

            <div class="mx-auto max-w-screen-sm text-center mb-6 mt-5 lg:mb-12 flex flex-col items-center">
                {{-- Preview Gambar --}}
                <img id="previewImage" class="hidden w-40 h-40 mt-3 rounded-lg shadow-lg object-cover">
                {{-- Preview Nama File --}}
                <p id="fileName" class="mt-2 text-gray-700 dark:text-white"></p>

                {{-- Instruksi Pilih Metode Scan --}}
                <p class="font-medium text-gray-500 sm:text-base dark:text-gray-400 text-center">
                    *Pastikan gambar menangkap kondisi kulit dengan pencahayaan dan fokus yang jelas
                </p>

                {{-- Button Kirim --}}
                <button id="btnAnalisaKamera" class="hidden mt-4 px-4 py-2 bg-green-500 dark:text-white rounded">
                    Analisa
                </button>
                <button id="btnAnalisaUpload" onclick="scanImage()"
                    class="hidden mt-4 px-4 py-2 bg-green-500 dark:text-white rounded">
                    Analisa
                </button>

                {{-- Button Ambil Gambar --}}
                <button id="captureImage" class="hidden mt-4 px-4 py-2 bg-green-500 dark:text-white rounded">
                    Ambil Gambar
                </button>
            </div>

        </div>
    </main>

    <script>
        // MENANGANI KAMERA
        let video = document.getElementById("cameraPreview");
        let canvas = document.getElementById("canvas");
        let canvasFrame = document.getElementById("canvasFrame");
        let openCameraBtn = document.getElementById("openCamera");
        let captureImageBtn = document.getElementById("captureImage");
        let KameraKamera = document.getElementById("btnAnalisaKamera");
        let previewImage = document.getElementById("previewImage");
        let uploadOption = document.getElementById("uploadOption");

        let stream = null;

        // Fungsi untuk membuka kamera
        openCameraBtn.addEventListener("click", async function() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    }
                });
                video.srcObject = stream;
                uploadOption.classList.add("hidden");
                video.classList.remove("hidden");
                canvasFrame.classList.remove("hidden")
                captureImageBtn.classList.remove("hidden");
            } catch (error) {
                console.error("Gagal mengakses kamera:", error);
                alert("Gagal mengakses kamera. Pastikan browser memiliki izin.");
            }
        });

        // Fungsi untuk mengambil gambar dari video
        captureImageBtn.addEventListener("click", function() {
            let context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Konversi canvas ke gambar
            let imageDataURL = canvas.toDataURL("image/png");

            // Tampilkan hasil gambar
            previewImage.src = imageDataURL;
            canvasFrame.classList.add("hidden")
            previewImage.classList.remove("hidden");
            btnAnalisaKamera.classList.remove("hidden");

            // Matikan kamera setelah mengambil gambar
            video.srcObject.getTracks().forEach(track => track.stop());
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null; // Reset stream agar bisa dibuka kembali nanti
            }
            video.classList.add("hidden");
            captureImageBtn.classList.add("hidden");
        });

        function reinitializeDropdown() {
            document.querySelectorAll("[data-dropdown-toggle]").forEach(button => {
                let dropdownId = button.getAttribute("data-dropdown-toggle");
                let dropdown = document.getElementById(dropdownId);

                if (!dropdown) return;

                button.addEventListener("click", function() {
                    dropdown.classList.toggle("hidden");
                });
            });
        }

        // Fungsi untuk mengunggah gambar
        btnAnalisaKamera.addEventListener("click", function() {
            canvas.toBlob((blob) => {
                let formData = new FormData();
                formData.append("image", blob, "captured_image.png");

                fetch("/scan-image", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        }
                    })
                    .then(response => response.text()) // Ambil HTML dari server
                    .then(html => {
                        document.open();
                        document.write(html); // Tampilkan halaman hasil scan
                        // window.location.href = "/scan-image"; // alternatif 1
                        document.close();
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan!");
                    });
                // .then(response => {
                //     if (!response.ok) { // Cek status HTTP untuk error
                //         throw new Error(`HTTP error! status: ${response.status}`);
                //     }
                //     return response.json(); // Parse respons JSON
                // })
                // .then(data => {
                //     if (data.status === 'success') { // Periksa status dari server
                //         // Simpan data di localStorage atau sessionStorage jika diperlukan
                //         localStorage.setItem("hasil_scan", JSON.stringify(data));

                //         // Arahkan ke halaman hasil
                //         window.location.href = "/scan-result";
                //     } else if (data.status === 'error') {
                //         console.error("Error:", data.error);
                //         alert(data.error); // Tampilkan pesan error kepada pengguna
                //     }

                // })
                // .catch(error => {
                //     console.error("Error:", error);
                //     alert("Terjadi kesalahan!"); // Tampilkan pesan error umum
                // });
            }, "image/png");
        });

        // MENANGANI UPLOAD FILE

        function previewFile() {
            let input = document.getElementById("fileInput");
            let preview = document.getElementById("previewImage");
            let fileNameText = document.getElementById("fileName");
            let uploadOption = document.getElementById("uploadOption");
            let btnAnalisa = document.getElementById("btnAnalisaUpload");

            if (input.files.length > 0) {
                let file = input.files[0];

                // Tampilkan nama file
                fileNameText.textContent = "File: " + file.name;

                // Tampilkan preview gambar
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove("hidden"); // Tampilkan gambar
                    btnAnalisa.classList.remove("hidden");
                    uploadOption.classList.add("hidden"); // Sembunyikan ikon upload
                };
                reader.readAsDataURL(file);
            }
        }

        function scanImage() {
            let input = document.getElementById("fileInput");
            if (input.files.length === 0) {
                alert("Pilih file terlebih dahulu!");
                return;
            }

            let formData = new FormData();
            formData.append("image", input.files[0]);

            fetch("/scan-image", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    }
                })
                .then(response => response.text()) // Ambil HTML dari server
                .then(html => {
                    document.open();
                    document.write(html); // Tampilkan halaman hasil scan
                    document.close();
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan!");
                });
        }
    </script>
</x-layout-menu>
