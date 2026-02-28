@extends('layouts.web')

@section('isi')
    <style>
        .pricing_section {
            background: #f8f9fa;
            padding: 80px 0;
        }

        .pricing_container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding-top: 20px;
            margin-bottom: 60px;
            /* Jarak ke info extra */
        }

        .pricing_card {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('{{ asset('web/images/1.jpg') }}');
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
            background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('{{ asset('web/images/1.jpg') }}');
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

        /* --- Extra Info Wrapper (Addons & Gears) --- */
        .extra_info_wrapper {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            padding: 40px;
            background: #ffffff;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            border: 1px solid #eee;
        }

        .addon_box h4,
        .gear_box h4 {
            font-weight: 800;
            font-size: 18px;
            margin-bottom: 20px;
            color: #222;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .addon_item {
            background: #fffdf5;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid #ffbe33;
            font-weight: 700;
            color: #444;
            transition: 0.3s;
        }

        .addon_item:hover {
            background: #fef5d4;
        }

        .gear_grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .gear_item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #f1f1f1;
        }

        .gear_item small {
            display: block;
            color: #ffbe33;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .gear_item span {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #333;
            line-height: 1.4;
        }

        /* --- Utility Classes --- */
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
        }

        .platform_icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            object-fit: contain;
        }

        .service_name {
            font-weight: 800;
            font-size: 20px;
            margin-bottom: 10px;
            min-height: 50px;
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

        .btn_order {
            display: inline-block;
            padding: 14px;
            background-color: #ffbe33;
            color: #000;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.3s;
            text-align: center;
            text-transform: uppercase;
            text-decoration: none !important;
            margin-top: auto;
        }

        .btn_order:hover {
            background-color: #000;
            color: #ffbe33;
        }

        @media (max-width: 991px) {
            .extra_info_wrapper {
                grid-template-columns: 1fr;
                padding: 25px;
            }
        }

        @media (max-width: 576px) {
            .gear_grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="pricing_section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="font-weight: 800; font-size: 38px; color: #111;">Rate Card Layanan</h2>
                <p style="color: #777;">Solusi konten kreatif profesional untuk meningkatkan branding bisnis Anda.</p>
            </div>

            <div class="extra_info_wrapper">
                <div class="addon_box">
                    <h4><i class="fa fa-plus-circle text-warning mr-2"></i> Add-on</h4>
                    <div class="addon_item">
                        <span>Keranjang Kuning</span>
                        <span class="text-warning">Rp. 499K</span>
                    </div>
                    <div class="addon_item">
                        <span>Request Tgl Posting</span>
                        <span class="text-warning">Rp. 499K</span>
                    </div>
                </div>

                <div class="gear_box">
                    <h4><i class="fa fa-video-camera text-warning mr-2"></i> Peralatan Perang</h4>
                    <div class="gear_grid">
                        <div class="gear_item">
                            <small>Kamera (Handycam)</small>
                            <span>SONY A7C II</span>
                        </div>
                        <div class="gear_item">
                            <small>Stabilizer (Kepala Ayam)</small>
                            <span>DJI RONIN SC III</span>
                        </div>
                        <div class="gear_item">
                            <small>Lensa (Kacamata Kakyol)</small>
                            <span>SONY GMaster FE 1.4 24mm</span>
                        </div>
                        <div class="gear_item">
                            <small>Audio (Rekam pake Hape)</small>
                            <span>SARAMONIC</span>
                        </div>
                    </div>
                </div>
            </div><br>

            @php
                $topPrices = $ratecards->pluck('harga')->unique()->sortDesc()->take(2)->toArray();
                $sortedCards = $ratecards->sortByDesc('harga')->values();
                $count = $sortedCards->count();
                if ($count >= 3) {
                    $cheapestItem = $sortedCards->pop();
                    $middleIndex = floor($count / 2);
                    $sortedCards->splice($middleIndex, 0, [$cheapestItem]);
                }
            @endphp

            <div class="pricing_container">
                @foreach ($sortedCards as $item)
                    @php
                        $isPopuler = in_array($item->harga, $topPrices);
                        $platforms = is_array($item->platform) ? $item->platform : explode(',', $item->platform);
                        $urlWa =
                            'https://wa.me/' .
                            ($konf->no_wa ?? '628123456789') .
                            '?text=' .
                            urlencode('Halo Admin, saya tertarik paket: ' . $item->nama_layanan);
                    @endphp

                    <div class="pricing_card {{ $isPopuler ? 'featured' : '' }}">
                        @if ($isPopuler)
                            <div class="badge_featured">POPULER</div>
                        @endif

                        <img src="{{ asset('file/ratecard/' . $item->gambar_layanan) }}"
                            onerror="this.src='https://via.placeholder.com/80?text=Icon'" class="platform_icon">

                        <div class="mb-3">
                            @foreach ($platforms as $p)
                                <span class="badge badge-light shadow-sm"
                                    style="font-size: 10px; padding: 5px 10px; border-radius: 50px;">
                                    <i class="fa fa-tag mr-1 text-warning"></i>{{ trim($p) }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Nama Layanan tetap di H3 --}}
                        <h3 class="service_name">{{ $item->nama_layanan }}</h3>

                        {{-- Posisi Talent dipindah ke bawah Nama Layanan agar lebih bersih --}}
                        <p style="font-size: 14px; color: #666; font-weight: 500; margin-top: -10px; margin-bottom: 15px;">
                            <i class="fa fa-users text-primary mr-1"></i> {{ $item->talent }} Talent
                        </p>

                        <div class="price_tag">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                        <div style="text-align: left; font-size: 13px; color: #555; margin-bottom: 25px;">
                            {!! $item->deskripsi_layanan !!}
                        </div>

                        <a href="{{ $urlWa }}" target="_blank" class="btn_order">
                            <i class="fa fa-whatsapp mr-1"></i> Pesan Sekarang
                        </a>
                    </div>
                @endforeach
            </div>



        </div>
    </section>
@endsection
