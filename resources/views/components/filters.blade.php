<div>
    <div>
        <div class="row">
            <div class="col-md-3">
                <label for="company" class="text-blue"><strong>Ristorante</strong></label>
                <select id="company" class="form-control">
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}"> {{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="from" class="text-blue"><strong>Dal</strong></label>
                <input type="date" id="from" name="from" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="to" class="text-blue"><strong>Al</strong></label>
                <input type="date" id="to" name="to" class="form-control" />
            </div>
            <div class="col-md-3 mt-4">
                <input type="button" class="btn btn-blue" value="Filtra" onclick="barChart()" />
            </div>
        </div>
    </div>
</div>