<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

html,body{
  margin: 0;
  width:  100%;
  background:  #fff;
  font-family: "Arial", Helvetica, sans-serif;
  font-size: 11px;
}


table {
   width: 96%;
    margin: 0 auto;
    text-align: left;
    border-collapse: collapse;;
}

th { padding-left: 2px; }
    td {
    padding: 2px; 
  }

.aeu{
  /*text-align: center;*/
  padding-right: 10px;
  font-family: 'Helvetica';
}

.line-top{
  border-left: 1px solid;
  padding-left: 10px;
 font-family: 'Helvetica';
}

.verify
{
  font-family: 'Trebuchet MS', 'Arial', 'Helvetica';
}

.imageaeu{
  width: 50px; height: 40px;

}

.th
{
  background-color: #ddd;
  border:1px solid #ddd;
  text-align: left;
}

.line-row{
  background-color: #fff;
  border: 1px solid #ddd;
  text-align: left; 
}

/*.lenghth-limit{
  max-height: 350px;
  min-height: 350px;

}*/
#container{
  width: 100%;
  margin: 0 auto;
}

.fwmc-os{
  font-family: 'Helvetica, sans-serif'; 
}

.divide{
  width: 100%; margin: 0 auto;
}

hr{
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  padding: 0;
  margin-top: 20px;
  margin-bottom: 10px;
  border: 0 none;
  border-top: 1px dashed #322f32;
  background: none;
  height: 0; 
}
.company {
  margin: auto;
  width: 96%;
  text-align: center;
  padding: 10px;
}

</style>
</head>
<body>
	@foreach ($data as $d)
@endforeach
<div id="divide">
<div id="container">
      <div class="lenghth-limit">
        <div class="company">
        @foreach($setting as $com)@endforeach
              <h1>{{ $com->company }}</h1>
              <h2>Goods Received Note</h2>
            </div>
        <table>
          <tr>
            
            <td class="aeu">
            </td>
          </tr>
          <tr>
            <td>
              Vendor Name: <b> {{ $d->vendors->company}} </b>
              <br> Address: {{ $d->vendors->address }}
              <br> Phone: {{ $d->vendors->contact }}
              <br> Transporter Name: {{ $d->cvendors->company }}
              <br> Transportation: <b>{{ number_format($data->sum('cargo'),2) }}</b></td>
            <td>
              P. Order N<sup>o</sup>: <b>{{ $d->po_id}}</b><br>
              Delivery N<sup>o</sup>: <b>{{ $d->dno}}</b><br>
              Sales Tax Invoice N<sup>o</sup>: <b>{{ $d->stinv}}</b><br>
              PO Status: <b>Received</b><br>
              Payable - Vendor <b>{{ number_format($data->sum('totalcost') + $d->tax,2) }}</b><br>
            </td>
            <td>
              Order Date: <b>{{ date('d-m-Y', strtotime($d->podate)) }}</b><br>
              Dispatch Date: <b>{{ date('d-m-Y', strtotime($d->ddate)) }}</b><br>
              Receiving Date:  <b>{{ date('d-m-Y', strtotime($d->rdate)) }}</b><br>
              Due Date: <b>{{ date('d-m-Y', strtotime($d->duedate)) }}</b><br>
              Income Tax: <b>{{ number_format($d->tax,2) }}</b></td>
          </tr>
        </table>
        <table>
          <thead>
            <tr>
	            <th class="th" style="text-align: center;">#</th>
				<th class="th">Code</th>
				<th class="th">Product Name</th>
				<th class="th">MPN</th>
				<th class="th">Category</th>
        <th class="th" style="text-align: center;">Qty</th> 
        <th class="th" style="text-align: right;">Cost</th> 
        <th class="th" style="text-align: right;">T. Cost</th> 
        <th class="th" style="text-align: right;">Cargo</th> 
        <th class="th" style="text-align: right;">P/U</th> 
        <th class="th" style="text-align: right;">Ad Cost</th> 
        <th class="th" style="text-align: right;">Ad T Cost</th> 
            </tr>
          </thead>
          <tbody>
        	<?php $no=1 ?>
		@foreach ($data as $td)    
      <tr>
        <td class="line-row" style="text-align: center;">{{$no++}}</td>
				<td class="line-row" >{{ $td->products->code }}</td>
				<td class="line-row">{{ $td->products->name }}</td>
				<td class="line-row">{{ $td->products->manpartno }}</td>
        <td class="line-row">{{ $td->products->cats->category }} </td>
        <td class="line-row" style="text-align: center;">{{ $td->qty }}</td>
        <td class="line-row" style="text-align: right;">{{ $td->cost }}</td>
				<td class="line-row" style="text-align: right;">{{number_format($costs = $td->cost * $td->qty,2) }}</td>
        <td class="line-row" style="text-align: right;">{{number_format( $cost=$td->cargopu * $td->qty,2) }}</td>
        <td class="line-row" style="text-align: right;">{{ number_format($td->cargopu,2) }}</td>
        <td class="line-row" style="text-align: right;">{{ number_format( $ad=$td->cargopu + $td->cost,2) }}</td>
        <td class="line-row" style="text-align: right;">{{ number_format($ad * $td->qty,2) }}</td>
      </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center;"><b> {{ $data->sum('qty') }}</b></td>
            <td></td>
            <td style="text-align: right;"><b>{{ number_format($data->sum('totalcost') ,2) }}</b>
            <td style="text-align: right;"><b>{{ number_format($data->sum('cargo'),2) }}</b> </td>
            <td></td>
            <td></td>
            <td style="text-align: right;"><b>{{ $inv=number_format($data->sum('atc') + $data->sum('cargo'),2) }}</b></td>
          </tr>
        </tfoot>
     </table>
     <table>
      <thead>
        <tr>
      <th with="300px">Accounts</th>
      <th with="200px">Debit </th>
      <th with="200px">Credit </th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
      </thead>
      <tbody>
       <tr>
         <td>Inventory</td>
         <td width="150px">{{ $inv }} </td>
         <td width="150px"></td>
       </tr>
       <tr>
        <td width="150px">Income Tax</td>
        <td width="150px">{{ number_format($td->tax,2) }} </td>
        <td width="150px"></td>
       </tr>
       <tr>
        <td>Payable - Vendor</td>
        <td width="150px"></td>
        <td width="150px">{{ number_format($data->sum('totalcost') + $td->tax,2) }}</td>
       </tr>
       <tr>
        <td>Payable - Services</td>
        <td width="150px"></td>
        <td width="150px">{{ number_format($data->sum('cargo'),2) }}</td>
       </tr>
       </tbody>
       <tfoot>
         <tr>
           <td></td>
           <td><b>{{ number_format($td->totalcargo + $data->sum('totalcost') + $td->tax,2) }}</b></td>
           <td><b>{{ number_format($td->totalcargo + $data->sum('totalcost') + $td->tax,2) }}</b></td>
           <td><b>Posted By</b></td>
           <td><b>Store Incharge</b></td>
           <td><b>Approved By</b></td>
         </tr>
       </tfoot>
     </table>
 </div>
</body>
</html>