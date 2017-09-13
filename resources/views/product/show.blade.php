@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-xs-12">
	<div class="card-box product-detail-box">
	   <div class="row">
	       <div class="col-sm-4">
                @foreach ($product->images as $image)
                @if ($image->is_main_image)
                    <img src="{!! $image->path->medUrl !!}" alt="Preview image">
                    @php
                        break;
                    @endphp
                @endif
                @endforeach
	       </div>
	       <div class="col-sm-8">
	           <div class="product-right-info">
	               <h1><b>{{ $product->name }}</b></h1>
	               <h3>
	                   <b>$ {{ number_format($product->price, 2, '.', '') }}</b>
	                   <small class="text-muted m-l-10"><del>$62</del> </small>
	               </h3>
	               <span class="label label-default m-l-5">In Stock</span>
	               <hr/>
	               <h5 class="font-600">Product Description</h5>

	               <p class="text-muted">{!! $product->description !!}</p>
	               <div class="m-t-30">
	                   <button type="button" class="btn btn-danger waves-effect waves-light m-l-10">
	                     <span class="btn-label"><i class="fa fa-shopping-cart"></i>
	                   </span>Buy Now</button>
	               </div>
	           </div>
	       </div>
	   </div>
	   <!-- end row -->

	   <div class="row m-t-30">
	       <div class="col-xs-12">
	           <h4><b>Specifications:</b></h4>
	           <div class="table-responsive m-t-20">
	               <table class="table">
	                   <tbody>
	                   @foreach ($attributes as $attribute)
	                       <tr>
	                           <td width="400">{{ $attribute->name }}</td>
	                           <td>
	                               {{ $attribute->value }}
	                           </td>
	                       </tr>
	                   @endforeach
	                   </tbody>
	               </table>
	           </div>
	       </div>
	   </div>


	</div> <!-- end card-box/Product detai box -->
	</div> <!-- end col -->
</div>
@endsection
