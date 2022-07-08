@extends('dashboard.layouts.main')
@section('content')
<style>
    .highcharts-figure,
.highcharts-data-table table {
  min-width: 310px;
  max-width: 800px;
  margin: 1em auto;
}

#container {
  height: 400px;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="bi bi-file-earmark-excel"></i> Report</h1>
</div>
<div class="container ">
    <div class="col-md-8">
        <form action='/dashboard/report-get' method='post'>
            @csrf
            <div class="mb-3 mt-3">
                <label for="user_id" class="form-label">Select User</label>
                <select class="form-select" name='user_id' id='user_id' aria-label="Default select example">
                    <option value="ALL"> -- All User</option>
                  @foreach ($user_job as $item_user)
                    <option value="{{ $item_user->user->id }}">---- {{ $item_user->user->name }}</option>
                  @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success mb-5" name="save"><i class="bi bi-arrow-down"></i> Get Report</button>
        </form>

        @if ($result_report == "empty")
        <div class="alert alert-warning" role="alert">
            Please Get Report ...
          </div>
        @else
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <figure class="highcharts-figure">
          <div id="container"></div>
          <p class="highcharts-description">
            Bar chart showing horizontal columns. This chart type is often
            beneficial for smaller screens, as the user can scroll through the data
            vertically, and axis labels are easy to read.
          </p>
        </figure>
        @endif
    </div>


</div>
@endsection
