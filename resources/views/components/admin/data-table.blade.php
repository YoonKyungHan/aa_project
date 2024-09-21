<table id="{{$id ?? 'data-table'}}" class="table table-bordered">
    <thead>
        <tr>
            {{$thead}}
        </tr>
    </thead>
    <tbody>
        {{$slot}}
    </tbody>
</table>