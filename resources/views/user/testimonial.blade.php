<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Halaman pendaftaran akun platform bimbingan skripsi GueBimbingin"
    />
    <title>Testimonial | Govind</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- AOS -->
    <link
      href="https://unpkg.com/aos@2.3.1/dist/aos.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
      body {
        font-family: 'Inter', sans-serif;
        background: radial-gradient(circle at top left, #e3f2f2, #c1dcdc);
        overflow-x: hidden;
      }

      .shadow-glow {
        box-shadow: 0 20px 45px rgba(40, 94, 94, 0.25);
      }
    </style>
  </head>

  <body class="flex items-center justify-center min-h-screen px-4">
    <main
        class="relative w-full max-w-5xl mx-auto flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-glow bg-white/80 backdrop-blur"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-easing="ease-out-cubic"
    >
        <!-- Left: Background Wave -->
        <aside
        class="relative hidden md:flex md:w-1/3 justify-center items-center text-white p-10 bg-gradient-to-br from-[#C1DCDC] to-[#9ECACA]"
        data-aos="fade-right"
        data-aos-delay="300"
        >
        <div class="absolute inset-0 opacity-40">
            <div
            class="absolute -top-10 -right-16 w-64 h-64 bg-white/30 rounded-full blur-3xl"
            ></div>
            <div
            class="absolute bottom-0 left-0 w-80 h-80 bg-white/20 rounded-full blur-3xl"
            ></div>
        </div>
        <div class="relative z-10 text-center px-6">
            <h2 class="text-4xl font-bold mb-3 drop-shadow-lg text-[#285E5E]">
            Hello {{ $user->name }}!
            </h2>
        </div>
        </aside>

        <!-- Right: Form -->
        <section
        class="flex-1 p-10 md:p-14 flex flex-col justify-center items-start text-gray-700"
        data-aos="fade-left"
        data-aos-delay="200"
        >
        <h2 class="text-3xl font-bold text-[#285E5E] mb-2">
            Testimonial Form
        </h2>
        <p class="text-sm mb-8 text-[#285E5E]/70">
            Leave your experience below!
        </p>

        <form
            action="{{ route('submit-testimonial') }}"
            method="POST"
            enctype="multipart/form-data"
            class="w-full space-y-7"
        >
            @csrf

            <!-- GRID 3 LEFT & 3 RIGHT -->
            <div class="grid grid-cols-1 gap-6">
                <div class="relative" data-aos="fade-left" data-aos-delay="400">
                    <input
                        id="occupation"
                        type="text"
                        name="occupation"
                        placeholder="Your Occupation / Current Role"
                        required
                        class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                        focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                        duration-300 placeholder:text-gray-400"
                    />
                </div>
                <div class="relative" data-aos="fade-left" data-aos-delay="400">
                    <textarea
                        id="text"
                        type="text"
                        name="text"
                        placeholder="Your Testimonial for Govind Abra Enterprise"
                        required
                        class="w-full pl-4 pr-4 py-2 rounded-xl border border-[#C1DCDC]
                        focus:ring-2 focus:ring-[#285E5E] bg-white/80 transition-all
                        duration-300 placeholder:text-gray-400"
                    ></textarea>
                </div>

            <!-- Submit Button -->
            <div class="flex flex-row gap-5">
                <a  href="{{ route('home') }}"
                    type="submit"
                    class="w-100 px-3 pe-4 py-3 mt-2 rounded-xl font-semibold text-white bg-gradient-to-r
                        from-[#285E5E] to-[#1F4A4A] hover:opacity-95 hover:shadow-lg transition-all
                        duration-300 transform hover:scale-[1.02] flex items-center justify-center gap-2"
                    data-aos="zoom-in"
                    data-aos-delay="900"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>
                <button
                    type="submit"
                    class="w-full py-3 mt-2 rounded-xl font-semibold text-white bg-gradient-to-r
                        from-[#285E5E] to-[#1F4A4A] hover:opacity-95 hover:shadow-lg transition-all
                        duration-300 transform hover:scale-[1.02]"
                    data-aos="zoom-in"
                    data-aos-delay="900"
                    >
                    Submit
                </button>
            </div>
        </form>

        </section>
    </main>

    <script>
        AOS.init();

        // Image preview logic
        const imgInput = document.getElementById('img');
        const previewContainer = document.getElementById('img-preview-container');
        const previewImg = document.getElementById('img-preview');

        if (imgInput) {
        imgInput.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];

            if (!file) {
            previewContainer.classList.add('hidden');
            previewImg.src = '';
            return;
            }

            // Optional: validasi hanya file image
            if (!file.type.startsWith('image/')) {
            previewContainer.classList.add('hidden');
            previewImg.src = '';
            return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
            previewImg.src = event.target.result;
            previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
        }
    </script>
  </body>

</html>
