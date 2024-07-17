<table class="table align-items-center mb-0" id="search-payroll-result">
    @php
        $count = 0;
    @endphp
@foreach ($payroll_list as $pl)
   
   <tr>
            <td payroll_id={{ $pl->id }}>
            <div class="d-flex align-items-center">
                <button type="button"
                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                        class="material-icons text-lg">expand_less</i></button>
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">@if(auth()->user()->type == 2)<input type="checkbox" name="payroll_id[]" value='{{ $pl->id }}' class="me-2">@endif{{ $pl->Beneficiary->name }}</h6>
                    <span class="text-xs">Control Number: {{ $pl->ProgramType->control_number }}, {{ $pl->Beneficiary->Address->brgy }}, Bontoc, Southern Leyte</span>
                    <h6 class="text-success text-xs">{{ $pl->Program->program }}</h6>
                </div>
            </div>
            </td>
            <td>
            <div class="d-flex align-items-center text-s ms-4 me-4 font-weight-bold">
                <span class="text-secondary text-xs me-2">Cash to be Released:</span> 
                <span class="text-info text-gradient">₱ {{ number_format($pl->balance, 2) }}</span>
            </div>
            </td>
        </tr>
        @php
            $count += 1;
        @endphp
 
@endforeach


    @if($count == 0)
            <tr>
                <td colspan="10" class="text-center">No data Available</td>
            </tr>
        @endif
</table>
                