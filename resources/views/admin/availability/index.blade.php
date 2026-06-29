@extends('layouts.admin')

@section('content')

    <div class="availability-box">
        <h2>Monthly Availability</h2>

        <form method="POST" action="{{ route('admin.availability.store') }}">
            @csrf

            <label>Date</label>
            <input type="date" name="date" class="form-control mb-3">

            <label>Open Time</label>
            <input type="time" name="open_time" class="form-control mb-3">

            <label>Close Time</label>
            <input type="time" name="close_time" class="form-control mb-3">

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_closed">
                <label class="form-check-label">Closed Full Day</label>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>

        <hr>

        <table class="table table-bordered">
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Timing</th>
            </tr>

            @foreach($data as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->is_closed ? 'Closed' : 'Open' }}</td>
                    <td>{{ $row->open_time }} - {{ $row->close_time }}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection