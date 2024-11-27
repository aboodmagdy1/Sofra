@extends('layouts.master')
@section('title','Order  Details')
@section('page-header','Order  Details')
@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-utensils"></i> {{$record->restaurant->name}}
                  <small class="float-right">Orderd At : {{$record->created_at->toDateString()}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info d-flex justify-between">
             
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <address>
                  <strong>Order Info :</strong><br>
                  Total Items : {{$record->meals()->count()}}<br>
                  Client Email : {{$record->client->email}}<br>
                  address : {{$record->address}}<br>
                  Average Rate : {{$record->avg_rate}}<br>
                </address>
              </div>


              <div class="col-sm-4 invoice-col ">
                
                <address>
                  <strong>Business Info: </strong><br>
                 Cost :  {{$record->cost}}<br>
                 Commision :  {{$record->commission_price}}<br>
                 Delivery Cost:  {{$record->delivery_price}}<br>
                 Total Price:  {{$record->total_price}}<br>
                 net : {{$record->net}}<br>
                </address>
              </div>

              <div class="col-sm-4 invoice-col">
                <address>
                  <strong>Status :</strong><br>
                  <span class="badge badge-primary">{{App\Enums\OrderStatus::from($record->status)->label()}}</span>
                </address>
              </div>

            </div>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>description  #</th>
                    <th>total</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($record->meals as $meal)
                    <tr>
                      <td>{{$meal->pivot->quantity}}</td>
                      <td>{{$meal->name}}</td>
                      <td>{{$meal->price}}</td>
                      <td>{{$meal->description}}</td>
                      <td>{{ $meal->pivot->quantity * $meal->pivot->price  }}</td>

                    </tr>
                    
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row no-print">
        <div class="col-12">
          <a href="{{route('admin.orders.print',$record->id)}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>        
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


