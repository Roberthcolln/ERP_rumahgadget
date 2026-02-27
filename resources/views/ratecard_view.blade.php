@extends('layouts.web')

@section('isi')
    <style>
        /* (CSS tetap sama seperti sebelumnya, tidak ada perubahan) */
        .pricing_section {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .pricing_container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding-top: 20px;
        }

        .pricing_card {
            /* Ganti URL dengan gambar background kartu Anda */
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
                url('{{ asset('web/images/1.jpg') }}');
            background-size: cover;
            background-position: center;

            border-radius: 20px;
            width: 320px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #eee;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .pricing_card:hover {
            transform: translateY(-10px);
            /* Saat hover, overlay sedikit menipis agar gambar background lebih jelas */
            background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)),
                url('{{ asset('web/images/1.jpg') }}');
            background-size: cover;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: #ffbe33;
        }

        .pricing_card.featured {
            border: 2px solid #ffbe33;
            transform: scale(1.05);
            z-index: 2;
            box-shadow: 0 10px 30px rgba(255, 190, 51, 0.2);
        }

        .badge_featured {
            position: absolute;
            top: 15px;
            right: -35px;
            background: #ffbe33;
            color: #000;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .platform_icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            object-fit: contain;
            border-radius: 15px;
        }

        .platform_badge_wrapper {
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .platform_badge {
            display: inline-block;
            padding: 4px 12px;
            background: #f1f3f5;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .service_name {
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 10px;
            color: #222;
            min-height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .price_tag {
            font-size: 28px;
            font-weight: 800;
            color: #ffbe33;
            margin-bottom: 20px;
        }

        .price_tag span {
            font-size: 14px;
            color: #888;
            font-weight: 400;
        }

        .description_list {
            text-align: left;
            margin-bottom: 30px;
            font-size: 14px;
            color: #555;
            flex-grow: 1;
            border-top: 1px solid #f8f9fa;
            padding-top: 20px;
        }

        .description_list ul {
            padding-left: 1.2rem;
            list-style-type: none;
        }

        .description_list ul li {
            position: relative;
            margin-bottom: 8px;
        }

        .description_list ul li::before {
            content: "\f00c";
            font-family: FontAwesome;
            position: absolute;
            left: -20px;
            color: #28a745;
            font-size: 12px;
        }

        .btn_order {
            display: inline-block;
            padding: 14px 20px;
            background-color: #ffbe33;
            color: #000;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s;
            width: 100%;
            text-transform: uppercase;
            text-decoration: none !important;
        }

        .btn_order:hover {
            background-color: #000;
            color: #ffbe33;
            transform: translateY(-2px);
        }
    </style>

    <section class="pricing_section">
        <div class="container">
            <div class="heading_container heading_center mb-5 text-center">
                <h2 style="font-weight: 800; color: #000; font-size: 36px;">Rate Card Layanan</h2>
                <p style="color: #666; max-width: 600px; margin: 0 auto;">Pilih paket konten kreatif yang paling sesuai untuk
                    bisnis Anda.</p>
            </div>

            @php
                // 1. Ambil 2 harga tertinggi untuk label POPULER
                $topPrices = $ratecards->pluck('harga')->unique()->sortDesc()->take(2)->toArray();

                // 2. Logika memindahkan harga TERMUDAH ke TENGAH
                // Urutkan dari termahal ke termurah dulu
                $sortedCards = $ratecards->sortByDesc('harga')->values();
                $count = $sortedCards->count();

                if ($count >= 3) {
                    // Ambil item terakhir (paling murah)
                    $cheapestItem = $sortedCards->pop();
                    // Masukkan ke posisi tengah index (misal data ada 3, masuk ke index 1)
                    $middleIndex = floor($count / 2);
                    $sortedCards->splice($middleIndex, 0, [$cheapestItem]);
                }
            @endphp

            <div class="pricing_container">
                @foreach ($sortedCards as $item)
                    @php
                        $isPopuler = in_array($item->harga, $topPrices);
                        $platforms = is_array($item->platform) ? $item->platform : explode(',', $item->platform);
                        $platformString = implode(', ', $platforms);

                        $pesanWa =
                            'Halo Admin, saya tertarik dengan layanan: *' .
                            $item->nama_layanan .
                            "*\nPlatform: " .
                            $platformString .
                            "\nHarga: Rp " .
                            number_format($item->harga, 0, ',', '.') .
                            "\n\nBisa bantu jelaskan prosedurnya?";
                        $urlWa = 'https://wa.me/' . ($konf->no_wa ?? '628123456789') . '?text=' . urlencode($pesanWa);
                    @endphp

                    <div class="pricing_card {{ $isPopuler ? 'featured' : '' }}">
                        @if ($isPopuler)
                            <div class="badge_featured">POPULER</div>
                        @endif

                        <img src="{{ asset('file/ratecard/' . $item->gambar_layanan) }}"
                            onerror="this.src='https://via.placeholder.com/80?text=Icon'" alt="Icon"
                            class="platform_icon">

                        <div class="platform_badge_wrapper">
                            @foreach ($platforms as $p)
                                <span class="platform_badge">
                                    <i class="fa fa-tag mr-1"></i> {{ trim($p) }}
                                </span>
                            @endforeach
                        </div>

                        <h3 class="service_name">{{ $item->nama_layanan }}</h3>

                        <div class="price_tag">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                            <span>/ paket</span>
                        </div>

                        <div class="description_list">
                            {!! $item->deskripsi_layanan !!}
                        </div>

                        <a href="{{ $urlWa }}" target="_blank" class="btn_order">
                            <i class="fa fa-whatsapp mr-2"></i> Pesan Sekarang
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
