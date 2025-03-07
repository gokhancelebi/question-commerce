@extends('admin.layouts.app')

@section('title', 'İletişim Mesajları')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>İletişim Mesajları</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Ad Soyad</th>
                            <th>Email</th>
                            <th>Konu</th>
                            <th>Tarih</th>
                            <th style="width: 200px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->full_name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-sm btn-info me-1" title="Görüntüle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')" title="Sil">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Henüz mesaj bulunmuyor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($contacts->hasPages())
                <div class="card-footer">
                    {{ $contacts->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
