@extends('layouts.app')

@section('content')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<div class="container">
    <h1>Demandes d'inscription</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                <tr>
                    <td>{{ $registration->username }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->phoneNumber }}</td>
                    <td>
                        <form action="{{ route('admin.registrations.approve', $registration->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Approuver</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
