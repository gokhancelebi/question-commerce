@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ürün Eşleştirmeleri</h1>
        <div>
            <form action="{{ route('admin.product-matches.generate') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success me-2" onclick="return confirm('Tüm mevcut eşleştirmeler silinecek ve yeniden oluşturulacak. Onaylıyor musunuz?')">
                    <i class="fas fa-sync"></i> Kombinasyonları Oluştur
                </button>
            </form>
            <a href="{{ route('admin.product-matches.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Eşleştirme
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-calculator"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Toplam Olası Kombinasyon</span>
                    <span class="info-box-number">{{ number_format($totalCombinations) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Mevcut Eşleştirme</span>
                    <span class="info-box-number">{{ number_format($existingCombinations) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Ürün</th>
                            <th>Cevap Kombinasyonu</th>
                            <th>Durum</th>
                            <th style="width: 200px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productMatches as $match)
                            <tr>
                                <td>{{ $match->id }}</td>
                                <td>{{ $match->product->title }}</td>
                                <td>
                                    @foreach($match->answer_combinations as $answerId)
                                        @php
                                            $answer = \App\Models\Answer::find($answerId);
                                            if ($answer) {
                                                $question = $answer->question;
                                                echo "<strong>{$question->title}:</strong> {$answer->content}<br>";
                                            }
                                        @endphp
                                    @endforeach
                                </td>
                                <td>
                                    @if($match->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Pasif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.product-matches.edit', $match->id) }}" class="btn btn-sm btn-info me-1" title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.product-matches.destroy', $match->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bu eşleştirmeyi silmek istediğinizden emin misiniz?')" title="Sil">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Henüz eşleştirme bulunmuyor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($productMatches->hasPages())
                <div class="card-footer">
                    {{ $productMatches->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 