@extends ('front.main')

@section ('content')

<div id="maincontainer">
  <section id="product">
    <div class="container">
    <!--  breadcrumb -->  
      <ul class="breadcrumb">
        <li>
          <a href="#">Home</a>
          <span class="divider">/</span>
        </li>
        <li class="active">Checkout</li>
      </ul>
      <div class="row">    


        <!-- Account Login-->
        <div class="span9">

          <form class="form-horizontal" action="{{ URL::route('pay') }}" method="POST">

          {{ csrf_field() }}

          @if (isset($message))
            <div class="alert alert-success">
                <ul>
                    <li>{{ $message }}</li>
                </ul>
            </div>
          @endif
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <div class="checkoutsteptitle">Step 1 : Delivery Details<a class="modify">Modify</a>
          </div>

          <div class="checkoutstep">
            <div class="row">


                <fieldset>

                  <div class="span4">
                    <div class="control-group">
                      <label class="control-label" >First Name<span class="red">*</span></label>
                      <div class="controls">
                        <input type="text" class=""  value="" name="first_name">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" >Last Name<span class="red">*</span></label>
                      <div class="controls">
                        <input type="text" class=""  value="" name="last_name">
                      </div>
                    </div>

                    @if (empty($user))
                    <div class="control-group">
                      <label class="control-label" >E-Mail<span class="red">*</span></label>
                      <div class="controls">
                        <input type="text" class=""  value="" name="email">
                      </div>
                    </div>
                    @endif

                  </div>


                  <div class="span4">


                    <div class="control-group">
                      <label class="control-label" >Address<span class="red">*</span></label>
                      <div class="controls">
                        <input type="text" class=""  value="" name="address">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" >Post Code<span class="red">*</span></label>
                      <div class="controls">
                        <input type="text" class=""  value="" name="post_code">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" >Delivery Method<span class="red">*</span></label>
                      <div class="controls">
                        <select name="method">
                          <option value="0">Please Select</option>
                          <option value="3">Super Delivery</option>
                          <option value="2">Fast Delivery</option>
                          <option value="1">Normal Delevery</option>
                        </select>
                      </div>
                    </div>


                  </div>
                </fieldset>


 
            </div>
          </div>


          <div class="checkoutsteptitle">Step 2: Confirm Order<a class="modify">Modify</a>
          </div>
          <div class="checkoutstep">
            <div class="container">  
              <!-- Cart-->
            <div class="cart-info">
              <table class="table table-striped table-bordered">

                {{-- Cart Head --}}
                <tr>
                  <th class="rowId"></th>
                  <th class="image">Image</th>
                  <th class="name">Product Name</th>
                  <th class="model">Model</th>
                  <th class="quantity">Qty</th>
                    <th class="total">Action</th>
                  <th class="price">Unit Price</th>
                  <th class="tax">Tax</th>
                  <th class="total">Total</th>
                </tr>

                {{-- Cart Information --}}
                @foreach ($carts as $cartItem)
                <tr>

                  <td class="rowId">{{ $cartItem->rowId }}</td>

                  <td class="image">
                  <a href="{{ URL::route('products::', $cartItem->id) }}">
                  @if ($cartItem->photo != null)
                  <img class="media-object img-responsive" title="product" alt="product" src="{!! URL::route('get_photo', $cartItem->photo) !!}" height="50" width="50">
                  @else 
                  <img class="media-object img-responsive" title="product" alt="product" src="{{ URL::asset('web_assets/img/product1.jpg') }}" height="50" width="50">
                  @endif
                  </a></td>


                  <td  class="name"><a href="{{ URL::route('products::', $cartItem->id)}}">{{ $cartItem->product_name }}</a></td>
                  <td class="model">Purchased Product</td>
                  <td class="quantity"><input type="text" size="1" value="{{ $cartItem->qty }}" name="quantity[]" class="span1">
                   </td>

                  {{-- Action Update or remove --}}
                   <td class="total"> 

                    <a class="update-cart" href="#"><img class="tooltip-test" data-original-title="Update" src="{{ URL::asset('web_assets/img/update.png') }}" alt=""></a>
                    <a href="{{ URL::route('cart_remove', $cartItem->rowId) }}"><img class="tooltip-test" data-original-title="Remove" src="img/remove.png" alt=""></a></td>
                 
                   
                  <td class="price">{{ $cartItem->price }}</td>
                  <td class="tax">{{ $cartItem->tax }}</td>
                  <td class="total">{{ $cartItem->total }}</td>
                   
                </tr>
                @endforeach
              </table>
            </div>
            
            <div class="container">

              <div class="pull-right">

                <div class="span4 pull-right">
                  <table class="table table-striped table-bordered ">
                    <tr>
                      <td><span class="extra bold">Sub-Total :</span></td>
                      <td><span class="bold">{{ Cart::subTotal() }}</span></td>
                    </tr>
                    <tr>
                      <td><span class="extra bold">Tax :</span></td>
                      <td><span class="bold">{{ Cart::tax() }}</span></td>
                    </tr>
                    <tr>
                      <td><span class="extra bold totalamout">Total :</span></td>
                      <td><span class="bold totalamout">{{ Cart::total() }}</span></td>
                    </tr>
                  </table>
                </div>

              </div>

            </div>

            <button type="submit" class="btn btn-orange pull-right">Checkout</button>
          </div>
        </div>
        </form>

        <!-- Sidebar Start-->
        <div class="span3">
          <aside>

            <div class="sidewidt">

              <h2 class="heading2"><span> Checkout Steps</span></h2>

              <ul class="nav nav-list categories">

                <li>
                  <a class="active" href="#">Checkout Options</a></li>

                <li>
                  <a href="#">Billing Details</a></li>

                <li>
                  <a href="#">Delivery Details</a></li>

                <li>
                  <a href="#">Delivery Method</a></li>

                <li>
                  <a href="#"> Payment Method</a></li>

              </ul>
              
            </div>
          </aside>
        </div>
        <!-- Sidebar End-->
      </div>


    </div>
  </section>
</div>

@stop