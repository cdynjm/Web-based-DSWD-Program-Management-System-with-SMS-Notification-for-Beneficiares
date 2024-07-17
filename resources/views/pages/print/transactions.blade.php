<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/DSWD-Logo.svg') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/css/print-page.css') }}" media="print">
    <title>
    MSWDO - {{ $name->program }} Transactions {{ $year }}
    </title>
</head>

<style>
    * {
        font-family: Cambria;
        font-size: 12px;
    }
    button {
        font-family: inherit;
        font-size: 11px;
        background-color: black;
        color: white;
        padding: 0.8em 1.2em;
        border: none;
        border-radius: 10px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
        margin-bottom: 20px;
        cursor: pointer;
    }
    table {
        width: 100%;
        height: auto;
        border: 1px solid lightgray;
        border-collapse: collapse;
    }
    table tr th {
        border: 1px solid lightgray;
        padding: 5px;
    }
    table tr td {
        padding: 10px;
        border: 1px solid lightgray;
    }
</style>

@php
    $countBeneficiary = 0;
    $cash = 0;
@endphp

@foreach ($transaction as $tr)
    @php
        $countBeneficiary += 1;
        $cash += $tr->cash;
    @endphp
@endforeach

<body>
    <div id="print-btn">
        <button onclick="window.location.href='{{ route('transaction-history') }}'"><i class="fa-solid fa-left-long"></i> Back</button>
        <button class="btn btn-primary" onclick="window.print();"><i class="fa-solid fa-print"></i> Print | PDF</button>
    </div>
<center>
    <span style="margin-bottom: 10px; font-weight: bold;">{{ $name->program }} 
 
        <p> @if($count != 0) Brgy. {{ $barangay->brgy }}, Bontoc, Southern Leyte @else All Beneficiaries @endif </p>

        <p>  @if(Session::get('event') != 0) {{ $event->title }} - {{ date('M d, Y', strtotime($event->date)) }} @else All Events @endif </p>

        <p> Year: {{ $year }} </p>

        <p> @if(Session::get('month') != 0) Month: {{ date('F', strtotime(Session::get('month'))) }}  @endif </p>

        <p> Total Beneficiaries Received: {{ $countBeneficiary }} | Total Amount of Cash Released: ₱ {{ number_format($cash, 2) }}</p>
    </span>
</center>
    <table>
        <tr>
            <th>Control Number</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Total Cash Received</th>
            <th>Date Received</th>
        </tr>
        @foreach ($transaction as $tr)
            <tr>
                <td>{{ $tr->ProgramType->control_number }}</td>
                <td>{{ $tr->Beneficiary->name }}</td>
                <td>{{ $tr->Beneficiary->gender }}</td>
                <td>Brgy. {{ $tr->Beneficiary->Address->brgy }}, Bontoc, Southern Leyte</td>
                <td>₱ {{ number_format($tr->cash, 2) }}</td>
                <td>{{ date('M d, Y', strtotime($tr->created_at)) }}</td>
            </tr>
        @endforeach
        
    </table>
    
</body>
</html>

