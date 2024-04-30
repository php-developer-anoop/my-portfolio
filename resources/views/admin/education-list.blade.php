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
        <div class="card-header">
          <a href="{{ url(ADMINPATH.'add-education') }}" class="btn btn-success m-auto float-right">Add Education</a>
        </div>
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
            url: '{{url(ADMINPATH.'education-data')}}?' + qparam,
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
                "url": '{{url(ADMINPATH.'education-data')}}' + newQueryParam,
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Education Detail","render":title_detail },
         
            { data: "id", "title": "Institution Detail","render":institution_detail },
            
            { data: "id",  "title": "Dates","render":dates },
           // { data: "id",  "title": "Status", "render": status_render },
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

    var title_detail = ( data, type, row, meta )=>{
  var data = '';
  let title= row.title!=null?row.title:"";
  let pass_year= row.pass_year!=null?row.pass_year:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Title : </b>'+title+'</span><br>' ;
        data += '<span class="fotr_10"><b>Pass Year : </b>'+pass_year+'</span>' ;
      
  }
return data;
}

var institution_detail = ( data, type, row, meta )=>{
  var data = '';
  let institution= row.institution!=null?row.institution:"";
  let institution_place= row.institution_place!=null?row.institution_place:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Institution : </b>'+institution+'</span><br>' ;
        data += '<span class="fotr_10"><b>Location : </b>'+institution_place+'</span>' ;
      
  }
return data;
}

var dates = ( data, type, row, meta )=>{
  var data = '';
  let created_at= row.created_at!=null?row.created_at:"";
  let updated_at= row.updated_at!=null?row.updated_at:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Added On : </b>'+created_at+'</span><br>' ;
        data += '<span class="fotr_10"><b>Updated On : </b>'+updated_at+'</span>' ;
      
  }
return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
        output = '<a href="{{url(ADMINPATH."add-education?id=")}}' + row.id + '" class="btn btn-success btn-sm text-white " title="Edit State"><i class="fa fa-edit"></i></a> ';
    }
    return output;
}


   function status_render(data, type, row, meta) {
    if (type === 'display') {
        const isChecked = row.status === 'Active';
        const label = isChecked ? 'Active' : 'Inactive';
        const id = `tableswitch5${row.id}`;
        const onchange = `change_status(${row.id}, 'tbl_education_list')`;

        return `<div class="custom-control custom-switch">
                <input type="checkbox" onchange="${onchange}" ${isChecked ? 'checked' : ''} class="custom-control-input" id="${id}">
                <label class="custom-control-label" for="${id}" id="label_id${row.id}">${label}</label>
            </div> `;
    }
    return '';
}

</script>