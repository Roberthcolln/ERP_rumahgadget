@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Service /</span> Edit Data</h4>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('service.update', $service->id_service) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori_service" class="form-select">
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori_service }}"
                                        {{ $service->id_kategori_service == $k->id_kategori_service ? 'selected' : '' }}>
                                        {{ $k->nama_kategori_service }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" value="{{ $service->type }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">MACBOOK</label>
                            <input type="text" name="macbook" class="form-control" value="{{ $service->macbook }}">
                        </div>
                    </div>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><button type="button" class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#edit-all">Update Harga Sparepart</button></li>
                        </ul>
                        <div class="tab-content border">
                            <div class="tab-pane fade show active" id="edit-all" role="tabpanel">
                                <div class="row g-3">
                                    @php
                                        // List semua field sesuai urutan gambar DB anda
                                        $all_fields = [
                                            'lcd',
                                            'lcd_oem',
                                            'lcd_original',
                                            'lcd_ori_premium_oled',
                                            'lcd_ori_apple',
                                            'lcd_bercak',
                                            'pindah_chip_lcd',
                                            'flexible_lcd',
                                            'repair_glass',
                                            'adhesive_lcd',
                                            'battery',
                                            'battery_garansi_1_tahun',
                                            'battery_garansi_lifetime',
                                            'battery_apple_chip',
                                            'battery_pindah_chip',
                                            'charger_port',
                                            'flex_charger',
                                            'flex_charger_ori_apple',
                                            'back_cam_ori',
                                            'back_cam_ori_copotan',
                                            'front_cam',
                                            'kaca_kamera',
                                            'face_id',
                                            'flex_on_off',
                                            'flex_volume',
                                            'flex_on_off_volume',
                                            'sensor_proximity',
                                            'home_button',
                                            'taptic_engine',
                                            'buzzer_atas',
                                            'buzzer_bawah',
                                            'antena_wifi',
                                            'housing_body',
                                            'back_door',
                                            'water_damage',
                                            'swap_part',
                                            'keyboard',
                                            'speaker',
                                            'trackpad',
                                        ];
                                    @endphp

                                    @foreach ($all_fields as $field)
                                        <div class="col-md-4">
                                            <label
                                                class="form-label text-capitalize">{{ str_replace('_', ' ', $field) }}</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="{{ $field }}" class="form-control"
                                                    value="{{ $service->$field ?? 0 }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('service.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-dark">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
