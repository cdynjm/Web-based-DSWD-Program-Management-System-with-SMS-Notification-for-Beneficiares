<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="program-profile"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Program Profile"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <h5 class="ms-1">{{ $program_name }}</h5>
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card h-100 mb-4">
                            <div class="card-header pb-0 px-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-0">Payroll</h6>
                                    </div>
                                    <div
                                        class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                                        <i class="material-icons me-2 text-lg">date_range</i>
                                        @php date_default_timezone_set("Asia/Singapore");  @endphp
                                        <small>As of {{ date('F d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <h6 class="text-capitalize text-xs text-danger font-weight-bolder mb-3">Pending (To be Released)</h6>
                                
                                <div class="table-responsive p-0 w-100 mt-4">
                                    @include('pages.tables.payroll-table')
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card h-100 mb-4">
                            <div class="card-header pb-0 px-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-0">Transaction History</h6>
                                    </div>
                                    <div
                                        class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                                        <i class="material-icons me-2 text-lg">date_range</i>
                                        @php date_default_timezone_set("Asia/Singapore");  @endphp
                                        <small>As of {{ date('F d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <h6 class="text-capitalize text-xs text-success font-weight-bolder mb-3">Cash Released</h6>
                                
                                <div class="table-responsive p-0 w-100 mt-4">
                                    @include('pages.tables.transaction-table')
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>