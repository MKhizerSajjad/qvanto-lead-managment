<x-app-layout>
    <div class="content-page rtl-page">
        <div class="container-fluid">

            @if ($message = Session::get('success'))
                <div class="alert alert-success auto-colse-3" role="alert" bis_skin_checked="1">
                    {{-- <div class="iq-alert-icon"> --}}
                        <i class="ri-check-double-line"></i>
                    {{-- </div> --}}
                    <div class="iq-alert-text" bis_skin_checked="1">
                        <b>Success!</b> {{ $message }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{--  card-block card-stretch card-height --}}
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Leads List</h4>
                            </div>
                            <a href="{{route('lead.create')}}" class="btn btn-primary">Add New</a>
                            {{-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContact">Add New</a> --}}
                        </div>

                        @php
                            if (Auth::user()->user_type == 1) {
                                $hideVendor = false;
                            } else {
                                $hideVendor = true;
                            }
                        @endphp

                        <div class="card-body">
                            @if (count($data) > 0)
                                <div class="table-responsive">
                                    <table class="table data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Examination Type</th>
                                                @if($hideVendor == false)
                                                    <th>Vendor</th>
                                                @endif
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $lead)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{getLeadType($lead->lead_type)}}</td>
                                                    @if($hideVendor == false)
                                                        <td>{{$lead->vendor->first_name ?? ''}} {{$lead->vendor->last_name ?? ''}}</td>
                                                    @endif
                                                    <td>{{$lead->dated}}</td>
                                                    <td>{!! getLeadStatus($lead->status, 'badge') !!}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge bg-warning-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route('lead.edit', $lead->id) }}">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            <a class="badge bg-primary-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Comment" href="{{ route('lead.comment', $lead->id) }}">
                                                                <i class="fa fa-comment"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h4 class="text text-center text-danger font-weight-bold p-5">No Record Found</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>