<table class="table align-items-center mb-0" id="view-beneficiary-result">
@if($table == true)
    <thead>
        <tr>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Control Number</th>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Name</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Gender</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Address</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Birthdate</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Age</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($programtype as $pt) 
        <tr>
           
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm text-secondary ms-2 mb-0 text-wrap">{{ $pt->control_number }}</p>
                    </div>
                </div>
            </td>
            <td>
                <p class="text-sm font-weight-bold mb-0">{{ $pt->Beneficiary->name }}</p>
            </td>
            
            <td class="align-middle text-center">
                <p class="text-sm text-secondary ms-2 mb-0 fw-bold text-wrap">{{ $pt->Beneficiary->gender }}</p>
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm text-secondary ms-2 mb-0 text-wrap">{{ $pt->Beneficiary->Address->brgy }}, Bontoc, Southern Leyte</p>
                    </div>
                </div>
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm text-secondary ms-2 mb-0 text-wrap">{{ date('M d, Y', strtotime($pt->Beneficiary->birthdate)) }}</p>
                    </div>
                </div>
            </td>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-sm text-secondary ms-2 mb-0 text-wrap">{{ date('Y') - date('Y', strtotime($pt->Beneficiary->birthdate)) }}</p>
                    </div>
                </div>
            </td>
            @if($pt->status == 1)
            <td class="align-middle text-center text-sm">
                <span class="badge badge-sm bg-gradient-success text-wrap">Active</span>
            </td>
            @endif
            @if($pt->status == 0)
            <td class="align-middle text-center text-sm">
                <span class="badge badge-sm bg-gradient-danger text-wrap">Inactive</span>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
@endif
</table>