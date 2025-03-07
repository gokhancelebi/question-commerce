@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sorular ve Cevaplar</h1>
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Yeni Soru
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Soru</th>
                            <th>Cevap Sayısı</th>
                            <th>Durum</th>
                            <th>Sıra</th>
                            <th style="width: 200px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td>
                                <td>
                                    <strong>{{ $question->title }}</strong>
                                    @if($question->description)
                                        <br>
                                        <small class="text-muted">{{ $question->description }}</small>
                                    @endif
                                </td>
                                <td>{{ $question->answers->count() }}</td>
                                <td>
                                    @if($question->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Pasif</span>
                                    @endif
                                </td>
                                <td>{{ $question->order }}</td>
                                <td>
                                    <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-sm btn-info me-1" title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bu soruyu silmek istediğinizden emin misiniz?')" title="Sil">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $questions->links() }}
        </div>
    </div>
</div>
@endsection
