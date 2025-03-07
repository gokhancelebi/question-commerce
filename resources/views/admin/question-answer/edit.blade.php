@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $question->exists ? 'Soru Düzenle' : 'Yeni Soru' }}</h1>
        <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Listeye Dön
        </a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ $question->exists ? route('admin.questions.update', $question->id) : route('admin.questions.store') }}" method="POST">
                @csrf
                @if($question->exists)
                    @method('PUT')
                @endif

                @include('admin.question-answer._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ $question->exists ? 'Güncelle' : 'Oluştur' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const answersContainer = document.querySelector('#answers-container');
    const addAnswerBtn = document.querySelector('#add-answer-btn');
    let answerCount = document.querySelectorAll('.answer-item').length;

    addAnswerBtn.addEventListener('click', function() {
        const template = `
            <div class="answer-item card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">Cevap ${answerCount + 1}</h5>
                        <button type="button" class="btn btn-sm btn-danger remove-answer" title="Cevabı Sil">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cevap İçeriği</label>
                        <textarea name="answers[${answerCount}][content]" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sıra</label>
                        <input type="number" name="answers[${answerCount}][order]" class="form-control" value="${answerCount}">
                    </div>
                </div>
            </div>
        `;
        answersContainer.insertAdjacentHTML('beforeend', template);
        answerCount++;
    });

    answersContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-answer')) {
            e.preventDefault();
            const answerItem = e.target.closest('.answer-item');
            answerItem.remove();
            updateAnswerNumbers();
        }
    });

    function updateAnswerNumbers() {
        document.querySelectorAll('.answer-item').forEach((item, index) => {
            item.querySelector('.card-title').textContent = `Cevap ${index + 1}`;
            item.querySelectorAll('[name^="answers["]').forEach(input => {
                input.name = input.name.replace(/answers\[\d+\]/, `answers[${index}]`);
            });
        });
        answerCount = document.querySelectorAll('.answer-item').length;
    }
});
</script>
@endpush
