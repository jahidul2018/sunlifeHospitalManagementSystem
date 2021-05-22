<div class="row">
    <div class="col-sm-6">
        <div class="container">
            <select class="form-control" name="selectMonth">
                <option disabled selected >Select Month</option>
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="container">
            <select class="form-control" name="selectMonth">
                <option disabled selected >Select Year</option>
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="container">
            <a href="{{ route('HR.incomeReport') }}">
                <input type="submit" class="btn btn-primary" value="Go">
            </a>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <table class="table" width="100">
            <tr>
                <th>Invoice No</th>
                <th>Invoice Date</th>
                <th>Income</th>
            </tr>
            @foreach($report as $report)
                <tr>
                    <td>{{ $report['invoiceNo'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>