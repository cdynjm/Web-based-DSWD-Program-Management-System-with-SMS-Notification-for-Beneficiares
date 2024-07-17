<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/DSWD-Logo.svg') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/css/print-page.css') }}" media="print">
    <title>
    MSWDO - {{ $name->program }}
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

<body>
    <div id="print-btn">
        <button onclick="window.location.href='{{ route('beneficiary') }}'"><i class="fa-solid fa-left-long"></i> Back</button>
        <button class="btn btn-primary" onclick="window.print();"><i class="fa-solid fa-print"></i> Print | PDF</button>
    </div>


    @php 
    
        $total = 0;
        $male = 0;
        $female = 0;
    
    @endphp

    @foreach($beneficiary as $bn)
        @php
            $total += 1;
        @endphp
        @if($bn->Beneficiary->gender == "M") @php $male += 1; @endphp @endif
        @if($bn->Beneficiary->gender == "F") @php $female += 1; @endphp @endif
    @endforeach

    
        <span style="margin-bottom: 10px; font-weight: bold;">{{ $name->program }} | @if($count != 0) Brgy. {{ $barangay->brgy }}, Bontoc, Southern Leyte @else All Beneficiaries @endif</span>
        <span style="float: right; margin-bottom: 10px; font-weight: bold;">Total: {{ $total }} | Male: {{ $male }} | Female: {{ $female }}</span>
    

    <table>
        <tr>
            <th>Control Number</th>
            <th>Name</th>
            <th>Gender</th>
            @if($name->id == 5) <th>Disability</th> @endif
            <th>Address</th>
            <th>Birthdate</th>
            <th>Age</th>
        </tr>
        @foreach($beneficiary as $bn)
        <tr>
            <td>{{ $bn->control_number }}</td>
            <td>{{ $bn->Beneficiary->name }}</td>
            <td>{{ $bn->Beneficiary->gender }}</td>
            @if($name->id == 5) <td>{{ $bn->disability }}</td> @endif
            <td>{{ $bn->Beneficiary->Address->brgy }}, Bontoc, Southern Leyte</td>
            <td>{{ date('F d, Y', strtotime($bn->Beneficiary->birthdate)) }}</td>
            <td>{{ date('Y') - date('Y', strtotime($bn->Beneficiary->birthdate)) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>

