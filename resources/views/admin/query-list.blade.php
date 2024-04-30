<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{ url(ADMINPATH.'dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">
              <?= $menu; ?>
            </li>
            <li class="breadcrumb-item active">
              <?= $title; ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        
        <div class="card-body">
          <input type="hidden" value="0" id="totalRecords" />
          <table id="responseData" class="table table-bordered mb-0">
          </table>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>
<script>
    function getTotalRecordsData(qparam) {
        $.ajax({
            url: '{{url(ADMINPATH.'query-data')}}?' + qparam,
            type: "POST",
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            data: { 'is_count': 'yes', 'start': 0, 'length': 10 },
            cache: false,
            success: function (response) {
                $('#totalRecords').val(response);
                //if (response) {
                    loadAllRecordsData(qparam);
                //}
            }
        });
    }

    $(document).ready(function () {
        let qparam = (new URL(location)).searchParams;
        getTotalRecordsData(qparam);
    });

    function loadAllRecordsData(qparam) {
        $('#responseData').html('');
        var newQueryParam = '?'+qparam + '&recordstotal=' + $('#totalRecords').val();
        $('#responseData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '{{url(ADMINPATH.'query-data')}}' + newQueryParam,
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "name", "title": "Name" },
            { data: "email", "title": "Email" },
            { data: "id",  "title": "Dates","render":dates },
            { data: "id",  "title": "Action", "render": action_render },
            //{ data: "id",  "title": "Add City", "render": add_city_render }
          ],

            "rowReorder": { selector: 'td:nth-child(2)' },
            "responsive": false,
            "autoWidth": false,
            "destroy": true,
            "searchDelay": 1000,
            "searching": true,
            "pagingType": 'simple_numbers',
            "rowId": (a) => { return 'id_' + a.id; },
            "iDisplayLength": 10,
            "order": [3, "asc"],
        });
    }


var dates = ( data, type, row, meta )=>{
  var data = '';
  let add_date= row.add_date!=null?row.add_date:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Added On : </b>'+add_date+'</span>' ;
 
      
  }
return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
        var onclick = "remove('" + row.id + "','tbl_enquiry_list')";
        output += '<a class="btn  btn-danger btn-sm" onclick="' + onclick + '" title="Delete Query"><i class="fa fa-trash"></i></a> ';
    }
    return output;
}



</script>