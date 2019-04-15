<!DOCTYPE html>
<html>
    <head>
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
  /*text-align: right;*/
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


</style>
</head>
<body>
	@foreach ($data as $d)
@endforeach
<div id="divide">
<div id="container">
      <div class="lenghth-limit">
        <table>
          <tr>
            {{-- <td style="padding-left: 40px; width: 50px;">
              <img src="{{ asset('fwmclogo.png') }}" class="imageaeu">
            </td> --}}
            <td class="aeu">
              <b style="font-weight: normal; font-size: 14px;"><h2>Goods Received Note</h2></b>
            </td>
          </tr>
          <tr>
            <td>
              Vendor Name: <b> {{ $d->company}} </b>
              <br> Address: {{ $d->address }}
              <br> Phone: {{ $d->contact }}
              <br> Transporter Name: {{ $d->transporter }}
              <br> Transportation: {{ number_format($d->totalcargo,2) }}</td>
            <td>
              P. Order N<sup>o</sup>: <b>{{ $d->poid}}</b><br>
              Delivery N<sup>o</sup>: <b>{{ $d->dno}}</b><br>
              Sales Tax Invoice N<sup>o</sup>: <b>{{ $d->stinv}}</b><br>
              PO Status: <b>Received</b><br>
              Payable - Vendor <b>{{ number_format($d->totalcost + $d->tax,2) }}</b><br>
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
        <th class="th">Qty</th> 
        <th class="th">Cost</th> 
        <th class="th">T. Cost</th> 
        <th class="th">Cargo</th> 
        <th class="th">P/U</th> 
        <th class="th">Ad Cost</th> 
        <th class="th">Ad T Cost</th> 
            </tr>
          </thead>
          <tbody>
        	<?php $no=1 ?>
		@foreach ($data as $td)    
      <tr>
        <td class="line-row" style="text-align: center;">{{$no++}}</td>
				<td class="line-row">{{ $td->code }}</td>
				<td class="line-row">{{ $td->name }}</td>
				<td class="line-row">{{ $td->manpartno }}</td>
        <td class="line-row">{{ $td->category }} {{ $td->subcat }}</td>
        <td class="line-row">{{ $td->qty }}</td>
        <td class="line-row">{{ $td->cost }}</td>
				<td class="line-row">{{ $td->cost * $td->qty }}</td>
        <td class="line-row">{{ $cost=$td->cargopu * $td->qty }}</td>
        <td class="line-row">{{ $td->cargopu }}</td>
        <td class="line-row">{{ $td->cargopu + $td->cost }}</td>
        <td class="line-row">{{ $td->cost * $td->qty + $td->cargopu }}</td>
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
            <td><b> {{ $data->sum('qty') }}</b></td>
            <td></td>
            <td><b>
              {{ number_format($td->totalcost,2) }}</b></td>
            <td><b>{{ number_format($td->qty * $td->totalcargo,2) }}</b> </td>
            <td></td>
            <td></td>
            <td>{{ number_format($td->atc,2) }}</td>
          </tr>
        </tfoot>
     </table>
     <table>
      <th with="400px">Accounts</th>
      <th with="200">Debit </th>
      <th with="200px">Credit </th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <tbody>
       <tr>
         <td width="200">Inventory 
         <td width="150">{{ number_format($td->totalcargo + $td->totalcost,2) }}</td>
         <td width="150"></td>
       </tr>
       <tr>
        <td>Income Tax </td>
        <td width="150">{{ number_format($td->tax,2) }}</td>
        <td width="150"></td>
       </tr>
       <tr>
        <td>Payable - Vendor</td>
        <td width="150"></td>
        <td width="150">{{ number_format($td->totalcost + $td->tax,2) }}</td>
       </tr>
       <tr>
        <td>Payable - Services</td>
        <td width="150"></td>
        <td width="150">{{ number_format($td->totalcargo,2) }}</td>
       </tr>
       </tbody>
       <tfoot>
         <tr>
           <td></td>
           <td><b>{{ number_format($td->totalcargo + $td->totalcost + $td->tax,2) }}</b></td>
           <td><b>{{ number_format($td->totalcargo + $td->totalcost + $td->tax,2) }}</b></td>
           <td><b>Posted By</b></td>
           <td><b>Store Incharge</b></td>
           <td><b>Approved By</b></td>
         </tr>
       </tfoot>
     </table>
</body>
</html>