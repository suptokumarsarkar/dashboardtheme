@extends("layout.app")
@section("title","Admin Portal")
@section("active","withdrawal")
@section("content")
<article>
<header style="overflow: hidden;">
	<div class="row">
		<div class="col-4">
			<input onkeyup="load_user(1)" id="searches"  placeholder="Search" class="form-control">
		</div>
		<div class="col-4">
			<select onchange="load_user(1)" id="type" class="form-control">
				<option value="">--Status--</option>
				<option value="">All</option>
        		<option value="pending" selected="">pending</option>
        		<option value="approved">approved</option>
            <option value="declined">declined</option>
			</select>
		</div>
		<div class="col-4">
	<a href="{{ url('/admin/createidwithdrawal') }}" class="btn btn-info float-right">Create ID Withdrawal</a>
  <a href="{{ url('/admin/withdral') }}" class="btn btn-warning float-right">Wallet Withdrawal</a>

{{-- 	<a href="{{ url('/admin/addconfigure') }}" class="btn btn-danger float-right">Add Exchange Type</a>
  <a href="{{ url('/admin/plan') }}" class="btn btn-success float-right">Add Plan</a> --}}
		</div>
	</div>
</header>
<section class="user_view">
	
</section>
</article>
@endsection
@section("script")
<style>
.page-content .grid > article:first-child {
    grid-column: 1 / -1;
    display: block;
}
.card-view {
  margin:2px;
  padding: 5px;
  border: 1px solid #ccc;
  animation: .4s moving;
}
@keyframes moving {
    from{
      margin-top: 30px;
    }
}
</style>

<script>
  $(document).ready(function() {
    load_user(1);
  });
  function dp_fun(page){
    load_user(page);
  }
  function load_user(page){
    $.ajax({
      url: '{{ url('/admin/idload_withdraw') }}',
      type: 'POST',
      data: {page: page, search: $("#searches").val(),type: $("#type").val(), _token:'{{csrf_token()}}'},
    })
    .done(function(data) {
     var d = JSON.parse(data);
      var body =  `<div class="row" style="text-align: center;">
        <div class="col-3" style='padding-top: 15px;'>
        <h5>User</h5>
        </div>
        <div class="col-2" style='padding-top: 15px;'>
        <h5>Gateway Info</h5>
        </div>
        <div class="col-2" style='padding-top: 15px;'><h5>Details</h5>
        </div>
        <div class="col-2" style='padding-top: 15px;'><h5>Status</h5>
        </div>
        <div class="col-3" style='padding-top: 15px;'><h5>Options</h5></div></div>`;
      for (var i = 0; i < d[0].length; i++) {
        var row = d[0][i];
        body+=`

        <div class="card-view row acd`+row['id']+`">
        <div class="col-3">
        <h4>Name : `+row['username']+`</h4>
        <h4>Phone: `+row['phone']+`</h4>
        <h4>ID balance: `+row['balance']+`</h4>
        <h4>Wallet: `+row['wallet']+`</h4>
        </div>
        <div class="col-2 center" style='padding-top: 15px;'>
        <h5>withdraw to: `+row['deposittype']+`</h5>
        <h5><pre style='color: white'>`+row['gatewayinfo']+`</pre></h5>
        </div>
        <div class="col-2 center" style='padding-top: 15px;'>
        <h5>ID: `+row['depositid']+`</h5>
        <h5>Amount: `+row['amount']+`</h5>
        <h5>Currency: `+row['currency']+`</h5>
        </div>
        <div class="col-2 center" style='padding-top: 15px;'>
        <h2 class='badge badge-info p-2'>`+row['status']+`</h2>
        </div>

        <div class="col-3 right" style='padding-top: 15px;'>
        `;

        if(row['status']!='approved'){
body+=`
<button onclick='edit(`+row['id']+`)' class='btn btn-success'>Approve</button>`;
        }
        if(row['status']!='declined'){
body+=`
<button onclick='decline(`+row['id']+`)' class='btn btn-info'>Decline</button>`;
        }
      body+=`
<button onclick='details(`+row['id']+`)' class='btn btn-primary'>View</button>
<button onclick='deletes(`+row['id']+`)' class='btn btn-danger'>Delete</button>

        </div>
        </div>


        `;
        }
        $page = d[1][1];
      $total = d[1][0];
      $limit = d[1][2];
      if (d[0]!='') {
        body+=generate_pagination($total, $page, $limit, "dp_fun");
      }
       $(".user_view").html(body);
    })
    .fail(function() {
      $(".user_view").html("Network error!");
    })    
  }
  function edit(id)
  {
   if (confirm("Are you sure you want to approve the withdrawal request?")) {
    $.ajax({
      url: '{{ url('/admin/idaddwithdrawalrequestapprove') }}',
      type: 'POST',
      data: {id: id,_token:"{{csrf_token()}}"},
    })
    .done(function(data) {
      $(".acd"+id).fadeOut('slow');
    });
  }
  }


  function decline(id)
  {
   window.location = '{{ url('/admin/declinewithdrawal/') }}/'+id;
  }
  function details(id)
  {
   window.location = '{{ url('/admin/withdrawal/') }}/'+id;
  }

function fc_this(th,id){
		$.ajax({
			url: '{{ url('/admin/statuschanger') }}',
			type: 'POST',
			data: {id: id,_token:"{{csrf_token()}}"},
		})
		.done(function(data) {
		});
}
function deletes(id){
  if (confirm("Are you sure you want to delete the withdrawal request?\nIf you delete it, it will be removed with the amount.")) {
    $.ajax({
      url: '{{ url('/admin/deletewithdrawal') }}',
      type: 'POST',
      data: {id: id,_token:"{{csrf_token()}}"},
    })
    .done(function(data) {
      $(".acd"+id).fadeOut('slow');
    });
  }
}
$('#toggle-demo').bootstrapToggle();

</script>

@endsection