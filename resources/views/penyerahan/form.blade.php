@extends('main')

@section('title')
    Penyerahan
@endsection

@section('content')
<div class="card" style="margin:1rem auto; width: 91%">
    <form action="{{ isset($data) ? route('penyerahan.update', $data->id) : route('penyerahan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            {{-- data kandidat --}}
            <div id="data_kandidat">
                {{-- ajax --}}
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" disabled value="{{ isset($data) ? $datarelasi->nama : '' }}" name="nama" class="form-control">
                        </div>
                        <div class="col-5">
                            <input type="text" disabled value="{{ isset($data) ? ($datarelasi->jk == 'L' ? 'Laki-Laki':'Perempuan' ) : '' }}" name="jk" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" disabled>{{ isset($data) ? $datarelasi->kkj->alamat : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="tmpt_lahir">Tempat & Tanggal Lahir</label>
                    <input type="text" class="form-control" disabled value="{{ isset($data) ? $datarelasi->tmpt_lahir .', '. Carbon\Carbon::parse($datarelasi->tgl_lahir, 'Asia/Jakarta')->translatedFormat('d F Y') : '' }}">
                </div>
                <div class="form-group">
                    <label for="">Nama Ayah</label>
                    <input type="text" disabled class="form-control" value="{{ isset($data) ? $datarelasi->kkj_kepala_keluarga->nama : '' }}">
                </div>
                <div class="form-group">
                    <label for="">Nama Ibu</label>
                    <input type="text" disabled class="form-control" value="{{ isset($data) ? ($datarelasi->kkj_pasangan ? $datarelasi->kkj_pasangan->nama : 'Tidak Ada') : '' }}">
                </div>
            </div>
            {{-- /data kandidat --}}
            <div class="form-group">
                <label for="waktu">Tanggal Penyerahan</label>
                <input type="datetime-local" class="form-control" value="{{ isset($data) ? $data->waktu : '' }}" name="waktu" id="waktu" required>
            </div>
            <div class="form-group">
                <label for="pendeta">Pendeta</label>
                <input type="text" class="form-control" id="pendeta" value="{{ isset($data) ? $data->pendeta : '' }}" name="pendeta" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" {{ isset($data) ? '' : 'required' }}>
            </div>
            <button class="btn btn-primary" style="margin-top: 1rem">Submit</button>
        </div>
    </form>
</div>
@endsection