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
                            <th>Ad</th>
                            <th>E-posta</th>
                            <th>Konu</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th style="width: 200px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    {!! $contact->getStatusBadgeAttribute() !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info" title="Görüntüle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Sil" onclick="return confirm('Emin misiniz?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Henüz mesaj bulunmuyor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $contacts->links() }}
        </div>
    </div>
</div>
@endsection
