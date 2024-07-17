<table class="table align-items-center mb-0" id="view-focal-person-result">
@if($table == true)
    <thead>
        <tr>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                No.
            </th>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Name</th>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Address</th>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Contact Number</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Program</th>
        </tr>
    </thead>
    <tbody>
        @php $cnt = 1; @endphp
        @foreach ($focal_person as $fp)
            <tr>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <p class="mb-0 text-sm">{{ $cnt }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column text-left">
                        <h6 class="mb-0 text-sm text-wrap">{{ $fp->name }}</h6>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column text-left">
                        <p class="mb-0 text-sm text-wrap">{{ $fp->address }}</p>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column text-left">
                        <p class="mb-0 text-sm text-wrap">{{ $fp->contact_number }}</p>
                    </div>
                </td>
               
                <td class="align-middle text-center text-lg">
                    <div class="d-flex flex-column text-center">
                    @foreach($programs as $pg)
                        @if($pg->focal_person == $fp->id)
                            <h6 class="mb-0 text-sm">{{ $pg->program }}</h6>
                        @endif
                    @endforeach
                    </div>
                </td>
            </tr>
            @php $cnt += 1; @endphp
        @endforeach
    </tbody>
    @endif
</table>