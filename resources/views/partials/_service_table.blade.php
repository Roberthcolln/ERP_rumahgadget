<div class="table-responsive-custom">
    <table class="table table-hover table-service-custom mb-0">
        <thead>
            <tr>
                <th class="sticky-col align-middle" rowspan="2">MODEL / TYPE</th>
                <th colspan="9" class="text-center py-2"
                    style="background:#fff9e6 !important; color:#d4a017 !important;">LCD COMPONENTS</th>
                <th colspan="6" class="text-center py-2"
                    style="background:#f0f7ff !important; color:#0056b3 !important;">BATTERY SERVICE</th>
                <th colspan="4" class="text-center py-2">CAMERA</th>
                <th colspan="7" class="text-center py-2">FLEXIBLE & BUTTONS</th>
                <th colspan="11" class="text-center py-2">OTHER PARTS & MACBOOK</th>
            </tr>
            <tr>
                {{-- LCD Section --}}
                <th>LCD</th>
                <th>LCD OEM</th>
                <th>LCD ORI</th>
                <th>ORI APPLE</th>
                <th>ORI PREM</th>
                <th>PNDH CHIP</th>
                <th>FLEX LCD</th>
                <th>REPAIR GLS</th>
                <th>LCD BERC</th>

                {{-- Battery Section --}}
                <th>BATTERY</th>
                <th>BATT 1 YR</th>
                <th>BATT LIFE</th>
                <th>APP CHIP</th>
                <th>PNDH CHIP</th>
                <th>CHG PORT</th>

                {{-- Camera Section --}}
                <th>BACK CAM</th>
                <th>CAM COPOT</th>
                <th>FRONT CAM</th>
                <th>KACA CAM</th>

                {{-- Flex & Buttons --}}
                <th>ON/OFF</th>
                <th>VOLUME</th>
                <th>ON/OFF+VOL</th>
                <th>FLEX CHG</th>
                <th>CHG APPLE</th>
                <th>HOME BTN</th>
                <th>TAPTIC</th>

                {{-- Others & Macbook --}}
                <th>BUZZ UP</th>
                <th>BUZZ LOW</th>
                <th>PROXIMITY</th>
                <th>WIFI</th>
                <th>FACE ID</th>
                <th>HOUSING</th>
                <th>BACKDOOR</th>
                <th>SWAP PART</th>
                <th>WATER DMG</th>
                <th>KEYBOARD</th>
                <th>SPEAKER/TPAD</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($service as $row)
                <tr>
                    <td class="sticky-col fw-bold">
                        {{ $row->type }}<br>
                        <small class="text-muted">{{ $row->macbook }}</small>
                    </td>

                    {{-- LCD Data --}}
                    <td class="text-center">{{ $row->lcd > 0 ? number_format($row->lcd / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">{{ $row->lcd_oem > 0 ? number_format($row->lcd_oem / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center fw-bold">
                        {{ $row->lcd_original > 0 ? number_format($row->lcd_original / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center text-primary">
                        {{ $row->lcd_ori_apple > 0 ? number_format($row->lcd_ori_apple / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->lcd_ori_premium_oled > 0 ? number_format($row->lcd_ori_premium_oled / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->pindah_chip_lcd > 0 ? number_format($row->pindah_chip_lcd / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->flexible_lcd > 0 ? number_format($row->flexible_lcd / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->repair_glass > 0 ? number_format($row->repair_glass / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center text-danger">
                        {{ $row->lcd_bercak > 0 ? number_format($row->lcd_bercak / 1000, 0) . 'k' : '-' }}</td>

                    {{-- Battery Data --}}
                    <td class="text-center">
                        {{ $row->battery > 0 ? number_format($row->battery / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->battery_garansi_1_tahun > 0 ? number_format($row->battery_garansi_1_tahun / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center text-success fw-bold">
                        {{ $row->battery_garansi_lifetime > 0 ? number_format($row->battery_garansi_lifetime / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->battery_apple_chip > 0 ? number_format($row->battery_apple_chip / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->battery_pindah_chip > 0 ? number_format($row->battery_pindah_chip / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->charger_port > 0 ? number_format($row->charger_port / 1000, 0) . 'k' : '-' }}</td>

                    {{-- Camera Data --}}
                    <td class="text-center">
                        {{ $row->back_cam_ori > 0 ? number_format($row->back_cam_ori / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->back_cam_ori_copotan > 0 ? number_format($row->back_cam_ori_copotan / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->front_cam > 0 ? number_format($row->front_cam / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->kaca_kamera > 0 ? number_format($row->kaca_kamera / 1000, 0) . 'k' : '-' }}</td>

                    {{-- Flexible Data --}}
                    <td class="text-center">
                        {{ $row->flex_on_off > 0 ? number_format($row->flex_on_off / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->flex_volume > 0 ? number_format($row->flex_volume / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->flex_on_off_volume > 0 ? number_format($row->flex_on_off_volume / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->flex_charger > 0 ? number_format($row->flex_charger / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->flex_charger_ori_apple > 0 ? number_format($row->flex_charger_ori_apple / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->home_button > 0 ? number_format($row->home_button / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->taptic_engine > 0 ? number_format($row->taptic_engine / 1000, 0) . 'k' : '-' }}</td>

                    {{-- Others & Macbook --}}
                    <td class="text-center">
                        {{ $row->buzzer_atas > 0 ? number_format($row->buzzer_atas / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->buzzer_bawah > 0 ? number_format($row->buzzer_bawah / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->sensor_proximity > 0 ? number_format($row->sensor_proximity / 1000, 0) . 'k' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->antena_wifi > 0 ? number_format($row->antena_wifi / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center text-info">
                        {{ $row->face_id > 0 ? number_format($row->face_id / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->housing_body > 0 ? number_format($row->housing_body / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->back_door > 0 ? number_format($row->back_door / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center text-warning">
                        {{ $row->swap_part > 0 ? number_format($row->swap_part / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->water_damage > 0 ? number_format($row->water_damage / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        {{ $row->keyboard > 0 ? number_format($row->keyboard / 1000, 0) . 'k' : '-' }}</td>
                    <td class="text-center">
                        @if ($row->speaker > 0)
                            S:{{ number_format($row->speaker / 1000, 0) }}k
                        @endif
                        @if ($row->trackpad > 0)
                            T:{{ number_format($row->trackpad / 1000, 0) }}k
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="38" class="text-center py-5">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
