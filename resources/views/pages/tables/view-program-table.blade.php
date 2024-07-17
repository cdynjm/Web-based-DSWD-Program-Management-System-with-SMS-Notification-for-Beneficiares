<table class="table align-items-center mb-0" id="view-program-result">
@if($table == true)
    <thead>
        <tr>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                No.
            </th>
            <th
                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Program Name</th>
            <th
                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                Total Beneficiaries</th>
        </tr>
    </thead>
    <tbody>
        @php $cnt = 1; @endphp
        @foreach ($programs as $pg)
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
                        <h6 class="mb-0 text-sm text-wrap">{{ $pg->program }}</h6>
                    </div>
                </td>
               
                <td class="align-middle text-center text-lg">
                    <div class="d-flex flex-column text-center">
                        @if($pg->id == 1)
                            <h6 class="mb-0 text-sm">{{ $aics }}</h6>
                        @endif
                        @if($pg->id == 2)
                            <h6 class="mb-0 text-sm">{{ $eccd }}</h6>
                        @endif
                        @if($pg->id == 3)
                            <h6 class="mb-0 text-sm">{{ $sc }}</h6>
                        @endif
                        @if($pg->id == 4)
                            <h6 class="mb-0 text-sm">{{ $sp }}</h6>
                        @endif
                        @if($pg->id == 5)
                            <h6 class="mb-0 text-sm">{{ $pwd }}</h6>
                        @endif
                    </div>
                </td>
            </tr>
            @php $cnt += 1; @endphp
        @endforeach
    </tbody>
    @endif
</table>