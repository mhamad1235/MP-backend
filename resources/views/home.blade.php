@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('css')
  <link href="{{ URL::asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-4">
      <div class="card card-animate">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar-sm flex-shrink-0">
              <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                <i data-feather="users" class="text-primary"></i>
              </span>
            </div>
            <div class="flex-grow-1 ms-3 overflow-hidden">
              <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">Total Users</p>
              <h4 class="fs-4 mb-0">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4">
      <div class="card card-animate">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar-sm flex-shrink-0">
              <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                <i data-feather="award" class="text-warning"></i>
              </span>
            </div>
            <div class="flex-grow-1 ms-3">
              <p class="text-uppercase fw-semibold text-truncate text-muted mb-3">Total Tickets</p>
              <h4 class="fs-4 mb-0">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4">
      <div class="card card-animate">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar-sm flex-shrink-0">
              <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                <i data-feather="dollar-sign" class="text-info"></i>
              </span>
            </div>
            <div class="flex-grow-1 ms-3 overflow-hidden">
              <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">Total Order Amount</p>
              <h4 class="fs-4 mb-0">0 IQD</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title flex-grow-1 mb-0">Top Ticket Buyers</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive table-card">
            <table class="table-borderless table-centered table-wrap mb-0 table align-middle">
              <thead class="text-muted table-light">
                <tr>
                  <th scope="col">User</th>
                  <th scope="col">Total Orders</th>
                  <th scope="col">Total Tickets</th>
                  <th scope="col">Total Amount</th>
                  <th scope="col">Last Bought Ticket</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="6" class="text-center">No data available</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title flex-grow-1 mb-0">Orders</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive table-card">
            <table class="table-borderless table-centered table-wrap mb-0 table align-middle">
              <thead class="text-muted table-light">
                <tr>
                  <th scope="col">User</th>
                  <th scope="col">Total Tickets</th>
                  <th scope="col">Grand Total</th>
                  <th scope="col">Order Number</th>
                  <th scope="col">Payment Method</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="6" class="text-center">No data available</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
