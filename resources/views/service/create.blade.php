@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Service /</span> {{ $title }}</h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data Service & Harga</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('service.store') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Kategori Service <span class="text-danger">*</span></label>
                            <select name="id_kategori_service"
                                class="form-select @error('id_kategori_service') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori_service }}">{{ $k->nama_kategori_service }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type / Model <span class="text-danger">*</span></label>
                            <input type="text" name="type" class="form-control" placeholder="Contoh: iPhone 13 Pro">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">MACBOOK / Spesifikasi</label>
                            <input type="text" name="macbook" class="form-control" placeholder="Contoh: Air M1 2020">
                        </div>
                    </div>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><button type="button" class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#tab-lcd">LCD & Screen</button></li>
                            <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#tab-battery">Battery & Power</button></li>
                            <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#tab-camera">Camera & Flex</button></li>
                            <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#tab-others">Hardware & Macbook</button></li>
                        </ul>
                        <div class="tab-content border">
                            <div class="tab-pane fade show active" id="tab-lcd" role="tabpanel">
                                <div class="row g-3">
                                    @php
                                        $lcd_fields = [
                                            'lcd' => 'LCD Umum',
                                            'lcd_oem' => 'LCD OEM',
                                            'lcd_original' => 'LCD Original',
                                            'lcd_ori_premium_oled' => 'LCD Ori Premium OLED',
                                            'lcd_ori_apple' => 'LCD Ori Apple',
                                            'lcd_bercak' => 'LCD Bercak',
                                            'pindah_chip_lcd' => 'Pindah Chip LCD',
                                            'flexible_lcd' => 'Flexible LCD',
                                            'repair_glass' => 'Repair Glass',
                                            'adhesive_lcd' => 'Adhesive LCD',
                                        ];
                                    @endphp
                                    @foreach ($lcd_fields as $key => $label)
                                        <div class="col-md-4">
                                            <label class="form-label">{{ $label }}</label>
                                            <div class="input-group"><span class="input-group-text">Rp</span>
                                                <input type="number" name="{{ $key }}" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-battery" role="tabpanel">
                                <div class="row g-3">
                                    @php
                                        $bat_fields = [
                                            'battery' => 'Battery Umum',
                                            'battery_garansi_1_tahun' => 'Battery (1 Thn)',
                                            'battery_garansi_lifetime' => 'Battery (Lifetime)',
                                            'battery_apple_chip' => 'Battery Apple Chip',
                                            'battery_pindah_chip' => 'Battery Pindah Chip',
                                            'charger_port' => 'Charger Port',
                                            'flex_charger' => 'Flex Charger',
                                            'flex_charger_ori_apple' => 'Flex Charger Ori Apple',
                                        ];
                                    @endphp
                                    @foreach ($bat_fields as $key => $label)
                                        <div class="col-md-4">
                                            <label class="form-label">{{ $label }}</label>
                                            <div class="input-group"><span class="input-group-text">Rp</span>
                                                <input type="number" name="{{ $key }}" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-camera" role="tabpanel">
                                <div class="row g-3">
                                    @php
                                        $cam_fields = [
                                            'back_cam_ori' => 'Back Cam Ori',
                                            'back_cam_ori_copotan' => 'Back Cam Copotan',
                                            'front_cam' => 'Front Cam',
                                            'kaca_kamera' => 'Kaca Kamera',
                                            'face_id' => 'Face ID',
                                            'flex_on_off' => 'Flex On/Off',
                                            'flex_volume' => 'Flex Volume',
                                            'flex_on_off_volume' => 'Flex On/Off + Volume',
                                            'sensor_proximity' => 'Sensor Proximity',
                                            'home_button' => 'Home Button',
                                            'taptic_engine' => 'Taptic Engine',
                                        ];
                                    @endphp
                                    @foreach ($cam_fields as $key => $label)
                                        <div class="col-md-4">
                                            <label class="form-label">{{ $label }}</label>
                                            <div class="input-group"><span class="input-group-text">Rp</span>
                                                <input type="number" name="{{ $key }}" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-others" role="tabpanel">
                                <div class="row g-3">
                                    @php
                                        $oth_fields = [
                                            'buzzer_atas' => 'Buzzer Atas',
                                            'buzzer_bawah' => 'Buzzer Bawah',
                                            'antena_wifi' => 'Antena Wifi',
                                            'housing_body' => 'Housing (Body)',
                                            'back_door' => 'Back Door',
                                            'water_damage' => 'Water Damage',
                                            'swap_part' => 'Swap Part',
                                            'keyboard' => 'Keyboard',
                                            'speaker' => 'Speaker',
                                            'trackpad' => 'Trackpad',
                                        ];
                                    @endphp
                                    @foreach ($oth_fields as $key => $label)
                                        <div class="col-md-4">
                                            <label class="form-label">{{ $label }}</label>
                                            <div class="input-group"><span class="input-group-text">Rp</span>
                                                <input type="number" name="{{ $key }}" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('service.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
