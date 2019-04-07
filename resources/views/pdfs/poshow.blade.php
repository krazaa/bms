<!DOCTYPE html>
<html>
    <head>
<style>

html,body{
  padding: 0;
  margin: 0;
  width:  100%;
  background:  #fff;
  font-family: "Arial", Helvetica, sans-serif;
  font-size: 11px;
}


table {
   width: 700px;
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
              <b style="font-weight: normal; font-size: 14px;"><h3>Purchase Order {{ $d->company}}</b>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align:">Vendor Name: <b> {{ $d->company}} </b>
            	<br> Address: {{ $d->address }}
            	<br> Phone: {{ $d->contact }}
            </td>
            <td colspan="0" style="text-align: right; padding-left: 80px;">
              <b>PO N<sup>o</sup>: {{ $d->poid}}</b><br>
              <b>Reference N<sup>o</sup>: {{ $d->refno}}</b>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: right;"></td>
            <td colspan="0" style="text-align: right; padding-left: 80px;">
            <b>Date:</b> {{ date('d-m-Y', strtotime($d->podate))}}
            </td>
          </tr>
        </table>
        <table>
          <thead>
            <tr>
	            <th class="th" style="text-align: center;">#</th>
				<th class="th">Code</th>
				<th class="th">Product Name</th>
				<th class="th">Category</th>
				<th class="th" style="text-align: center;">Qty</th>
				<th class="th">Branch</th>	
            </tr>
          </thead>
          <tbody>
        	<?php $no=1 ?>
		@foreach ($data as $td)    
            <tr>
             	<td class="line-row" style="text-align: center;">{{$no++}}</td>
				<td class="line-row">{{ $td->code }}</td>
				<td class="line-row">{{ $td->name }}</td>
				<td class="line-row">{{ $td->category }} {{ $td->subcat }}</td>
				<td class="line-row" style="text-align: center;">{{ $td->qty }}</td>
				<td class="line-row">{{ $td->branch }}</td>
            </tr>
            @endforeach
        </tbody>
     </table>
</body>
</html>
