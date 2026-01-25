<select class="col-sm-12 select2" name="jur_pilih" id="jur_pilih" onchange="initPilihJurusan(this)" required>
    <option value="all">-- Semua Prodi --</option>
    @foreach ($jurusan as $jur)
        <option value="{{ $jur->jur_id }}">{{ $jur->jur_nama }} -
            ({{ $jur->jur_jenjang }})
        </option>
    @endforeach
</select>

@push('additional_script')
    <script type="text/javascript">
        $('#jur_pilih').select2();
    </script>
@endpush
