<!-- The Modal -->
<div class="modal fade" id="viewBeneficiaryModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Beneficiaries</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">  
                   @include('pages.tables.view-beneficiary-table')
                </div>
            </div>
        </div>
    </div>
</div> 